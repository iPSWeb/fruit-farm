<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION["title"] = "Правила";
$_OPTIMIZATION["description"] = "Общие правила проекта";
$_OPTIMIZATION["keywords"] = "Правила, помятка пользователя, правила проекта";
?>
<div class="s-bk-lf">
	<div class="acc-title">Правила проекта</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP
$result = $pdo->query("SELECT `rules` FROM `db_conabrul` WHERE `id` = '1'");
$xt = $result->fetchColumn();
echo $xt;
?>
</div>
<div class="clr"></div>	
