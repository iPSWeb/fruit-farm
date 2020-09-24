<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Ежедневный бонус';
?>
<div class="s-bk-lf">
    <div class="acc-title">{!TITLE!}</div>
</div>
<div class="silver-bk">
<div class="clr"></div>	
<BR />
Бонус выдется 1 раз в 24 часа. <BR />
Бонус выдается серебром на счет для покупок. <BR />
Сумма бонуса генерируется случайно от <b><?=$bonus_min;?></b> до <b><?=$bonus_max;?></b> серебра.
<BR /><BR />
<?PHP
$ddel = time() + 60*60*$config->frequencyBonus;
$dadd = time();
$result = $pdo->prepare("SELECT COUNT(*) FROM `db_bonus_list` WHERE `user_id` = :user_id AND `date_del` > :dadd");
$result->execute(array(
    'user_id' => $user_id,
    'dadd' => $dadd
));
$hide_form = false;
if($result->fetchColumn() == 0){
    # Выдача бонуса
    if(isset($_POST['bonus'])){
        $amount = rand($config->minBonus, rand($config->minBonus, $config->maxBonus) );
        # Зачилсяем пользователю
        $result = $pdo->prepare("UPDATE `db_users_b` SET `money_".$config->accountBonus."` = `money_".$config->accountBonus."` + :amount WHERE `id` = :user_id");
        $result->execute(array(
            'amount' => $amount,
            'user_id' => $user_id
        ));
        # Вносим запись в список бонусов
        $result = $pdo->prepare("INSERT INTO `db_bonus_list` (`user`,`user_id`,`sum`,`date_add`,`date_del`) VALUES (:user_name,:user_id,:sum,:dadd,:ddel)");
        $result->execute(array(
            'user_name' => $user_name,
            'user_id' => $user_id,
            'sum' => $amount,
            'dadd' => $dadd,
            'ddel' => $ddel
        ));
        # Очистка устаревших записей
        $result = $pdo->prepare("DELETE FROM db_bonus_list WHERE date_del < :dadd");
        $result->execute(array('dadd'=>$dadd));
        echo '<center><font color = "green"><b>На Ваш счет для покупок зачислен бонус в размере '.$amount.' серебра</b></font></center><BR />';
        $hide_form = true;
    }
    # Показывать или нет форму
    if(!$hide_form){
        ?>
        <form action="" method="post">
        <table width="330" border="0" align="center">
          <tr>
                <td align="center"></td>
          </tr>
          <tr>
                <td align="center"><input type="submit" name="bonus" value="Получить бонус" style="height: 30px; margin-top:10px;"></td>
          </tr>
        </table>
        </form>
        <?PHP 
    }
}else{
    echo '<center><font color = "red"><b>Вы уже получали бонус за последние 24 часа</b></font></center><BR />';
}
?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
    <tr>
        <td colspan="5" align="center"><h4>Последние 20 бонусов</h4></td>
    </tr>
    <tr>
        <td align="center" class="m-tb">ID</td>
        <td align="center" class="m-tb">Пользователь</td>
        <td align="center" class="m-tb">Сумма</td>
        <td align="center" class="m-tb">Дата</td>
    </tr>
<?PHP
$result = $pdo->query("SELECT * FROM `db_bonus_list` ORDER BY `id` DESC LIMIT 20");
if($result->rowCount() > 0){
    while($data = $result->fetch()){
    ?>
    <tr class="htt">
    <td align="center"><?=$data['id']; ?></td>
    <td align="center"><?=$data['user']; ?></td>
    <td align="center"><?=$data['sum']; ?></td>
    <td align="center"><?=date('d.m.Y',$data['date_add']); ?></td>
    </tr>
    <?PHP
    }
}else{
    echo '<tr><td align="center" colspan="4">Нет записей</td></tr>';
}
?>
</table>
<div class="clr"></div>		
</div>