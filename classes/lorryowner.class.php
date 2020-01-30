<?
	include('checkmyip.php');
	class LorryOwner{
		
	private $dbconn;



		
/***************************Get Lorry Owner Driver***************************************/		
		public static function GetLorryOwnerDriver($owner_id="",$user_type=""){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT u1.name driver, u2.name owner, u1.login_id, u1.user_status, d.*, ud.*
						FROM user u1
						INNER JOIN driver d ON u1.user_id = d.user_id
						INNER JOIN user u2 ON d.owner_id = u2.user_id
						INNER JOIN user_detail ud ON ud.user_id = u2.user_id
						left join tbl_user_role ur on ur.user_id=u1.user_id
						WHERE 1 AND u1.user_status='Active'";
			// echo $query;die;
			if($owner_id != "") 
			{
					$query .= " and u2.user_id =".$owner_id;

			}
			if($user_type == 'LO') 
			{
					$role_id_owner = User::getRoleId($user_type);
					$role_id_driver = User::getRoleId('D');
					$query .= " and u1.user_type in ('".$role_id_owner."','".$role_id_driver."')";
			}
			elseif($user_type == 'D') {
					
					$role_id = User::getRoleId($user_type);	
					
					$query .= " and ur.role_id in ('".$role_id."')";
			}
			// echo $query; die;
			$dbconn->SetQuery($query);

			// print_r($dbconn->LoadObjectList());die;
			return $dbconn->LoadObjectList();

		

		} 
		
/***********************************Add New Truck******************************************/
		public static function AddTruck(){
			// print_r($_SESSION['sess_admin_id']);die;
			// print_r($_REQUEST); die;
			global $config;
			$dbconn = db::singleton();
			
			$arr = utility::ClearSqlInjection($_REQUEST);
			$time=time();
			//$c_agent = "0";
			extract($arr);
			


				if($_FILES['truck_rc']['size'] > 0){
				$targert_dir   = "C:/xampp/htdocs/uploads/truck_rc/";		
				$target_file   = $targert_dir . basename($_FILES["truck_rc"]["name"]);
				$truck_rc_file  	   = basename($_FILES["truck_rc"]["name"]);	
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
				// print_r($user_id);die;
				if (file_exists($target_file))
				 {
					    echo "Sorry, file already exists.";
					    $uploadOk = 0;
				 }
					
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
					    if (move_uploaded_file($_FILES["truck_rc"]["tmp_name"], $target_file))
					     {
					  
					     } else 
					      {
					      
					        echo "Sorry, there was an error uploading your file.";

					      }
					 
					}

				}	


			if($_FILES['truck_documents']['size'] > 0){
				$targert_dir   = "C:/xampp/htdocs/uploads/truck_documents/";		
				$target_file   = $targert_dir . basename($_FILES["truck_documents"]["name"]);
				$truck_document_file  	   = basename($_FILES["truck_documents"]["name"]);	
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
				// print_r($user_id);die;
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
					    if (move_uploaded_file($_FILES["truck_documents"]["tmp_name"], $target_file))
					     {
					  
					     } else 
					      {
					      
					        echo "Sorry, there was an error uploading your file.";

					      }
					 
					}

				}		
		

			$sql = " INSERT into `truck`
					(`user_id`,`truck_type_id`,`truck_company`,`truck_model`,`truck_capacity`,`truck_no`,`truck_rc`,`truck_documents`,`truck_tracker_id`,`status`,`datetime`)
					 VALUES
				(".$_SESSION['sess_admin_id'].",'$truck_type','$truck_company','$truck_model','$truck_type','$truck_no','$truck_rc_file','$truck_document_file','$truck_tracker_id','Pending','$time')";
				// echo $sql;die;
			$dbconn->SetQuery($sql);	
		
		}//  fuction add


