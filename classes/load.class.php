<?php

	class Load{
		
	private $dbconn;


/***********************************Add New User******************************************/
		public static function AddLoadPost(){
		
			extract($_REQUEST);
			
			$user_id = $_SESSION["sess_admin_id"];
			
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$created_on=time();
			$updated_on=time();		

		
			if($_REQUEST['truck_type'] == "9" || $_REQUEST['truck_type'] =="10"){
			
				$query = "insert into load_post
			(job_type,agent_name,agent_mobile_no,truck_type_id,user_id,capacity,load_date,expected_price,total_truck,container_no,remaining_truck ,bid_date_start, bid_date_end,status,datetime) 
			
			values('$job_type','$agent_name','$agent_mobileno','$truck_type',$user_id,'$truck_type','$load_date','$expected_price','$truck_no','$container_no','$truck_no','$bid_date_start','$bid_date_end','Pending',now()) ";
			
				$dbconn->SetQuery($query);
				$load_id=$dbconn->GetLastID();
	
				$query1 = "insert into tbl_container_loc
			(load_id,user_id,con_location,con_latitude,con_longitude,con_cro,gd_doc,bl_doc,invoice_doc,delivery_doc,guarantee_doc,created_on ,updated_on,status) 

			values('$load_id',$user_id,'$con_location','$container_lat','$container_lng', '','','','','','','$created_on','$updated_on','Active')";
			
				$dbconn->SetQuery($query1);
				$doc_last_id=$dbconn->GetLastID();

			
			$var=array("con_cro","delivery_doc","guarantee_doc","gd_doc","bl_doc","invoice_doc");
				foreach ($var as  $value) {
			
					
				$targert_dir   = "C:/xampp/htdocs/uploads/goodsowner_Cro/";		
				$target_file   = $targert_dir . basename($_FILES[$value]["name"]);
				$file_name  = basename($_FILES[$value]["name"]);	
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
				
			
				if (file_exists($target_file))
				 {
					    echo "Sorry, file already exists.use an-other name";
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
					    if (move_uploaded_file($_FILES[$value]["tmp_name"], $target_file))
					     {
					  
					     } else 
					      {
					      
					        echo "Sorry, there was an error uploading your file.";

					      }
					}
		
			$updte ="UPDATE `tbl_container_loc` SET `$value` ='$file_name' WHERE load_id=$load_id";
			$dbconn->SetQuery($updte);	
			
			}
			
		
			}else {

				$query = "insert into load_post
			(job_type,agent_name,agent_mobile_no,truck_type_id,user_id,capacity,load_date,expected_price,total_truck,container_no,remaining_truck ,bid_date_start, bid_date_end,status,datetime) 
			
			values('$job_type','$agent_name','$agent_mobileno','$truck_type',$user_id,'$truck_type','$load_date','$expected_price','$truck_no','$container_no','$truck_no','$bid_date_start','$bid_date_end','Pending',now()) ";
			

			$dbconn->SetQuery($query);
			$load_id=$dbconn->GetLastID();	
			
			// $query3 = "insert into tbl_container_loc
			// (load_id,user_id,created_on ,updated_on,status) 
			// values('$load_id',$user_id,'$created_on','$updated_on','Active')";
			// $dbconn->SetQuery($query3);


			
			}
			// print_r($_FILES);die;	
			return $load_id;
			
		} //function

// ==============================================================================================
//								Update Document For GO from Accptd Bid		
//================================================================================================

	// public static function Update_Documnt(){
		
	// 		$hid_bl_doc = "";
	// 		$hid_invoice_doc = "";
	// 		$hid_delivery_doc = "";
	// 		$hid_guarantee_doc = "";
	// 		$hid_gd_doc = "";
	// 		$hid_con_cro = "";
			
	// 		extract($_REQUEST);
	// 		global $config;
	// 		$dbconn = db::singleton();
	// 		$arr = utility::ClearSqlInjection($_REQUEST);
	// 		extract($arr);
	// 		$created_on=time();
	// 		$updated_on=time();	

	// 		$user_id = $_SESSION["sess_admin_id"];
	// 	 	$load_id = $_REQUEST['load_id'];
	
	// 		 $bl_doc = $hid_bl_doc;
	// 		 $invoice_doc = $hid_invoice_doc;
	// 		 $delivery_doc = $hid_delivery_doc;
	// 		 $guarantee_doc = $hid_guarantee_doc;
	// 		 $gd_doc = $hid_gd_doc;
	// 		 $con_cro = $hid_con_cro;
			

	// 		/******************* BOF *************************
			
	// 			Author: Azhar
	// 			Date: 12 sept,2019

	// 		****************************************************/
			
	// 		$path = "C:/xampp/htdocs/uploads/goodsowner_Cro/";
			
	// 		if($gd_doc != ""){
				
	// 		   $ext = Attachment::GetFileExtension($_FILES['gd_doc']['name']);
	// 		   $filename = "gd_doc".$load_id.$ext;
	// 		   Attachment::UploadFile("gd_doc",$path,$filename);
				
	// 		   $updte ="UPDATE `tbl_container_loc` SET `gd_doc` ='$filename' WHERE load_id=$load_id";
	// 		   $dbconn->SetQuery($updte);	
			 
	// 		 }
			
	// 		if($bl_doc != ""){
				
	// 			$ext = Attachment::GetFileExtension($_FILES['bl_doc']['name']);
	// 			$filename = "bl_doc".$load_id.$ext;
	// 			Attachment::UploadFile("bl_doc",$path,$filename);
				
	// 		   $updte ="UPDATE `tbl_container_loc` SET `bl_doc` ='$filename' WHERE load_id=$load_id";
	// 		   $dbconn->SetQuery($updte);	
	// 		}
			
	// 		if($invoice_doc != ""){
				
	// 			$ext = Attachment::GetFileExtension($_FILES['invoice_doc']['name']);
	// 			$filename = "invoice_doc".$load_id.$ext;
	// 			Attachment::UploadFile("invoice_doc",$path,$filename);	
				
	// 			$updte ="UPDATE `tbl_container_loc` SET `invoice_doc` ='$filename' WHERE load_id=$load_id";
	// 			$dbconn->SetQuery($updte);				
	// 		}
			
	// 		if($delivery_doc != ""){
				
	// 			$ext = Attachment::GetFileExtension($_FILES['delivery_doc']['name']);
	// 			$filename = "delivery_doc".$load_id.$ext;
	// 			Attachment::UploadFile("delivery_doc",$path,$filename);	
				
	// 			$updte ="UPDATE `tbl_container_loc` SET `delivery_doc` ='$filename' WHERE load_id=$load_id";
	// 			$dbconn->SetQuery($updte);	
	// 		}
			
	// 		if($guarantee_doc != ""){
				
	// 			$ext = Attachment::GetFileExtension($_FILES['guarantee_doc']['name']);
	// 			$filename = "guarantee_doc".$load_id.$ext;
	// 			Attachment::UploadFile("guarantee_doc",$path,$filename);
				
	// 			$updte ="UPDATE `tbl_container_loc` SET `guarantee_doc` ='$filename' WHERE load_id=$load_id";
	// 			$dbconn->SetQuery($updte);	
				
	// 		}

	// 		if($con_cro != ""){
				
	// 			$ext = Attachment::GetFileExtension($_FILES['con_cro']['name']);
	// 			$filename = "con_cro".$load_id.$ext;
	// 			Attachment::UploadFile("con_cro",$path,$filename);
				
	// 			$updte ="UPDATE `tbl_container_loc` SET `con_cro` ='$filename' WHERE load_id=$load_id";
	// 			$dbconn->SetQuery($updte);	
				
	// 		}
			
			
	// 					/******************* EOF **************************/
	
	// 		return $load_id;
			
	// 	} //function



//============================================================================================
		public static function addContainerLocation($load_id){
		
			extract($_REQUEST);
			// print_r($_REQUEST);die;
			
			$user_id = $_SESSION["sess_admin_id"];
			
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			// print_r($load_id);die;

				$targert_dir   = "C:/xampp/htdocs/uploads/goodsowner_Cro/";		
				$target_file   = $targert_dir . basename($_FILES["cro"]["name"]);
				$cro_file  = basename($_FILES["cro"]["name"]);	
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
					    if (move_uploaded_file($_FILES["cro"]["tmp_name"], $target_file))
					     {
					  
					     } else 
					      {
					      
					        echo "Sorry, there was an error uploading your file.";

					      }
					 
					}

			$created_on=time();
			$updated_on=time();			
			$query = "insert into tbl_container_loc
			(load_id,user_id,con_location,con_latitude,con_longitude,con_cro,created_on ,updated_on) 
			
			values('$load_id',$user_id,'$con_load_from','$container_lat','$container_lng', '$cro_file','$created_on','$updated_on')";
						// echo $query; die;

				$dbconn->SetQuery($query);

				$load_id=$dbconn->GetLastID();
				// echo $load_id;die;
					
			
			return $load_id;
			
			
		}


