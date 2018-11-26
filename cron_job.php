<?PHP
# Константа для Include
define('CONST_PSWeb', true);
# Подматываем классы
function __autoload($name){ include("classes/_class.".$name.".php");}
# Класс конфига 
$config = new config;
$type = "sender";//strval($_GET["type"]);
# Функции
$func = new func;
# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
switch($type){
	case "sender": include("cron_job/_sender.php"); break; // Отправка пользователям
	default: die("Type not exist"); break;
}