//******************************* ADD Truck by Admin *******************************************

	public static function AddTruck_admin(){
			// print_r($_SESSION['sess_admin_id']);die;
			// print_r($_REQUEST); die;
			global $config;
			$dbconn = db::singleton();
			
			$arr = utility::ClearSqlInjection($_REQUEST);
			$time=time();
			//$c_agent = "0";
			extract($arr);
			


				if($_FILES['truck_rc']['size'] > 0){
				$targert_dir   = "C:/xampp/htdocs/uploads/truck_rc/";		
				$target_file   = $targert_dir . basename($_FILES["truck_rc"]["name"]);
				$truck_rc_file  	   = basename($_FILES["truck_rc"]["name"]);	
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
				// print_r($user_id);die;
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
					    if (move_uploaded_file($_FILES["truck_rc"]["tmp_name"], $target_file))
					     {
					  
					     } else 
					      {
					      
					        echo "Sorry, there was an error uploading your file.";

					      }
					 
					}

				}	


			if($_FILES['truck_documents']['size'] > 0){
				$targert_dir   = "C:/xampp/htdocs/uploads/truck_documents/";		
				$target_file   = $targert_dir . basename($_FILES["truck_documents"]["name"]);
				$truck_document_file  	   = basename($_FILES["truck_documents"]["name"]);	
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
				// print_r($user_id);die;
				if (file_exists($target_file))
				 {
					    echo "Sorry, file already exists.";
					    $uploadOk = 0;
				 }
					
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
					    if (move_uploaded_file($_FILES["truck_documents"]["tmp_name"], $target_file))
					     {
					  
					     } else 
					      {
					      
					        echo "Sorry, there was an error uploading your file.";

					      }
					 
					}

				}		
		

			$sql = " INSERT into `truck`
					(`user_id`,`truck_type_id`,`truck_company`,`truck_model`,`truck_capacity`,`truck_no`,`truck_rc`,`truck_documents`,`truck_tracker_id`,`status`,`datetime`)
					 VALUES
				('$transporter','$truck_type','$truck_company','$truck_model','$truck_type','$truck_no','$truck_rc_file','$truck_document_file','$truck_tracker_id','Pending','$time')";
				// echo $sql;die;
			$dbconn->SetQuery($sql);	
		
		} 

			
//***************************************** ADD Driver By LorryOwner*******************************


		public static function AddDriver(){
			// print_r($_SESSION['sess_admin_id']);die;
			// print_r($_REQUEST); die;
			global $config;
			$dbconn = db::singleton();
			
			$arr = utility::ClearSqlInjection($_REQUEST);
	
			extract($arr);

				if($_FILES['truck_rc']['size'] > 0){
				$targert_dir   = "C:/xampp/htdocs/uploads/license/";		
				$target_file   = $targert_dir . basename($_FILES["license"]["name"]);
				$license_file  = basename($_FILES["license"]["name"]);	
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
				// print_r($user_id);die;
				if (file_exists($target_file))
				 {
					    echo "Sorry, file already exists.";
					    $uploadOk = 0;
				 }
					
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
					    if (move_uploaded_file($_FILES["license"]["tmp_name"], $target_file))
					     {
					  
					     } else 
					      {
					      
					        echo "Sorry, there was an error uploading your file.";

					      }
					 
					}

				}	
				
			$pwd=sha1($password);
			$time=time();			
			$sql = " INSERT into `user`
					(`name`,`login_id`,`login_pass`,`user_type`,`user_status`,`user_datetime`)
					 VALUES
				('$username','$loginid','$pwd','D','Pending','$time')";
				
			$dbconn->SetQuery($sql);
			$user_id = $dbconn->GetLastID();

			$sql_1 = " INSERT into `driver`
					(`owner_id`,`user_id`,`address`,`cnic_no`,`contact_no`,`city`,`license_file_name`,`reference_name1`,`reference_no1`,`reference_name2`,`reference_no2`)
					 VALUES
				(".$_SESSION['sess_admin_id'].",".$user_id.",'$address','$cnic_no','$contact_no','$city','$license_file','$reference_name1','$reference_no1','$reference_name2','$reference_no2')";
				
			$dbconn->SetQuery($sql_1);	
		
		}//  fuction add

/**************************Get Truck**********************************/

		public static function GetTruck($owner_id=""){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT u1.name driver, u1.login_id, u1.user_status, t.*,tt.truck_type_name,tt.truck_capacity 
						FROM user u1
						
						INNER JOIN truck t on t.user_id = u1.user_id
						INNER JOIN truck_type tt on tt.truck_type_id = t.truck_type_id
						 where 1 AND t.status='Active'";
		
			if($owner_id != "") 
			{
					$query .= " and u2.user_id =".$owner_id;
			}
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		} 


