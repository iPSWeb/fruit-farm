<?php
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
$_OPTIMIZATION['title'] = 'Выплаты';
$status_array = array( 0 => "Проверяется", 1 => "Выплачивается", 2 => "Отменена", 3 => "Выплачено");
$page = (isset($_GET['page']) && intval($_GET['page']) < 1000 && intval($_GET['page']) >= 1) ? (intval($_GET['page'])-1) : 0;
$lim = $page * 10;
$db->Query("SELECT COUNT(`id`) FROM `db_payment` WHERE `status` = '0' OR `status` = '1'");
$count_rows = $db->FetchRow();
?>
<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="">
            <div class="page-header-title">
                <h4 class="page-title">{!TITLE!}</h4>
            </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if(!empty($_POST['status'])){
                            $payment_id = intval($_POST['id']);
                            $status = intval($_POST['status']);
                            if($status == 3){
                                $db->Query("SELECT `user_id`, `purse`, `sum`, `commission` FROM `db_payment` WHERE `id` = '$payment_id'");
                                $data = $db->FetchArray();
                                $user_id = $data['user_id'];
								$amount = $data['sum'] - $data['commission'];
								$purse = $data['purse'];
								if(!empty($_POST['payeer_id'])){
									$ps = $_POST['payeer_id'];
								# Делаем выплату
									$payeer = new payeer($config->AccountNumber, $config->apiId, $config->apiKey);
									if(!$payeer->isAuth()){ $error[] = 'Не удалось авторизоваться в Payeer. Проверь настройки массовых выплат'; }
									if(empty($error)){
										$arBalance = $payeer->getBalance();
										if($arBalance['auth_error']){ $error[] = 'Ошибка авторизации'; }
										$balance = $arBalance['balance']['RUB']['DOSTUPNO'];
										if($balance < $amount){ $error[] = 'На балансе в Payeer недостаточно средств для выплаты'; }
									}
									if(empty($error)){
										$array = array(
											'action' => 'output',
											'ps' => $ps,
											'curIn' => 'RUB', // счет списания
											'sumOut' => $amount, // сумма получения
											'curOut' => 'RUB', // валюта получения
											'param_ACCOUNT_NUMBER' => $purse // получатель
										);
										$initOutput = $payeer->initOutput($array);
										if (!$initOutput){ $error[] = $payeer->getErrors(); }
									}
									if(empty($error)){
										$historyId = $payeer->output();
										if (empty($historyId)){ $error[] = $payeer->getErrors(); }
									}
								}
								if(empty($error)){
									$db->Query("UPDATE `db_users_b` SET `payment_sum` = `payment_sum` + '$amount' WHERE `id` = '$user_id'");
									$db->Query("UPDATE `db_stats` SET `all_payments` = `all_payments` + '$amount' WHERE `id` = '1'");
									echo '<div class="alert alert-success"><b>Выплата успешно произведена.</b></div>';
								}else{
									foreach($error as $key => $value){
										echo '<div class="alert alert-danger"><center><b>'.$value.'</b></center></div>';
									}
								}
                            }elseif($status == 2){
                                $db->Query("SELECT `user_id`,`serebro` FROM `db_payment` WHERE `id` = '$payment_id'");
                                $data = $db->FetchArray();
                                $user_id = $data['user_id'];
                                $serebro = $data['serebro'];
                                $db->Query("UPDATE `db_users_b` SET `money_p` = `money_p` + '$serebro' WHERE `id` = '$user_id'");
								echo '<div class="alert alert-success"><center><b>Заявка успешно отменена.</b></center></div>';
                            }
							if(empty($error)){
								$db->Query("UPDATE `db_payment` SET `status`='$status' WHERE `id`= '$payment_id'");
							}
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 partner_cl">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h4 class="m-b-30 m-t-0">Выплаты</h4>
                                <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered text-center" width="100%" cellspacing="0">
                                                    <thead>
                                                        <th style="padding: 5px;text-align: center;"><b>Логин</b></th>
                                                        <th style="padding: 5px;text-align: center;"><b>Серебро</b></th>
                                                        <th style="padding: 5px;text-align: center;"><b>Рублей</b></th>
                                                        <th style="padding: 5px;text-align: center;"><b>ПС</b></th>
                                                        <th style="padding: 5px;text-align: center;"><b>Кошелек</b></th>
                                                        <th style="padding: 5px;text-align: center;"><b>Дата</b></th>
                                                        <th style="padding: 5px;text-align: center;"><b>Статус</b></th>
                                                        <th style="padding: 5px;text-align: center;"><b>Управление</b></th>
                                                    </thead>
                                                    <tbody>
                                                    <?PHP
                                                    $db->Query("SELECT *,(SELECT `name` FROM `db_ps` WHERE `id` = `ps`) as `name`,(SELECT `icon` FROM `db_ps` WHERE `id` = `ps`) as `icon` FROM `db_payment` WHERE `status` = '0' OR `status` = '1' ORDER BY `date_add` DESC LIMIT {$lim}, 10");
                                                    if($db->NumRows() > 0){
                                                        while($data = $db->FetchArray()){
                                                    ?>
                                                        <tr align="center" class="ltb">
                                                            <td style="padding: 5px;"><a href="/admin/users/view=<?=$data['user_id']; ?>"><?=$data['user']; ?></a></td>
                                                            <td style="padding: 5px;"><?=$data['serebro']; ?></td>
                                                            <td style="padding: 5px;"><?=$data['sum']-$data['commission']; ?></td>
                                                            <td style="padding: 5px;"><img src="/assets/img/ps/icon/<?=$data['icon'];?>" width="20"> <?=$data['name']; ?></td>
                                                            <td style="padding: 5px;"><?=$data['purse']; ?></td>
                                                            <td style="padding: 5px;"><?=date('H:i d.m.Y',$data['date_add']); ?></td>
                                                            <td style="padding: 5px;"><?=$status_array[$data['status']]; ?></td>
                                                            <td style="padding: 5px;">
                                                            <?php
                                                            if($data['payeer_id'] != 0){ ?>
								<form action="" method="post">
                                                                    <input type="hidden" name="id" value="<?=$data['id'];?>">
                                                                    <input type="hidden" name="payeer_id" value="<?=$data['payeer_id'];?>">
                                                                    <select name="status">
                                                                        <option value="2">Отменить</option>
                                                                        <option value="3">Выплатить</option>
                                                                    </select>
                                                                    <button type="submit">Изменить</button>
                                                                </form>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="id" value="<?=$data['id'];?>">
                                                                    <select name="status">
                                                                        <option value="0">Проверяется</option>
                                                                        <option value="1">Выплачивается</option>
                                                                        <option value="2">Отменить</option>
                                                                        <option value="3">Выплачено</option>
                                                                    </select>
                                                                    <button type="submit">Изменить</button>
                                                                </form>
                                                            <?php
                                                            }
                                                            ?>
                                                            </td>
                                                        </tr>
                                                    <?PHP
                                                        }
                                                    }else echo '<tr><td align="center" colspan="8">Выплат нет</td></tr>'
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php
                                            if($count_rows > 10){
                                                $page = (isset($_GET['page']) AND intval($_GET['page']) < 1000 AND intval($_GET['page']) >= 1) ? (intval($_GET['page'])) : 1;
                                                $nav = new navigator;
                                                echo '<BR /><center>'.$nav->Navigation(10, $page, ceil($count_rows / 10), '/admin/exchanges/page='), '</center>';
                                            }?>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>