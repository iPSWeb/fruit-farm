<?PHP
$_OPTIMIZATION['title'] = 'Аккаунт - Профиль';
?>
<div class="s-bk-lf">
	<div class="acc-title">Мой профиль</div>
</div>
<div class="silver-bk">
	<p><center>Ваша дата регистрации: <font color="#000;"><?=date('d.m.Y в H:i:s',$user_data['date_reg']); ?></font></center></p>
	<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr><td colspan="2" align="center">&nbsp;</td></tr>
	  <tr>
		<td align="left" style="padding:3px;">ID</td>
		<td align="left" style="padding:3px;"><font color="#000;"><?=$user_data['id']; ?></font></td>
	  </tr>
	  <tr>
		<td align="left" style="padding:3px;">Псевдоним</td>
		<td align="left" style="padding:3px;"><font color="#000;"><?=$user_data['user']; ?></font></td>
	  </tr>
	  <tr>
		<td align="left" style="padding:3px;">Email</td>
		<td align="left" style="padding:3px;"><font color="#000;"><?=$user_data['email']; ?></font></td>
	  </tr>
	  <tr>
		<td align="left" style="padding:3px;">Баланс (Для покупок)</td>
		<td align="left" style="padding:3px;"><font color="#000;"><?=sprintf('%.2f',$user_data['money_b']); ?> cеребра</font></td>
	  </tr>
	  <tr>
		<td align="left" style="padding:3px;">Баланс (На вывод)</td>
		<td align="left" style="padding:3px;"><font color="#000;"><?=sprintf('%.2f',$user_data['money_p']); ?> cеребра</font></td>
	  </tr>
	  <tr>
		<td align="left" style="padding:3px;">Заработано на рефералах</td>
		<td align="left" style="padding:3px;"><font color="#000;"><?=sprintf('%.2f',$user_data['from_referals']); ?> cеребра</font></td>
	  </tr>
		<tr>
		<td align="left" style="padding:3px;">Выплачено</td>
		<td align="left" style="padding:3px;"><font color="#000;"><?=sprintf('%.2f',$user_data['payment_sum']); ?> <?=$config->VAL; ?></font></td>
	  </tr>
	  <tr align="left">
		<td colspan="2" style="padding:3px;">&nbsp;</td>
		</tr>
	  <tr>
		<td align="left" style="padding:3px;">Вас пригласил:</td>
		<td align="left" style="padding:3px;"><font color="#000;"><?=$user_data['referer']; ?> его ID <?=$user_data['referer_id']; ?></font></td>
	  </tr>
	  
	</table>
	<div class="clr"></div>	
</div>