// =================================== GEt truck Verify=================================================

		public static function GetTruckVerify($owner_id=""){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT u1.name owner_name, u1.login_id, u1.user_status, t.*,tt.truck_type_name,tt.truck_capacity 
						FROM truck t
						
						INNER JOIN user u1 on t.user_id = u1.user_id
						INNER JOIN truck_type tt on tt.truck_type_id = t.truck_type_id
						where   t.status='Pending'";
		
			if($owner_id != "") 
			{
					$query .= " and u2.user_id =".$owner_id;
			}
			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		} 

		
//********************************************************************************************************** 
		public static function getloadlist($status,$truck_type)
		{
			$posted_loads = Load::GetLoadList('',$status,$truck_type);
			$json='';
			if($posted_loads)
			{
			$a=0;
			foreach($posted_loads as $row)
			{	
				$json[$a]=$row;
				$load_details=Load::GetLoadDetails($row->load_id,$status);				
				$i=0;

				foreach($load_details as $row1)
				{
					
					$json[$a]->load_detail[]=$row1;
					$i++;
				}

				$pickup_details=Load::GetSerPickupDetails($row->load_id,$status);
				
				$j=0;
				foreach($pickup_details as $row2)
				{
					
					$json[$a]->pickup_detail[]=$row2;
					$j++;
				}

				$container_details=Load::fetchContainerLoc($row->load_id);
				
				$k=0;
				if(!empty($container_details)){
				foreach($container_details as $row3)
				{
					
					$json[$a]->container_detail[]=$row3;
					$k++;
				}
			 }
				$a++;
			}
		}

			return $json;	
		}


//*************************************************************************************************
		public static function getloaddetail($load_id)
		{

			$status='Active';
			$posted_loads = Load::GetLoadDetail($load_id);

			if($posted_loads) 
		{	$a=0;
			foreach($posted_loads as $row)
			{	
				$json[$a]=$row;
				
				$load_details=Load::GetLoadDetails($row->load_id,$status);
				
				$i=0;
				foreach($load_details as $row1)
				{
					
					$json[$a]->load_detail[]=$row1;
					$i++;
				}

				$pickup_details=Load::GetSerPickupDetails($row->load_id,$status);
			
				$j=0;
				foreach($pickup_details as $row2)
				{
					
					$json[$a]->pickup_detail[]=$row2;
					$j++;
				}
				$a++;
			}
		}

			return $json;	
		}

//********************************************************************************************************
		public static function addBid()
		{
			
			// $_SESSION['sess_admin_id']
			$client_ip =  get_client_ip();
			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$query2 = "select remaining_truck from load_post where load_id = ".$job_id."";
			$dbconn->SetQuery($query2);
			$remaining_truck = $dbconn->LoadObjectList()[0]->remaining_truck;
			
			if ($remaining_truck >= $truck_no) {
					
				$query ="INSERT INTO `tbl_bid`(`user_id`, `load_id`, `go_id`, `bid_amount`, `no_of_truck`, `ip_address`, `added_on`) VALUES ('".$lo_id."','$job_id','$go_id','$amount','$truck_no','$client_ip',now())";

				$dbconn->SetQuery($query);

				// $query3 ="UPDATE `load_post` SET `is_bid`='$remaining_truck' WHERE  load_id='$job_id' ";
				// $dbconn->SetQuery($query3);
				return true;	
			}else{
				return false;
			}
		}

