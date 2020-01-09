<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION["title"] = "Аккаунт - PSCoin";
$activate = 1;//1 - активация при создании кошелька, с Вашего кошелька будет отправлена случайная сумма от 10 до 50 PSC, 0 - кошелек не активируется, для активации требуется отправить на него некоторую сумму PSC.
$data_psc = $db->Query("SELECT * FROM `db_psc` WHERE `user_id` = '$user_id' LIMIT 1");
if($db->NumRows() == 1){
    $user_data['psc'] = $db->FetchAssoc();
}
$nqt = 100000000;//стоимость одного PSC в NQT
$proccess = false;
$deadline = 24;//количество подтверждений для гарантированного баланса
$fee=100000000;//комиссия за операцию в NQT, не может быть меньше 100000000 (1 PSC)
$feePSC = $fee/$nqt;//комиссия в PSC
$amountActivation = 1;//сумма для активации аккаунта
$psc = new MyPSCoin();
?>
<div class="s-bk-lf">
	<div class="acc-title">PSCoin</div>
</div>
<div class="silver-bk">
    <p>Кошелек PSCoin откроет Вам много новых возможностей</p>
<?PHP
if(empty($user_data['psc'])){
    if(isset($_POST['new_psc'])){
        $secretPhrase = $func->getPhrase();
        //Генерируется номер кошелька
        $accountRS = $psc->getAccountId($secretPhrase);
        //Запрашивается информация о кошельке
        $q = $psc->getAccount($accountRS);
        //Если кошелек существует (нет ошибки с кодом 5), 
        //то происходит повторная генерация и проверка до того момента,
        //пока не будет найден свободный кошелек
        while(empty($q->errorCode) && $q->errorCode != 5){
            $secretPhrase = $func->getPhrase();
            $accountRS = $psc->getAccountId($secretPhrase);
            $q = $psc->getAccount($accountRS);
        }
        $data = $psc->getAccountData($secretPhrase);
        $account = $data->account;
        $publicKey = $data->publicKey;
        $db->Query("INSERT INTO `db_psc` SET `user_id` = '$user_id',`publickey` = '$publicKey',`accountRS` = '$accountRS',`account`='$account',`phrase`='$secretPhrase'");
        if($activate == 1){
            $amount = $amountActivation * $nqt;
            $GuaranteedBalanceAdmin = $psc->getGuaranteedBalance($config->PSCoinWallet);
            if($GuaranteedBalanceAdmin >= $amount+$fee){
                $psc->sendMoney($accountRS, $amount, $config->PSCoinSecret,$publicKey);
                echo 'Кошелек PSC успешно создан<br>'
                    . 'Адрес кошелька: '. $accountRS .'<br>'
                    . 'Открытый ключ: '. $publicKey .'<br>'
                    . 'Кошелек активирован автоматически путем отправки на него '.$rand.' PSC<br>'
                    . 'Обновите страницу через несколько минут<br>';
                $proccess = true;
            }
        }
        if($proccess === false){
            echo 'Кошелек PSC успешно создан<br>'
                . 'Адрес кошелька: '. $accountRS .'<br>'
                . 'Открытый ключ: '. $publicKey .'<br>'
                . 'Вам требуется его активировать путем отправки на него любой суммы PSC. Вы можете отправить со своего кошелька либо воспользоваться формой ниже и обменять со счета на вывод на счет PSCoin.<br>'
                . 'При первом пополнении этого кошелька со своего кошелька обязательно укажите открытый ключ получателя в форме отправки PSC<br>';
        }
        $user_data['psc']['accountRS'] = $accountRS;
        $user_data['psc']['account'] = $account;
        $user_data['psc']['phrase'] = $secretPhrase;
        $user_data['psc']['publickey'] = $publicKey;
    }else{
    ?>
    Откройте счет PSCoin и зарабатывайте PSC.<br>
    Чтобы иметь возможность автоматически пополнять и выводить PSCoin нажмите "Открыть счет PSCoin".<br>
    Этот кошелек будет управляться нашей системой и с его помощью Вы сможете пополнять игровой счет и выводить с игрового счета средства<br>
    <form id="psc_form" method="POST" action="">
        <button name="new_psc">Открыть счет PSCoin</button>
    </form>
    <?PHP
    }
}
if(!empty($user_data['psc']) && $proccess === false){
    if(empty($user_data['psc']['publickey'])){
        $publickey = $psc->getAccountPublicKey($user_data['psc']['accountRS']);
        $accountRS = $user_data['psc']['accountRS'];
        if(!empty($publickey)){
            $db->Query("UPDATE `db_psc` SET `publickey` = '$publickey' WHERE `accountRS` = '$accountRS'");
        }
    }
    $q = $psc->getAccount($user_data['psc']['accountRS']);
    if(!empty($q->errorCode) && $q->errorCode == 5){
        echo 'Ваш кошелек не активирован. Отправьте на него любую сумму PSC. В форме отправки PSC обязательно укажите открытый ключ получателя.<br>'
        . 'Адрес кошелька: '. $user_data['psc']['accountRS'] .'<br>'
        . 'Открытый ключ: '. $user_data['psc']['publickey'] .'<br>';
        echo 'Вы можете активировать аккаунт путем вывода на него средств со счета на вывод (обмен), используя форму ниже.<br>';
    }else{
        $balance = $psc->getBalance($user_data['psc']['accountRS']);
        $GuaranteedBalance = $psc->getGuaranteedBalance($user_data['psc']['accountRS'],$deadline);
        if($balance < $nqt){
            $balance = 0;
        }else{
             $balance = $balance / $nqt;
        }
        if($GuaranteedBalance < $nqt){
            $GuaranteedBalance = 0;
        }else{
             $GuaranteedBalance = $GuaranteedBalance / $nqt;
        }
        echo 'Ваш баланс счета PSC: '. $balance .' PSC<br>';
        echo 'Гарантированный баланс счета PSC: '. $GuaranteedBalance .' PSC<br>';
        echo 'Гарантированный баланс - это неизменный баланс, с которым проводятся все операции. В нашей системе гарантированный баланс - это баланс, имеющий '.$deadline.' подтверждения<br><br>';
        
        if(isset($_POST['getMoney']) && !empty($_POST['amount'])){
            $wait = $psc->getUnconfirmedTransactionIds($user_data['psc']['accountRS']);
            if(empty($wait)){
                $amount = intval($_POST['amount']);
                if($amount >=1){
                    if($amount <= $GuaranteedBalance-$feePSC){
                        $serebro = $amount * $db_config['ser_per_psc'];
                        $send = $amount * $nqt;
                        $psc->sendMoney($config->PSCoinWallet, $send, $user_data['psc']['phrase'],'',$fee,$deadline);
                        $db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` + '$serebro' WHERE `id` = '$user_id'");
                        echo 'Средства успешно зачислены!<br>';
                    }else{
                        echo 'Гарантированный баланс PSC меньше нужной суммы<br>';
                    }
                }else{
                    echo 'Минимальная сумма ввода 1 PSCoin<br>';
                }
            }else{
                echo 'Подождите выполнения предыдущей транзакции<br>';
            }
            
        }
        ?>
    Обменять PSCoin на серебро для покупок<br>
    <form action="" method="POST">
        <input type="text" name="amount" value="" placeholder="Введите сумму серебра"><br>
        <button name="getMoney">Обменять</button>
    </form><br>
    <?PHP
    if(isset($_POST['pay']) && !empty($_POST['amount']) && !empty($_POST['wallet'])){
        $wait = $psc->getUnconfirmedTransactionIds($user_data['psc']['accountRS']);
        if(empty($wait)){
            $amount = intval($_POST['amount']);
            $wallet = $func->validatePSC($_POST['wallet']);
            if($amount >=10){
                if($amount <= $GuaranteedBalance-$feePSC){
                    $send = $amount * $nqt;
                    $tr = $psc->sendMoney($wallet, $send, $user_data['psc']['phrase'],'',$fee,$deadline);
                    if(empty($tr)){
                        echo 'Ошибка отправки PSC!<br>';
                    }else{
                        echo 'Средства успешно отправлены!<br>';
                    }
                }else{
                    echo 'Гарантированный баланс PSC меньше нужной суммы<br>';
                }
            }else{
                echo 'Минимальная сумма вывода 10 PSCoin<br>';
            }
        }else{
            echo 'Подождите выполнения предыдущей транзакции<br>';
        }
    }
    ?>
    Вывести PSCoin на свой кошелек<br>
    <form action="" method="POST">
        <input type="text" name="wallet" value="" placeholder="Введите Ваш кошелек PSC"><br>
        <input type="text" name="amount" value="" placeholder="Введите сумму серебра"><br>
        <button name="pay">Вывести</button>
    </form><br>
    <?PHP
    }
    if(isset($_POST['sendMoney']) && !empty($_POST['amount'])){
        $wait = $psc->getUnconfirmedTransactionIds($user_data['psc']['accountRS']);
        if(empty($wait)){
            $amount = intval($_POST['amount']);
            if($amount >=10){
                if($amount <= $user_data['money_p']){
                    $send = $amount / $db_config['ser_per_psc'] * $nqt;
                    $GuaranteedBalanceAdmin = $psc->getGuaranteedBalance($config->PSCoinWallet);
                    if($send <= $GuaranteedBalanceAdmin-$feePSC){
                        $tr = $psc->sendMoney($user_data['psc']['accountRS'], $send, $config->PSCoinSecret,$user_data['psc']['publickey'],$fee,$deadline);
                        if(!empty($tr)){
                            $db->Query("UPDATE `db_users_b` SET `money_p` = `money_p` - '$amount' WHERE `id` = '$user_id'");
                            echo 'Средства успешно отправлены!<br>';
                        }else{
                            echo 'Ошибка #631! Сообщите о ней администратору!<br>';
                        }
                    }else{
                        echo 'Ошибка #631! Сообщите о ней администратору!<br>';
                    }
                }else{
                    echo 'Недостаточно серебра на счету<br>';
                }
            }else{
                echo 'Минимальная сумма вывода 10 серебра<br>';
            }
        }else{
            echo 'Подождите выполнения предыдущей транзакции<br>';
        }
    }
    ?>
    Обменять серебро для вывода на PSCoin<br>
    <form action="" method="POST">
        <input type="text" name="amount" value="" placeholder="Введите сумму серебра"><br>
        <button name="sendMoney">Обменять</button>
    </form>
    <?PHP
    
}
?>
<div class="clr"></div>		
</div>