<? 
	include("../classes/common.class.php");
	extract($_REQUEST);
	
	switch($command)
	{
		case "addowner":

		extract($_REQUEST);
	
		global $config;
		$dbconn = db::singleton();
		$arr = utility::ClearSqlInjection($_REQUEST);
		$eml=$_REQUEST['login_id'];
		$email_checking="SELECT login_id from user WHERE login_id='$eml'";		
		$dbconn->SetQuery($email_checking);
		$email = $dbconn->LoadObject();	

		if ($email > 0 ) 
		{

		header("Location: ../signup.php?param=2");

		}
		else {

		extract($arr);	
		$user_status = "Pending";
		$self_reg="SELF_REG";
		$time=time();
		$pwd=sha1($password);
		$created_on=time();
		$updated_on=time();	
		
		$query ="INSERT INTO `user`( `catagory_id`,`name`, `login_id`, `login_pass`, `user_type`,`user_email`, `user_status`,
		 `admin_id`, `user_datetime`) 
				 VALUES
				 ('$catgory_user_role','$username','$login_id','$pwd','$role','$email','$user_status','$self_reg','$time')";
		
		$dbconn->SetQuery($query);
		$user_id = $dbconn->GetLastID();

		$sql1 = "INSERT INTO  `user_detail`
						(`user_id`,`contact_no`,`cnic_no`, `nicop`, `alien`, `passport_no`,`ntn_no`,`address`,`city`)
						 VALUES
						($user_id,'$contact_no','$cnic_no','$nicop','$alien_no','$passport_no','$ntn_no','$address','$city')"; 	
		$dbconn->SetQuery($sql1);
			
				
	
			// print_r($dbconn->LoadObjectList()[0]->user_type);die;
			// return $dbconn->LoadObjectList()[0]->user_type;

		$targert_dir   = "C:/xampp/htdocs/uploads/registrartion_document/";		

		foreach($_POST['document_id'] as $key => $val)
		{


			$up_files = 'upload_file_'.$val;
			$up_file_name = $_FILES[$up_files]['name'];
			$up_file_tmp_name = $_FILES[$up_files]['tmp_name'];

			if(!empty($up_file_name))
			{
							
				$target_file   = $targert_dir . basename($up_file_name);
				$user_document  = basename($up_file_name);
				$document_id  = $val;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
			

				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif"  && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "ppt" ){
					
					echo "Sorry, this file format  are not allowed.";
					$uploadOk = 0;
				}

				if ($uploadOk == 0)
				{
					    echo "Sorry, your file was not uploaded.";
				}else 
				{
					if (move_uploaded_file($up_file_tmp_name, $target_file))
					{
					  
					} else 
					  {					      
					        echo "Sorry, there was an error uploading your file.";
					  }					
				}
		
				$query2 ="INSERT INTO tbl_user_document
				(user_id,catagory_id,document_id,document_name,created_on,updated_on) 
				 
				 VALUES
				 ('$user_id',$catgory_user_role,'$document_id','$user_document','$created_on', '$updated_on')";

				$dbconn->SetQuery($query2);	

			}
	  	}
		
		header("Location: ../index.php?param=1");
		}
		
		break;

		case 'document_upload':
			

		extract($_REQUEST);

			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			
			$targert_dir   = "C:/xampp/htdocs/uploads/registrartion_document/";		

			foreach($_POST['document_id'] as $key => $val)
			{


					$up_files = 'upload_file_'.$val;
					$up_file_name = $_FILES[$up_files]['name'];
					$up_file_tmp_name = $_FILES[$up_files]['tmp_name'];

				if(!empty($up_file_name))
				{

							
				$target_file   = $targert_dir . basename($up_file_name);
				$user_document  = basename($up_file_name);
				$document_id  = $val;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
			

					
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif"  && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "ppt" ){
					
					echo "Sorry, this file format  are not allowed.";
					$uploadOk = 0;
				}

				if ($uploadOk == 0)
				{
					    echo "Sorry, your file was not uploaded.";
				}else 
				{
					if (move_uploaded_file($up_file_tmp_name, $target_file))
					{
					  
					} else 
					  {					      
					        echo "Sorry, there was an error uploading your file.";
					  }					
				}

			$created_on=time();
			$updated_on=time();			
			$query = "insert into tbl_user_document
			(user_id,catagory_id,document_id,document_name,created_on,updated_on) 
			
			values('$user_id',$catgory_user_role,'$document_id','$user_document','$created_on', '$updated_on')";

			$dbconn->SetQuery($query);
		
			$query1 ="UPDATE `user` SET `catagory_id`=$catgory_user_role WHERE `user_id`=$user_id";	
			$dbconn->SetQuery($query1);

			$query2 = "SELECT `user_type` FROM `user` WHERE `user_id`=$user_id";
			
			$dbconn->SetQuery($query2);			
			return $dbconn->LoadObjectList()[0]->user_type;
		 }
	  }
		
	}
			break;
	

?>