// ----------------------------------------------------------------------------------------------------

		public static function getbidlist($user_id)
		{
			global $config;
			$dbconn = db::singleton();

			$query2 = "select * from tbl_bid where user_id='$user_id'";
			//echo $query; die;
			$dbconn->SetQuery($query2);
			return $dbconn->LoadObjectList();
		}

		public static function getDriverList($lo_id)
		{
			
			global $config;
			$dbconn = db::singleton();

			$query1 = "select role_id from tbl_role where role_code='D' AND status='A'";	

			$dbconn->SetQuery($query1);
			$role_id = $dbconn->LoadObjectList()[0]->role_id;
			// print_r($role_id);die();

			$query2 = "select d.user_id,u.name from driver d  
			inner join user u on d.user_id=u.user_id
			inner join tbl_user_role ur on ur.user_id=u.user_id
			where d.owner_id = '$lo_id'  AND  ur.role_id='$role_id'  AND d.status='F'";
			// echo $query2; die;
			$dbconn->SetQuery($query2);
			return $dbconn->LoadObjectList();

		}
		
		public static function getTruckList($lo_id,$load_id)
		{
			global $config;
			$dbconn = db::singleton();

			$query = "select truck_type_id from  load_post where load_id='$load_id'";
			
			$dbconn->SetQuery($query);
			// echo $query;
			$truck_type = $dbconn->LoadObjectList()[0]->truck_type_id;
			// echo $truck_type;die;
			// $query2 = "SELECT tt.truck_type_name, t.truck_id,t.truck_no  FROM `truck` t  
			// inner join load_post lp on lp.user_id = t.user_id
			// inner join truck_type tt on tt.truck_type_id='$truck_type'
			// where t.user_id = '$lo_id' AND lp.truck_type_id='$truck_type'"  ;

			$query2 = "SELECT  * FROM `truck` t  
			inner join truck_type tt on tt.truck_type_id=$truck_type
			where t.user_id = '$lo_id' AND t.truck_type_id=$truck_type  AND t.status='Active'";

			// echo $query2; die;
			$dbconn->SetQuery($query2);
			return $dbconn->LoadObjectList();
		}

		public static function assignDriverJob($job_id,$bid_id,$lo_id,$go_id,$driver,$truck)
		{
			global $config;
			$dbconn = db::singleton();

			$query = "UPDATE `tbl_bid` SET `status`='S' WHERE bid_id='$bid_id'";
			$dbconn->SetQuery($query);


			$query23 = "UPDATE `load_post` SET `status`='Accepted' WHERE load_id='$job_id'";
			// echo $query23;die;

			$dbconn->SetQuery($query23);

			$query24 = "UPDATE `load_post` SET `accept_by`='$lo_id' WHERE load_id='$job_id'";
			// echo $query23;die;

			$dbconn->SetQuery($query24);
			
			
			
			$title = "lorrynlorry";
			

			// echo $body;die;		
			for ($i=0; $i < count($driver) ; $i++)
			{ 
				

				if($lo_id==$driver[$i]){

						$body = "new_job";
				}else{
					$body = "new_job_driver";
				}   

				$driver_query = "UPDATE `driver` SET `status` = 'B' WHERE `user_id` = '$driver[$i]';";
				$dbconn->SetQuery($driver_query);
				echo $driver_query;
				$truck_query = "UPDATE `truck` SET `status` = 'Busy' WHERE `truck_id` = '$truck[$i]';";
				$dbconn->SetQuery($truck_query);
				echo $truck_query;



				date_default_timezone_set("Asia/Karachi");	
				$time = time();
				$query2 = " INSERT INTO `tbl_driver_job`(`load_id`, `bid_id`, `owner_id`, `go_id`, `driver_id`, `truck_id`,`assign_time`) 	VALUES ('$job_id','$bid_id','$lo_id','$go_id','$driver[$i]','$truck[$i]','$time')";

				
						$dbconn->SetQuery($query2);

						// اپ کو ايک کام ديا گيا ہے
						// header("location: ../../webservices/jobassignNotification.php?owner_id=$driver[$i]&user_id=$lo_id&title='".$title."'&body='".$body."'");


						$owner_token=GoodsOwner::CheckToken($driver[$i]); 
					    
					    // print_r($owner_token);die
						
						$url = "https://fcm.googleapis.com/fcm/send";
					/*
					    $token = "flcrLlbk_5I:APA91bFOdb61O0UAUsXJY_ks0TXgfySPVhOG_-_67bYkdv6j-SHIx-wgLOZ6wy0PuduczAhFdGjDpCQ_XhcW3h-iM6O61xDBKSThHsbBiA5HsALhWiwPxofEzT-S75DbwxxJN2nVNTiz";
					*/
						$token=$owner_token->user_token;
					    $serverKey = 'AAAAWw4AfHI:APA91bF2ttOJ8rU-2K83bX5mVNX1hmPozrcS2G_u1A_ox10q7Bmp_QnLUVp5BBCBxhRzLbYxVHs2G1Nfkv39jOQd8f2JNz9gY52d3tGYeAH9Kc992kABMVEP9z_HZ1Tof55Laho9RWxn';
					/*
						$title = "Notification title";

					    $body = "Hello I am from Your php server";
					*/
						$notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
					    
						$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
					    
						$json = json_encode($arrayToSend);
					    
						$headers = array();
					    $headers[] = 'Content-Type: application/json';
					    $headers[] = 'Authorization: key='. $serverKey;
					    $ch = curl_init();
					    curl_setopt($ch, CURLOPT_URL, $url);
					    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
					    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
					    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
					    //Send the request
					    $response = curl_exec($ch);
					    //Close request
					    if ($response === FALSE) {
					    die('FCM Send Error: ' . curl_error($ch));
					    }
					    curl_close($ch);
						echo $response;


			}

			// die;
			  header("location: ../load_post.php?user_id=$lo_id");

		}