// ===========================================================================================

		public static function fectCapacity($truck_type){

			global $config;
			
			$dbconn=db::singleton();
			$query="select `truck_capacity` from truck_type where truck_type_id = ".$truck_type;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		}

// ==============================================================================================
		public static function fetch_Document($fetchDocument){

			global $config;
			
			$dbconn=db::singleton();
			$query="select *  from tbl_catagory_document where catagory_id = ".$fetchDocument;
			$dbconn->SetQuery($query);
			// print_r($dbconn);
			return $dbconn->LoadObjectList();

		}

// ============================================================================================= 
		
		public static function GetPickupPointList($load_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select * from tbl_loadpickup_point where load_id = ".$load_id." && `status`='Active'";
			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		}


// ============================================================================================
		public static function getchPackages(){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select `packages_name` from tbl_packages ";
			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		}

/***********************************Add New User******************************************/
		public static function AddLoadDetail(){
		
			extract($_REQUEST);
			
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);

			$seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // and any other characters
			    shuffle($seed); // probably optional since array_is randomized; this may be redundant
			    $rand = '';
			    foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];


		$query = "insert into load_post_details
	(load_id,pickup_id,goods_type, no_of_packages, load_type, weight,total_luggage,luggage_unit,package_type, target_price, destination_name, destination_contactno, destination_email,`security_code`,`load_to`,`to_latitude`,`to_longitude`) 
		
	        values('$load_id','$pickup_id','$goods_type','$no_of_packages','$load_type','$weight','$total_luggage','$luggage_unit','$package_type','$target_price','$destination_name','$destination_contactno','$destination_email','$rand','$load_from','$lat','$lng')";
			$dbconn->SetQuery($query);
			// echo $query;die;         
			if($query)
			{
				$update_load = "update load_post set status='Active' where load_id=".$load_id; 
				$dbconn->SetQuery($update_load);
			}

				
			return $load_id;
			
			
		} //function

//============================================================================================
		public static function AddInsurance()
		{
			extract($_REQUEST);
			
			
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);


			$query = "UPDATE `load_post` SET insurance='$Premium', insurance_number='$insu_number'   where load_id='$load_id' ";

			

			$dbconn->SetQuery($query);
			
				
			return $load_id;
		}
		
/***********************************Add Pickup point******************************************/
		public static function AddpickPoint(){
		
			extract($_REQUEST);
			
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);


			$query = "INSERT INTO `tbl_loadpickup_point`(`load_id`,source_name, source_contactno, source_email , `load_from`, `from_latitude`, `from_longitude`) 
			VALUES ('$load_id','$source_name','$source_contactno','$source_email','".$load_from."','$lat','$lng')";
			$dbconn->SetQuery($query);
			
			
			return $load_id;	
			
		}


/***********************************Add AddDesig Point******************************************/
		public static function AddDesigPoint(){
		
			extract($_REQUEST);
			// echo "<pre>";	
			// print_r($_REQUEST);
			// echo "</pre>";
			// die();
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);

			$query = "INSERT INTO `tbl_destination_point`(`load_id`,`security_code`, `load_from`, `from_latitude`, `from_longitude`) 
			VALUES ('$load_id','$rand','".$load_from."','$lat','$lng')";
			$dbconn->SetQuery($query);
			
			return $laod_id;
			
			
		}


//======================================Add Current Truck Weight ==========================

		public static function AddTruckWeight(){
		
			// extract($_REQUEST);
			// echo "<pre>";	
			// print_r($_REQUEST);
			// echo "</pre>";
			// die();
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);

			$query ="UPDATE load_post_details set truck_curnt_load = ".$_REQUEST['truck_Weight']." where load_id = ".$_REQUEST['load_id'];
			$dbconn->SetQuery($query);
			return $laod_id;
	
		} 

// ************************************Delete Pickup Location ******************************

		public static function disable_PickUp($load_id){
		
			extract($_REQUEST);

			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			global $config;
			$dbconn=db::singleton();
		
			$query = "UPDATE tbl_loadpickup_point set status ='Disbale' where load_id =".$load_id;
			
			$dbconn->SetQuery($query);
			$dbconn->LoadObjectList();
			return $load_id;
			
			
		} 


