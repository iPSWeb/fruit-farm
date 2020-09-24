<?PHP

/*
 * Author: pligin
 * Site: psweb.ru
 * Telegram: t.me/pligin
 */


if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
class config{
    public $HostDB = '';
    public $UserDB = '';
    public $PassDB = '';
    public $BaseDB = '';
    public $CharsetDB = 'utf8';
    
    public $SYSTEM_START_TIME = 1357338458;
    public $VAL = 'Руб.';
    #автоматический сбор продуктов
    public $autoSborActive = true;//true - включен автосбор, false - выключен автосбор
    public $autoSborTime = '12:00';//время автоматического сбора
    #приветственное сообщение
    public $costWelcomeText = 1;//стоимость приветственного сообщения
    public $accountWelcomeText = 'b';//Счет списания: b - с покупок, p - с выплат
    #настройка бонуса
    public $frequencyBonus = 24;//периодичность получения бонуса в часах
    public $minBonus = 10;//минимальная сумма бонуса в серебре
    public $maxBonus = 100;//максимальная сумма бонуса в серебре
    public $accountBonus = 'b';//счет для получения бонуса: b - дя поупок, p - для выплаты
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