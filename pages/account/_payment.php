<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Заказ выплаты';
?>
<div class="s-bk-lf">
    <div class="acc-title">{!TITLE!}</div>
</div>
<div class="silver-bk">
<BR />
<?PHP
$status_array = array( 0 => 'Проверяется', 1 => 'Выплачивается', 2 => 'Отменена', 3 => 'Выплачено');
# Минималка серебром!
$minPay = $db_config['min_pay']; 
?>
<b>Выплаты осуществляются в автоматическом режиме и только на платежную систему <a href="https://payeer.com/0470864" target="_BLANK">PAYEER!</a> Процент при выводе составляет 0%</b> <BR /><BR />
<b>Из платежной системы Payeer Вы можете вывести свои средства в автоматическом режиме на все известные платежные системы и международные банки.</b><BR /><BR />
<b>Ссылки на учебные материалы:</b><BR />
 - <a href="https://payeer.com/0470864" target="_blank">Создание счета в Payeer</a> <BR />
 - <a href="https://payeer.com/0470864" target="_blank">Вывод средств из payeer</a> <BR /><BR />
<center><b>Заказ выплаты:</b></center><BR />
<?PHP
# Заносим выплату
if(isset($_POST['purse'])){
    $purse = $func->CheckPayeer($_POST['purse']);
    $sum = intval($_POST['sum']);
    $val = 'RUB';
    if($purse !== false){
        if($sum >= $minPay){
            if($sum <= $user_data['money_p']){
                # Проверяем на существующие заявки
                $result = $pdo->prepare("SELECT COUNT(*) FROM `db_payment` WHERE `user_id` = :user_id AND `status` IN('0','1')");
                $result->execute(array(
                    'user_id'=>$user_id
                ));
                if($result->fetchColumn() == 0){		
                    ### Делаем выплату ###	
                    $payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
                    if ($payeer->isAuth()){
                        $arBalance = $payeer->getBalance();
                        if($arBalance['auth_error'] == 0){
                            $sum_pay = round( ($sum / $db_config['ser_per_wmr']), 2);
                            $balance = $arBalance['balance']['RUB']['DOSTUPNO'];
                            if($balance >= $sum_pay){
                                $arTransfer = $payeer->transfer(array(
                                'curIn' => 'RUB', // счет списания
                                'sum' => $sum_pay, // сумма получения
                                'curOut' => 'RUB', // валюта получения
                                'to' => $purse, // получатель (email)
                                'comment' => 'Выплата пользователю '.$user_name.' с проекта '.$_SERVER['HTTP_HOST']
                                ));
                                if (!empty($arTransfer['historyId'])){	
                                    # Снимаем с пользователя
                                    $result = $pdo->prepare("UPDATE `db_users_b` SET `money_p` = `money_p` - :sum,`payment_sum` = `payment_sum` + :sum_pay WHERE `id` = :user_id");
                                    $result->execute(array(
                                        'sum'=>$sum,
                                        'sum_pay'=>$sum_pay,
                                        'user_id'=>$user_id
                                    ));
                                    # Вставляем запись в выплаты
                                    $da = time();
                                    $dd = $da + 60*60*24*15;
                                    $ppid = $arTransfer['historyId'];
                                    $result = $pdo-prepare("INSERT INTO `db_payment` (`user`,`user_id`,`purse`,`sum`,`valuta`,`serebro`,`payment_id`,`date_add`,`status`) VALUES (:user_name,:user_id,:purse,:sum_pay,:valuta,:sum,:ppid',:time,:status)");
                                    $result->execute(array(
                                        'user_name'=>$user_name,
                                        'user_id'=>$user_id,
                                        'purse'=>$purse,
                                        'sum_pay'=>$sum_pay,
                                        'valuta'=>'RUB',
                                        'ppid'=>$ppid,
                                        'time'=>time(),
                                        'status'=>3
                                    ));
                                    $result = $pdo->prepare("UPDATE `db_stats` SET `all_payments` = `all_payments` + :sum_pay WHERE `id` = '1'");
                                    $result->execute(array('sum_pay'=>$sum_pay));
                                    echo '<center><font color = "green"><b>Выплачено!</b></font></center><BR />';	
                                }else{
                                    echo '<center><font color = "red"><b>Внутреняя ошибка - сообщите о ней администратору!</b></font></center><BR />';	
                                }
                            }else{
                                echo '<center><font color = "red"><b>ОШИБКА 629. Сообщите о ней администратору!</b></font></center><BR />';
                            }
                        }else{
                            echo '<center><font color = "red"><b>Ошибка 630. Не удалось выплатить! Попробуйте позже</b></font></center><BR />';
                        }
                    }else{
                        echo '<center><font color = "red"><b>Ошибка 631. Не удалось выплатить! Попробуйте позже</b></font></center><BR />';	
                    }
                }else{
                    echo '<center><font color = "red"><b>У вас имеются необработанные заявки. Дождитесь их выполнения.</b></font></center><BR />';
                }
            }else{
                echo '<center><font color = "red"><b>Вы указали больше, чем имеется на вашем счету</b></font></center><BR />';
            }
        }else{
            echo '<center><b><font color = "red">Минимальная сумма для выплаты составляет '.$minPay.' серебра!</font></b></center><BR />';
        }
    }else{
        echo '<center><b><font color = "red">Кошелек Payeer указан неверно! Смотрите образец!</font></b></center><BR />';
    }
}
?>
<form action="" method="post">
<table width="99%" border="0" align="center">
  <tr>
    <td><font color="#000;">Введите кошелек Payeer [Пример: P1304289]</font>: </td>
	<td><input type="text" name="purse" size="15"/></td>
  </tr>
  <tr>
    <td><font color="#000;">Отдаете серебро для вывода</font> [Мин. <span id="res_min"></span>]<font color="#000;">:</font> </td>
	<td><input type="text" name="sum" id="sum" value="<?=round($user_data["money_p"]); ?>" size="15" onkeyup="PaymentSum();" /></td>
  </tr>
  <tr>
    <td><font color="#000;">Получаете <span id="res_val"></span></font><font color="#000;">:</font> </td>
	<td>
	<input type="text" name="res" id="res_sum" value="0" size="15" disabled="disabled"/>
	<input type="hidden" name="per" id="RUB" value="<?=$db_config["ser_per_wmr"]; ?>" disabled="disabled"/>
	<input type="hidden" name="per" id="min_sum_RUB" value="0.5" disabled="disabled"/>
	<input type="hidden" name="val_type" id="val_type" value="RUB" />
	</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="swap" value="Заказать выплату" style="height: 30px; margin-top:10px;" /></td>
  </tr>
