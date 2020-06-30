<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
if(isset($_GET['i'])){
    $rid = (intval($_GET['i']) > 0) ? intval($_GET['i']) : 1;
    if(!isset($_COOKIE['referer_id'])){
        setcookie('referer_id',$rid,time() + (60*60*24*30),'/',$_SERVER['HTTP_HOST'],0);
        $_SESSION['referer_id'] = $rid;
        //$db->query("UPDATE `db_users` SET `ref_view` = `ref_view` + '1' WHERE `id` = :id",array('id'=>$rid));
    }else{
        $_SESSION['referer_id'] = $_COOKIE['referer_id'];
    }
    #откуда пришел
    if (!empty($_SERVER['HTTP_REFERER']) && !isset($_COOKIE['referer_site'])) {
        setcookie('referer_site', $_SERVER['HTTP_REFERER'], time() + (60*60*24*30),'/',$_SERVER['HTTP_HOST'],0);
    }
    header('Location: /');
}else{
    $_SESSION['referer_id'] = 1;
}