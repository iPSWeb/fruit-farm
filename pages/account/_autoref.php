<?PHP
/*
 * Модуль Автореферал для Фруктовой Фермы
 * Author: pligin
 * Site: psweb.ru
 * Telegram: t.me/pligin
 */
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Автореферал';
# Настройки
$cost = 100; // Стоимость покупки услуги "Автореферал" на сутки
$ac = 'p'; // Счет для оплаты
$min_term = 3;//Минимальное количество дней
$ac_array = array('b' => 'покупок','p' => 'вывода');
$msg = '';
if(isset($_POST['buy'])){
    $term = intval($_POST['term']);
    if($term < $min_term){
        $msg = '<font color="red">Минимальное количество дней '. $min_term.'</font>';
    }else{
        $total = $term * $cost;
    }
    if(empty($msg) && $user_data['money_'.$ac] < $total){
        $msg = '<font color="red">У Вас недостаточно средств на счете для '.$ac_array[$ac].'</font>';
    }
    if(empty($msg)){
        $db->Query("SELECT COUNT(`id`) FROM `db_autoref` WHERE `user_id` = '$user_id' AND `status` = '1'");
        if($db->FetchRow() > 0){
            $msg = '<font color="red">У Вас еще действует услуга. Дождитесь ее окончания</font>';
        }
    }
    if(empty($msg)){
        $date = new DateTime();
        $date->modify('+'.$term.' day');
        $end = $date->format('Y-m-d H:i:s');
        $db->Query("UPDATE `db_users_b` SET `money_".$ac."` = `money_".$ac."` - '$total' WHERE `id` = '$user_id'");
        $db->Query("INSERT INTO `db_autoref` (`user_id`,`cost`,`term`,`end`,`status`) VALUES ('$user_id','$cost','$term','$end',1)");
        $msg = '<font color="green">Вы успешно активировали услугу</font>';
    }
}
?>
<div class="s-bk-lf">
    <div class="acc-title">{!TITLE!}</div>
</div>
<div class="silver-bk">
<b>Автореферал</b> - это услуга, после покупки которой Вам будут отдаваться рефералы, которые пришли без приглашения.<br>
Стоимость услуги - <?=$cost;?> серебра со счета для <?=$ac_array[$ac];?> <br>
Минимальное количество дней - <?=$min_term;?>
<BR /><BR />
<center>
    <?=!empty($msg)?$msg:'';?>
    <form action="" method="POST">
        Введите количество дней<br>
        <input type="number" name="term" value="<?=$min_term;?>" min="1" max="99"><br><br>
        <button name="buy">Купить</button>
    </form>
</center>
<div class="clr"></div>	
</div>