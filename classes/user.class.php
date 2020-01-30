<?
	
	class User{
		
	private $dbconn;



		
/***********************************Add New User******************************************/
		public static function AddUser($user_type=""){
			// print_r($_REQUEST); die;
			global $config;
			$dbconn = db::singleton();
			
			$arr = utility::ClearSqlInjection($_REQUEST);
			
			//$c_agent = "0";
			$status ="Pending";
			extract($arr);
			$pwd=sha1($password);
			$time=time();
			//print("add to ship".$c_ship); die;
			$sql = "insert into user
					(`name`,`login_id`,`login_pass`,`user_type`,`user_email`,`user_status`,`admin_id`,`user_datetime`)
					 values
		('$username','$loginid','$pwd','$user_type','$email','$status',".$_SESSION['sess_admin_id'].",$time)";

			$dbconn->SetQuery($sql);	
			$user_id = $dbconn->GetLastID();
			// echo $user_id;die;
			if($user_type=='D' || $user_type=='LO')
			{
				if($_FILES['license']['size'] > 0)
					{
						$file_path = $config["site_root_path"].$config["license_path"];
						$code = Attachment::UploadFile("license", $file_path, $_FILES['license']['name']);
						$file_name = Attachment::$file_name;
					}//file is !empty
				
					if($user_type=='LO')
					{$lorryowner=$user_id;}

						$sql = " insert into driver
						(owner_id, user_id,license_file_name, reference_name1, reference_no1, reference_name2, reference_no2)
						values
						('.$lorryowner.','$user_id', '$file_name', '$reference_name1', '$reference_no1', '$reference_name2', '$reference_no2')";
						$dbconn->SetQuery($sql);				
			}
				
				$sql1 = " insert into user_detail
				(`user_id`,`contact_no`,`cnic_no`, `nicop`, `alien`,`passport_no`,`ntn_no`,`address`,`city`)
						 values
						($user_id,'$contact_no','$cnic_no','$nicop','$alien_no','$passport_no','$ntn_no','$address','$city')"; 
				$dbconn->SetQuery($sql1);

				User::setUserRole($user_type,$user_id);
				return $user_id;
		
		}//  fuction add

		// this function will set user role into tbl_user_role
		public static function setUserRole($user_type,$user_id)
		{
			global $config;
			$dbconn = db::singleton();
			
			$query = "SELECT role_id FROM `tbl_role` WHERE role_code='$user_type'";
			
			$dbconn->SetQuery($query);

			$role_id = $dbconn->LoadObjectList()[0]->role_id;
				
			$roleQry = "INSERT INTO `tbl_user_role`(`user_id`, `role_id`) VALUES ('$user_id','$role_id')"; 
		
			$dbconn->SetQuery($roleQry);	
		}
		public static function checkDrive_status($user_id)
		{
			
			global $config;
			$dbconn = db::singleton();
			
			$query = "SELECT role_id FROM `tbl_role` WHERE role_code='D'";
			// echo $query;die;
			$dbconn->SetQuery($query);

			$role_id = $dbconn->LoadObjectList()[0]	->role_id;
			
			$check = "SELECT * FROM tbl_user_role where user_id='$user_id'  AND role_id='$role_id' ";

			$dbconn->SetQuery($check);

			$row = $dbconn->GetNumRows();

			return $row;
		}
		
		/************************************************************************************/
			public static function UpdateUser($uid) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
		
			$dbconn=db::singleton();
			
			$query = "update users set user_name='".$username."',password='".md5($pwd)."',email= '".$email."',gender='".$gender."',gid=".$gid." where uid=".$uid; 
			//echo $query; die;		 
			$dbconn->SetQuery($query);
			

				//$qid=$dbconn->GetLastID();
			
			if (!empty($option)) 
			{	
			
				$query1 = "delete from question_options where qid = ".$qid."";					
					$dbconn->SetQuery($query1);
				
			for($a=0;$a<sizeof($option);$a++)
				{
					if($score==$a)
					{
						 $currect=1;
					 } else {
						 $currect=0;
					 }
					
					$query2 = "insert into question_options
					(qid,q_option,score) 
					 values($qid,'".addslashes($option[$a])."',$currect)";
					$dbconn->SetQuery($query2);
				}
			}
			
			
			return $qid;
			
			
		} //function	
		
		public static function DeleteUser($uid) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
		
			$dbconn=db::singleton();
			
			$userstatus="D";
			
			$query = "Update user set user_status='".$userstatus."' where user_id=".$uid; 
			//echo $query; die;		 
			$dbconn->SetQuery($query);
			
			return $uid;
			
			
		}		
