<?
	class Constrain {
	
		private static $const_msg;
		
		
		/*******************************************************************************
		//Gettign Error String against error code from tbl_error table
		/*******************************************************************************/
		public static function GetErrorString($error_key) {
		
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			$query = "select * from tbl_error where Error_key='$error_key'";

			//print($query); exit;
			$dbconn->SetQuery($query);
			
			if($dbconn->GetNumRows()) {		
				
				$obj = $dbconn->LoadObject();
				
				if($obj->Active==1) {
					
					//returning Object List array
					return $obj->Error_name;
					
				} else {
					
					return "This is Not Active";
				}
				
			} else {
			
				//returning Error Message
				return "This Error code is not available.";
			}
			
		}  //getAll
		
		
		/*******************************************************************************/
		//Gettign constant Value against constant key from tbl_constant table
		/*******************************************************************************/
		public static function GetConstantValue($const_key) {
		
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			$query = "select * from tbl_constant where Constant_key='$const_key'";

			//print($query); exit;
			$dbconn->SetQuery($query);
			
			if($dbconn->GetNumRows()) {		
				
				$obj = $dbconn->LoadObject();
				
				Constrain::$const_msg = $obj->Description;
				return $obj->Constant_value;
				
				
			} else {
			
				//returning Error Message
				return "This Constant Key is not available.";
				
			}
			
		}  //getAll
		
		/*******************************************************************************
		// this function must be called after GetConstantValue function. It would
		// just return Constant description.
		/*******************************************************************************/
		
		public static function GetConstantMessage() {
		
			return Constrain::$const_msg;
			
		}
	
		
		/*******************************************************************************/
		//checking Number of Words in String
		/*******************************************************************************/
	
		public static function IsNumberOfWordsOk($string,$allow_words) {
		
			$string = str_replace(" ",",",$string);
			$arr = explode(",",$string);

			$m = 0;
			for($i=0;$i<count($arr);$i++) {
				
				// this is not string then move to array
				$pattern = "/[a-zA-Z0-9]+/";
				
				if(preg_match($pattern,$arr[$i]))  {
				
					$arr2[$m] = $arr[$i];
					$m++;
				}
				
			} //for
			//print_r($arr2); exit;
			if(count($arr2) <= $allow_words) 
				return true;
			else
				return false; //count($arr2);
			
		
		} //function
		
	
	
		/*******************************************************************************/
		//checking Word Length in String
		/*******************************************************************************/
	
		public static function IsWordLengthOk($string) {
		
			$string = str_replace(" ",",",$string);
			$arr = explode(",",$string);

			$m = 0;
			for($i=0;$i<count($arr);$i++) {
				
				// this is not string then move to array
				$pattern = "/[a-zA-Z0-9]+/";
				
				if(preg_match($pattern,$arr[$i]))  {
					//print(strlen($arr[$i])." = ". Constrain::GetConstantValue(2)."<br>");
					if(strlen($arr[$i]) > Constrain::GetConstantValue(2))  {
						
						$arr2[$m] = $arr[$i];
						$m++;
						
					}
				}
				
			} //for
			
			//print("Count = ".count($arr2)); exit;
			if(count($arr2) > 0) 
				return false; //$arr2;
			else
				return true;
			
		
		} //function
		
		/************************************************************************************/
		//checking whether word is exist in dictionary and Return array of wrong words
		/************************************************************************************/
		public static function CheckSpelling($string) {
			
			
			$string = strtolower(str_replace(" ",",",$string));
			$arr = explode(",",$string);
		
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			$m = 0;
			for($i=0;$i<count($arr);$i++) {
				
				// this is not string then move to array
				$pattern = "/[a-zA-Z]+/";
				
				if(preg_match($pattern,$arr[$i]))  {
					
					$word = $arr[$i];
					
					$query = "select * from tbl_dictionary where lower(Words) in ('$word') ";
					$dbconn->SetQuery($query);
					
					if(!$dbconn->GetNumRows()) {
						$arr2[$m] = $arr[$i];
						$m++;
					}
				}
				
			} //for
			
			
			if(count($arr2)) {
			
				return $arr2;
				
			} else {
				return 0;
			}

		}		
		
		
		/************************************************************************************/
		//checking whether user is entering consecutive word in same row from same ip address
		/************************************************************************************/
		public static function IsUserIPSame() {
			
			extract($_REQUEST);
			
			$user_ip = $_SERVER['REMOTE_ADDR'];
			
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			
			$query = "select Author_IP from 
							( 
								select Author_IP from tbl_story where Parent_story_key='$parent_id'
								order by Submission_time desc limit 1
								
							) as tmp
							
					 where Author_IP = '$user_ip' ";
			//print($query); exit;		 
			$dbconn->SetQuery($query);
			
			if($dbconn->GetNumRows()) {
			
				return true;
			
			} else {
				
				return false;
			}

		}		
		
		/*******************************************************************************/
		//checking forbidden word from tbl_forbidden table
		/*******************************************************************************/
		public static function IsForbidden($string) {
		
			$string = str_replace(" ",",",$string);
			$arr = explode(",",$string);

			$m = 0;
			for($i=0;$i<count($arr);$i++) {
				
				// this is not string then move to array
				$pattern = "/[a-zA-Z0-9]+/";
				
				if(preg_match($pattern,$arr[$i]))  {
				
						$arr2[$m] = "'".addslashes(strtolower($arr[$i]))."'";
						$m++;
						
					}
				
			} //for
			
			$word = "'0'";
			if(count($arr2) > 0)
				$word = implode(",",$arr2);
		

			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			$query = "select * from tbl_forbidden where lower(Word) in ($word)";

			//print($query); exit;
			$dbconn->SetQuery($query);
			
			if($dbconn->GetNumRows()) {		
				
				//$obj = $dbconn->LoadObject();
				return true;
		
			} else {
			
				
				return false;
				
			}
			
		}  //getAll
	
		/********************************************************************************************/
		// Get Total symbol from string. This function will receive string input and check this string
		// into database to find number of sysmbol in string. function will return number of occurance
		// of sysmbol found in database.
		/********************************************************************************************/
		
		public static function GetTotalSymbol($string) {
			//print($string); exit;
			global $config;
			
			$string = str_replace(" ",",",$string);
			$arr = explode(",",$string);

			$m = 0;
			for($i=0;$i<count($arr);$i++) {
				
				// this is not string then move to array
				$pattern = $config["allow_character"];
				
				//$pattern = str_replace("/","\/",$pattern);
				//$pattern = str_replace("'","\'",$pattern);
				
				$pattern = "/".$pattern."+/"; 

				if(!preg_match($pattern,$arr[$i]))  {
				
					$arr2[$m] = $arr[$i];
					$m++;
				}
				
			}
			//print_r($arr2); exit;
			if(count($arr2) > 0 )
				$a = implode("",$arr2);
			else 
				$a = "";
			
			return strlen($a);
			
			/*if(strlen($a) > 1) {
			
				return "You can use Only 1 Sysmbol. Right now you have ".strlen($a)." symbol(s).";
			}*/

			
		} //function		

		
		/****************************************************************************
		//	 This function removing to those character that can inject to database.
		****************************************************************************/
		
		public static function ClearSqlInjection($str) {
		
			$arr=array('%','$','/','\\','*','+','-','\'','"','#','@','(',')','^','~','`','&',
 				'_',',',':',';','?','<','>','!','{','}','[',']');
				
			return str_replace($arr,'',$str);

		}
		
		public static function SendMail($to,$from,$subject,$message,$cc,$bcc) {
		
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From:  $from\r\n";
			
			if(strcmp($cc,'0')) 
				$headers .= "Cc: $cc\r\n";
			if(strcmp($bcc,'0')) 
				$headers .= "Bcc: $bcc\r\n";
			
			$headers .= "Reply-To: <$from>\r\n";
			$headers .= "X-Mailer: PHP/" . phpversion();
			mail($to, $subject, $message, $headers);
			
		} //function
		
		/**************************************************************************************
						Read html via filing
		***************************************************************************************/
		
		public static function ReadFile($path) {
			
			$fp = fopen($path,"r");
			
			$str = "";
			
			while(!feof($fp))  {
			
				$str .= fread($fp,1024);
			
			}
			
			return $str;
			
			
		}
		
	} //constrain  class
?>