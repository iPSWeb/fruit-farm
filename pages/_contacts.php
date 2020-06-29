<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Контакты';
$_OPTIMIZATION['description'] = 'Связь с администрацией';
$_OPTIMIZATION['keywords'] = 'Связь с администрацией проекта';
?>
<div class="s-bk-lf">
	<div class="acc-title">Контакты</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP
$result = $pdo->query("SELECT `contacts` FROM `db_conabrul` WHERE `id` = '1'");
$xt = $result->fetchColumn();
echo $xt;
?>
</div>
<div class="clr"></div>	