/************************************************************************************/

		public static function GetUser($usertype=''){

			global $config;
			
			$dbconn=db::singleton();
				
		

				$query = "SELECT * FROM `user` WHERE `user_type`='".$usertype."' && `user_status`= 'Active'";
				
				// echo $query;die;
				$dbconn->SetQuery($query);

				$goodsOwner = $dbconn->LoadObjectList();
			
			if($goodsOwner) 
			{	
				$a=0;
				foreach($goodsOwner as $row)
				{
					
					$json[$a]=$row;
					$goodsowner_details=Load::fetch_All_OWNER($row->user_id);
					// echo $pending_user;die;	
					$i=0;
					if (is_array($goodsowner_details) || is_object($goodsowner_details))
					{
					    foreach ($goodsowner_details as $row1)
					    {
					       // print_r($document_details);die;
							$json[$a]->_detail[]=$row1;
							$i++;
					    }
					}					
					$a++;
					
				}
				return $json;		
			}
			// 	if($user_type == 'D' || $user_type == 'LO')
			// {
				
			// 	-- INNER JOIN `tbl_user_role` ur on ur.user_id=u.user_id ";
				
			// }
			// elseif($user_type == 'All')
			// {
			// 	$query = "select u.*, d.*, ud.* 
			// 	 from user u
			// 	 inner join driver d on u.user_id=d.user_id 
			// 	 inner join user_detail ud on u.user_id=ud.user_id 
			// 	 where 1";
				
			// }
			// else
			// {	
			// 	$rquery = "SELECT role_id FROM `tbl_role` WHERE role_code='$user_type'";
			
			// 	$dbconn->SetQuery($rquery);

			// 	$role_id = $dbconn->LoadObjectList()[0]->role_id;

			// 	$query = "select u.*, ud.*
			// 	from user u 
			// 	inner join user_detail ud on u.user_id=ud.user_id 
			// 	inner join tbl_user_role ur on ur.user_id=u.user_id 
			// 	where ur.role_id = '".$role_id."'";
			// }

			// echo $query; die;
			// $dbconn->SetQuery($query);

			return $goodsOwner;
				
	
	} 

	public static function getUserInfo($userId='')
	{
					
				extract($_REQUEST);

				$dbconn=db::singleton();

				$query = "select u.*,ud.* from user u
						inner join user_detail ud on ud.user_id = u.user_id
						where u.user_status = 'Active' ";


				if(!empty($userId)){
				
				 $query .= "AND u.user_id = $userId ";
				}
				// $query .= " order by c_id desc";
				
				//echo $query;die;
				$dbconn->SetQuery($query);

				return $dbconn->LoadObject();
	}
	
	public static function updateUserInfo() {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
			$nic = "";
			$nico = "";
			$alien = "";
			$passport = "";
			if($identity_documnt == "1")
			{
				$nic = $cnic_no;
			}
			else if($identity_documnt == "2")
			{
				$nico = $nicop;
			}
			else if($identity_documnt == "3")
			{
				$alien = $alien_no;
				$passport = $passport_no;
			}
			else
			{
				//
			}
			
			$dbconn=db::singleton();
			
			$userstatus="D";
			
			if(empty($password))
			{
				$query = "Update user set name='".$username."', login_id='".$loginid."', user_email='".$email."' where user_id=".$user_id; 
				//echo $query; die;		 
				$dbconn->SetQuery($query);
			}
			else
			{
				$query = "Update user set name='".$username."', login_id='".$loginid."', login_pass='".sha1($password)."', user_email='".$email."' where user_id=".$user_id; 
				//echo $query; die;		 
				$dbconn->SetQuery($query);
			}
			
			
			$query1 = "Update user_detail set contact_no='".$contact_no."', identity_doc_id='".$identity_documnt."', cnic_no='".$nic."', nicop='".$nico."', alien='".$alien."', passport_no='".$passport."', ntn_no='".$ntn_no."', address='".$address."', city='".$city."' where user_id=".$user_id; 
				//echo $query; die;		 
				$dbconn->SetQuery($query1);
			
			return TRUE;
	
			
	}	
		
