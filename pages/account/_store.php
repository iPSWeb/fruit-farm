<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION["title"] = "Аккаунт - Склад";
$_OPTIMIZATION["description"] = "Фруктовый склад";
?>
<div class="s-bk-lf">
	<div class="acc-title">Фруктовый склад</div>
</div>
<div class="silver-bk">Собирайте на фруктовом складе ваши плоды посаженые на фруктовой ферме. Ваша ферма дает урожай 
каждые 10 минут. Плоды постоянно накапливается, не обязательно собирать каждые 10 мин. достаточно
собрать их раз в месяц.<br /> Как вам удобнее.
<BR />
<BR />
<?PHP
if(isset($_POST['sbor'])){
    if($user_data['last_sbor'] < (time() - 60*10) ){
        $items_string = '';
        foreach($items as $item => $description){
            $$item = $func->SumCalc($description['in_hour'], $user_data[$item], $user_data['last_sbor']);
            $items_string.= '`'.$description['char'].'_b` = `'.$description['char'].'_b`+\''.$$item.'\',';
            $db->Query("UPDATE `db_users_b` SET `all_time_".$description['char']."` = `all_time_".$description['char']."` + '".$$item."' WHERE `id` = '$user_id' LIMIT 1");
        }
        $db->Query("UPDATE db_users_b SET 
        ".$items_string."
        last_sbor = '".time()."' 
        WHERE id = '$user_id' LIMIT 1");
        echo '<center><font color = "green"><b>Вы собрали урожай</b></font></center><BR />';
        $db->Query("SELECT * FROM db_users_b WHERE id = '$user_id' LIMIT 1");
        $user_data = $db->FetchArray();
    }else{
        echo '<center><font color = "red"><b>Урожай можно собирать не чаще 1го раза в 10 минут</b></font></center><BR />';
    }
}
?>
<form action="" method="post">
    <div class="clr"></div>
    <?PHP
    foreach($items as $item => $description){
        echo '<div class="sm-line">';
        echo '<img src="'.$description['img_small'].'" />Ваших '.$user_data[$item].' '.$description['name'].' уродили: <font color="#000"> '.$func->SumCalc($description['in_hour'], $user_data[$item], $user_data['last_sbor']).' '.$description['production'].'</font>';
        echo '</div>';
    }
    ?>
    <div class="clr"></div>
    <center><input type="submit" name="sbor" value="Собрать все" style="height:30px;"/></center>
</form>                
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" align="center" style="padding:5px;"><b>У вас имеется на складе:</b></td>
    </tr>
  <tr>
    <?PHP
    foreach($items as $item => $description){
        echo '<td align="center" width="20%"><div class="sm-line-nt"><img src="'.$description['img_small'].'" /></div></td>';
    }
    ?>
  </tr>
  <tr>
      <?PHP
    foreach($items as $item => $description){
        echo ' <td align="center">'.$user_data[$description['char'].'_b'].'</td>';
    }
    ?>
  </tr>
</table>
<div class="clr"></div>
</div>