/********************************************************************************************************
									Driver Latlng Save
*********************************************************************************************************/
	
	public static function AddLoadPickup($load_id,$driver_id,$job_id,$latitude,$longitude,$status){
		 
	
		extract($_REQUEST);

		global $config;	
		$dbconn = db::singleton();
		$arr = utility::ClearSqlInjection($_REQUEST);
		extract($arr);
		$time=time();
			
			if($status == "finish")
			{

				$finish_query = "insert into load_pickup
				(load_id,driver_id,job_id,pickup_latitude,pickup_longitude,pickup_status,pickup_datetime) 
			values('$load_id','$driver_id','$job_id','$latitude','$longitude','$status',$time)";
				
			// $dbconn->SetQuery($finish_query);

			$selct_drivers ="Select driver_id from tbl_driver_job WHERE load_id=".$load_id;
			
			$dbconn->SetQuery($selct_drivers);
			$data= $dbconn->LoadObjectList();
			$complete_ = 1;
			foreach ($data as $row)
			{
				
				$status_check = "SELECT Count(pickup_status) jobstatus FROM `load_pickup` WHERE load_id =$load_id and driver_id =".$row->driver_id." AND pickup_status ='finish' ORDER BY pickup_status DESC LIMIT 1";
				
				$dbconn->SetQuery($status_check);
				$data1= $dbconn->LoadObject();
				
				
					if($data1->jobstatus == "0" )
					{
						// echo "inprocess".$data1->jobstatus;
						$complete_=0;
					}
			}

				// all jobs are complete then run
				if($complete_ == "1" )
				{
					// echo "com : ".$complete_;
				$update_load = "update load_post set status='".$status."' where load_id=".$load_id; 
				$dbconn->SetQuery($update_load);

				$update_pickup = "update `tbl_loadpickup_point` set status='".$status."' WHERE load_id=".$load_id;
				$dbconn->SetQuery($update_pickup);

				$update_pickup = "update `tbl_driver_job` set status='".$status."' WHERE load_id=".$load_id;
				$dbconn->SetQuery($update_pickup);

				}
				

			$classid=$dbconn->GetLastID();
			return $dbconn->LoadObject();

			}else{

		
			$update_load = "update load_post set status='".$status."' where load_id=".$load_id; 
			$dbconn->SetQuery($update_load);

			$query = "insert into load_pickup
				(load_id,driver_id,job_id,pickup_latitude,pickup_longitude,pickup_status,pickup_datetime) 
			values('$load_id','$driver_id','$job_id','$latitude','$longitude','$status',$time)";
				
			$dbconn->SetQuery($query);
			$classid=$dbconn->GetLastID();
			return $dbconn->LoadObject();
		
			}
			
		} //function
		
/**********************************************************************************************/
		
	public static function GetLoadList($owner_id="",$status="",$truck_type="")
	{

		global $config;
		$dbconn=db::singleton();
		
		$query = "SELECT u1.name posted_by,lp.*,tt.* 
		FROM load_post lp
		INNER JOIN user u1 ON lp.user_id = u1.user_id
		INNER JOIN truck_type tt ON lp.truck_type_id = tt.truck_type_id";

		if ($owner_id != "") 
		{
		 	$query .="  and u1.user_id = ".$owner_id."";
		}
		if ($truck_type != "") 
		{

			$query2 = "SELECT * FROM `truck` where user_id='".$truck_type."' ";
			$dbconn->SetQuery($query2);
			$truck_type =  $dbconn->LoadObjectList();
			$truck_type_array=0;
			
			foreach ($truck_type as $row) 
			{
				if(!empty($row->truck_type_id))
				{
					$truck_type_array = $truck_type_array . ','. $row->truck_type_id ;	
				}		
			}
			
			$query .="  and lp.truck_type_id  in ($truck_type_array)";
		}
		if ($status != "") 
		{
		 	$query .="  and lp.status='".$status."'";
		 	$query .="  and lp.remaining_truck > 0";
		}
			$query .="  order by lp.load_id desc";
			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();
		

	} 
		
//============================================================================================= 
		public static function GetPrintLoadList($load_id)
		{
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT t.truck_no,u2.name as driver_name,ud.cnic_no,u1.name posted_by,lp.*,tt.* FROM load_post lp
			INNER JOIN user u1 ON lp.user_id = u1.user_id
			INNER JOIN truck_type tt ON lp.truck_type_id = tt.truck_type_id
			INNER JOIN tbl_driver_job dj on dj.load_id=lp.load_id

			INNER join user u2 on dj.driver_id = u2.user_id
			INNER JOIN user_detail ud on ud.user_id = u2.user_id
			INNER join truck t on dj.truck_id = t.truck_id

			WHERE lp.load_id='$load_id'

			";

			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		}
//===========================================================================================
		public static function GetLoadDetail($load_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT u1.name posted_by,lp.*,tt.* FROM load_post lp
			INNER JOIN user u1 ON lp.user_id = u1.user_id
			INNER JOIN truck_type tt ON lp.truck_type_id = tt.truck_type_id
			where lp.load_id='".$load_id."'
			";

			
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		}

/************************************************************************************/
		
		public static function GetLoadDetails($load_id,$status){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select * from load_post_details where load_id = ".$load_id." and lpd_status='Active'";
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		}
//**********************************************************************************************
		public static function fetch_PendingUser($user_id){

			global $config;
			
			$dbconn=db::singleton();
			// $query = " SELECT * DISTINCT  FROM user_detail ORDER BY load_id where load_id = ".$load_id";
			$query = "SELECT * from user_detail where user_id = ".$user_id."";
			
			$dbconn->SetQuery($query);
			// echo $dbconn->SetQuery($query); die;
			return $dbconn->LoadObjectList();
		

		} 

// ********************************* Fetch Driver Detail ***************************************

			public static function fetch_PendingDriver($user_id){

			global $config;
			
			$dbconn=db::singleton();
			// $query = " SELECT * DISTINCT  FROM user_detail ORDER BY load_id where load_id = ".$load_id";
			$query = "SELECT * from driver where user_id = ".$user_id."";
			
			$dbconn->SetQuery($query);
			// echo $dbconn->SetQuery($query); die;
			return $dbconn->LoadObjectList();
		

		} 
