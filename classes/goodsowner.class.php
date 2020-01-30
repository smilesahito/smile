<?

	class GoodsOwner{
		
	private $dbconn;

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
			
			$query = "Update users set user_status='".$userstatus."' where uid=".$uid; 
			//echo $query; die;		 
			$dbconn->SetQuery($query);
			
			return $uid;
			
			
		}		


		public static function _GetAcceptedLoad($accept_by="",$owner_id=""){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT u1.name posted_by,p.*, u2.name accepted_by,lpd.*, ud.address address, ud.city city, ud.cnic_no cnic_no, ud.contact_no contact_no,lp.* 
			FROM load_post lp
			INNER JOIN user u1 ON lp.user_id = u1.user_id
			INNER JOIN user u2 ON lp.accept_by = u2.user_id
			INNER join load_post_details lpd on lp.load_id = lpd.load_id
			INNER JOIN user_detail ud ON u2.user_id = ud.user_id
			INNER JOIN tbl_loadpickup_point p on p.load_id=lp.load_id
			WHERE lp.status='On_the_way'";
			
			if($accept_by != "") 
			{
			 	$query .="  and u2.user_id = '$accept_by'";
			}
			if($owner_id != "") 
			{
			 	$query .="  and u1.user_id = '$owner_id'";
			}
			// echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 
		
		
/************************************************************************************/


		public static function AcceptLoad($user_id,$laod_id){

			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "update load_post set accept_by='$user_id', 
			accepted_date=now(),
			status='Accepted' where load_id='$load_id' and status='Active'";
			$result=$dbconn->SetQuery($query);
			
			if($dbconn->GetEffRows($result))
			{
				return 1;
			}else{
				return 2;

			}
			
		

		} 
		
/************************************************************************************/


		public static function SecurityCodeCheck($laod_id,$security_code){

			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select security_code from load_post where load_id=$laod_id and security_code='".$security_code."'";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();
		

		} 
		
		/************************************************************************************/
		
		public static function GetOwnerLoad($owner_id=""){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT u1.name posted_by, u2.name accepted_by, ud.address address, ud.city city, ud.cnic_no cnic_no, ud.contact_no contact_no,lp.* FROM load_post lp
			INNER JOIN user u1 ON lp.user_id = u1.user_id
			INNER JOIN user u2 ON lp.accept_by = u2.user_id
			INNER JOIN user_detail ud ON u2.user_id = ud.user_id
			where u1.user_id = '$owner_id' and lp.status in ('Driver Going to Pick Up','onthe Way')";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		} 
		
		/************************************************************************************/
			public static function AddToken($owner_id,$token) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
		
			$dbconn=db::singleton();
			
			$query = "update user set user_token='".$token."' where user_id='$owner_id'";
			//echo $query; die;		 
			$dbconn->SetQuery($query);
			
			return 1;
			
			
		} //function	
		
		
			public static function CheckToken($owner_id) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select user_token from user where user_id='$owner_id'";
			//echo $query; die;		 
			$dbconn->SetQuery($query);
			
			return $dbconn->LoadObject();
			
			
		} //function	


/* 				**********************************************************************
								 GET Pending Job Details For GO 	
				**********************************************************************/

		public static function fetch_PendingDetails_PP($lp_deatil_id) {

			
			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			$query="SELECT  lpd.*,lp.*
					from load_post_details lpd
					INNER JOIN load_post lp on lp.load_id= lpd.load_id
					where lpd.load_detail_id = $lp_deatil_id";
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		

		}
	

				/***********************************************************************
									Get PENDING PICKUP DETAILS
				***********************************************************************/

	public static function get_pend_pikcup($pickup_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			
			$query="SELECT  * from load_post_details where load_id=$pickup_id";
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

	}



			/***********************************************************************
										Get PENDING PICKUP DETAILS
			***********************************************************************/



	public static function get_pend_dest($pickup_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			
			$query="SELECT  pp.*,lpd.no_of_packages,lpd.weight,lpd.total_luggage,lpd.luggage_unit,lpd.package_type,lpd.target_price,lpd.destination_name,lpd.destination_contactno,lpd.goods_type,lpd.load_to 
					from tbl_loadpickup_point pp
					INNER JOIN load_post_details lpd ON lpd.load_detail_id = pp.dest_detail_id
					where pp.pickup_id=$pickup_id";
			
			$dbconn->SetQuery($query);
		
			return $dbconn->LoadObjectList();

	}

