<?
	class Attachment {
	
		private $dbconn;
		public $file_size;
		public static $file_name;
		public $file_extension;
		public $file_type;
		public $extension_valid;
		private $attid;
		//private $extension = array(".jpg" , ".png");
		
		
		function ShowImage($filename) {
			
			$str = readfile($filename);
			return $str;
			
		}
		
		/**
			1 = There is no attachment or error in file 
			2 = If extension is not valid
			3 = If file uploaded successfull
			4 = Error while uploading. It may be due to wrong path in Config File or folder permission.
		**/
		
		public static function UploadFile($field,$path,$property_id) {
			//echo $_FILES[$field]['name']; die;
		if(!$_FILES[$field]['error'] && $_FILES[$field]['size']) {
		
			if(Attachment::IsValidExtension($_FILES[$field]['name'])) {

				//$file = str_replace(' ','-',$_FILES[$field]['name']);
				//$property_id = trim($property_id);
				
				
				
				//Attachment::$file_name = $property_id."_".$file;
				Attachment::$file_name = $property_id;
	
			
				
				if(@move_uploaded_file($_FILES[$field]['tmp_name'],$path.Attachment::$file_name)) {
	
					return "3";
					
				} else {
				
					return "4";
				}
				
			} else {
			
				return "2";
				
			} 
		
		} else {
		
			
			return "1";
		
		}
		
	} //UploadFile
	
	
	public static function GetFileExtension($filename) {
		
		$extension = substr($filename,strrpos($filename,"."),strlen($filename)); 
		return $extension;
	
	} //getfileextension
	
	
	public static function IsValidExtension($filename) {
		
		global $config;
		
		$ext = Attachment::GetFileExtension($filename);

		$flag = false;
		for($i=0;$i<count($config["image_extension"]);$i++) {
			
			if($ext == $config["image_extension"][$i]) {
				$flag = true;
				
			}
		
		}	//for	
	
		return $flag;
		
	}
	
	public static function DownloadFile($file_name,$folder_name)
	{
	  global $config;
	  $file = $file_name; 
      $download_path = $config["site_root_path"].$folder_name.$file;
      $file_to_download = $download_path; // file to be downloaded
      header("Expires: 0");
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");  header("Content-type: application/file");
      header('Content-length: '.filesize($file_to_download));
      header('Content-disposition: attachment; filename='.basename($file_to_download));
      readfile($file_to_download);
      exit;
	}
} //case

?>