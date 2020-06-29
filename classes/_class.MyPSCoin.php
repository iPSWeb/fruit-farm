<?php
class MyPSCoin extends PSCoinApi {
	public function initialize(){
            parent::initialize();
	}

	function getSecret(){
            if(empty($this->_secret)) {
                echo "\n".'ENTER Secret Phrase: ';
                $this->_secret = trim(fgets(STDIN));
            }
            return $this->_secret;
	}

	function setSecret($sSecret){
            $this->_secret = $sSecret;
	}

	function getAccountId($secret) {
            if(!empty($this->accountId)) return $this->accountId;
            $this->aInput =  array(
                'requestType'=>'getAccountId',
                'secretPhrase'=>$secret
            );
            return $this->getResponse('accountRS');
	}

	function getAccount($accountId) {
            $this->aInput =  array(
                'requestType'=>'getAccount',
                'account'=>$accountId
            ); 
            return $this->getResponse();
        }
        
        function getAccountData($secret) {
            if(!empty($this->accountId)) return $this->accountId;
            $this->aInput =  array(
                'requestType'=>'getAccountId',
                'secretPhrase'=>$secret
            );
            return $this->getResponse();
	}
        
        function getAccountPublicKey($accountId) {
            $this->aInput =  array(
                'requestType'=>'getAccountPublicKey',
                'account'=>$accountId
            ); 
            return $this->getResponse();
        }
        
        function getBalance($accountId) {
            $this->aInput =  array(
                'requestType'=>'getBalance',
                'account'=>$accountId
            ); 
            return $this->getResponse('balanceNQT');
        }
        
        function getGuaranteedBalance($accountId,$deadline=24) {
            $this->aInput =  array(
                'requestType'=>'getGuaranteedBalance',
                'numberOfConfirmations'=>$deadline,
                'account'=>$accountId
            ); 
            return $this->getResponse('guaranteedBalanceNQT');
        }
        
	function getAliasList($accountId,$index=0) {
            $this->aInput =  array(
                'requestType'=>'getAliases',
                'firstIndex'=>$index,
                'account'=>$accountId
            );
            return $this->getResponse();
        }

	function getUnconfirmedTransactionIds($account) {
            $this->aInput =  array(
                'requestType'=>'getUnconfirmedTransactionIds',
                'account'=>$account
                ); 
            return $this->getResponse('unconfirmedTransactionIds');
        }

        function getTransaction($transactionId) {
            $this->aInput =  array(
                'requestType'=>'getTransaction',
                'transaction'=>$transactionId); 
            return $this->getResponse();
        }
        
	function getBlock($blockId) {
			$this->aInput =  array(	'requestType'=>'getBlock',
									'block'=>$blockId);
			return $this->getResponse();
		}

	function getTime() {
			$this->aInput =  array('requestType'=>'getTime'); 
			return $this->getResponse('time');
		}

	function sendMoney($recipient,$amount,$secret,$publickey='',$fee=100000000,$deadline=24) {
            $this->aInput =  array(
                'requestType'=>'sendMoney',
                'recipient'=>$recipient,
                'recipientPublicKey' => $publickey,
                'amountNQT'=>$amount,
                'secretPhrase'=>$secret,
                //'publicKey'=>$this->_publicKey,
                'feeNQT' => $fee,
                'deadline'=>$deadline
            );
            return $this->getResponse('transaction');
        }

	function unlock(){
			$this->aInput =  array(	'user'=>rand(),
									'requestType'=>'startForging',
									'secretPhrase'=>$this->getSecret()); 
			return $this->getResponse();
	}
	function lock(){
			$this->aInput =  array(	'user'=>rand(),
									'requestType'=>'stopForging',
									'secretPhrase'=>$this->getSecret()); 
			return $this->getResponse();
	}
	function islocked(){
			$this->aInput =  array(	'user'=>rand(),
									'requestType'=>'getForging',
									'secretPhrase'=>$this->getSecret()); 
			return $this->getResponse();
	}
}





