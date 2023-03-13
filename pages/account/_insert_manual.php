<?PHP

/*
 * Модуль Ручные пополнения для Фруктовой Фермы
 * Author: pligin
 * Site: psweb.ru
 * Telegram: t.me/pligin
 */

if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Пополнение баланса';
?>
<div class="s-bk-lf">
	<div class="acc-title">{!TITLE!}</div>
</div>
<div class="silver-bk"> 
Курс игровой валюты: 1 рубль = <?=$db_config['ser_per_wmr']; ?> серебра.
<p>Для пополнения отправьте сумму на кощелек <?=$config->payeerWalletAdmin;?> и в форме ниже укажите сумму перевода и номер транзакции.</p>
<p>После проверки администратором сумма будет зачислена на Ваш баланс.</p> 
<?PHP
/// db_payeer_insert
if(!empty($_POST['sum']) && !empty($_POST['txn'])){
    $amount = round(floatval($_POST['sum']),2);
    $txn = strval($_POST['txn']);
    $result = $pdo->prepare("SELECT * FROM `db_payeer_insert` WHERE `operation_id` = :txn");
    $result->execute(array('txn'=>$txn));
    if($result->rowCount() == 0){
        if($amount > 0){
            # Заносим в БД
            $result = $pdo->prepare("INSERT INTO `db_payeer_insert` (`user_id`, `user`, `sum`, `date_add`,`description`,`operation_id`) VALUES (:user_id,:user_name,:amount,:time,:description,:operation_id)");
            $result->execute(array(
                'user_id' => $user_id,
                'user_name'=>$user_name,
                'amount'=>$amount,
                'time'=>time(),
                'description'=>'Payeer',
                'operation_id'=>$txn
            ));
            echo '<center><font color="green">Заявка на пополнение создана. Ожидайте обработки.</font></center>';
        }
    }else{
        echo '<center><font color="red">Неверный номер транзакции!</font></center>';
    }
}
?>
<div id="error3"></div>
    <form method="POST" action="">
	Введите сумму [RUB]:  
	<input type="text" value="100" name="sum" size="7">
	<BR />
        Введите номер транзакции:  
	<input type="text" value="" name="txn" size="20">
        <BR />
        <center><input type="submit" id="submit" value="Пополнить баланс" ></center>
    </form>
<div class="clr"></div>		
</div>