// ======================================================================================================
//							fetching Data for displaying after succfull submitting		
// =====================================================================================================
	
	public static function fetch_basicInfo($load_id){

			extract($_REQUEST);
			global $config;
			$dbconn=db::singleton();
			
			$query="SELECT * from  load_post where load_id = $load_id";				
			
			$dbconn->SetQuery($query);
		
			return $dbconn->LoadObjectList();

	}


// ------------------------------------------------------------------------------------------------------


		public static function fetch_Truck_Name_Cap($truckType_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select `truck_type_name`,`truck_capacity` from truck_type where truck_type_id =$truckType_id";
		
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		} 


// =========================================================================================================
//											Confimation Data Fetch
// ========================================================================================================= 



		public static function fetchConfimation_data($load_id){

			global $config;			
			$dbconn=db::singleton();
			
			$query = "SELECT * from load_post where load_id = $load_id"; 			
			$dbconn->SetQuery($query);
			$data = $dbconn->LoadObjectList();
			
			$a=0;
			foreach($data as $row)
			{	

				$json[$a]=$row;
				$des_details = GoodsOwner::fetch_Destination_details_($row->load_id);
			
				foreach($des_details as $row1)
				{
					$json[$a]->drop_details[]=$row1;
				}

				$pickUp=GoodsOwner::fetch_PickUp_details_($row->load_id);
	
				foreach($pickUp as $row2)
				{
					$json[$a]->pickUp_details[]=$row2;
				}
	
				$a++;
			}

			return $json;
		}


		/***********************************************************************
										check if user if id is exist or not
		***********************************************************************/

		public static function _id_exist_($load_id){
	
			global $config;			
			$dbconn=db::singleton();
			
			$query = "SELECT `load_id` from tbl_loadpickup_point where load_id = $load_id"; 		

			$dbconn->SetQuery($query);
			return $dbconn->LoadObject();
	}	

// ---------------------------------------------------------------------------------------------------

	public static function fetch_Destination_details_($load_id){
	
			global $config;			
			$dbconn=db::singleton();
			
			$query = "SELECT pp.*,lpd.no_of_packages,lpd.weight,lpd.total_luggage,lpd.luggage_unit,lpd.package_type,lpd.target_price,lpd.destination_name,lpd.destination_contactno,lpd.goods_type,lpd.load_to				
				 from tbl_loadpickup_point pp 
				 INNER JOIN load_post_details lpd ON pp.dest_detail_id = lpd.load_detail_id
				 where pp.load_id = $load_id"; 			
			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();
	}	

// ----------------------------------------------------------------------------------------------------

	public static function  fetch_PickUp_details_($load_id){
	
			global $config;			
			$dbconn=db::singleton();
			$query = "SELECT lpd.*, gc.good_type, gn.good_nature_name from load_post_details  lpd
						LEFT JOIN tbl_goods_classification gc ON gc.g_id = lpd.goods_classification
				 		LEFT JOIN tbl_goods_nature gn ON gn.nature_id = lpd.goods_nature
						where load_id = $load_id"; 			
			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();
	}