//**************************************************************************************************
		public static function GetDriverJobList($driver_id,$status)
		{
			global $config;
			$dbconn = db::singleton();

			$query = "SELECT lp.*,dj.job_id,dj.truck_id,dj.driver_id,t.truck_no,tt.truck_type_name,u.user_type FROM load_post lp 
					  INNER JOIN tbl_driver_job dj on dj.load_id = lp.load_id
					  INNER JOIN truck t ON t.truck_id=dj.truck_id
					  INNER JOIN truck_type tt ON t.truck_type_id=tt.truck_type_id
					  INNER JOIN user u ON dj.driver_id=u.user_id
					  where dj.driver_id='$driver_id' AND dj.status='P'
					  order by lp.load_id desc";
			
			$dbconn->SetQuery($query);
			
			return $dbconn->LoadObjectList();	
		}


		public static function GetDriverAccJobList($job_id)
		{
			global $config;
			$dbconn = db::singleton();

			$query = "UPDATE `tbl_driver_job` SET `status`='A' WHERE job_id='$job_id'";
			
			$dbconn->SetQuery($query);
			
			return $dbconn->LoadObjectList();	

		}

		public static function imageUpload($load_id,$job_id,$go_id,$driver_id,$file_name)
		{
			global $config;
			$dbconn = db::singleton();

			$query = "INSERT INTO `tbl_load_img`(`load_id`, `job_id`, `go_id`,`driver_id`,`file_name`) VALUES ('$load_id','$job_id','$go_id','$driver_id','$file_name')";
			
			// echo $query;
			$dbconn->SetQuery($query);
					
		}

		public static function revertBid($bid_id,$lo_id)
		{
			global $config;
			$dbconn = db::singleton();

			$query = "DELETE FROM `tbl_bid` WHERE user_id='$lo_id' AND bid_id='$bid_id' ";
			
			$dbconn->SetQuery($query);


		}

		public static function cancleJob($job_id,$bid_id,$driver_id,$truck_id,$msg)
		{
			global $config;
			$dbconn = db::singleton();
		
			$query1 = "DELETE FROM `tbl_driver_job` WHERE job_id='$job_id'";
			
			$dbconn->SetQuery($query1);

			$query2 = "UPDATE `tbl_bid` SET `status`='A'  WHERE bid_id='$bid_id'";
			
			$dbconn->SetQuery($query2);


			// echo $driver_id;die;
			$driver_query = "UPDATE `driver` SET `status` = 'F' WHERE `user_id` = '$driver_id';";
			$dbconn->SetQuery($driver_query);

			$truck_query = "UPDATE `truck` SET `status` = 'Active' WHERE `truck_id` = '$truck_id';";
			$dbconn->SetQuery($truck_query);



// 				...............lorryOwner cancel job send notifictn to driver..............			
			// ============================================================================
					$title = "lorrynlorry";
					$body  =  $msg;	

					$owner_token=GoodsOwner::CheckToken($driver_id); 
					    
					    // print_r($owner_token);die
						
						$url = "https://fcm.googleapis.com/fcm/send";
					/*
					    $token = "flcrLlbk_5I:APA91bFOdb61O0UAUsXJY_ks0TXgfySPVhOG_-_67bYkdv6j-SHIx-wgLOZ6wy0PuduczAhFdGjDpCQ_XhcW3h-iM6O61xDBKSThHsbBiA5HsALhWiwPxofEzT-S75DbwxxJN2nVNTiz";
					*/
						$token=$owner_token->user_token;
					    $serverKey = 'AAAAWw4AfHI:APA91bF2ttOJ8rU-2K83bX5mVNX1hmPozrcS2G_u1A_ox10q7Bmp_QnLUVp5BBCBxhRzLbYxVHs2G1Nfkv39jOQd8f2JNz9gY52d3tGYeAH9Kc992kABMVEP9z_HZ1Tof55Laho9RWxn';
					/*
						$title = "Notification title";

					    $body = "Hello I am from Your php server";
					*/
						$notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
					    
						$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
					    
						$json = json_encode($arrayToSend);
					    
						$headers = array();
					    $headers[] = 'Content-Type: application/json';
					    $headers[] = 'Authorization: key='. $serverKey;
					    $ch = curl_init();
					    curl_setopt($ch, CURLOPT_URL, $url);
					    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
					    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
					    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
					    //Send the request
					    $response = curl_exec($ch);
					    //Close request
					    if ($response === FALSE) {
					    die('FCM Send Error: ' . curl_error($ch));
					    }
					    curl_close($ch);
						echo $response;

			// ============================================================================


		}

		public static function UpdateDriverTruck($driver_id,$truck_id)
		{
			global $config;
			$dbconn = db::singleton();


			$driver_query = "UPDATE `driver` SET `status` = 'F' WHERE `user_id` = '$driver_id';";
			$dbconn->SetQuery($driver_query);

			$truck_query = "UPDATE `truck` SET `status` = 'Active' WHERE `truck_id` = '$truck_id';";
			$dbconn->SetQuery($truck_query);
		}

		public static function GetLorryOwnerActiveDriver($id)
		{
			global $config;
			$dbconn = db::singleton();


			$driver_query = "SELECT u.name as driver_name,j.*,lp.pickup_latitude,lp.pickup_longitude,ld.goods_type from tbl_driver_job  j 

							 JOIN user u on u.user_id = j.driver_id	
							 JOIN load_pickup lp ON j.load_id=lp.load_id
							 JOIN load_post_details ld ON j.load_id=ld.load_id
							 WHERE j.owner_id = '$id' AND j.status = 'A'";
	
			$dbconn->SetQuery($driver_query);

			return $dbconn->LoadObject();

		}	


		public static function fetch_Drivers_Cordinate_Lo($owner_id)
		{
			
			global $config;
			$dbconn = db::singleton();

				$query="SELECT * FROM `tbl_driver_job` WHERE owner_id='$owner_id' and status='A'";
				$dbconn->SetQuery($query);
				$data1 = $dbconn->LoadObjectList();

				if($data1) 
				{	
					$a=0;
					foreach($data1 as $row)
					{	
						$json[$a]=$row;
						$cordintes=LorryOwner::fetch_Current_Cordinates($row->load_id,$row->job_id,$row->driver_id);
						
						foreach($cordintes as $row1)
						{
					
							$json[$a]->destination_details[]=$row1;
							
						}

						$a++;
					}	
				}
				
				return $json;
		}

