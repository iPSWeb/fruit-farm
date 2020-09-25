<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Аккаунт';
# Блокировка сессии
if(!isset($_SESSION['user_id'])){ Header('Location: /'); return; }
$user_id = $_SESSION['user_id'];
$result = $pdo->prepare("SELECT * FROM `db_users_a`, `db_users_b` WHERE `db_users_a`.`id` = `db_users_b`.`id` AND `db_users_a`.`id` = :user_id");
$result->execute(array('user_id'=>$user_id));
$user_data = $result->fetch();
if($user_data['ip']!= $func->IpToInt($func->UserIP)){ @session_destroy(); Header('Location: /'); return; }
if($user_data['banned']){ @session_destroy(); Header('Location: /'); return; }
$user_name = $user_data['user'];
include(BASE_DIR.'/inc/_autosbor.php');
if(isset($_GET['sel'])){	
	$smenu = strval($_GET['sel']);		
	switch($smenu){
		case '404': include(BASE_DIR.'/pages/_404.php'); break; // Страница ошибки
		case 'farm': include(BASE_DIR.'/pages/account/_farm.php'); break; // Моя ферма
		case 'store': include(BASE_DIR.'/pages/account/_store.php'); break; // Склад
		case 'market': include(BASE_DIR.'/pages/account/_market.php'); break; // Рынок
		case 'bonus': include(BASE_DIR.'/pages/account/_bonus.php'); break; // Ежедневный бонус
		case 'lottery': include(BASE_DIR.'/pages/account/_lottery.php'); break; // Лотерея
                case 'newlottery': include(BASE_DIR.'/pages/account/_newlottery.php'); break; // Лотерея
		case 'swap': include(BASE_DIR.'/pages/account/_swap.php'); break; // Обменный пункт
		case 'referals': include(BASE_DIR.'/pages/account/_referals.php'); break; // Рефералы
		case 'insert': include(BASE_DIR.'/pages/account/_insert.php'); break; // Пополнение баланса
		case 'payment': include(BASE_DIR.'/pages/account/_payment.php'); break; // Выплата
                case 'payment_manual': include('pages/account/_payment_manual.php'); break; // Ручные выплаты
		case 'config': include(BASE_DIR.'/pages/account/_config.php'); break; // Настройки
                case 'autoref': include(BASE_DIR.'/pages/account/_autoref.php'); break; // Автореферал
                case 'psc': include(BASE_DIR.'/pages/account/_psc.php'); break; // PSCoin
		case 'exit': @session_destroy(); Header('Location: /'); break; // Выход	
	# Страница ошибки
	default: include(BASE_DIR.'/pages/_404.php'); break;	
	}	
}else{
    include(BASE_DIR.'/pages/account/_user_account.php');
}