// ---------------------------------------------------------------------------------------------------
	public static function  update_basic_info(){
	
			
			 $_load_id_ = $_REQUEST['_load_id_'];	
			$hid_bl_doc = $_FILES['bl_doc'];
			$hid_invoice_doc = $_FILES['invoice_doc'];
			$hid_delivery_doc = $_FILES['delivery_doc'];
			$hid_guarantee_doc = $_FILES['guarantee_doc'];
			$hid_gd_doc = $_FILES['gd_doc'];
			$hid_con_cro = $_FILES['con_cro'];
			$user_id = $_SESSION["sess_admin_id"];	
			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$created_on=time();
			$updated_on=time();	


			if($_REQUEST['truck_type'] == "9" || $_REQUEST['truck_type'] =="10"){
				
		
			$query = "UPDATE `load_post` SET `job_type`='$job_type',`agent_name`='$agent_name',`agent_mobile_no`='$agent_mobileno',`truck_type_id`='$truck_type',`capacity`='$truck_type',`load_date`='$load_date',`expected_price`='$expected_price',`total_truck`='$truck_no',`container_no`='$container_no',`remaining_truck`='$truck_no',`bid_date_start`='$bid_date_start',`bid_date_end`='$bid_date_end',`status`='Pending',`datetime`=now() 
				WHERE load_id=$_load_id_"; 		
			$dbconn->SetQuery($query);
			$load_id=$dbconn->GetLastID();
			
			$query1 = "UPDATE `tbl_container_loc` SET
			`con_location`='$con_location',`con_latitude`='$container_lat',`con_longitude`='$container_lng' WHERE `load_id`='$_load_id_'";
			
				$dbconn->SetQuery($query1);
				$doc_last_id=$dbconn->GetLastID();

				
			
			 $bl_doc = $hid_bl_doc;
			 $invoice_doc = $hid_invoice_doc;
			 $delivery_doc = $hid_delivery_doc;
			 $guarantee_doc = $hid_guarantee_doc;
			 $gd_doc = $hid_gd_doc;
			 $con_cro = $hid_con_cro;
			
			
			$path = $config["root_path"];
			
			if(!empty($gd_doc)){
				
			   $ext = Attachment::GetFileExtension($_FILES['gd_doc']['name']);
			   $filename = "gd_doc".$_REQUEST['_load_id_'].$ext;
			   Attachment::UploadFile("gd_doc",$path,$filename);
				
			   $updte ="UPDATE `tbl_container_loc` SET `gd_doc` ='$filename' WHERE load_id=$_load_id_";
			   $dbconn->SetQuery($updte);	
			 
			 }
			
			if(!empty($bl_doc)){
				

				$ext = Attachment::GetFileExtension($_FILES['bl_doc']['name']);
				$filename = "bl_doc".$_REQUEST['_load_id_'].$ext;
				Attachment::UploadFile("bl_doc",$path,$filename);
				
			   $updte ="UPDATE `tbl_container_loc` SET `bl_doc` ='$filename' WHERE load_id=$_load_id_";
			   $dbconn->SetQuery($updte);	
			}
			
			if(!empty($invoice_doc)){
				
				$ext = Attachment::GetFileExtension($_FILES['invoice_doc']['name']);
				$filename = "invoice_doc".$_REQUEST['_load_id_'].$ext;
				Attachment::UploadFile("invoice_doc",$path,$filename);	
				
				$updte ="UPDATE `tbl_container_loc` SET `invoice_doc` ='$filename' WHERE load_id=$_load_id_";
				$dbconn->SetQuery($updte);				
			}
			
			if(!empty($delivery_doc)){
				
				$ext = Attachment::GetFileExtension($_FILES['delivery_doc']['name']);
				$filename = "delivery_doc".$_REQUEST['_load_id_'].$ext;
				Attachment::UploadFile("delivery_doc",$path,$filename);	
				
				$updte ="UPDATE `tbl_container_loc` SET `delivery_doc` ='$filename' WHERE load_id=$_load_id_";
				$dbconn->SetQuery($updte);	
			}
			
			if(!empty($guarantee_doc)){
				

				$ext = Attachment::GetFileExtension($_FILES['guarantee_doc']['name']);
				$filename = "guarantee_doc".$_REQUEST['_load_id_'].$ext;
				Attachment::UploadFile("guarantee_doc",$path,$filename);
				
				$updte ="UPDATE `tbl_container_loc` SET `guarantee_doc` ='$filename' WHERE load_id=$_load_id_";
				$dbconn->SetQuery($updte);	
				
			}

			if(!empty($con_cro)){
				

				$ext = Attachment::GetFileExtension($_FILES['con_cro']['name']);
				$filename = "con_cro".$_REQUEST['_load_id_'].$ext;
				Attachment::UploadFile("con_cro",$path,$filename);
				
				$updte ="UPDATE `tbl_container_loc` SET `con_cro` ='$filename' WHERE load_id=$_load_id_";
				$dbconn->SetQuery($updte);	
				
			}
		
		return $_load_id_;
	}else {

		
		$query  = "UPDATE `load_post` SET `job_type`='$job_type',`truck_type_id`='$truck_type',`capacity`='$truck_type',`load_date`='$load_date',`expected_price`='$expected_price',`total_truck`='$truck_no',`remaining_truck`='$truck_no',`bid_date_start`='$bid_date_start',`bid_date_end`='$bid_date_end',`status`='Pending',`datetime`=now() 
				WHERE load_id=$_load_id_"; 
			
			$dbconn->SetQuery($query);
			$load_id=$dbconn->GetLastID();	
			
			
			return $_load_id_;
	}
		
		
	}		

