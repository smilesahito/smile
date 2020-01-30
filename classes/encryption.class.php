<?
	class encryption {
	
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
	
		// To Encrypt string
		public static function encrypt($param) {
			
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
	
	}//encryption class
?>