<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
if(!empty($_COOKIE['referer'])){
    $referer_id = intval($_COOKIE['referer']);
    $db->Query("SELECT `text` FROM `db_welcomText` WHERE `user_id` = '$referer_id'");
    if($db->NumRows() == 1){
        echo htmlspecialchars_decode($db->FetchRow());
    }
}
?>
<div class="wim">Как это работает?</div>
<div class="wim-block">
	<div class="wim-lf"></div>
	<div class="wim-ctr">
		Закупаете фрукты
		<div class="wim-ctr-in"></div>
		Получаете прибыль
	</div>
	<div class="wim-rg"></div>
</div>
<div class="clr"><br /></div>	
<div class="wim">Гарантии?</div>
<div class="garant-bk">
	<i style="background-position:top left;"></i>
	Резервный фонд
</div>
<div class="garant-bk">
	<i style="background-position:top center;"></i>
	Окупаемость
</div>
<div class="garant-bk">
	<i style="background-position:top right;"></i>
	Выгодные условия
</div>
<div class="garant-bk">
	<i style="background-position:left bottom;"></i>
	Cтабильность
</div>
<div class="garant-bk">
	<i style="background-position:bottom center;"></i>
	Тех. поддержка
</div>
<div class="garant-bk">
	<i style="background-position:right bottom;"></i>
	Прозрачность системы
</div>