<?PHP

class db{
	private $con = false; // Идентификатор
	private $Queryes = 0; // Число запросов
	private $MySQLErrors = array(); // Массив с ошибками
	private $TimeQuery = 0; // Всемя запросов
	private $MaxExTime = 0; // Максимальное время за 1 запрос
	private $ListQueryes = array(); // Список запросов
	private $HardQuery = ""; // Самый тяжелый запрос
	private $LastQuery = false; // Ресурс запрос
        private $LastResource = false; // Крайний Ресурс запрос
	private $ConnectData = array(); // Данные соединения
	
	/*======================================================================*\
	Function:	__construct
	Descriiption: Выполняется при создании экземпляра класса
	\*======================================================================*/
	public function __construct($host, $user, $pass, $base){
		$this->Connect($host, $user, $pass, $base);
		$this->query("SET NAMES 'utf8'");
		$this->query("SET CHARACTER SET 'utf8'");
	}
	
	/*======================================================================*\
	Function:	Stats
	Descriiption: Возвращает статистику по запросам
	\*======================================================================*/
	public function Stats(){
		$sD = array();
		$sD["TimeQuery"] = $this->TimeQuery;
		$sD["MaxExTime"] = $this->MaxExTime;
                $sD["LastQuery"] = $this->ListQueryes['last'];
		$sD["ListQueryes"] = $this->ListQueryes;
		$sD["HardQuery"] = $this->HardQuery;
		$sD["Queryes"] = $this->Queryes;
		return $sD;
	}

	/*======================================================================*\
	Function:	GetError
	Descriiption: Выводит описание ошибки в поток
	\*======================================================================*/
	private function GetError($TextError,$query = false){
		$this->MySQLErrors[] = $TextError;
                $fp = fopen('logs/mysql.txt', 'a');
		fwrite($fp, date('Y-m-d H:i:s',time()).' ERROR: '.$TextError.'; QUERY: '.$query . PHP_EOL);
		fclose($fp);
		die($TextError);
	}
	/*======================================================================*\
	Function:	query
	Descriiption: Запрос
	\*======================================================================*/	
	public function query($query, $FreeMemory = false, $write_last = true){
		$TimeA = $this->get_time();
		$xxt_res = mysqli_query($this->con, $query) or $this->GetError(mysqli_error($this->con),$query);	
		if($write_last === true){
                    $this->LastQuery = $xxt_res;
                    $this->ListQueryes['last'] = $query;
                }else{
                    $this->LastResource = $xxt_res;
                }
		$TimeB = $this->get_time() - $TimeA;
		$this->TimeQuery += $TimeB;
		if($TimeB > $this->MaxExTime){$this->HardQuery = $query; $this->MaxExTime = $TimeB;}
		$this->ListQueryes[] = $query;
		$this->Queryes++;
		if(!$FreeMemory){
                    return $this->LastQuery;
		}else{
                    return $this->FreeMemory();
                }
	}

	/*======================================================================*\
	Function:	Connect
	Descriiption: Соединяется с ДБ
	\*======================================================================*/	
	private function Connect($host, $user, $pass, $base){
		$this->con =  @mysqli_connect($host, $user, $pass, $base) or $this->GetError(mysqli_connect_error());
	} 
	
	
	/*======================================================================*\
	Function:	MultiQuery
	Descriiption: Множественный запрос
	\*======================================================================*/	
	function MultiQuery($query){
            $TimeA = $this->get_time();
            mysqli_multi_query($this->con, $query) or $this->GetError(mysqli_connect_error());
            $TimeB = $this->get_time() - $TimeA;	
            $ret_data = array();
            $counter = 0;
            do{
                if ($result = mysqli_store_result($this->con)) {
                    while ($row = mysqli_fetch_array($result)) {
                        $ret_data[$counter][] = $row;
                    }
                    mysqli_free_result($result);
                    $counter++;
                }
            }
            while(mysqli_next_result($this->con));
            $this->TimeQuery += $TimeB;
            if($TimeB > $this->MaxExTime){$this->HardQuery = $query; $this->MaxExTime = $TimeB;}
            $this->ListQueryes[] = $query;
            $this->Queryes++;
            return $ret_data;
	}
	
