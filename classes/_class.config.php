<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
class config{
    public $HostDB = 'localhost';
    public $UserDB = 'root';
    public $PassDB = '';
    public $BaseDB = 'fruit-farm';

    public $SYSTEM_START_TIME = 1357338458;
    public $VAL = 'Руб.';

    # PAYEER настройки
    public $AccountNumber = 'P111111';
    public $apiId = '11111111';
    public $apiKey = '11111111';

    public $shopID = '11111111';
    public $secretW = '11111111';
    # Настройки для оплаты кредита
    public $kredit_shopID = 'ShopID';
    public $kredit_secretW = 'SecretKEY';
}