</table>
</form>
<script language="javascript">PaymentSum(); SetVal();</script>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
    <tr>
        <td colspan="5" align="center"><h4>Последние 10 выплат</h4></td>
    </tr>
    <tr>
        <td align="center" class="m-tb">Серебро</td>
        <td align="center" class="m-tb">Получаете</td>
        <td align="center" class="m-tb">Кошелек</td>
        <td align="center" class="m-tb">Дата</td>
        <td align="center" class="m-tb">Статус</td>
    </tr>
<?PHP
$result = $pdo->prepare("SELECT * FROM `db_payment` WHERE `user_id` = :user_id ORDER BY `id` DESC LIMIT 20");
$result->execute(array('user_id'=>$user_id));
    if($result->rowCount() > 0){
        while($data = $result->fetch()){
        ?>
            <tr class="htt">
                <td align="center"><?=$data['serebro']; ?></td>
                <td align="center"><?=sprintf('%.2f',$data['sum'] - $data['comission']); ?> <?=$data['valuta']; ?></td>
                <td align="center"><?=$data['purse']; ?></td>
                <td align="center"><?=date('d.m.Y',$data['date_add']); ?></td>
                <td align="center"><?=$status_array[$data['status']]; ?></td>
            </tr>
        <?PHP
        }
    }else{
        echo '<tr><td align="center" colspan="5">Нет записей</td></tr>';
    }
?>
</table>
<div class="clr"></div>		
</div>