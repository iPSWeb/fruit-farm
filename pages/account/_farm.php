<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Аккаунт - Ферма';
?>
<div class="s-bk-lf">
	<div class="acc-title">Ферма</div>
</div>
<div class="silver-bk">
	<p>В этом магазине Вы можете приобрести саженцы различных растений. Каждое растение приносит особые плоды которые можно потом продать на рынке и обменять на реальные деньги. Каждое растение даёт разное количество плодов, чем дороже оно тем больше плодоносит. Вы можете покупать любое их количество, растения не засыхают, не исчезают и будут плодоносить всегда. </p><p><font color="#808e04">Перед тем как докупить саженцы следует собрать урожай на складе!</font></p>
	<?PHP
if(isset($_POST['item'])){
    $item = $_POST['item'];
    $count  = 1;//количество фруктов для покупки
    if(array_key_exists($item,$items)){
        # Проверяем средства пользователя
        $need_money = $db_config['amount_'.$item]*$count;
        if($need_money <= $user_data['money_b']){
            if($user_data['last_sbor'] == 0 OR $user_data['last_sbor'] > ( time() - 60*10) ){
                # Добавляем и списываем деньги
                $result = $pdo->prepare("UPDATE `db_users_b` SET `money_b` = `money_b` - :need_money, `$item` = `$item` + :count WHERE `id` = :user_id");
                $result->execute(array(
                    'need_money'=> $need_money,
                    'count'=>$count,
                    'user_id'=>$user_id
                ));
                # Вносим запись о покупке
                $result = $pdo->prepare("INSERT INTO `db_stats_btree` (`user_id`,`user`,`tree_name`,`amount`,`date_add`,`date_del`)"
                        . "VALUES (:user_id,:user_name,:item,:need_money,:time,:dd)");
                $result->execute(array(
                    'user_id'=>$user_id,
                    'user_name'=>$user_name,
                    'item'=>$items[$item]['name'],
                    'need_money'=>$need_money,
                    'time'=>time(),
                    'dd'=>time()+60*60*24*15
                ));
                //$life_time->AddItem($user_id,$item,1,$items[$item]['time_life']);
                echo '<center><font color = "green"><b>Вы успешно посадили '.$items[$item]['name'].'</b></font></center><BR />';
                $result = $pdo->prepare("SELECT * FROM `db_users_a`, `db_users_b` WHERE `db_users_a`.`id` = `db_users_b`.`id` AND `db_users_a`.`id` = :user_id");
                $result->execute(array('user_id'=>$user_id));
                $user_data = $result->fetch();
            }else{
                echo '<center><font color = "red"><b>Перед тем как докупить саженцы следует собрать урожай на складе!</b></font></center><BR />';
            }
        }else{
            echo '<center><font color = "red"><b>Недостаточно серебра для покупки</b></font></center><BR />';
        }
    }else{
        echo '<center><font color = "red"><b>У нас нет такого фрукта!</b></font></center><BR />';
    }
}
foreach($items as $item => $description){
    echo '<div class="fr-block">';
    echo '<form action="" method="post">';
    echo '<div class="cl-fr-lf">';
    echo '<img src="'.$description['img'].'" />';
    echo '</div>';
    echo '<div class="cl-fr-rg" style="padding-left:20px;">';
    echo '<div class="fr-te-gr-title"><b>'.$description['name'].'</b></div>';
    echo '<div class="fr-te-gr">Плодовитость: <font color="#000000">'.$description['in_hour'].' в час</font></div>';
    echo '<div class="fr-te-gr">Стоимость: <font color="#000000">'.$description['price'].' серебра</font></div>';
    echo '<div class="fr-te-gr">Куплено: <font color="#000000">'.$user_data[$item].' шт.</font></div>';
    echo '<input type="hidden" name="item" value="'.$item.'" />';
    echo '<input type="submit" value="Посадить" style="height: 30px; margin-top:10px;" />';
    echo '</div>';
    echo '</form>';
    echo '</div>';
}
?>
<div class="clr"></div>
</div>