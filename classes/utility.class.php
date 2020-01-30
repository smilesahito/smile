<?

	class Utility {

	

		//default constructor. Private doesn't allow to create encryption class object

		private function encryption() { 

		

			//do nothing

		} //default constructor

		

		private function RandomCharacter($length) { 

			

			srand(date("s")); 

			$possible_charactors = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 

			$string = ""; 

			while(strlen($string)<$length) { 

				

				$string .= substr($possible_charactors, (rand()%(strlen($possible_charactors))),1);

				

			}  //while

		

		return($string); 

		

		} 

		public static function RandomNumber($length) { 

			

			srand(date("s")); 

			$possible_charactors = "1234567890"; 

			$string = ""; 

			while(strlen($string)<$length) { 

				

				$string .= substr($possible_charactors, (rand()%(strlen($possible_charactors))),1);

				

			}  //while

		

		return($string); 

		

		} 

		

		// To Encrypt string

		public static function encrypt() {

			

			$num_args = func_num_args();

			

			$param= "";

			for($x=0;$x<$num_args;$x++) {

				

				$param .= trim(func_get_arg($x))."||";

			

			}

			

			$param = substr($param,0,strlen($param)-2);

			

			$param = base64_encode($param);

			$m=1;

			$str="";

			

			for($i=0;$i<strlen($param);$i++) {

				$str .=substr($param,$i,1);

				

				if($m==4) {

					

					$possible_charactors = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 

					$val = substr($possible_charactors, rand(0,strlen($possible_charactors))%(strlen($possible_charactors)-20),1);

					$str .=$val;

					$m=1;

				}

				

			$m++;

		}

		

		$str = str_replace("=","TcVY",$str);

		return $str;

		

		} //function

		

		// To Decrypt String

		public static function decrypt($str) {

		

			$arr=array('%','$','/','\\','*','+','-','\'','"','#','@','(',')','^','~','`','&',

					'_',',',':',';','?','<','>','!','{','}','[',']');

					

			$str=str_replace($arr,'',$str);

		

			$str = str_replace("TcVY","=",$str);

			$m=1;

			$d_str="";

			for($i=0;$i<strlen($str);$i++) {

				if($m!=5) {

						$d_str .= substr($str,$i,1);

					} else {

						$m=1;

					}

				$m++;		

			}

			

			$d_str = base64_decode($d_str);

			return explode("||",$d_str);

			

		} //function

		

		/****************************************************************************

		//	 This function will send HTML base EMAIL.

		****************************************************************************/

		

		public static function SendMail($to,$from,$subject,$message,$cc='0',$bcc='0') {

		

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

					Send SMTP Email

		****************************************************************************************/

		

		public static function SendSmtpEmail($to,$from="",$subject,$message) {

	

		include_once(dirname(__FILE__) . '/../PEAR/Mail.php');

		include_once(dirname(__FILE__) . '/../PEAR/Mail/mime.php');

		

		

		//$host = "";

		$host = "localhost";

		$username = "";

		$password = "";

		

		if($from=="") {

		

			$from = "";

			

		}

		

		

		$html = $message;

		$crlf = "\n";

		

		

		//$to = 'azhar215@gmail.com';

		//$cc = "azhar@benthamscience.org";

		//$to = $to.",".$cc;

		

		$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);

		//$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject,'Cc'=>'azhar@benthamscience.org');

		

		// Creating the Mime message

		$mime = new Mail_mime($crlf);

		

		// Setting the body of the email

		$mime->setTXTBody($html);

		$mime->setHTMLBody($html);

		$body = $mime->get(array('text_charset' => 'utf-8'));

		$headers = $mime->headers($headers);

		

		//print_r($body); exit;

		$smtp = Mail::factory('smtp',

		array ('host' => $host,

		'auth' => true,

		'username' => $username,

		'password' => $password));

		

		$mail = $smtp->send($to, $headers, $body);

		

		 if (PEAR::isError($mail)) {

		   //echo("<p>" . $mail->getMessage() . "</p>");

		   return false;

		  } else {

		  	 //echo("<p>Message successfully sent!</p>");

			return true;

		  }

		  

		// print($message.'<br><br>');

		//  print_r($headers); exit;

	

	} 

		

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

		

		/*********************************************************************************************

		//	 This function removing to those character that can inject to database from REQUEST Array

		**********************************************************************************************/

		

		public static function ClearSqlInjection($arr) {			

				

			$arr = array();
	
		

			foreach($_REQUEST as $var => $val) {

			

				$val = addslashes($val);

				$arr[$var] = $val;

			

			}

		

			return $arr;



		}

		

		/*********************************************************************************************

		//	 This function Generate Invoice number

		**********************************************************************************************/

		public static function generateInvoiceNumber($content_type,$oid,$year){

		

			$dbconn=db::singleton();

			$query = "select content_type_id from tbl_content_type where content_type='$content_type'";

			$dbconn->SetQuery($query);

			$content_type_id = $dbconn->LoadObject()->content_type_id;	

			

			if($content_type_id<10) $content_type_id = "0".$content_type_id;

						// year 2 digit . contentType . orderID

			$invoiceno = $year.$content_type_id.$oid;

				

			return $invoiceno;

			

		}



		

		/*********************************************************************************************

		//	 This function get Complete URL

		**********************************************************************************************/

		public static function getAddress()  {

		

			/*** check for https ***/

			$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

			

			/*** return the full address ***/

			return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

			

		}





		

		public static function GetCountryList() {

			

			

			$dbconn=db::singleton();

				

				$query="select distinct * from tbl_country order by country_name";

				

				$dbconn->SetQuery($query);													

				return	$dbconn->LoadObjectList();

				

		}//GetCountryList
		
		public static function GetCountryDataById($country_id){
			global $config;
			$dbconn = db::singleton();
					
			$sql = "select * from country where count_id='$country_id' ";
			$dbconn->SetQuery($sql);
			
			return  $dbconn->LoadObject();	 
		 
		 } // Function country
			

		public static function GetStateList() {

			

			

			$dbconn=db::singleton();

				

				$query="select distinct * from  tbl_state order by state_name";

				

				$dbconn->SetQuery($query);													

				return	$dbconn->LoadObjectList();

				

		}//GetCountryList

		

		

	}//getPrint class

	
?>