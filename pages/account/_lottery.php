<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Лотерея';
$accountPayTicket=($config->accountPayTicket === 'b')?'покупок':'выплаты';
$accountPayPrize=($config->accountPayPrize === 'b')?'покупок':'выплаты';
?>
<div class="s-bk-lf">
    <div class="acc-title">{!TITLE!}</div>
</div>
<div class="silver-bk">
<?PHP
# список предыдущих лотерей
if(isset($_GET['winners'])){ ?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
    <tr>
        <td colspan="6" align="center"><h4>Завершенные лотереи</h4></td>
    </tr>
    <tr>
        <td align="center" class="m-tb">№</td>
        <td align="center" class="m-tb">Пользователь<BR />[Билет]</td>
	<td align="center" class="m-tb">Пользователь<BR />[Билет]</td>
	<td align="center" class="m-tb">Пользователь<BR />[Билет]</td>
	<td align="center" class="m-tb">Банк</td>
	<td align="center" class="m-tb">Дата</td>
    </tr>
    <?PHP
    $result = $pdo->query("SELECT * FROM `db_lottery_winners` ORDER BY `id` DESC");
    if($result->rowCount() > 0){
        while($data = $result->fetch()){
        ?>
        <tr class="htt">
            <td align="center"><?=$data['id']; ?></td>
            <td align="center"><?=$data['user_a']; ?><BR />Билет: <?=$data['bil_a']; ?></td>
            <td align="center"><?=$data['user_b']; ?><BR />Билет: <?=$data['bil_b']; ?></td>
            <td align="center"><?=$data['user_c']; ?><BR />Билет: <?=$data['bil_c']; ?></td>
            <td align="center"><?=$data['bank']; ?></td>
            <td align="center"><?=date('d.m.Y',$data['date_add']); ?></td>
        </tr>
        <?PHP
        }
    }else{
        echo '<tr><td align="center" colspan="6">Нет записей</td></tr>';
    }
  ?>
</table>
<div class="clr"></div></div>
<?PHP return; } ?>
<b>Лотерея</b> - это такая игры :) Всего имеется <?=$config->countTickets; ?> билетов. После того, как все билеты будут проданы состоится розыгрыш счастливых билетов. Система случайным образом выберет 3 номера счастливых билетов и зачислит им призы на счет для <?=$accountPayPrize;?>. <BR />
1 место - <?=$config->lotteryFirst;?>% от общего банка [<?=$config->costTicket * $config->countTickets * $config->lotteryFirst/100; ?> серебра]. <BR />
2 место - <?=$config->lotterySecond;?>% от общего банка [<?=$config->costTicket * $config->countTickets * $config->lotterySecond/100; ?> серебра]. <BR />
3 место - <?=$config->lotteryThird;?>% от общего банка [<?=$config->costTicket * $config->countTickets * $config->lotteryThird/100; ?> серебра]. <BR />
<BR />
<u>Стоимость билета = <?=$config->costTicket; ?> серебра со счета для <?=$accountPayTicket;?></u>.
<BR />
<a href="/account/lottery/winners">Список завершенных лотерей</a>
<BR /><BR />
<?PHP
if(isset($_POST['set_lottery'], $_POST['hash']) AND $_SESSION['lot_hash'] == $_POST['hash']){
    $result = $pdo->prepare("SELECT `money_".$config->accountPayTicket."` FROM `db_users_b` WHERE `id` = :user_id LIMIT 1");
    $result->execute(array('user_id'=>$user_id));
    if($result->fetchColumn() >= $config->costTicket){
        $result = $pdo->prepare("UPDATE `db_users_b` SET `money_".$config->accountPayTicket."` = `money_".$config->accountPayTicket."`-:cost WHERE `id` = :user_id");
        $result->execute(array(
            'cost' => $config->costTicket,
            'user_id' => $user_id
        ));
        $result = $pdo->prepare("INSERT INTO `db_lottery` (`user_id`,`user`,`date_add`) VALUE (:user_id,:user_name,:date_add)");
        $result->execute(array(
            'user_id' => $user_id,
            'user_name' => $user_name,
            'date_add' => time()
        ));
        $lid = $pdo->lastInsertId();
        if($lid >= $config->countTickets){
            # Розыгрываем призы
            while(true){
                $ticketFirst = rand(1, $config->countTickets);
                $ticketSecond = rand(1, $config->countTickets);
                $ticketThird = rand(1, $config->countTickets);
                if($ticketFirst != $ticketSecond AND $ticketSecond != $ticketThird AND $ticketThird != $ticketFirst) break;
            }
            # Пользователь 1
            $result = $pdo->query("SELECT `user` FROM `db_lottery` WHERE `id` = '$ticketFirst'");
            $winnerFirst = $result->fetchColumn();
            # Пользователь 2
            $result = $pdo->query("SELECT `user` FROM `db_lottery` WHERE id = '$ticketSecond'");
            $winnerSecond = $result->fetchColumn();
            # Пользователь 3
            $result = $pdo->query("SELECT `user` FROM `db_lottery` WHERE id = '$ticketThird'");
            $winnerThird = $result->fetchColumn();
            # чистим таблицу
            $result = $pdo->query("TRUNCATE TABLE `db_lottery`");
            # Вставляем запись о победителях
            $bank = $config->countTickets*$config->costTicket;
            $result = $pdo->query("INSERT INTO `db_lottery_winners` (`user_a`,`bil_a`,`user_b`,`bil_b`,`user_c`,`bil_c`,`bank`,`date_add`) VALUES ('$winnerFirst','$ticketFirst','$winnerSecond','$ticketSecond','$winnerThird','$ticketThird','$bank','".time()."')");
            # Обновляем средства пользователям
            # 1 место
            $prizeFirst = $bank * $config->lotteryFirst/100;
            $result = $pdo->query("UPDATE `db_users_b` SET `money_".$config->accountPayTicket."` = `money_".$config->accountPayTicket."` + '$prizeFirst' WHERE `user` = '$winnerFirst'");
            # 2 место
            $prizeSecond = $bank * $config->lotterySecond/100;
            $result = $pdo->query("UPDATE `db_users_b` SET `money_".$config->accountPayTicket."` = `money_".$config->accountPayTicket."` + '$prizeSecond' WHERE `user` = '$winnerSecond'");
            # 3 место
            $prizeThird = $bank * $config->lotteryThird/100;
            $result = $pdo->query("UPDATE `db_users_b` SET `money_".$config->accountPayTicket."` = `money_".$config->accountPayTicket."` + '$prizeThird' WHERE `user` = '$winnerThird'");
            echo '<center><b><font color="green">Лотерея окончена</font></b></center><BR />';
        }else{
            echo '<center><b><font color="green">Билет успешно куплен</font></b></center><BR />';
        }
    }else{
        echo '<center><b><font color="red">Недостаточно средств для покупки билета</font></b></center><BR />';
    }
}
?>
<center>
<?PHP
$_SESSION['lot_hash'] = rand(1, 9999999);//хеш для предотвращение покупок путем обновления страницы
?>
    <form action="" method="post">
        <input type="submit" name="set_lottery" value="Купить билет" style="padding:7px;" />
        <input type="hidden" name="hash" value="<?=$_SESSION['lot_hash']; ?>" />
    </form>
</center>
    <table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
        <tr>
            <td colspan="5" align="center"><h4>Пользователи купившие билеты</h4></td>
        </tr>
        <tr>
            <td align="center" class="m-tb">№ билета</td>
            <td align="center" class="m-tb">Пользователь</td>
            <td align="center" class="m-tb">Дата</td>
        </tr>
        <?PHP
        $result = $pdo->query("SELECT * FROM `db_lottery` ORDER BY `id` DESC");
        if($result->rowCount() > 0){
            while($data = $result->fetch()){
            ?>
            <tr class="htt">
                <td align="center"><?=$data['id']; ?></td>
                <td align="center"><?=$data['user']; ?></td>
                <td align="center"><?=date('d.m.Y',$data['date_add']); ?></td>
            </tr>
                    <?PHP
            }
        }else{
            echo '<tr><td align="center" colspan="3">Нет записей</td></tr>';
        }
      ?>
    </table>
    <div class="clr"></div>	
</div>