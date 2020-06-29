<?php

/*
 * Author: pligin
 * Site: psweb.ru
 * Telegram: t.me/pligin
 */

if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
if(empty($_SESSION['user_id'])){ Header('Location: /'); return; }
if($config->autoSborActive){
    $lastsbor = $user_data['last_sbor'];
    $lsDay = date('d.m',$lastsbor);
    $date = new DateTime();
    $thisDay = $date->format('d.m');
    if($lsDay<$thisDay){
        $thisTime = $date->format('H:i');
        if($thisTime >= $config->autoSborTime){
            $result = $pdo->query("SELECT * FROM `db_users_b`");
            while($data = $result->fetch()){
                $items_string = '';
                $ui = $data['id'];
                foreach($items as $item => $description){
                    $$item = $func->SumCalc($description['in_hour'], $data[$item], $data['last_sbor']);
                    $items_string.= '`'.$description['char'].'_b` = `'.$description['char'].'_b`+\''.$$item.'\',';
                    $pdo->query("UPDATE `db_users_b` SET `all_time_".$description['char']."` = `all_time_".$description['char']."` + '".$$item."' WHERE `id` = '$ui' LIMIT 1");
                }
                $pdo->query("UPDATE `db_users_b` SET 
                ".$items_string."
                `last_sbor` = '".time()."' 
                WHERE `id` = '$ui' LIMIT 1");
            }
        }
    }
}