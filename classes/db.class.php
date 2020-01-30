<?
	// Implementing Singleoton Function to restric single instance of class
	
	class db {
	
	
	private static $obj;
	private $db_link=null;
	private $result;
	private $last_id=null;
	private $num_pages=null;
	
	//DB Class default Contructor
	private function db() {
		
		//private constructor
		
		global $config;
			
		$this->db_link = mysql_connect($config["server"],$config["username"],$config["password"]) or die("Could not connect");
		mysql_select_db($config["catelog"],$this->db_link) or die("Could not Select DatabBase");
		
		
	} //end of private static constructor
	
	/*public static function DestroyDbObject() {
		
		self::$obj=null;
		
	}*/
	
	
	public static function singleton() {
		
	
		if(!isset(self::$obj))  {
		
			self::$obj = new db();

		} 
		
		return self::$obj;
		
	} //singleton function
	
	
	
	
	function SetQuery($query) {
	
		$this->result = mysql_query($query,$this->db_link) or die(mysql_error());
		$this->last_id = mysql_insert_id();
		
	}
	
	public function GetLastID() {
		
		return $this->last_id;
		
	}
	
	public function GetNumRows() {
	
		return mysql_num_rows($this->result);
	}
		
	public function GetEffRows() {
	
		return mysql_affected_rows();
	}
		
	
	public function GetNumberOfPages() {
		
		return $this->num_pages;
		
	}
	
	
	public function LoadObjectList($pageno="null",$pagesize="null") {

		if($pageno != "null" && $pagesize != "null") {

			$num_rows = $this->GetNumRows();
			$this->num_pages = intval($num_rows/$pagesize);
			if($num_rows%$pagesize) $this->num_pages++;
			
		}
		
		$arr = array();
		
		if($this->GetNumRows()) {
			
			$index = 0;		
			if($pageno != "null" && $pagesize != "null") {

				mysql_data_seek($this->result,($pageno-1)*$pagesize);
				$i=1;
				while($row = mysql_fetch_object($this->result)) {
					
					if($pagesize<$i++) break;
					
					$arr[$index] = $row;
					$index++;
				
				} //WHILE
				
			} else {
			
				while($row = mysql_fetch_object($this->result)) {
					$arr[$index] = $row;
					$index++;
				
				} //WHILE
			
			}
			
			return $arr;
			
		} else{
			
			return false;
			
		} //if
		
		
	
	} 
	
		public function LoadObject() {
		
		if($this->GetNumRows()) {
					
			$row = mysql_fetch_object($this->result);
			
			return $row;	
		
		} else {  //if
		
			return false;
		} 
		
		
	
	}  //load object
	
	
	public static function GetLink() { 
			
		return $this->db_link;
		
		
	} //function
		
	
		
		
} //class
	
?>