// =====================================================================================================

	public static function  _getBasicInfo_($load_id){

	
			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$created_on=time();
			$updated_on=time();	

			$query  = "SELECT lp.*,ty.truck_type_name,ty.truck_capacity,cl.con_location,cl.con_latitude,cl.con_longitude,cl.con_cro,cl.gd_doc,cl.bl_doc,cl.invoice_doc,cl.delivery_doc,cl.guarantee_doc
					   from load_post lp
					   LEFT JOIN truck_type ty	ON ty.truck_type_id = lp.truck_type_id
					   LEFT JOIn tbl_container_loc cl ON lp.load_id = cl.load_id
					   where lp.load_id = $load_id"; 
			
			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();

	}

// *********************************** Get BasicInfo

// =====================================================================================================
	public static function  _getPickUp_info_($load_id,$pickUp_id){


			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$created_on=time();
			$updated_on=time();	

		$query ="SELECT * from load_post_details where load_id = $load_id AND load_detail_id = $pickUp_id"; 
			
			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();

	}

// ******************************************************************************************************
// 										Update PickUp Info
// ******************************************************************************************************	

	public static function  _updatePickUp_info_(){
			

			$brand_name = $_REQUEST['brand_name'];
			$_load_id_ = $_REQUEST['_load_id_'];
			$detail_id = $_REQUEST['load_detail_id_'];
			
			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$created_on=time();
			$updated_on=time();	

		$query ="UPDATE `load_post_details` SET 
				`goods_classification` = '$good_classification', `goods_nature`='$good_nature',
				`goods_type`='$goods_type',`no_of_packages`='$no_of_packages',`weight`='$weight', 
				`total_luggage`='$total_luggage',`luggage_unit`='$luggage_unit',`package_type`='$package_type',
				`target_price`='$target_price',`destination_name`='$destination_name',
				`destination_contactno`='$destination_contactno',`load_to`='$load_from',`to_latitude`='$lat',
				`to_longitude`='$lng',`brand_name`='$brand_name'
		 WHERE `load_id` ='$_load_id_' AND `load_detail_id`='$detail_id'";

			
			$dbconn->SetQuery($query);
			return $_load_id_;
	}


// **************************** **************************************************** ********************
// 													Get Drop Details
// ****************************	**************************************************** ********************

	public static function  _getDrop_detail_info_($load_id,$pickUp_id){

			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$created_on=time();
			$updated_on=time();	

		$query ="SELECT lpp.*,lpd.load_to
				 from tbl_loadpickup_point lpp
				 INNER JOIN load_post_details lpd ON lpp.pickUp_id = lpd.pickup_id
				 where lpp.load_id = $load_id AND lpp.pickup_id = $pickUp_id"; 
			
			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();

	}

// ******************************************************************************************************
// 										Update Destination Info
// ******************************************************************************************************	


		public static function  _update_Destination_info_(){
				

	
			
			$dest_id = $_REQUEST['dest_id'];
			$_load_id_ = $_REQUEST['load_id'];
		
			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$created_on=time();
			$updated_on=time();	

			$query ="UPDATE `tbl_loadpickup_point` SET `weight_drop`='$drop_weight',`source_name`='$source_name',`source_contactno`='$source_contactno',`source_email`='$source_email',`load_from`='$load_from',`from_latitude`='$lat',`from_longitude`='$lng' 
				WHERE `load_id` ='$_load_id_' AND `pickup_id` ='$dest_id'";

			$dbconn->SetQuery($query);
			return $_load_id_;
	}

// ************************ *********** Active Job when all equip is ready ******** ***********************

	public static function job_active(){

			$load_id = $_REQUEST['load_id'];
		
			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$created_on=time();
			$updated_on=time();

		

			$query ="UPDATE `load_post` SET `status`='Active'
				WHERE `load_id` ='$load_id'";

			$dbconn->SetQuery($query);


	}

//****************** *************** Get Container Info ******************* **************************

	public static function getContainerInfo($load_id){

			global $config;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$created_on=time();
			$updated_on=time();

			$query = "SELECT * from tbl_container_loc where load_id = $load_id";
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
	}





// class end 
 }
?>
