<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
?>
<div class="s-bk-lf">
	<div class="acc-title">О ферме</div>
</div>
<div class="silver-bk"><div class="clr"></div>	

<script type="text/javascript" src="/assets/js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<?PHP
if(isset($_POST['tx'])){
    $result=$pdo->prepare("UPDATE `db_conabrul` SET `about` = :about WHERE `id` = '1'");
    $result->execute(array('about'=>$_POST['tx']));
    echo '<center><font color = "green"><b>Сохранено</b></font></center><BR />';
}
$result=$pdo->query("SELECT * FROM `db_conabrul` WHERE id = '1'");
$data = $result->fetch();
?>
<form action="" method="post">
<textarea name="tx" cols="78" rows="25"><?=$data['about']; ?></textarea>
<BR /><BR />
<center><input type="submit" value="Сохранить" /></center>
</form>
</div>
<div class="clr"></div>	