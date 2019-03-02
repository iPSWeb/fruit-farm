<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION["title"] = "Админка - Настройки";
?>
<div class="s-bk-lf">
	<div class="acc-title">Настройки</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP
# Обновление
if(isset($_POST["admin"])){
    $string = '';
    # Проверка на ошибки
    $errors = array();
    $admin = $func->IsLogin($_POST['admin']);
    $pass = $func->md5password($func->IsPassword($_POST['pass']));
    $ser_per_wmr = intval($_POST['ser_per_wmr']);
    $min_pay = intval($_POST['min_pay']);
    $percent_swap = intval($_POST['percent_swap']);
    $percent_sell = intval($_POST['percent_sell']);
    $items_per_coin = intval($_POST['items_per_coin']);
    foreach($items as $item => $description){
        $in_h = $description['char'].'_in_h';
        $$in_h = floatval($_POST[$description['char'].'_in_h']);
        if($$in_h < 0.0001){
            $errors[] = '<center><font color = "red"><b>Неверная настройка плодовитости в час! Минимум 0.0001</b></font></center><BR />'; 
        }
        $amount = 'amount_'.$item;
        $$amount = floatval($_POST['amount_'.$item]);
        if($$amount < 1){
            $errors[] = '<center><font color = "red"><b>Минимальная стоимость дерева не должна быть менее 1 серебра</b></font></center><BR />'; 
        }
        $string.=',`'.$in_h.'`= \''.$$in_h.'\',`'.$amount.'`= \''.$$amount.'\'';
    }
    if($admin === false){
        $errors[] = '<center><font color = "red"><b>Логин администратора имеет неверный формат</b></font></center><BR />'; 
    }
    if($pass != $db_config['pass']){
        $errors[] = '<center><font color = "red"><b>Пароль неверный</b></font></center><BR />'; 
    }
    if($min_pay < 0){
        $errors[] = '<center><font color = "red"><b>Минимальная сумма выплаты не может быть меньше 0</b></font></center><BR />'; 
    }
    if($percent_swap < 1 OR $percent_swap > 99){
        $errors[] = '<center><font color = "red"><b>Прибавляемый процент при обмене должен быть от 1 до 99</b></font></center><BR />'; 
    }

    if($percent_sell < 1 OR $percent_sell > 99){
        $errors[] = '<center><font color = "red"><b>% серебра на вывод при продаже должен быть от 1 до 99</b></font></center><BR />'; 
    }

    if($items_per_coin < 1 OR $items_per_coin > 50000){
        $errors[] = '<center><font color = "red"><b>Сколько добычи = 1 серебра, должно быть от 1 до 50000</b></font></center><BR />'; 
    }

	# Обновление
	if(empty($errors)){
            $db->Query("UPDATE db_config SET 
            admin = '$admin',
            pass = '$pass',
            ser_per_wmr = '$ser_per_wmr',
            min_pay = '$min_pay',
            percent_swap = '$percent_swap',
            percent_sell = '$percent_sell',
            items_per_coin = '$items_per_coin'
            $string
            WHERE id = '1'");
            echo "<center><font color = 'green'><b>Сохранено</b></font></center><BR />";
            $db->Query("SELECT * FROM db_config WHERE id = '1'");
            $db_config = $db->FetchArray();
	}else{
            foreach($errors as $error){
                echo $error;
            }
        }
	
}

?>
<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td><b>Логин администратора:</b></td>
	<td width="150" align="center"><input type="text" name="admin" value="<?=$db_config["admin"]; ?>" /></td>
  </tr>
  <tr>
    <td ><b>Пароль администратора:</b></td>
	<td width="150" align="center"><input type="password" name="pass" value="" /></td>
  </tr>
  
  <tr>
    <td><b>Стоимость 1 RUB (Серебром):</b></td>
	<td width="150" align="center"><input type="text" name="ser_per_wmr" value="<?=$db_config["ser_per_wmr"]; ?>" /></td>
  </tr>
  <tr>
    <td><b>Минимальная сумма выплаты (Серебром):</b></td>
	<td width="150" align="center"><input type="text" name="min_pay" value="<?=$db_config["min_pay"]; ?>" /></td>
  </tr>
  <tr >
    <td><b>Прибавлять % при обмене (От 1 до 99):</b></td>
	<td width="150" align="center"><input type="text" name="percent_swap" value="<?=$db_config["percent_swap"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>% серебра на вывод при продаже (от 1 до 99):</b><BR /></td>
	<td width="150" align="center"><input type="text" name="percent_sell" value="<?=$db_config["percent_sell"]; ?>" /></td>
  </tr>
  
  <tr >
  <td><b>Сколько фруктов = 1 серебра:</b></td>
	<td width="150" align="center"><input type="text" name="items_per_coin" value="<?=$db_config["items_per_coin"]; ?>" /></td>
  </tr>
  <tr>
  <?PHP
  foreach($items as $item => $description){
      echo '<tr>';
      echo '<td><b>Плодовитость в час '.$description['name'].':</b></td>';
      echo '<td width="150" align="center"><input type="text" name="'.$description['char'].'_in_h" value="'.$db_config[$description['char'].'_in_h'].'" /></td>';
      echo '</tr>';
  }
  foreach($items as $item => $description){
      echo '<tr>';
      echo '<td><b>Стоимость серебром '.$description['name'].':</b></td>';
      echo '<td width="150" align="center"><input type="text" name="amount_'.$item.'" value="'.$db_config['amount_'.$item].'" /></td>';
      echo '</tr>';
  }
  ?>
  <tr> <td colspan="2" align="center"><input type="submit" value="Сохранить" /></td> </tr>
</table>
</form>
</div>