// *****************************************************************************************

			public static function verifyUser(){

			global $config;
			
			$dbconn=db::singleton();

				$status = "Pending";
				// $query = "SELECT u.*,ud.*,u_doc.*
				// FROM `user` as u 
				// JOIN `user_detail` as ud on u.user_id=ud.user_id
				// JOIN `tbl_user_document` as u_doc on u.user_id=u_doc.user_id
				// WHERE `user_status`= 'Pending'";
				// return $dbconn->LoadObjectList();
				// $query =" SELECT * from `user`  WHERE `user_status`='Pending' AND `user_type` in('GO','LO')";
				$query =" SELECT * from `user`  WHERE `user_status`='Pending' AND `user_type`='GO' ";
				$dbconn->SetQuery($query);
				$pending_user = $dbconn->LoadObjectList();
			    // print_r($pending_user);die;
			  
			    // -----
			if($pending_user) 
			{	
				$a=0;
				foreach($pending_user as $row)
				{
					
					$json[$a]=$row;
					$pending_user_details=Load::fetch_PendingUser($row->user_id);
					// echo $pending_user;die;	
					$i=0;
					if (is_array($pending_user_details) || is_object($pending_user_details))
					{
					    foreach ($pending_user_details as $row1)
					    {
					       // print_r($document_details);die;
							$json[$a]->load_detail[]=$row1;
							$i++;
					    }
					}		
					$document_details=Load::fetch_PendingUser_Document($row->user_id);
	
					$j=0;						
					if (is_array($document_details) || is_object($document_details))
					{
					    foreach ($document_details as $row2)
					    {
					       // print_r($document_details);die;
							$json[$a]->detail[]=$row2;
							$j++;
					    }
					}					
					$a++;
					
				}
				return $json;		
			}


	
		} 

// =====================================Verify Transporter and active(LorryOwner)===================


		public static function verifyTransporter(){

			global $config;
			
			$dbconn=db::singleton();

				$status = "Pending";
				// $query = "SELECT u.*,ud.*,u_doc.*
				// FROM `user` as u 
				// JOIN `user_detail` as ud on u.user_id=ud.user_id
				// JOIN `tbl_user_document` as u_doc on u.user_id=u_doc.user_id
				// WHERE `user_status`= 'Pending'";
				// return $dbconn->LoadObjectList();
				// $query =" SELECT * from `user`  WHERE `user_status`='Pending' AND `user_type` in('GO','LO')";
				$query =" SELECT * from `user`  WHERE `user_status`='Pending' AND `user_type`='LO' ";
				$dbconn->SetQuery($query);
				$pending_user = $dbconn->LoadObjectList();
			    // print_r($pending_user);die;
			  
			    // -----
			if($pending_user) 
			{	
				$a=0;
				foreach($pending_user as $row)
				{
					
					$json[$a]=$row;
					$pending_user_details=Load::fetch_PendingUser($row->user_id);
					// echo $pending_user;die;	
					$i=0;
					if (is_array($pending_user_details) || is_object($pending_user_details))
					{
					    foreach ($pending_user_details as $row1)
					    {
					       // print_r($document_details);die;
							$json[$a]->load_detail[]=$row1;
							$i++;
					    }
					}		
					$document_details=Load::fetch_PendingUser_Document($row->user_id);
	
					$j=0;						
					if (is_array($document_details) || is_object($document_details))
					{
					    foreach ($document_details as $row2)
					    {
					       // print_r($document_details);die;
							$json[$a]->detail[]=$row2;
							$j++;
					    }
					}					
					$a++;
					
				}
				return $json;		
			}


	
		} 
//=================================Verify Driver By Admin ===========================================



			public static function verifyDriver(){

			global $config;
			
			$dbconn=db::singleton();

				$status = "Pending";
				// $query = "SELECT u.*,ud.*,u_doc.*
				// FROM `user` as u 
				// JOIN `user_detail` as ud on u.user_id=ud.user_id
				// JOIN `tbl_user_document` as u_doc on u.user_id=u_doc.user_id
				// WHERE `user_status`= 'Pending'";
				// return $dbconn->LoadObjectList();
				$query =" SELECT * from `user`  WHERE `user_status`='Pending' AND `user_type`='D'";
				$dbconn->SetQuery($query);
				$pending_user = $dbconn->LoadObjectList();
			    // print_r($pending_user);die;
			  
			    // -----
			if($pending_user) 
			{	
				$a=0;
				foreach($pending_user as $row)
				{
					
					$json[$a]=$row;
					$pending_user_details=Load::fetch_PendingDriver($row->user_id);
					// echo $pending_user;die;	
					$i=0;
					if (is_array($pending_user_details) || is_object($pending_user_details))
					{
					    foreach ($pending_user_details as $row1)
					    {
					       // print_r($document_details);die;
							$json[$a]->load_detail[]=$row1;
							$i++;
					    }
					}		
								
					$a++;
					
				}
				return $json;		
			}


	
		}  

//*************************************************************************************************

		public static function fetch_UserCatagory($catagory_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT `catagory_name`  from tbl_catagory WHERE `catagory_id` = ".$catagory_id;
				
			
			$dbconn->SetQuery($query);
			
			return $dbconn->LoadObjectList();

				
		

		}


