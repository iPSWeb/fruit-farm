<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
?>
<div class="s-bk-lf">
	<div class="acc-title">История обменов обменника</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP
$tdadd = time() - 24*60;
if(isset($_POST['clean'])){
    $pdo->query("DELETE FROM `db_swap_ser` WHERE `date_add` < '$tdadd'");
    echo '<center><font color = "green"><b>Очищено</b></font></center><BR />';
}
$result=$pdo->query("SELECT * FROM `db_swap_ser` ORDER BY `id` DESC");
if($result->rowCount() > 0){
?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
    <tr bgcolor="#efefef" class="m-tb">
        <td align="center" width="50" class="m-tb">ID</td>
        <td align="center" class="m-tb">Пользователь</td>
        <td align="center" width="75" class="m-tb">Отдал</td>
        <td align="center" width="75" class="m-tb">Получил</td>
        <td align="center" width="150" class="m-tb">Дата операции</td>
    </tr>
<?PHP
	while($data = $result->fetch()){
	?>
    <tr class="htt">
        <td align="center" width="50"><?=$data['id']; ?></td>
        <td align="center"><?=$data['user']; ?></td>
        <td align="center" width="75"><?=$data['amount_p']; ?></td>
	<td align="center" width="75"><?=$data['amount_b']; ?></td>
	<td align="center" width="150"><?=date('d.m.Y в H:i:s',$data['date_add']); ?></td>
    </tr>
	<?PHP
	}
?>
</table>
<BR />
<form action="" method="post">
<center><input type="submit" name="clean" value="Очистить" /></center>
</form>
<?PHP
}else{
    echo '<center><b>Записей нет</b></center><BR />';
}
?>
<div class="clr"></div>
</div>	