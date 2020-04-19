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
$isset = false;
$db->Query("SELECT * FROM `db_autoref` WHERE `user_id` = '$user_id' AND `status` = '1'");
if($db->NumRows() > 0){
    $data = $db->FetchArray();
    $msg = '<font color="red">У Вас еще действует услуга. Дождитесь ее окончания.<br>Дата окончания '.$data['end'].'</font>';
    $isset = true;
}
if(isset($_POST['buy']) && $isset === false){
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
        $msg = '<font color="green">Вы успешно активировали услугу.<br>Дата окончания '.$end.'</font>';
        $isset = true;
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
    <?PHP
    if($isset === false){
    ?>
    <?=!empty($msg)?$msg:'';?>
    <form action="" method="POST">
        Введите количество дней<br>
        <input type="number" name="term" value="<?=$min_term;?>" min="1" max="99"><br><br>
        <button name="buy">Купить</button>
    </form>
    <?PHP
    }else{
        echo $msg;
    }
    ?>
    <br><br>
    <table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
        <tr>
            <td colspan="5" align="center"><h4>Последние 20 покупок</h4></td>
        </tr>
        <tr>
            <td align="center" class="m-tb">Пользователь</td>
            <td align="center" class="m-tb">Количество дней</td>
            <td align="center" class="m-tb">Дата покупки</td>
            <td align="center" class="m-tb">Дата окончания</td>
        </tr>
  <?PHP
  $db->Query("SELECT `db_autoref`.*,`db_users_a`.`user` FROM `db_autoref`,`db_users_a` WHERE `db_autoref`.`status` = '1' AND `db_autoref`.`user_id` = `db_users_a`.`id` LIMIT 20");
	if($db->NumRows() > 0){
  		while($data = $db->FetchArray()){
		?>
		<tr class="htt">
                    <td align="center"><?=$data['user']; ?></td>
                    <td align="center"><?=$data['term']; ?></td>
                    <td align="center"><?=$data['timestamp']; ?></td>
                    <td align="center"><?=$data['end']; ?></td>
  		</tr>
		<?PHP
		}
	}else{
            echo '<tr><td align="center" colspan="4">Нет записей</td></tr>';
        }
  ?>
</table>
</center>
<div class="clr"></div>	
</div>