	/*======================================================================*\
	Function:	get_time
	Descriiption: Возвращает строку времени
	\*======================================================================*/	
	private function get_time()
	{
		list($seconds, $microSeconds) = explode(' ', microtime());
		return ((float) $seconds + (float) $microSeconds);
	}
	
	/*======================================================================*\
	Function:	__destruct
	Descriiption: Выполняется при уничтожении экземпляра класса
	\*======================================================================*/
	function __destruct(){
		
		if( !count($this->MySQLErrors) ) mysqli_close($this->con);
	
	}
	
	/*======================================================================*\
	Function:	FreeMemory
	Descriiption: Освобождает память
	\*======================================================================*/
	function FreeMemory()
	{
		$tr = ($this->LastQuery) ? true : false;
		@mysqli_free_result($this->LastQuery);
		return $tr;
	}
        
        /*======================================================================*\
	Function:	FreeMemoryLast
	Descriiption: Освобождает память последнего ресурса
	\*======================================================================*/
	function FreeMemoryLast()
	{
		$tr = ($this->LastResource) ? true : false;
		@mysqli_free_result($this->LastResource);
		return $tr;
	}
	
	/*======================================================================*\
	Function:	RealEscape
	Descriiption: Фильтрация )
	\*======================================================================*/
	function RealEscape($string)
	{
		if ($this->con) return mysqli_real_escape_string ($this->con, $string);
		else return mysqli_escape_string($string);
	}
	
	/*======================================================================*\
	Function:	NumRows
	Descriiption: Подсчет числа строк
	\*======================================================================*/
	function NumRows(){
		return mysqli_num_rows($this->LastQuery);
	}
        /*======================================================================*\
	Function:	NumRowsLast
	Descriiption: Подсчет числа строк крайнего запроса
	\*======================================================================*/
	function NumRowsLast(){
		return mysqli_num_rows($this->LastResource);
	}
	
	/*======================================================================*\
	Function:	fetch_array
	Descriiption: Возвращ массив, создает циферные ключи...
	\*======================================================================*/
	function FetchArray(){
            return mysqli_fetch_array($this->LastQuery);
	}
        
        /*======================================================================*\
	Function:	fetch_array LAST
	Descriiption: Возвращ массив, создает циферные ключи...
	\*======================================================================*/
	function FetchArrayLast(){
            return mysqli_fetch_array($this->LastResource);
	}
        
        /*======================================================================*\
	Function:	fetch_assoc
	Descriiption: Возвращ массив, создает строковые ключи...
	\*======================================================================*/
	function FetchAssoc(){
            return mysqli_fetch_assoc($this->LastQuery);
	}
        
        /*======================================================================*\
	Function:	fetch_assoc LAST
	Descriiption: Возвращ массив, создает строковые ключи...
	\*======================================================================*/
	function FetchAssocLast(){
            return mysqli_fetch_assoc($this->LastResource);
	}
	
	/*======================================================================*\
	Function:	NumRows
	Descriiption: Возвращает результат
	\*======================================================================*/
	function FetchRow(){
		$xres = mysqli_fetch_row($this->LastQuery);
		return (count($xres) > 1) ? $xres :  $xres[0];
	}
        
        /*======================================================================*\
	Function:	NumRowsLast
	Descriiption: Возвращает результат
	\*======================================================================*/
	function FetchRowLast(){
		$xres = mysqli_fetch_row($this->LastResource);
		return (count($xres) > 1) ? $xres :  $xres[0];
	}
	
	/*======================================================================*\
	Function:	LastInsert()
	Descriiption: Возвращает последний ID вставки
	\*======================================================================*/
	function LastInsert(){
		return @mysqli_insert_id($this->con);
	}
}