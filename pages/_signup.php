<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION["title"] = "Регистрация";
$_OPTIMIZATION["description"] = "Регистрация пользователя в системе";
$_OPTIMIZATION["keywords"] = "Регистрация нового участника в системе";
if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }
?>
<div class="s-bk-lf">
	<div class="acc-title">Регистрация</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP
# Регистрация
if(isset($_POST["signup"])){
    if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
        unset($_SESSION["captcha"]);
        $login = $func->IsLogin($_POST["login"]);
        $password = $func->IsPassword($_POST["password"]);
        $ip = $func->UserIP;
        $email = $func->IsMail($_POST["email"]);
        $rules = isset($_POST["rules"]) ? true : false;
        $time = time();
        $referer_id = intval($_SESSION['referer_id']);
        $referer_name = "";
        if($referer_id != 1){
                $db->Query("SELECT user FROM db_users_a WHERE id = '$referer_id' LIMIT 1");
                if($db->NumRows() > 0){$referer_name = $db->FetchRow();}
                else{ $referer_id = 1; $referer_name = "Admin"; }
        }else{ $referer_id = 1; $referer_name = "Admin"; }
        if($rules){
            if($email !== false){
                if($login !== false){
                    if($password !== false){
                        if($password == $_POST["repass"]){
                            $db->Query("SELECT COUNT(*) FROM `db_users_a` WHERE `email` = '$email'");
                            if($db->FetchRow() == 0){
                                $db->Query("SELECT COUNT(*) FROM db_users_a WHERE user = '$login'");
                                if($db->FetchRow() == 0){
                                    $autoreferal = false;
                                    if($referer_id == 1){
                                        $date = new DateTime();
                                        $datetime = $date->format('Y-m-d H:i:s');
                                        $db->Query("UPDATE `db_autoref` SET `status` = 0 WHERE `end` < '$datetime'");
                                        $db->Query("SELECT * FROM `db_autoref` WHERE `status` = 1");
                                        if($db->NumRows() > 0){
                                            $a = array();
                                            $tmp = array();
                                            while($x = $db->FetchArray()){
                                                $a[] = $x['user_id'];
                                            }
                                            $db->Query("SELECT * FROM `db_autoref_temp`");
                                            if($db->NumRows() > 0){
                                                while($x = $db->FetchArray()){
                                                    $tmp[] = $x['user_id'];
                                                }
                                                $diff = array_diff($a, $tmp);
                                                if(!empty($diff)){
                                                    $referer_id = $diff[array_rand($diff,1)];
                                                }else{
                                                    $db->Query("TRUNCATE TABLE `db_autoref_temp`");
                                                    $db->Query("SELECT `user_id` FROM `db_autoref` ORDER BY RAND() LIMIT 1");
                                                    $referer_id = $db->FetchRow();
                                                }
                                            }else{
                                                $referer_id = $a[array_rand($a,1)];
                                            }
                                            if($referer_id){
                                                $db->Query("INSERT INTO `db_autoref_temp` (`user_id`) VALUES ('$referer_id')");
                                                $db->Query("SELECT `user` FROM `db_users_a` WHERE `id` = '$referer_id'");
                                                $referer_name = $db->FetchRow();
                                                $autoreferal = true;
                                            }
                                        }
                                    }
                                    # Регаем пользователя
                                    $db->Query("INSERT INTO db_users_a (user, email, pass, referer, referer_id, date_reg, ip) 
                                    VALUES ('$login','{$email}','$password','$referer_name','$referer_id','$time',INET_ATON('$ip'))");
                                    $lid = $db->LastInsert();
                                    $db->Query("INSERT INTO db_users_b (id, user, a_t, last_sbor) VALUES ('$lid','$login','1', '".time()."')");
                                    if($autoreferal === true){
                                        $db->Query("INSERT INTO `db_autoref_history` (`user_id`,`referal_id`) VALUES ('$referer_id','$lid')");
                                    }
                                    # Вставляем статистику
                                    $db->Query("UPDATE db_stats SET all_users = all_users +1 WHERE id = '1'");
                                    # Отправляем на почту
                                    $sender = new isender;
                                    $sender -> SendAfterReg($login,$email, $password);
                                    $_SESSION["user_id"] = $lid;
                                    $_SESSION["user"] = $login;
                                    $_SESSION["referer_id"] = $referer_id;
                                    setcookie('referer',NULL,-1,'/',$_SERVER['HTTP_HOST'],0);
                                    Header("Location: /account");
                                    ?></div>
                                    <div class="clr"></div>	
                                    <?PHP
                                    return;
                                }else echo "<center><b><font color = 'red'>Указанный логин уже используется</font></b></center><BR />";
                            }else echo "<center><b><font color = 'red'>Указанный email уже используется</font></b></center><BR />";
                        }else echo "<center><b><font color = 'red'>Пароль и повтор пароля не совпадают</font></b></center><BR />";
                    }else echo "<center><b><font color = 'red'>Пароль заполнен неверно</font></b></center><BR />";
                }else echo "<center><b><font color = 'red'>Логин заполнен неверно</font></b></center><BR />";
            }else echo "<center><font color = 'red'><b>Email имеет неверный формат</b></font></center>";
        }else echo "<center><b><font color = 'red'>Вы не подтвердили правила</font></b></center><BR />";
    }else echo "<center><font color = 'red'><b>Символы с картинки введены неверно</b></font></center>";
}	
?>


