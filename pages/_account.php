<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION["title"] = "Аккаунт";
$_OPTIMIZATION["description"] = "Аккаунт пользователя";
$_OPTIMIZATION["keywords"] = "Аккаунт, личный кабинет, пользователь";
# Блокировка сессии
if(!isset($_SESSION["user_id"])){ Header("Location: /"); return; }
$user_id = $_SESSION['user_id'];
$db->Query("SELECT * FROM `db_users_a`, `db_users_b` WHERE `db_users_a`.`id` = `db_users_b`.`id` AND `db_users_a`.`id` = '$user_id'");
$user_data = $db->FetchArray();
if($user_data['banned']){ @session_destroy(); Header('Location: /signin'); return; }
$user_name = $user_data['user'];
if(isset($_GET["sel"])){	
	$smenu = strval($_GET["sel"]);		
	switch($smenu){
		case "404": include("pages/_404.php"); break; // Страница ошибки
		case "farm": include("pages/account/_farm.php"); break; // Моя ферма
		case "store": include("pages/account/_store.php"); break; // Склад
		case "market": include("pages/account/_market.php"); break; // Рынок
		case "bonus": include("pages/account/_bonus.php"); break; // Ежедневный бонус
		case "lottery": include("pages/account/_lottery.php"); break; // Лотерея
		case "swap": include("pages/account/_swap.php"); break; // Обменный пункт
		case "referals": include("pages/account/_referals.php"); break; // Рефералы
		case "insert": include("pages/account/_insert.php"); break; // Пополнение баланса
		case "payment": include("pages/account/_payment.php"); break; // Выплата
                case 'payment_manual': include('pages/account/_payment_manual.php'); break; // Ручные выплаты
		case "config": include("pages/account/_config.php"); break; // Настройки
                case "autoref": include("pages/account/_autoref.php"); break; // Автореферал
                case "psc": include("pages/account/_psc.php"); break; // PSCoin
		case "exit": @session_destroy(); Header("Location: /"); return; break; // Выход	
	# Страница ошибки
	default: @include("pages/_404.php"); break;	
	}	
}else @include("pages/account/_user_account.php");