//-------------------------------------------------------------------------------------------------------
 
		public static function fetch_Current_Cordinates($load_id,$job_id,$driver_id){

			extract($_REQUEST);
			global $config;
		
			$dbconn=db::singleton();
			$query="SELECT cc.*,lp.*,u.name as driver_name
					from load_pickup  cc
					INNER JOIN load_post lp on cc.load_id=lp.load_id
					LEFT JOIN user u on u.user_id = $driver_id
					where cc.load_id='$load_id' AND cc.job_id='$job_id' AND cc.pickup_status ='On_the_way' ORDER BY cc.pickup_id DESC LIMIT 1";

				
			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();


		}


//========================================================================================================
//								Fetch Complain For LO
//========================================================================================================

	public static function fetch_complain_Lo($owner_id)
		{
			
			global $config;
			$dbconn = db::singleton();

				$query="SELECT * FROM `tbl_driver_job` WHERE owner_id='$owner_id' and status='A'";
				$dbconn->SetQuery($query);
				$data1 = $dbconn->LoadObjectList();

					$a=0;
					foreach($data1 as $row)
					{	
						$json[$a]=$row;
						$comp=LorryOwner::fetch_Complains($row->load_id);
						
						foreach($comp as $row1)
						{
							
							$json[$a]->complains_details[]=$row1;
							
						}

						$a++;
					}	
	
				return $json;
		}	