<BR />
<form action="" method="post">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="left" style="padding:3px;">Ваш псевдоним: <font color="#FF0000">*</font></td>
			<td align="left" style="padding:3px;"><input name="login" type="text" size="25" maxlength="10" value="<?=(isset($_POST["login"])) ? $_POST["login"] : false; ?>"/></td>
		</tr>
		<tr>
			<td colspan="2" align="left" style="padding:3px;">Поле псевдоним должно иметь от 4 до 10 символов (только англ. символы).</td>
		</tr>
		<tr>
			<td align="left" style="padding:3px;">Email: <font color="#FF0000">*</font></td>
			<td align="left" style="padding:3px;"><input name="email" type="text" size="25" maxlength="50" value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>"/></td>
		</tr>
		<tr>
			<td colspan="2" align="left">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" style="padding:3px;">Пароль: <font color="#FF0000">*</font></td>
			<td align="left" style="padding:3px;"><input name="password" type="password" size="25" maxlength="20" /></td>
		</tr>
		<tr>
			<td colspan="2" align="left" style="padding:3px;">Поле Пароль должно иметь от 6 до 20 символов (только англ. символы).</td>
		</tr>
		<tr>
			<td align="left" style="padding:3px;">Пароль еще раз: <font color="#FF0000">*</font></td>
			<td align="left" style="padding:3px;"><input name="repass" type="password" size="25" maxlength="20" /></td>
		</tr>
		<tr>
			<td colspan="2" align="left" style="padding:3px;">Пароли должны совпадать.</td>
		</tr>
		<tr>
			<td colspan="2" align="left">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="2" align="left" style="padding:3px;">
			С <a href="/rules" target="_blank" class="stn">правилами</a> проекта ознакомлен(а) и принимаю: <input name="rules" type="checkbox" /></td>
		</tr>
		<tr>
			<td align="left" style="padding:3px;">
				<a href="#" onclick="ResetCaptcha(this);"><img src="/captcha.php?rnd=<?=rand(1,10000); ?>"  border="0" style="margin:0;"/></a>
			</td>
			<td align="left" style="padding:3px;">Введите символы с картинки<input name="captcha" type="text" size="25" maxlength="50" /></td>
		</tr>
		<tr>
			<td colspan="2" align="left">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center" style="padding:3px;"><input type="submit" name="signup" value="Зарегистрироваться" style="height: 30px;"></td>
		</tr>
	</table>
</form>
</div>
<div class="clr"></div>	