<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Пополнение баланса';
?>
<div class="s-bk-lf">
	<div class="acc-title">{!TITLE!}</div>
</div>
<div class="silver-bk"> 
Курс игровой валюты: 1 рубль = <?=$db_config['ser_per_wmr']; ?> серебра.
<p>Ввод средств позволяет автоматически приобрести игровое серебро с помощью различных платежных 
систем: Yandex Деньги, банковских карт, SMS, терминалов, денежных переводов и т.д.</p>
<p>Оплата и зачисление серебра на баланс производится в автоматическом режиме.</p> 
<p>Введите сумму в РУБЛЯХ, которую вы хотите пополнить на баланс. <BR />
После пополнения вам будет зачислено серебро.<br /></p>
<?PHP
/// db_payeer_insert
if(isset($_POST['sum'])){
    $amount = round(floatval($_POST['sum']),2);
    if($amount >= 1){
        # Заносим в БД
        $result = $pdo->prepare("INSERT INTO `db_payeer_insert` (`user_id`, `user`, `sum`, `date_add`,`description`) VALUES (:user_id,:user_name,:amount,:time,:description)");
        $result->execute(array(
            'user_id' => $user_id,
            'user_name'=>$user_name,
            'amount'=>$amount,
            'time'=>time(),
            'description'=>'Payeer'
        ));
        $desc = base64_encode("Пополнение баланса на проекте ".$_SERVER["HTTP_HOST"]." пользователем ".$user_name);
        $m_shop = $config->shopID;
        $m_orderid = $pdo->lastInsertId();
        $m_amount = number_format($amount, 2, '.', '');
        $m_curr = 'RUB';
        $m_desc = $desc;
        $m_key = $config->secretW;
        $arHash = array(
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc,
            $m_key
        );
        $sign = strtoupper(hash('sha256', implode(":", $arHash)));
        ?>
        <center>
            <form method="POST" action="//payeer.com/merchant/">
                <input type="hidden" name="m_shop" value="<?=$config->shopID; ?>">
                <input type="hidden" name="m_orderid" value="<?=$m_orderid; ?>">
                <input type="hidden" name="m_amount" value="<?=$m_amount;?>">
                <input type="hidden" name="m_curr" value="<?=$m_curr;?>">
                <input type="hidden" name="m_desc" value="<?=$desc; ?>">
                <input type="hidden" name="m_sign" value="<?=$sign; ?>">
                <input type="submit" name="m_process" value="Оплатить и получить серебро" />
            </form>
        </center>
    <div class="clr"></div>		
</div>
<?PHP
return;
    }else{
        echo '<center><font color="red">Сумма не может быть меньше 1 руб</font></center>';
    }
}
?>
<script type="text/javascript">
var min = 0.01;
var ser_pr = 100;
function calculate(st_q) {  
	var sum_insert = parseFloat(st_q);
	$('#res_sum').html( (sum_insert * ser_pr).toFixed(0) );
}
</script>
<div id="error3"></div>
<form method="POST" action="">
	Введите сумму [RUB]:  
	<input type="text" value="100" name="sum" size="7" id="psevdo" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)"> 
    Вы получите <span id="res_sum">10000</span> серебра
	<BR /><BR />
    <center><input type="submit" id="submit" value="Пополнить баланс" ></center>
</form>
<script type="text/javascript">
calculate(100);
</script>
<div class="clr"></div>		
</div>