//-----------------------------------------------------------------------------------------------------------


	public static function fetch_Complains($load_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			$query="SELECT tc.*,d.contact_no,u.name
					from tbl_complain tc
					INNER JOIN driver d ON tc.user_id=d.user_id
					INNER JOIN user u ON tc.user_id=u.user_id
					where tc.load_id='$load_id' and tc.status_com='Active'";

			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();


		}


	public static function fetch_cordinate($load_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			$query="SELECT * from load_pickup where load_id='$load_id' ORDER BY cc.pickup_id DESC LIMIT 1";

			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();


		}				
//========================================================================================================
//								Fecth Driver Data For Images Display in Tranporter Side
// ======================================================================================================


   public static  function getdriverdata($load_id)
	{
			global $config;
		
			$dbconn=db::singleton();
			
			$query = "SELECT driver_id 
					  FROM `tbl_load_img` i 
					  WHERE  i.load_id='$load_id' 
					  group by driver_id order by i.img_id desc";
			// echo $query;die;	
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
	}	


//------------------------------------------------------------------------------------------------------------

	public static  function GetImage_LO($load_id,$driver_id)
	{
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT img.*
			FROM `tbl_load_img`  img
			WHERE img.load_id ='$load_id' 
			AND img.driver_id  = '$driver_id'
		    order by img_id desc";
			// echo $query;die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
	}	

// ---------------------------------------------------------------------------------------------------------------

	public static function get_ImageData_($file_path){

			if (file_exists($file_path)) 
			{
		            $imageData = base64_encode(file_get_contents($file_path));
		            // Format the image SRC:  data:{mime};base64,{data};
		            $src = 'data: ' . mime_content_type($file_path) . ';base64,' . $imageData;
		        	// echo $src;die;
		            
		        	return $src;   
        	}

	}

//--------------------------------------------------------------------------------------------------------------


	public static function getImageFile_LO($file_path){

			if (file_exists($file_path)) 
			{
		            $imageData = base64_encode(file_get_contents($file_path));
		            $src = 'data: ' . mime_content_type($file_path) . ';base64,' . $imageData;
		        	return $src;   
        	}

	}	


// -------------------------------------------------------------------------------------------------------
	public static function _GetInProcessBids_($lo_id){
			

			global $config;
			$dbconn=db::singleton();
			$query = "SELECT tb.*,lp.expected_price
					 FROM tbl_bid tb 
					 INNER JOIN load_post lp ON lp.load_id = tb.load_id
					 WHERE tb.user_id='$lo_id' AND tb.status='P'";
			$dbconn->SetQuery($query);
			$bid_list = $dbconn->LoadObjectList();
			
			if($bid_list) 
			{	
				$a=0;
				foreach($bid_list as $row)
				{

					$json[$a]=$row;	
					$load_details=LorryOwner::inProcess_LoadDetails($row->load_id,'Active');
					$i=0;

					foreach($load_details as $row1)
					{
						
						$json[$a]->load_detail[]=$row1;
						$i++;
					}

					$pickup_details=LorryOwner::inProcessPickupDetails($row->load_id);
		
					$j=0;
					foreach($pickup_details as $row2)
					{
						
						$json[$a]->pickup_detail[]=$row2;
						$j++;
					}
					$a++;
					
			}
		
				return $json;	
			}


		}

// -------------------------------------------------------------------------------------------------------

	public static function inProcess_LoadDetails($load_id){

			global $config;
			$dbconn=db::singleton();
			$query = "SELECT lpd.*,lp.bid_date_end
					 from load_post_details  lpd
					 INNER JOIN load_post lp ON lp.load_id=lpd.load_id
					 WHERE  lpd.load_id =".$load_id." &&  lpd_status='Active' ORDER BY lp.bid_date_end DESC";
			
			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();
		

		}	

// ---------------------------------------------------------------------------------------------------
	
	public static function inProcessPickupDetails($laod_id)
	{
		global $config;			
		$dbconn=db::singleton();
		$query = "SELECT pp.*
		from tbl_loadpickup_point pp
		where pp.load_id = ".$laod_id." and status='Active' ";			
		$dbconn->SetQuery($query);

		return $dbconn->LoadObjectList();


	}
	












}// class end 


?>