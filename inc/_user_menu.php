<div class="acc-title"><?=$_SESSION["user"]; ?></div>
<div class="field-gr"><a href="/account">��� �������</a></div>
<?
if(isset($_SESSION["admin"])){
	echo '<div class="field-rd"><a href="/admin">�������</a></div>';
}
?>
<div class="field-gr"><a href="/account/farm">��������� �����</a></div>
<div class="field-gr"><a href="/account/store">��������� �����</a></div>
<div class="field-gr"><a href="/account/market">�������� �����</a></div>
<div class="field-gr"><a href="/account/bonus">���������� �����</a></div>
<div class="field-gr"><a href="/account/lottery">�������</a></div>
<div class="field-gr"><a href="/account/swap">��������</a></div>
<div class="field-gr"><a href="/account/referals">���� ��������</a></div>
<div class="field-gr"><a href="/account/insert">��������� ������</a></div>
<div class="field-gr"><a href="/account/payment">�������� �������</a></div>
<div class="field-gr"><a href="/account/config">���������</a></div>
<div class="field-rd"><a href="/account/exit">����� �� �������</a></div>
<div style="margin-top:20px;">
	<div class="acc-title">��������� �����</div>
	<div class="field-ar"><a href="/account/insert">{!BALANCE_B!}</a>  <span style="margin:3px 10px 0px 0px;">[��� �������]</span></div>
	<div class="field-ars"><a href="/account/payment">{!BALANCE_P!}</a> <span style="margin:3px 10px 0px 0px;">[�� �����]</span></div>
</div>