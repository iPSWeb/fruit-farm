<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
?>
<div class="s-bk-lf">
	<div class="acc-title">Статистика проекта</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP
$string = '';
foreach($items as $item => $description){
    $string.='SUM(`'.$item.'`) `'.$item.'`,SUM(`'.$description['char'].'_b`) `'.$description['char'].'_b`,SUM(`all_time_'.$description['char'].'`) `all_time_'.$description['char'].'`,';
}
$result=$pdo->query("SELECT 
	COUNT(id) all_users, 
	SUM(money_b) money_b, 
	SUM(money_p) money_p, 
	".$string."
	SUM(payment_sum) payment_sum, 
	SUM(insert_sum) insert_sum
	FROM db_users_b");
$data_stats = $result->fetch();
?>
<table width="450" border="0" align="center">
  <tr class="htt">
    <td><b>Зарегистрировано пользователей:</b></td>
	<td width="100" align="center"><?=$data_stats["all_users"]; ?> чел.</td>
  </tr>
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  <tr class="htt">
    <td><b>Серебра на счетах (Для покупок):</b></td>
	<td width="100" align="center"><?=sprintf("%.0f",$data_stats["money_b"]); ?></td>
  </tr>
  <tr class="htt">
    <td><b>Серебра на счетах (На вывод):</b></td>
	<td width="100" align="center"><?=sprintf("%.0f",$data_stats["money_p"]); ?></td>
  </tr>
  <tr> <td colspan="2" align="center"><b>- - - - -Куплено- - - - -</b></td> </tr>
  <?PHP
  foreach($items as $item => $description){
      echo '<tr class="htt">';
      echo '<td><b>'.$description['name'].':</b></td>';
      echo '<td width="100" align="center">'.$data_stats[$item].' шт.</td>';
      echo '</tr>';
  }
  ?>
  <tr> <td colspan="2" align="center"><b>- - - - -На складах- - - - -</b></td> </tr>
  <?PHP
  foreach($items as $item => $description){
      echo '<tr class="htt">';
      echo '<td><b>'.$description['production'].':</b></td>';
      echo '<td width="100" align="center">'.$data_stats[$description['char'].'_b'].' шт.</td>';
      echo '</tr>';
  }
  ?>
  <tr> <td colspan="2" align="center"><b>- - - - -Собрано за все время- - - - -</b></td> </tr>
  <?PHP
  foreach($items as $item => $description){
      echo '<tr class="htt">';
      echo '<td><b>'.$description['name'].':</b></td>';
      echo '<td width="100" align="center">'.$data_stats['all_time_'.$description['char']].' шт.</td>';
      echo '</tr>';
  }
  ?>
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  <tr class="htt">
    <td><b>Введено пользователями:</b></td>
	<td width="100" align="center"><?=sprintf("%.2f",$data_stats["insert_sum"]); ?> RUB</td>
  </tr>
  <tr class="htt">
    <td><b>Выплачено пользователям:</b></td>
	<td width="100" align="center"><?=sprintf("%.2f",$data_stats["payment_sum"]); ?> RUB</td>
  </tr>
</table>
</div>
<div class="clr"></div>	