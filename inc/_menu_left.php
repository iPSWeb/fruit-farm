<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
if(isset($_SESSION['user'])){
	if(isset($_SESSION['admin']) AND $_SESSION['admin'] === TRUE AND $_GET['menu'] == 'admin'){
		include('inc/_admin_menu.php');
	}else{
            include('inc/_user_menu.php');
        }
}else{
    include('inc/_login.php');
}
include('inc/_stats.php');