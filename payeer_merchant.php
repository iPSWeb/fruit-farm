<?PHP

/*
 * Author: pligin
 * Site: psweb.ru
 * Telegram: t.me/pligin
 */

//Проверка IP сервера оповещений Payeer
if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) die('ERROR IP');
if (isset($_POST['m_operation_id']) && isset($_POST['m_sign'])){
    define('PSWeb', true);
    define('BASE_DIR',$_SERVER['DOCUMENT_ROOT']);
    # Автоподгрузка классов
    function my_autoloader($class) {
        include BASE_DIR.'/classes/_class.'.$class.'.php';
    }
    spl_autoload_register('my_autoloader');
    # Класс конфига 
    $config = new config;
    $m_key = $config->secretW;
    # Формируем массив для генерации подписи
    $arHash = array(
        $_POST['m_operation_id'],
        $_POST['m_operation_ps'],
        $_POST['m_operation_date'],
        $_POST['m_operation_pay_date'],
        $_POST['m_shop'],
        $_POST['m_orderid'],
        $_POST['m_amount'],
        $_POST['m_curr'],
        $_POST['m_desc'],
        $_POST['m_status']
    );
    # Если были переданы дополнительные параметры, то добавляем их вмассив
    if (isset($_POST['m_params'])){
	$arHash[] = $_POST['m_params'];
    }
    # Добавляем в массив секретный ключ
    $arHash[] = $m_key;
    # Формируем подпись
    $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
    # Если подписи совпадают и статус платежа “Выполнен”
    if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success'){
        $txnId = $_POST['m_operation_id'];
        $wallet = $_POST['client_account'];
        $email = $_POST['client_email'];
        $order_id = $_POST['m_orderid'];
	# База данных
	include(BASE_DIR.'/inc/_connect.php');
	# Информация о платеже из базы
        $result = $pdo->prepare("SELECT * FROM `db_payeer_insert` WHERE `id` = :id");
        $result->execute(array('id'=>$order_id));
	# Если в базе нет такого платежа, выдаем "Ошибка"
        if($result->rowCount() == 0){ exit($order_id.'|error');}
	# Массив информации о платеже	
        $row = $result->fetch();
	# Если статус платежа 1 ('Выполнено'), возвращаем 'Выполненно'
        if($row['status'] == 1){ exit($order_id.'|success');}
	# Если сумма платежа в оповещении не равна сумме в базе
        if($row['sum'] != $_POST['m_amount']){ exit($order_id.'|error');}
	# Сумма платежа		
        $amount = $row['sum'];
	# ID пользователя
        $user_id = $row['user_id']; 
	# Настройки из базы
        $result = $pdo->query("SELECT * FROM `db_config` WHERE `id` = '1' LIMIT 1");
        $config_site = $result->fetch();
	# Информация о пользователе и реферере
        $result = $pdo->prepare("SELECT * FROM `db_users_a`, `db_users_b` WHERE `db_users_a`.`id` = `db_users_b`.`id` AND `db_users_a`.`id` = :user_id");
        $result->execute(array('user_id'=>$user_id));
        $user_data = $result->fetch();
        $user_name = $user_data['user'];
        $referer_id = $user_data['referer_id'];
	# Зачисляем баланс
        $serebro = $config_site['ser_per_wmr'] * $amount;
	# Бонус при первом пополнении
        $serebro = $user_data['insert_sum'] == 0 ? $serebro + $serebro * $config->bonusFirstInsert/100 : $serebro;
	# Дерево/фрукт при пополнении на определенную сумму
        $add_tree = ( $amount >= 500) ? 2 : 0;
	# Отчисления рефералу
        $to_referer = $serebro * $config->toRefererFromInsert / 100;
        $result = $pdo->prepare("SELECT `refback` FROM `db_users_a` WHERE `id` = :referer_id");
        $result->execute(array('referer_id'=>$referer_id));
        $refback = $result->fetchColumn();
        if($refback > 0){
            $amount_refback = $to_referer*$refback/100;
            $result = $pdo->prepare("UPDATE `db_users_b` SET `money_p` = `money_p` + :amount_refback WHERE `id` = :user_id");//начисление рефбек: money_p - на счет для вывода,money_b - на счет для оплаты
            $result->execute(array(
                'amount_refback' => $amount_refback,
                'user_id' => $user_id
            ));
            $to_referer -= $amount_refback;
        }
	# Зачисляем пользователю
        $result = $pdo->prepare("UPDATE `db_users_b` SET `money_b`=`money_b`+ :serebro,`to_referer`=`to_referer`+ :to_referer,`last_sbor` = :time,`insert_sum`=`insert_sum`+ :amount WHERE `id` = :user_id");
        $result->execute(array(
            'serebro' => $serebro,
            'to_referer'=>$to_referer,
            'time' => time(),
            'amount' => $amount,
            'user_id' => $user_id
        ));
        $result = $pdo->prepare("UPDATE `db_payeer_insert` SET `status` = :status WHERE `id` = :order_id");
        $result->execute(array(
            'status'=>1,
            'order_id'=>$order_id
        ));
	# Зачисляем средства рефереру
        $result = $pdo->prepare("UPDATE `db_users_b` SET `money_b`=`money_b`+ :to_referer,`from_referals`=`from_referals`+ :from_referals WHERE `id` = :referer_id");
        $result->execute(array(
            'to_referer' => $to_referer,
            'from_referals' => $to_referer,
            'referer_id' => $referer_id
        ));
	# Статистика пополнений
        $da = time();
        $dd = $da + 60*60*24*15;
        $result = $pdo->prepare("INSERT INTO db_insert_money (`user`,`user_id`,`money`,`serebro`,`date_add`,`date_del`) VALUES (:user_name,:user_id,:amount,:serebro,:da,:dd)");
        $result->execute(array(
            'user_name' => $user_name,
            'user_id' => $user_id,
            'amount' => $amount,
            'serebro' => $serebro,
            'da' => $da,
            'dd' => $dd
        ));
	# Обновление статистики сайта
        $pdo->query("UPDATE `db_stats` SET `all_insert` = `all_insert` + '$amount' WHERE `id` = '1'");
        exit($_POST['m_orderid'].'|success');
    }
}
exit($_POST['m_orderid'].'|error');