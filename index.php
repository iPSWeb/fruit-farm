<?PHP
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
# Счетчик
function TimerSet(){
    list($seconds, $microSeconds) = explode(' ', microtime());
    return $seconds + (float) $microSeconds;
}
$_timer_a = TimerSet();
# Старт сессии
@session_start();
# Старт буфера
@ob_start();
# Default
$_OPTIMIZATION = array();
$_OPTIMIZATION['title'] = 'Фруктовая ферма';
$_OPTIMIZATION['description'] = 'Фруктовая ферма';
$_OPTIMIZATION['keywords'] = 'Заработок на растениях, вложения, заработать, ферма, денежная ферма, заработать на ферме';
# Константа для Include
define('PSWeb', true);
define('BASE_DIR',$_SERVER['DOCUMENT_ROOT']);
# Автоподгрузка классов
function __autoload($name){ include('classes/_class.'.$name.'.php');}
# Класс конфига 
$config = new config;
# Функции
$func = new func;
# Установка REFERER
include('inc/_set_referer.php');
# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
# База данных
include(BASE_DIR.'/inc/_connect.php');
$result = $pdo->query("SELECT * FROM `db_config` WHERE `id` = '1' LIMIT 1");
$db_config = $result->fetch();
$array_items = new items($db_config);
$items = $array_items->getItems();
# Шапка
include(BASE_DIR.'/inc/_header.php');
if(isset($_GET['menu'])){
    $menu = strval($_GET['menu']);
    switch($menu){
        case '404': include(BASE_DIR.'/pages/_404.php'); break; // Страница ошибки
        case 'rules': include(BASE_DIR.'/pages/_rules.php'); break; // Правила проекта
        case 'about': include(BASE_DIR.'/pages/_about.php'); break; // О проекте
        case 'contacts': include(BASE_DIR.'/pages/_contacts.php'); break; // Контакты
        case 'news': include(BASE_DIR.'/pages/_news.php'); break; // Новости
        case 'signup': include(BASE_DIR.'/pages/_signup.php'); break; // Регистрация
        case 'recovery': include(BASE_DIR.'/pages/_recovery.php'); break; // Восстановление пароля
        case 'payments': include(BASE_DIR.'/pages/_payments.php'); break; // Выплаты
        case 'users': include(BASE_DIR.'/pages/_users.php'); break; // Пользователи
        case 'account': include(BASE_DIR.'/pages/_account.php'); break; // Аккаунт
        case 'admin': include(BASE_DIR.'/pages/_admin.php'); break; // Админка
        case 'success': include(BASE_DIR.'/pages/_success.php'); break; // Успешная оплата
        case 'fail': include(BASE_DIR.'/pages/_fail.php'); break; // Неуспешная оплата
        # Страница ошибки
        default: @include(BASE_DIR.'/pages/_404.php'); break;
    }
}else{
    include(BASE_DIR.'/pages/_index.php');
}
# Подвал
include(BASE_DIR.'/inc/_footer.php');
# Заносим контент в переменную
$content = ob_get_contents();
# Очищаем буфер
ob_end_clean();
# Заменяем данные
$content = str_replace('{!TITLE!}',$_OPTIMIZATION['title'],$content);
$content = str_replace('{!DESCRIPTION!}',$_OPTIMIZATION['description'],$content);
$content = str_replace('{!KEYWORDS!}',$_OPTIMIZATION['keywords'],$content);
$content = str_replace('{!GEN_PAGE!}', sprintf('%.5f', (TimerSet() - $_timer_a)) ,$content);
# Вывод баланса
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $result = $pdo->prepare("SELECT `money_b`, `money_p` FROM `db_users_b` WHERE `id` = :user_id");
    $result->execute(array('user_id'=>$user_id));
    $db->Query("SELECT `money_b`, `money_p` FROM `db_users_b` WHERE `id` = '$user_id'");
    $balance = $result->fetch();
    $content = str_replace('{!BALANCE_B!}', sprintf('%.2f', $balance['money_b']) ,$content);
    $content = str_replace('{!BALANCE_P!}', sprintf('%.2f', $balance['money_p']) ,$content);
}
// Выводим контент
echo $content;