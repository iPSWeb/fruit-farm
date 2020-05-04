<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Партнерская программа';
$db->Query("SELECT COUNT(*) FROM `db_users_a` WHERE `referer_id` = '$user_id'");
$refs = $db->FetchRow();
$ac_array = array('b' => 'покупок','p' => 'вывода');
$costText = '';
$text = '';
$isset = false;
if($config->costWelcomeText > 0){
    $costText = '(Стоимость '.$config->costWelcomeText.' сер. со счета для '.$ac_array[$config->accountWelcomeText].')';
}
$db->Query("SELECT `text` FROM `db_welcomText` WHERE `user_id` = '$user_id'");
if($db->NumRows() == 1){
    $text = $db->FetchRow();
    $isset = true;
}
?>
<script type="text/javascript" src="/assets/js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="s-bk-lf">
	<div class="acc-title">{!TITLE!}</div>
</div>
<div class="silver-bk">
Приглашайте в игру своих друзей и знакомых, Вы будете получать 10% от каждого пополнения баланса  
приглашенным Вами человеком. Доход ни чем не ограничен. Даже несколько приглашенных могут 
принести вам более 100 000 серебра. 
Ниже представлена ссылка для привлечения и количество приглашенных Вами людей.<br /><br />
<img src="/assets/style/img/piar-link.png" style="vertical-align:-2px; margin-right:5px;" /><font color="#000;">http://<?=$_SERVER['HTTP_HOST']; ?>/?i=<?=$_SESSION["user_id"]; ?></font>
<BR /><BR />
<?PHP
if(isset($_POST['save']) && !empty($_POST['text']) && $_POST['text'] != '<br>'){
    $text = htmlspecialchars(strip_tags($_POST['text'],'<br><b><font><p><div><h1><h2><h3><h4><h5><h6><pre><ol><li>'));
    if($isset === false){
        if($user_data['money_'.$config->accountWelcomeText] >= $config->costWelcomeText){
            $db->Query("INSERT INTO `db_welcomText` (`user_id`,`text`) VALUES ('$user_id','$text')");
            $db->Query("UPDATE `db_users_b` SET `money_".$config->accountWelcomeText."` = `money_".$config->accountWelcomeText."` - '".$config->costWelcomeText."' WHERE `id` = '$user_id'");
            $isset = true;
            echo '<center><b><font color = "green">Приветственное сообщение добавлено!</font></b></center><BR />';
        }else{
            echo '<center><b><font color = "red">У Вас недостаточно средств!</font></b></center><BR />';
        }
    }elseif($isset === true){
        $db->Query("UPDATE `db_welcomText` SET `text` = '$text' WHERE `user_id` = '$user_id'");
        echo '<center><b><font color = "green">Приветственное сообщение обновлено!</font></b></center><BR />';
    }
}
if(isset($_POST['delete'])){
    $db->Query("DELETE FROM `db_welcomText` WHERE `user_id` = '$user_id'");
    $text = '';
    $isset = false;
}
?>
<form action="" method="post">
    <b>Приветственное сообщение:</b> <?=$costText;?><BR /><BR />
    <textarea name="text" cols="70" rows="5"><?=(isset($_POST['text'])) ? $_POST['text'] : $text; ?></textarea><BR />
    <center><input type="submit" name="save" value="Сохранить" /></center>
</form>
<?PHP
if($isset){?>
    <form action="" method="post"><center><input type="submit" name="delete" value="Удалить" /></center></form>
<?PHP
}
?>
<p><center>Количество ваших рефералов: <font color="#000;"><?=$refs; ?> чел.</font></center></p>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width='98%'>
<tr height='25' valign=top align=center>
	<td class="m-tb"> Логин </td>
	<td class="m-tb"> Дата регистрации </td>
	<td class="m-tb"> Доход от партнера </td>
</tr>
<?PHP
  $all_money = 0;
  $db->Query("SELECT db_users_a.user, db_users_a.date_reg, db_users_b.to_referer FROM db_users_a, db_users_b 
  WHERE db_users_a.id = db_users_b.id AND db_users_a.referer_id = '$user_id' ORDER BY to_referer DESC");
	if($db->NumRows() > 0){
  		while($ref = $db->FetchArray()){
		?>
		<tr height="25" class="htt" valign="top" align="center">
			<td align="center"> <?=$ref["user"]; ?> </td>
			<td align="center"> <?=date("d.m.Y в H:i:s",$ref["date_reg"]); ?> </td>
			<td align="center"> <?=sprintf("%.2f",$ref["to_referer"]); ?> </td>
		</tr>
		<?PHP
		$all_money += $ref["to_referer"];
		}
	}else{
            echo '<tr><td align="center" colspan="3">У вас нет рефералов</td></tr>';
        }
  ?>
</table>
<div class="clr"></div>	
</div>