<?PHP

/*
 * Author: pligin
 * Site: psweb.ru
 * Telegram: t.me/pligin
 */


if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
class config{
    public $HostDB = 'localhost';
    public $UserDB = 'user_1_ff';
    public $PassDB = '9U8u7V8j';
    public $BaseDB = 'user_1_ff';
    public $CharsetDB = 'utf8';
    
    public $SYSTEM_START_TIME = 1357338458;
    public $VAL = 'Руб.';
    public $autoSborActive = true;//true - включен автосбор, false - выключен автосбор
    public $autoSborTime = '12:00';//время автоматического сбора
    public $costWelcomeText = 1;//стоимость приветственного сообщения
    public $accountWelcomeText = 'b';//Счет списания: b - с покупок, p - с выплат
    # PAYEER настройки
    public $AccountNumber = 'P111111';
    public $apiId = '11111111';
    public $apiKey = '11111111';

    public $shopID = '11111111';
    public $secretW = '11111111';
    #PSCoin
    public $PSCoinWallet = 'PSC-X2QN-WQL6-K96N-7ZGB9';
    public $PSCoinSecret = 'speak although wood pair strife breast claw thunder stupid unlike deadly either';
}