<?php
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Выплаты';
$status_array = array( 0 => "Проверяется", 1 => "Выплачивается", 2 => "Отменена", 3 => "Выплачено");
$page = (isset($_GET['page']) && intval($_GET['page']) < 1000 && intval($_GET['page']) >= 1) ? (intval($_GET['page'])-1) : 0;
$lim = $page * 10;
$db->Query("SELECT COUNT(`id`) FROM `db_payment` WHERE `status` = '0' OR `status` = '1'");
$count_rows = $db->FetchRow();
?>
<div class="s-bk-lf">
    <div class="acc-title">Заказ выплат на Payeer</div>
</div>
<div class="silver-bk"><div class="clr"></div>
<?php
if(!empty($_POST['status'])){
    $status = intval($_POST['status']);
    $payment_id = intval($_POST['id']);
    if($status == 3){
        $db->Query("SELECT `user_id`, `sum`, `comission` FROM `db_payment` WHERE `id` = '$payment_id'");
        $data = $db->FetchArray();
        $user_id = $data['user_id'];
        $amount = $data['sum'] - $data['comission'];
            $db->Query("UPDATE `db_users_b` SET `payment_sum` = `payment_sum` + '$amount' WHERE `id` = '$user_id'");
            $db->Query("UPDATE `db_stats` SET `all_payments` = `all_payments` + '$amount' WHERE `id` = '1'");
            echo '<center><font color="green"><b>Выплата успешно произведена.</b></font></center>';
    }elseif($status == 2){
        $db->Query("SELECT `user_id`,`serebro` FROM `db_payment` WHERE `id` = '$payment_id'");
        $data = $db->FetchArray();
        $user_id = $data['user_id'];
        $serebro = $data['serebro'];
        $db->Query("UPDATE `db_users_b` SET `money_p` = `money_p` + '$serebro' WHERE `id` = '$user_id'");
        echo '<center><font color="green"><b>Заявка успешно отменена.</b></font></center>';
    }
    $db->Query("UPDATE `db_payment` SET `status`='$status' WHERE `id`= '$payment_id'");
}
?>
<table class="table table-striped table-bordered text-center" width="100%" cellspacing="0">
    <thead>
        <th style="padding: 5px;text-align: center;"><b>Логин</b></th>
        <th style="padding: 5px;text-align: center;"><b>Серебро</b></th>
        <th style="padding: 5px;text-align: center;"><b>Рублей</b></th>
        <th style="padding: 5px;text-align: center;"><b>Кошелек</b></th>
        <th style="padding: 5px;text-align: center;"><b>Дата</b></th>
        <th style="padding: 5px;text-align: center;"><b>Статус</b></th>
        <th style="padding: 5px;text-align: center;"><b>Управление</b></th>
    </thead>
    <tbody>
    <?PHP
    $db->Query("SELECT * FROM `db_payment` WHERE `status` = '0' OR `status` = '1' ORDER BY `date_add` DESC LIMIT {$lim}, 10");
    if($db->NumRows() > 0){
        while($data = $db->FetchArray()){
    ?>
        <tr align="center" class="ltb">
            <td style="padding: 5px;"><a href="/admin/users/edit/<?=$data['user_id']; ?>"><?=$data['user']; ?></a></td>
            <td style="padding: 5px;"><?=$data['serebro']; ?></td>
            <td style="padding: 5px;"><?=$data['sum']-$data['commission']; ?></td>
            <td style="padding: 5px;"><?=$data['purse']; ?></td>
            <td style="padding: 5px;"><?=date('H:i d.m.Y',$data['date_add']); ?></td>
            <td style="padding: 5px;"><?=$status_array[$data['status']]; ?></td>
            <td style="padding: 5px;">

                <form action="" method="post">
                    <input type="hidden" name="id" value="<?=$data['id'];?>">
                    <select name="status">
                        <option value="0">Проверяется</option>
                        <option value="1">Выплачивается</option>
                        <option value="2">Отменить</option>
                        <option value="3">Выплачено</option>
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
        echo '<BR /><center>'.$nav->Navigation(10, $page, ceil($count_rows / 10), '/admin/payment_manual/page/'), '</center>';
    }?>
</div><div class="clr"></div>