// ==========================================================================================
		public static function fetch_PendingUser_Document($user_id){

			global $config;
			
			$dbconn=db::singleton();
			// $query = " SELECT * DISTINCT  FROM user_detail ORDER BY load_id where load_id = ".$load_id";
			$query = "SELECT * from tbl_user_document where user_id = ".$user_id."";
			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 
// ============================================================================================
		public static function Getpickup($laod_id,$status){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select * from tbl_loadpickup_point where load_id = ".$load_id."";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		}
//============================================================================================
	public static function GetSerPickupDetails($laod_id)
	{
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT pp.*,dp.goods_type,dp.load_to,dp.load_type,dp.package_type,dp.destination_name,dp.destination_contactno
			  from tbl_loadpickup_point pp
			  JOIN load_post_details dp ON pp.load_id=dp.load_id
			  where pp.load_id = ".$laod_id." and status='Active' ";
		//echo $query; die;
		$dbconn->SetQuery($query);

		return $dbconn->LoadObjectList();


	}

//=============================================================================================
	public static function fetchContainerLoc($laod_id)
	{
		global $config;
			
		$dbconn=db::singleton();
			
		$query = "select con_location,con_latitude,con_longitude from tbl_container_loc where load_id = ".$laod_id."";
			//echo $query; die;
		$dbconn->SetQuery($query);

		return $dbconn->LoadObjectList();


	}
//===========================================================================================
	public static function fetchContainerCRO($laod_id)
	{
		global $config;
		
		$dbconn=db::singleton();
		
		$query = "select con_cro from tbl_container_loc where load_id = ".$laod_id."";
		//echo $query; die;
		$dbconn->SetQuery($query);

		return $dbconn->LoadObjectList();
	}
//============================================================================================
		public static function imgdetail($load_id)
		{
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT * FROM `tbl_load_img` where load_id = ".$load_id."";
			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		}
/*****************************************get pickup id*******************************************/
		
		public static function GetPickupDetails($load_id){

			global $config;
			
			$dbconn=db::singleton();
		
			$query = "select * from tbl_loadpickup_point where load_id = ".$load_id." && `status`='Active'";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 
// ============================================================================================
		public static function GetDetails($laod_id){
			 // print_r($laod_id);die();
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select * from load_post_details where load_id = ".$laod_id."";
			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		}

/*****************************************get destination id***********************************/
		
		public static function GetDestDetails($load_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select * from tbl_destination_point where load_id = ".$load_id."";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 
// =========================================================================================== 
		public static function GetLoadDetailById($detail_id,$driver_id){

		global $config;
		$dbconn=db::singleton();
		$query1 = "select load_id from load_post_details where load_detail_id = ".$detail_id."";
		$dbconn->SetQuery($query1);
		$id =$dbconn->LoadObjectList()[0]->load_id;

			$query =" SELECT lp.*, ld.*,tli.*
			FROM  load_post lp
			INNER JOIN load_post_details ld  ON ld.load_id = lp.load_id
			INNER JOIN tbl_load_img tli ON lp.load_id = tli.load_id 
			WHERE tli.load_id ='$id' AND tli.driver_id ='$driver_id' ";
			// echo $query;die;
			$dbconn->SetQuery($query);
			return $dbconn->LoadObject();
		

		} 


//******************************Save_Invoice_******************************************************

	public static function InsertInvoiceById($user_id,$owner_id,$pickup_id,$job_id,$driver_id,$load_detail_id,$load_id,$truck_type_id,$img_id,$truck_current_load,$weight){
	
			// echo $weight;die;
			global $config;
			$dbconn=db::singleton();
			$created_on=time();
			$updated_on=time();
		
			$query = "INSERT INTO `tbl_invoice`(`go_id`, `owner_id`, `pickup_id`, `job_id`, `driver_id`, `detail_id`, `load_id`, `truck_type_id`, `img_id`, `truck_current_load`, `return_weight`,`created_on`,`updated_on`)
			 VALUES ('$user_id','$owner_id','$pickup_id','$job_id','$driver_id','$load_detail_id','$load_id','$truck_type_id','$img_id','$truck_current_load','$weight','$created_on','$updated_on')";
			// echo $query; die;
			$dbconn->SetQuery($query);
			return $dbconn->LoadObject();
	
		} 		
		
/************************************************************************************/
		
		public static function GetLoad($load_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select lp.*, tt.* from load_post lp
			inner join truck_type tt on lp.truck_type_id = tt.truck_type_id  where load_id = ".$load_id."";
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();
		

		} 
		
		/************************************************************************************/
		public static function GetLoadPickup($load_id) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
		
			$dbconn=db::singleton();
			
			$query = "SELECT * FROM load_pickup where load_id=".$load_id." ORDER BY pickup_id DESC LIMIT 1"; 
			$dbconn->SetQuery($query);
			return $dbconn->LoadObject();
		} //function	
		
// ================================================================================ 
		public static function DeleteLoadDetail($load_detail_id) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
		
			$dbconn=db::singleton();
			
			$query1 = "update load_post_details set lpd_status='D' where load_detail_id = ".$load_detail_id."";
			$dbconn->SetQuery($query1);
			
			
		}		
/************************************************************************************/

		public static function GetLoadPost($ower_id=""){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select l.*,u.name as posted_by ,ud.contact_no,ud.cnic_no,ud.ntn_no,ud.address,ud.city from load_post l
					  inner join user u on u.user_id = l.user_id 
					  inner join user_detail ud on l.user_id = ud.user_id
					  where l.status='Active'";

			if($ower_id != "") 
			{
			 	$query .="  and u.user_id = '$ower_id'";
			}
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 
		
/************************************************************************************/

		public static function GetAcceptedLoad_($accept_by="",$post_by=""){

			global $config;
			
			$dbconn=db::singleton();
			
		if(isset($post_by))
		{

			$accptd_bid = Load::fetch_accptd_bid($post_by); 
		}

			$a=0;
			foreach($accptd_bid as $row)
			{	

				
				$json[$a]=$row;
				$des_detail=Load::fetch_Accptd_JOb_Owner_details($row->accept_by);
				
				$i=0;
				foreach($des_detail as $row1)
				{
					
					$json[$a]->transporter_details[]=$row1;
					$i++;
				}

				$documnts=Load::fetch_Documnt_details($row->load_id);
				
				$j=0;
				foreach($documnts as $row2)
				{
			
					$json[$a]->document_details[]=$row2;
					$j++;
				}

				$a++;
			}
			
			return $json;

			// $query="SELECT lp.*,cl.*
			// 		from load_post lp
			// 	 	INNER JOIN  tbl_container_loc cl ON lp.load_id=cl.load_id	
			// 	    where lp.status ='Accepted' and lp.user_id='$post_by'";

			// $dbconn->SetQuery($query);
			// $details = $dbconn->LoadObjectList();
			
			
			// $a=0;
			// foreach ($details as $value) {
			
			// $query="SELECT u.* from user u where user_id=".$value->accept_by;
			// $dbconn->SetQuery($query);
			// $Lo_accpt_details = $dbconn->LoadObjectList();
			
			// $json[$a]=$Lo_accpt_details;
			// foreach($Lo_accpt_details as $row)
			// {	

			// 	$json[$a]=$row;
				
			// }
		// 
			// }
			// 	echo "<pre>";
			// print_r($details);
			// echo "</pre>";
		
			
			// $query = "SELECT  lp.*,u1.name posted_by, u2.name accepted_by, ud.address address, ud.city city, ud.cnic_no cnic_no, ud.contact_no contact_no,cp.*
			// 		FROM load_post lp
			// 		INNER JOIN tbl_container_loc cp ON lp.user_id = $post_by
			// 		INNER JOIN user u1 ON lp.user_id = u1.user_id
			// 		INNER JOIN user u2 ON lp.accept_by = u2.user_id
			// 		INNER JOIN user_detail ud ON u2.user_id = ud.user_id

			// 		WHERE lp.status='Accepted' and lp.user_id=$post_by";

				// if($accept_by != "") 
				// {
				//  	$query .="  and u2.user_id = '$accept_by'";
				// }
				// if($post_by != "") 
				// {
			 // 		$query .="  and u1.user_id = '$post_by'";
				// }
					// echo $query; die;
				// $dbconn->SetQuery($query);

				// return $dbconn->LoadObjectList();
		
		} 


//===============================================================================================
//								Slect Accpted Data For GO show Accptd Bids
//===============================================================================================

	// public static function fetch_accptd_bid($user_id){

	// 		extract($_REQUEST);
	// 		global $config;
	// 		$dbconn=db::singleton();
	// 		$query="SELECT * from load_post where user_id=$user_id and status='Accepted'";

	// 		$dbconn->SetQuery($query);
	// 		return $dbconn->LoadObjectList();

	// }
//--------------------------------------------------------------------------------------

	// public static function fetch_Accptd_JOb_Owner_details($user_id){

	// 		extract($_REQUEST);
	// 		global $config;
	// 		$dbconn=db::singleton();
	// 		$query=" SELECT u.*,ud.* 
	// 				 from user u
	// 				 INNER JOIN user_detail ud ON u.user_id =ud.user_id
	// 				 where u.user_id=$user_id";

	// 		$dbconn->SetQuery($query);
	// 		return $dbconn->LoadObjectList();

	// }

//----------------------------------------------------------------------------------------------
	// public static function fetch_Documnt_details($load_id){

	// 		extract($_REQUEST);
	// 		global $config;
	// 		$dbconn=db::singleton();
	// 		$query="SELECT * from tbl_container_loc  where load_id=$load_id";

	// 		$dbconn->SetQuery($query);
	// 		return $dbconn->LoadObjectList();

	// }


//***********************************************************************************************
//										Fetch Commodities List for GO
// **********************************************************************************************

	public static function fetchCommoditiesList(){
  			
  			global $config;
			$dbconn=db::singleton();
			$query = "SELECT * FROM `tbl_commodities` ";
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

  	}

//***********************Fetch data Balance Sheet**********************************************		
	public static function GetInvoice($owner_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query ="SELECT distinct(load_id) from `tbl_invoice`  where  `go_id`=  '$owner_id'";

			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 
//		-----------------------------------------------------------
	
	public static function GetInvoice_Pickup($load_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query ="SELECT * from `tbl_loadpickup_point` where `load_id`='$load_id'";

			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		}
//  -------------------------------------------------------------
	public static function GetInvoice_Destination($load_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query ="SELECT lp.*,lpd.*  
					from load_post lp 
					INNER JOIN load_post_details lpd ON lp.load_id=lpd.load_id
			 		where lp.load_id='$load_id'";

			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		}		
//	----------------------------------------------------------------------

	public static function GetallDrivers($load_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query ="SELECT dj.driver_id,dj.owner_id,dj.job_id,u.name as driver_name,d.address as driver_addres,d.cnic_no as driver_cnicno,d.contact_no as driver_contctno,d.city as driver,u1.name as owner_name,u1.user_email as owner_email,ud.contact_no as owner_contct_no,inv.truck_current_load,inv.return_weight,inv.truck_type_id,tt.truck_type_name,tt.truck_capacity,t.truck_no  
					from `tbl_driver_job` dj
					INNER JOIN `driver` d ON dj.driver_id=d.user_id
					INNER JOIN `user` u ON dj.driver_id=u.user_id  
					INNER JOIN `user` u1 ON dj.owner_id=u1.user_id		
					INNER JOIN user_detail ud ON dj.owner_id=ud.user_id
					INNER JOIN tbl_invoice inv ON dj.job_id=inv.job_id
					INNER JOIN truck_type tt ON inv.truck_type_id=tt.truck_type_id
					INNER JOIN truck t ON tt.truck_type_id=t.truck_type_id
			 		where dj.load_id='$load_id'";

			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		}

//--------------------------------------------------------------------------

public static function GetInvoice_Drivers($driver_id,$truck_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query ="SELECT u.*,d.*,inv.truck_current_load,inv.return_weight,t.truck_type_name,t.truck_capacity,td.truck_no  
					from `user` u 
					INNER JOIN driver d ON u.user_id=d.user_id
					INNER JOIN tbl_invoice inv ON u.user_id=inv.driver_id
					INNER JOIN truck_type t ON t.truck_type_id=$truck_id
					INNER JOIN truck td ON td.truck_type_id=$truck_id
			 		where u.user_id='$driver_id'";

			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		}

//***************************************************************************************************		
		public static function AcceptLoad_not_in_use($user_id,$laod_id){

			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "update load_post set accept_by='$user_id', 
			accepted_date=now(),
			status='Accepted' where load_id='$load_id'";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return 1;
		

		} 

//==================================================================================================
//								GO Seen COmpplain change status
// ==================================================================================================


		public static function change_status_Complain($owner_id){

			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			

			$query="UPDATE `tbl_complain` SET `seen`=0 WHERE owner_id=$owner_id";
			$dbconn->SetQuery($query);
			return $dbconn->LoadObject();
		}



// ==================================================================================================
//									Fetch Complain for GO
//===================================================================================================

	public static function fetchComplain($owner_id){

			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
		if(isset($owner_id))
		{

			$complains_data = Load::fetch_complain_details($owner_id); 
		}

	
		if($complains_data) 
		{	

			$a=0;
			foreach($complains_data as $row)
			{	

				
				$json[$a]=$row;
				$des_detail=Load::fetch_destination($row->load_id);
				
				$i=0;
				foreach($des_detail as $row1)
				{
					
					$json[$a]->destination_details[]=$row1;
					$i++;
				}

				$pickup_det=Load::fetch_pp($row->load_id);
				
				$j=0;
				foreach($pickup_det as $row2)
				{
			
					$json[$a]->pickup_details[]=$row2;
					$j++;
				}

				$driver_det=Load::driver_data($row->user_id);
				
				$j=0;
				foreach($driver_det as $row3)
				{
			
					$json[$a]->drivers_details[]=$row3;
					$j++;
				}
				$a++;
			}
			
			return $json;
		}
			

			// $query = "SELECT com.*,lp.*,lpd.*,d.*,lo.*,dt.* 
			// 		  FROM tbl_complain com
			// 		  INNER JOIN load_post lp ON com.load_id=lp.load_id 
			// 		  INNER JOIN load_post_details lpd ON com.load_id=lpd.load_id
			// 		  INNER JOIN user d ON com.user_id=d.user_id
			// 		  INNER JOIN driver dt ON com.user_id=dt.user_id
			// 		  INNER JOIN user lo ON com.user_id=lo.user_id
			// 		  WHERE com.owner_id = $owner_id";
			// // echo $query; die;
			// $dbconn->SetQuery($query);
			// return $dbconn->LoadObjectList();
				

		} 

//  -----------------------------------------------------------------------------------------

	public static function fetch_complain_details($owner_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			$query="SELECT * from tbl_complain where owner_id=$owner_id";

			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();

	}



//-----------------------------------------------------------------------------------------
	public static function fetch_destination($load_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			$query="SELECT lp.*,lpd.*
					from load_post lp 
					INNER JOIN `load_post_details` lpd ON lp.load_id=lpd.load_id
					where lp.load_id=$load_id";

			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();

	}

//-------------------------------------------------------------------------------------------

	public static function fetch_pp($load_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			$query="SELECT * from tbl_loadpickup_point  where load_id=$load_id";

			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();

	}	

//-------------------------------------------------------------------------------------------------
		public static function driver_data($user_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			$query="SELECT d.*,dt.*,lo.name as LO_Name,lo.user_email as Lo_Email,lod.contact_no as  LO_contact_no
					from user d
					INNER JOIN driver dt ON d.user_id=dt.user_id
					INNER JOIN user lo ON dt.owner_id=lo.user_id
					INNER JOIN user_detail lod ON lo.user_id=lod.user_id
					where d.user_id=$user_id";

			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();

	}


//=================================================================================================
//								Complain Problem with Driver Notification for dashboard
//================================================================================================


	public static function complain_dashboard($owner_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			
			$query="SELECT  COUNT(complain_id) notification from tbl_complain  where owner_id=1 AND seen=1";
			$dbconn->SetQuery($query);
			return $dbconn->LoadObject();

	}	


// ================================================================================================
//									Get Destination Details for GO Complain Popup
//=====================================================================================================

		public static function Hello() {

			print("hello Daniyal");
		}



		public static function LoadDestinationDetail($load_id) {

			
			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			
			$query="SELECT  lp.*,lpd.*
					from load_post_details lpd
					INNER JOIN load_post lp ON lpd.load_id=lp.load_id
					where lpd.load_detail_id=$load_id";
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
			

		}	

// =======================================================================================================
// 
//======================================================================================================= 
		public static function _fetch_pikcup($pickup_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			
			$query="SELECT  * from tbl_loadpickup_point where pickup_id=$pickup_id";
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		}	




// ================================================================================================
// 									Bidding List 
// ================================================================================================

		public static function GetLoadBidList($go_id,$status){
			
			// print_r($_REQUEST['sess_admin_id']);die;
			
			global $config;
			$dbconn=db::singleton();
			
			$query = "SELECT * FROM tbl_bid WHERE go_id='".$go_id."' AND status='".$status."'";
			// print_r($query);die;
			$dbconn->SetQuery($query);
			
			$bid_list = $dbconn->LoadObjectList();
			
			if($bid_list) 
			{	$a=0;
				foreach($bid_list as $row)
				{
					
			

					$json[$a]=$row;
					
					$load_details=Load::GetLoadDetails($row->load_id,'Active');
					$i=0;
					foreach($load_details as $row1)
					{
						
						$json[$a]->load_detail[]=$row1;
						$i++;
					}

					$pickup_details=Load::GetSerPickupDetails($row->load_id,'Acceptedtive');
				
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
// =========================================================================================
		public static function GetLoadAcceptBidList($lo_id,$status){
			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			// echo $lo_id;
			$query = "SELECT u.name,b.*
			FROM tbl_bid b 
			INNER JOIN user u on b.go_id = u.user_id 
			WHERE b.user_id='".$lo_id."' AND b.status='".$status."'";
			$dbconn->SetQuery($query);
			$bid_list = $dbconn->LoadObjectList();
			
				$a=0;
				foreach($bid_list as $row)
				{
					
					$json[$a]=$row;

					$load_details=Load::GetLoadDetails($row->load_id,'Active');
					$i=0;
		
					if(!empty($load_details))
					{
						foreach($load_details as $row1)
						{
							
							$json[$a]->load_detail[]=$row1;
							$i++;
						}

					}	
					
					
					$pickup_details=Load::GetSerPickupDetails($row->load_id,'Active');
				
					$j=0;
					if (!empty($pickup_details)) {
					
							foreach($pickup_details as $row2)
							{
								
								$json[$a]->pickup_detail[]=$row2;
								$j++;
							}
					}
					

					$cro_details=Load::fetchContainerCRO($row->load_id);
					
					if(!empty($cro_details))
					{
						
						foreach($cro_details as $row3)
						{
							
							$json[$a]->cro[]=$row3;
							
						}
				  	}

				  	// echo "<pre>";print_r($json);echo "</pre>";		
					$a++;
					
				} //foreach


				return $json;	
			


		}

// WHERE j.owner_id='".$lo_id."' AND j.status='P' OR j.status='A'";
// ----------------------------------------------------------------------------------------------------------
	public static function GetAccpDriverJobList($lo_id){
			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT b.bid_amount,b.no_of_truck,u.name,j.* 
			FROM tbl_driver_job j 
			INNER JOIN user u on j.driver_id = u.user_id 
			INNER JOIN tbl_bid b on b.bid_id=j.bid_id
			WHERE j.owner_id='".$lo_id."'";
			// echo $query;die();
			$dbconn->SetQuery($query);
			$bid_list = $dbconn->LoadObjectList();
			
			if($bid_list) 
			{	
				$a=0;
				foreach($bid_list as $row)
				{
					$json[$a]=$row;					
					$load_details=Load::GetLoadDetails($row->load_id,'Active');
					$i=0;

				if(empty($load_details)){}else{
					foreach($load_details as $row1)
					{
						
						$json[$a]->load_detail[]=$row1;
						$i++;
					}
				}	
					$pickup_details=Load::GetSerPickupDetails($row->load_id,'Active');
				
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

//****************************File Download Func Php *********************************************


	// public static function downloadFile($load_id,$text){
		
	// 		extract($_REQUEST);
			
	// 		global $config;
	// 		$dbconn = db::singleton();
	// 		$arr = utility::ClearSqlInjection($_REQUEST);
	// 		extract($arr);




	// 		$url_to_image = 'http://cleversoft.co/wp-content/uploads/2013/08/senior-php-developer.jpg';

	// 		$ch = curl_init($url_to_image);

	// 		$my_save_dir = 'images/';
	// 		$filename = basename($url_to_image);
	// 		$complete_save_loc = $my_save_dir . $filename;

	// 		$fp = fopen($complete_save_loc, 'wb');

	// 		curl_setopt($ch, CURLOPT_FILE, $fp);
	// 		curl_setopt($ch, CURLOPT_HEADER, 0);
	// 		curl_exec($ch);
	// 		curl_close($ch);
	// 		fclose($fp);
			
			
	// 	}

/****************************************************************************/
		public static function AddLoadMsg($load_id,$text){
		
			extract($_REQUEST);
			
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			
			$query = "insert into  load_msg
			(load_id,text,msg_date_time) 
			values($load_id,'$text',now())";
			$dbconn->SetQuery($query);
			$classid=$dbconn->GetLastID();
			return $dbconn->LoadObject();
			
			
		} //function
	
/************************************************************************************/

		public static function GetLoadMsg($load){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select * from load_msg where load_id=$load order by load_msg_id desc";
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 
		
		public static function updateTruckNo($bid_id,$no_truck,$load_id,$owner_id,$amount)
		{
			global $config;
			$dbconn = db::singleton();

			
			$query2 = "select remaining_truck from load_post where load_id = ".$load_id."";
			//echo $query; die;
			$dbconn->SetQuery($query2);
			$remaining_truck = $dbconn->LoadObjectList()[0]->remaining_truck;

			$update_truck = $remaining_truck - $no_truck;
			// echo $update_truck;die();
			$query3 ="UPDATE `load_post` SET `total_price`='$amount' WHERE  load_id='$load_id' ";

			$dbconn->SetQuery($query3);

			$query4 ="UPDATE `tbl_bid` SET `status`='A' WHERE  bid_id='$bid_id' ";

			$dbconn->SetQuery($query4);

			$query5 = "UPDATE `load_post` SET `remaining_truck`='$update_truck' WHERE  load_id='$load_id' ";
			$dbconn->SetQuery($query5);
		}

	// ================================================================================================
	public static function  getDetailLoadList($owner_id,$status)
	{
		
		if(isset($owner_id) && isset($status))
		{
			$posted_loads = Load::GetLoadList($owner_id,$status); 
		}
		

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

				$pickup_details=Load::GetSerPickupDetails($row->load_id);
				
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

// ==================================== InProcess Job GO ======================================


	public static function  inProcessJobs($owner_id)
	{
	
		$status="On_the_way";
		if(isset($owner_id))
		{

			$accptd_jobs_details = Load::Accp_Inprocess_Details($owner_id); 
		}

		if($accptd_jobs_details) 
		{	
			$a=0;
			foreach($accptd_jobs_details as $row)
			{	

				$json[$a]=$row;
				$inprocess_dest=Load::Get_Inproces_dp_details($row->go_id,$status,$row->load_id,$row->driver_id,$row->owner_id,$row->truck_id);

				$j=0;
				foreach($inprocess_dest as $row2)
				{
					
					$json[$a]->inprocess_destination[]=$row2;
					$j++;
				}
				
				$i=0;
				$inprocess_pickup=Load::Get_Inproces_Job_pp_details($row->load_id);
				foreach($inprocess_pickup as $row3)
				{
					
					$json[$a]->inprocess_pickuppoint[]=$row3;
					$i++;
				}
				$a++;	
			}	
		}
	
		
		return $json;		
	}
	


// ================================= Complete Job for GO  ===================================

	public static function  completeJobs($owner_id)
	{
		
		if(isset($owner_id))
		{
			$complete_job=Load::fetchCompleteJob($owner_id);
		}
			
		if($complete_job) 
		{	
			$a=0;
			foreach($complete_job as $row)
			{	

				$json[$a]=$row;
				$dest_details=Load::fetch_DetailsCompleteJobs($row->load_id);
			
				foreach($dest_details as $row1)
				{	

					$json[$a]=$row;
					$json[$a]->dest_detail[]=$row1;	
				}

				$pick_details=Load::fetch_PP_detailsCompleteJobs($row->load_id);
				
				foreach($pick_details as $row2)
				{	
						$json[$a]->pp_detail[]=$row2;
				}
			$a++;	
		}
	
		}


		return $json;		
	}
	

//============================================================================================== 
	public static function  getPrintLoad($load_id)
	{
		
		$status='Active';
		$posted_loads = Load::GetPrintLoadList($load_id); 
		
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
				

				$img_detail = Load::imgdetail($row->load_id);
				// print_r($img_detail);die;
				$k=0;
				foreach($img_detail as $row3)
				{
					
					$json[$a]->img_detail[]=$row3;
					$k++;
				}
				$a++;

			}	

			return $json;	
			
		}

	}
// ***************************************************************************************************


	public static  function GetImage($user_id,$load_id,$driver_id)
	{
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT img.*,u.name,dt.*,u2.name as owner_name,u2.user_email as owner_email,od.contact_no as owner_contact_no
			FROM `tbl_load_img`  img
			INNER JOIN `user` u on img.driver_id=u.user_id
			INNER JOIN `driver` dt on img.driver_id=dt.user_id
			INNER JOIN `user` u2 on dt.owner_id = u2.user_id
			INNER JOIN `user_detail` od on dt.owner_id = od.user_id
			WHERE img.go_id ='$user_id' 
			AND img.driver_id  = '$driver_id'
		    AND load_id='$load_id'
		    order by img_id desc";
			// echo $query;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
	}

// *********************************Fetch Driver Detail for image *************************** 	



	public static  function GetDriver_Details($driver_id)
	{
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT `name` FROM `user` WHERE `user_id`='$driver_id'";
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
	}

// ***************************************************************************************************

	public static  function GetDriverID($user_id,$load_id)
	{
			global $config;
		
			$dbconn=db::singleton();
			
			$query = "SELECT driver_id 
					  FROM `tbl_load_img` i 
					  WHERE i.go_id='$user_id'
					  AND i.load_id='$load_id' 
					  group by driver_id order by i.img_id desc";
			// echo $query;die;	
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
	}

//**************************************************************************************************** 
	public static function getImageData($file_path){

			if (file_exists($file_path)) 
			{
		            $imageData = base64_encode(file_get_contents($file_path));
		            // Format the image SRC:  data:{mime};base64,{data};
		            $src = 'data: ' . mime_content_type($file_path) . ';base64,' . $imageData;
		        	// echo $src;die;
		            
		        	return $src;   
        	}

	}
// ===============================================================================================

	public static function imgDescUpdate($desc,$img_id,$truck_Weight)
	{
		// print_r($_REQUEST);die;
	  global $config;
			
	 $dbconn=db::singleton();	

	 $query = "UPDATE `tbl_load_img` SET `img_description`='$desc',`truck_current_load`='$truck_Weight' WHERE `img_id`='$img_id'";
	
	$dbconn->SetQuery($query);

	}

// ==============================================================================================

	public static function fetech_all_driver($goodsOwner_id)
	{

			global $config;
			$status_="on_the_Way";
			$dbconn=db::singleton();
			$query="select pickup_latitude,pickup_longitude from load_pickup where load_id ='$goodsOwner_id' && pickup_status ='$status_'";
			// echo $query;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();


	}

	public static function fetch_All_OWNER($user_id){

			global $config;
			
			$dbconn=db::singleton();
			// $query = " SELECT * DISTINCT  FROM user_detail ORDER BY load_id where load_id = ".$load_id";
			$query = "SELECT * from user_detail where user_id = ".$user_id."";
			
			$dbconn->SetQuery($query);
			// echo $dbconn->SetQuery($query); die;
			return $dbconn->LoadObjectList();
		

		} 


// =====================================Accepted Bids For Dashboard Data=======================

	public static function GetAcceptedLoad_fordashboard($accept_by="",$post_by=""){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT u1.name posted_by, u2.name accepted_by, ud.address address, ud.city city, ud.cnic_no cnic_no, ud.contact_no contact_no,lp.* FROM load_post lp
			INNER JOIN user u1 ON lp.user_id = u1.user_id
			INNER JOIN user u2 ON lp.accept_by = u2.user_id
			INNER JOIN user_detail ud ON u2.user_id = ud.user_id
			WHERE lp.status='Accepted'";
			if($accept_by != "") 
			{
			 	$query .="  and u2.user_id = '$accept_by'";
			}
			if($post_by != "") 
			{
			 	$query .="  and u1.user_id = '$post_by'";
			}
			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 
	
// =========================== InProcess Job Go Driver Acccpted Job details===================

		public static function Accp_Inprocess_Details($owner_id)
		{

		
			global $config;	
			$dbconn=db::singleton();
			
			$query = "SELECT * from tbl_driver_job where go_id =$owner_id AND status='A'";
	
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 



// ==================== Destination details Onthe way JOBIN Process==============================

		public static function Get_Inproces_dp_details($go_id,$status,$load_id,$driver_id,$lo_id,$truck_id){

			global $config;
			$dbconn=db::singleton();
			
			$query = "SELECT lp.*,ld.*,u.name as driver_name,dd.address as driver_address,dd.cnic_no as driver_cnic,dd.contact_no as driver_contactno,dd.city as driver_city,u1.name as lo_name,u1.user_email as lo_email,ud.contact_no as lo_contactno,ud.cnic_no as lo_cnic,ud.nicop as lo_nicop,ud.alien as lo_alien,ud.passport_no as lo_passport_no,ud.ntn_no as lo_ntn_no,ud.address as lo_address,ud.city as lo_city,t.truck_no,tt.truck_type_name,tt.truck_capacity,tt.truck_lose_weight
			 			FROM load_post lp 
			 			INNER JOIN load_post_details ld ON lp.load_id=ld.load_id 
			 			INNER JOIN user u ON u.user_id=$driver_id
			 			INNER JOIN driver dd ON dd.user_id=$driver_id
			 			INNER JOIN user u1  ON u1.user_id=$lo_id
			 			INNER JOIN user_detail ud ON ud.user_id=$lo_id
			 			INNER JOIN truck t ON t.truck_id=$truck_id
			 			INNER JOIN truck_type tt ON tt.truck_type_id=t.truck_type_id
			 			WHERE  lp.user_id = ".$go_id." and lp.status="."'$status' AND  lp.load_id=".$load_id;
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		}
// ============================= Pickpoint Details  for Job in Process ========================
	
		public static function Get_Inproces_Job_pp_details($load_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT *	FROM tbl_loadpickup_point pp 
			 			WHERE  load_id =".$load_id." AND status='Active'";
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		}
//================================ Complete job for GO =======================================


	public static function fetchCompleteJob($owner_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT *	FROM load_post  
			 			WHERE  user_id =".$owner_id." AND status='finish'";
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		}


//======================== Complete Jobs Details ===========================================


		public static function fetch_DetailsCompleteJobs($load_id)
		{

			global $config;	
			$dbconn=db::singleton();
			
			// $query = "SELECT lpp.*,lp.*,lpd.*,pp.*,lp.status as final_status
			// 		  from load_pickup lpp
			// 		  INNER JOIN load_post lp ON lp.load_id=lpp.load_id					  
			// 		  INNER JOIN load_post_details lpd ON lpd.load_id=lpp.load_id
			// 		  INNER JOIN tbl_loadpickup_point pp ON pp.load_id=lpp.load_id
			// 		  where lpp.load_id =$load_id AND lpp.pickup_status='finish'";

			$query="SELECT * from load_post_details WHERE load_id=".$load_id;
	
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 

// ---------------------------------------------------------------------------------------------
	public static function fetch_PP_detailsCompleteJobs($load_id)
		{

			global $config;	
			$dbconn=db::singleton();
			

			$query="SELECT * from tbl_loadpickup_point WHERE load_id=$load_id and status='finish'" ;
	
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 



//======================================================================================
}// class end 


?>