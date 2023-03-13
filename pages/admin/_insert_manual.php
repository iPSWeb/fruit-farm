<?php
/*
 * Модуль Ручные пополнения для Фруктовой Фермы
 * Author: pligin
 * Site: psweb.ru
 * Telegram: t.me/pligin
 */

if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
if (!defined('PSWebAdmin') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Выплаты';
$status_array = array( 0 => "Проверяется", 1 => "Зачислено", 2 => "Отменено");
$page = (isset($_GET['page']) && intval($_GET['page']) < 1000 && intval($_GET['page']) >= 1) ? (intval($_GET['page'])-1) : 0;
$lim = $page * 10;
$result = $pdo->query("SELECT * FROM `db_payeer_insert` WHERE `status` = '0' AND `description`='Payeer'");
$count_rows = $result->rowCount();
?>
<div class="s-bk-lf">
    <div class="acc-title">Заявки пополнения на Payeer</div>
</div>
<div class="silver-bk"><div class="clr"></div>
<?php
if(!empty($_POST['status'])){
    $status = intval($_POST['status']);
    $insert_id = intval($_POST['id']);
    if($status == 1){
        $result = $pdo->prepare("SELECT `user_id`, `sum` FROM `db_payeer_insert` WHERE `id` = :id");
        $result->execute(array('id'=>$insert_id));
        $data = $result->fetch();
        $user_id = $data['user_id'];
        $result = $pdo->prepare("SELECT * FROM `db_users_a`, `db_users_b` WHERE `db_users_a`.`id` = `db_users_b`.`id` AND `db_users_a`.`id` = :user_id");
        $result->execute(array('user_id'=>$user_id));
        $user_data = $result->fetch();
        $user_name = $user_data['user'];
        $referer_id = $user_data['referer_id'];
        $amount = $data['sum'];
        $serebro = $db_config['ser_per_wmr'] * $amount;
        # Отчисления рефералу
        $to_referer = $serebro * $config->toRefererFromInsert / 100;
        # Зачисляем пользователю
        $result = $pdo->prepare("UPDATE `db_users_b` SET `money_b`=`money_b`+ :serebro,`to_referer`=`to_referer`+ :to_referer,`last_sbor` = :time,`insert_sum`=`insert_sum`+ :amount WHERE `id` = :user_id");
        $result->execute(array(
            'serebro' => $serebro,
            'to_referer'=>$to_referer,
            'time' => time(),
            'amount' => $amount,
            'user_id' => $user_id
        ));
        $result = $pdo->prepare("UPDATE `db_payeer_insert` SET `status` = :status WHERE `id` = :order_id");
        $result->execute(array(
            'status'=>1,
            'order_id'=>$insert_id
        ));
	# Зачисляем средства рефереру
        $result = $pdo->prepare("UPDATE `db_users_b` SET `money_b`=`money_b`+ :to_referer,`from_referals`=`from_referals`+ :from_referals WHERE `id` = :referer_id");
        $result->execute(array(
            'to_referer' => $to_referer,
            'from_referals' => $to_referer,
            'referer_id' => $referer_id
        ));
	# Статистика пополнений
        $da = time();
        $dd = $da + 60*60*24*15;
        $result = $pdo->prepare("INSERT INTO db_insert_money (`user`,`user_id`,`money`,`serebro`,`date_add`,`date_del`) VALUES (:user_name,:user_id,:amount,:serebro,:da,:dd)");
        $result->execute(array(
            'user_name' => $user_name,
            'user_id' => $user_id,
            'amount' => $amount,
            'serebro' => $serebro,
            'da' => $da,
            'dd' => $dd
        ));
	# Обновление статистики сайта
        $pdo->query("UPDATE `db_stats` SET `all_insert` = `all_insert` + '$amount' WHERE `id` = '1'");
        echo '<center><font color="green"><b>Средсва успешно зачислены.</b></font></center>';
    }
    $result = $pdo->prepare("UPDATE `db_payeer_insert` SET `status`=:status WHERE `id`= :id");
    $result->execute(array('status'=>$status,'id'=>$insert_id));
}
?>
<table class="table table-striped table-bordered text-center" width="100%" cellspacing="0">
    <thead>
        <th style="padding: 5px;text-align: center;"><b>ID</b></th>
        <th style="padding: 5px;text-align: center;"><b>Логин</b></th>
        <th style="padding: 5px;text-align: center;"><b>Рублей</b></th>
        <th style="padding: 5px;text-align: center;"><b>№ транзакции</b></th>
        <th style="padding: 5px;text-align: center;"><b>Дата</b></th>
        <th style="padding: 5px;text-align: center;"><b>Статус</b></th>
        <th style="padding: 5px;text-align: center;"><b>Управление</b></th>
    </thead>
    <tbody>
    <?PHP
    $result = $pdo->prepare("SELECT * FROM `db_payeer_insert` WHERE `status` = '0' AND `description`='Payeer' ORDER BY `date_add` DESC LIMIT :lim, 10");
    $result->execute(array('lim'=>$lim));
    if($result->rowCount() > 0){
        while($data = $result->fetch()){
    ?>
        <tr align="center" class="ltb">
            <td style="padding: 5px;"><?=$data['id']; ?></td>
            <td style="padding: 5px;"><a href="/admin/users/edit/<?=$data['user_id']; ?>"><?=$data['user']; ?></a></td>
            <td style="padding: 5px;"><?=$data['sum']; ?></td>
            <td style="padding: 5px;"><?=$data['operation_id']; ?></td>
            <td style="padding: 5px;"><?=date('H:i d.m.Y',$data['date_add']); ?></td>
            <td style="padding: 5px;"><?=$status_array[$data['status']]; ?></td>
            <td style="padding: 5px;">

                <form action="" method="post">
                    <input type="hidden" name="id" value="<?=$data['id'];?>">
                    <select name="status">
                        <option value="0">Проверяется</option>
                        <option value="1">Зачислить</option>
                        <option value="2">Отменить</option>
                    </select>
                    <button type="submit">Изменить</button>
                </form>
            </td>
        </tr>
    <?PHP
        }
    }else{
        echo '<tr><td align="center" colspan="8">Заявок нет</td></tr>';
    }
    ?>
    </tbody>
</table>
    <?php
    if($count_rows > 10){
        $page = (isset($_GET['page']) AND intval($_GET['page']) < 1000 AND intval($_GET['page']) >= 1) ? (intval($_GET['page'])) : 1;
        $nav = new navigator;
        echo '<BR /><center>'.$nav->Navigation(10, $page, ceil($count_rows/10), '/admin/im/page/'), '</center>';
    }?>
</div><div class="clr"></div>