//**************************************Fetch Lorry Owner Detail for Driver********************************


		public static function fetch_LO_detail($user_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT  *  from `user` WHERE `user_id` = ".$user_id;
				
			
			$dbconn->SetQuery($query);
			
			return $dbconn->LoadObjectList();

				
		

		} 

//**************************************************************************************************


		public static function fetch_UserDocument($document_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT `document_name`  from tbl_catagory_document WHERE `document_id` = ".$document_id;
				
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		}


// **************************************************************************************


		public static function getRoleId($user_type)
		{
				global $config;
			
				$dbconn=db::singleton();
				
				$rquery = "SELECT role_id FROM `tbl_role` WHERE role_code='$user_type'";
			
				$dbconn->SetQuery($rquery);

				$role_id = $dbconn->LoadObjectList()[0]->role_id;


				return $role_id;
		}
//===================================================================================================== 
		public static function GetRole(){

			global $config;
			
			$dbconn=db::singleton();
			
				$query = "select  * from tbl_role";
				
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		}

// ==============Activer Owner By Admin ==============================================

	public static function active_User(){

		// print_r($_REQUEST);die;
		global $config;
			
		$dbconn=db::singleton();
			
		$query = "UPDATE `user` SET `user_status`='Active' WHERE `user_id`=".$_REQUEST['user_id']."";
					
		// echo $query;die;	
		$dbconn->SetQuery($query);

		$query1 ="SELECT `user_type` from `user` WHERE `user_id`=".$_REQUEST['user_id']."";
		$dbconn->SetQuery($query1);
		$usertype= $dbconn->LoadObjectList()[0]->user_type;

	$query2 ="SELECT `user_email` from `user` WHERE `user_id`=".$_REQUEST['user_id']."";
	
		$dbconn->SetQuery($query2);
		$user_email_= $dbconn->LoadObjectList()[0]->user_email;
	
	
	
		$to      = $user_email_;
		$subject = 'User Activation';
		$message = 'Verfication  Completed !! all submitted documents are verified.';
		$headers = 'From: lorrynlorry <lorrynlorry123@gmail.com>\r\n' .
		    'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);

		return  $usertype;

	
		}

// ====================Active Driver by ADmin ========================================


	public static function active_Driver(){

		// print_r($_REQUEST);die;
		global $config;
			
		$dbconn=db::singleton();
			
		$query = "UPDATE `user` SET `user_status`='Active' WHERE `user_id`=".$_REQUEST['user_id']."";		
		$dbconn->SetQuery($query);
		return $dbconn->LoadObjectList();

		

		}

	public static function active_Truck(){

		// print_r($_REQUEST);die;
		global $config;
			
		$dbconn=db::singleton();
			
		$query = "UPDATE `truck` SET `status`='Active' WHERE `truck_id`=".$_REQUEST['user_id']."";	
		$dbconn->SetQuery($query);
		return $dbconn->LoadObjectList();

		

		}	

//==================================================================================================== 

		public static function insert_document(){

			extract($_REQUEST);
			// print_r($_FILES);die;
			// print_r($_REQUEST);die;

			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			
			$targert_dir   = "C:/xampp/htdocs/uploads/registrartion_document/";		

			foreach($_POST['document_id'] as $key => $val)
			{

					// print_r($_POST['document_id']);die;
					$up_files = 'upload_file_'.$val;
					$up_file_name = $_FILES[$up_files]['name'];
					$up_file_tmp_name = $_FILES[$up_files]['tmp_name'];

				if(!empty($up_file_name))
				{
					// echo '<pre>';
					// echo $val .'<br>';
					// echo $up_file_name.'<br>';
					// echo $up_file_tmp_name.'<br>';
					// echo '</pre>';
							
				$target_file   = $targert_dir . basename($up_file_name);
				$user_document  = basename($up_file_name);
				$document_id  = $val;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
			
				// if (file_exists($target_file))
				//  {
				// 	    echo "Sorry, file already exists.";
				// 	    $uploadOk = 0;
				//  }
					
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
			 }
		  }

			$query1 ="UPDATE `user` SET `catagory_id`=$catgory_user_role WHERE `user_id`=$user_id";	
			$dbconn->SetQuery($query1);

			$query2 = "SELECT `user_type` FROM `user` WHERE `user_id`=$user_id";
			
			$dbconn->SetQuery($query2);			
			// print_r($dbconn->LoadObjectList()[0]->user_type);die;
			return $dbconn->LoadObjectList()[0]->user_type;
		
	}

}// class end 


?>