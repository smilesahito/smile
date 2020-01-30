<?php



	class Accessories {		

		private $dbconn;

				
	
		
/************************************************************************************ 								**** view all Accessories *****

************************************************************************************/

		public static function ViewAccessoriesType($accessories_type_id=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "select * from accessories_type acc where acc.accessories_type_status='A'";
			
			if($accessories_type_id != "") 
			{
			 	$query .= " and acc.accessories_type_id = ".$accessories_type_id."";
			 }
			 	$query .= " order by acc.accessories_type_name asc ";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
		
/************************************************************************************ 								**** Add New Accessories Type List *****

************************************************************************************/
		public static function AddAccessoriesType() {
		
			extract($_REQUEST);
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);

			$query = "insert into accessories_type
			(accessories_type_name,accessories_type_status,user_id,accessories_type_datetime) 
			values('".$accessoriestypename."','A',".$_SESSION['sess_admin_id'].",now())";
						//echo $query; die;

					$dbconn->SetQuery($query);

				$accessories_id=$dbconn->GetLastID();
			
			return $accessories_id;
			
			
		} //function
		
/************************************************************************************ 								**** view all Accessories *****

************************************************************************************/

		public static function ViewAccessories($accessories_type_id="",$accessories_id=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "SELECT a . * , at . * 
FROM  `accessories` a
INNER JOIN accessories_type at ON at.`accessories_type_id` = a.`accessories_type_id` 
WHERE a.`accessories_status` =  'A'";
			
			if($accessories_type_id != "") 
			{
			 	$query .= " and a.accessories_type_id = ".$accessories_type_id."";
			 }
			
			if($accessories_id != "") 
			{
			 	$query .= " and a.accessories_id = ".$accessories_id."";
			 }
			 	$query .= " order by a.accessories_id desc ";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 

		
/************************************************************************************ 								**** Add New Accessories *****

************************************************************************************/
		public static function AddAccessories() {
		
			extract($_REQUEST);
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			
			extract($arr);
			
	
			
			if($_FILES['acc_image']['size'] > 0){
		

			 	$file_path = $config["site_root_path"].$config["accessories-image_path"];
				$code = Attachment::UploadFile("acc_image", $file_path, $_FILES['acc_image']['name']);
				$file_name = Attachment::$file_name;
				
				/** UploadFile may return following code		

				  1 = There is no attachment or error in file

				  2 = If extension is not valid

				  3 = If file uploaded successfull

				  4 = Error while uploading. It may be due to wrong path in Config File or folder permission.

				 * */

				}//file is !empty
			
			$query = "insert into accessories
			(product_type_id,accessories_name,accessories_type_id,accessories_image,accessories_description,accessories_price,accessories_status,user_id,accessories_datetime) 
			values(2,'".$accessoriesname."',".$accessoriestype.",'".$file_name."','".$description."',".$price.",'A',".$_SESSION['sess_admin_id'].",now())";
						//echo $query; die;

					$dbconn->SetQuery($query);

				$accessories_id=$dbconn->GetLastID();
			
			return $accessories_id;
			
			
		} //function		
						
		
		
		/************************************************************************************ 								
		Delete Accessories Type
		************************************************************************************/

		public static function DeleteAccessoriesType($accessories_type_id) {
			
			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "update accessories_type set accessories_type_status='D' where accessories_type_id=".$accessories_type_id; 
			$dbconn->SetQuery($query);
			

			return $accessories_type_id;
			
			
		}	
		
		/************************************************************************************ 								
		Delete Accessories
		************************************************************************************/

		public static function DeleteAccessories($accessories_id) {
			
			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "update accessories set accessories_status='D' where accessories_id=".$accessories_id; 
			$dbconn->SetQuery($query);
			

			return $accessories_id;
			
			
		}	
		
		
		
		/************************************************************************************ 								**** Get Question All Type *****

************************************************************************************/

		public static function GetQuestionType(){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from question_type
					order by qt_id asc";
			
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
		
		
/************************************************************************************ 								**** Get Question Selected Type *****

************************************************************************************/

		public static function GetQuestionTypeDetail($qt_id=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from question_type";
			
			if($qt_id != "") 
			{
			 	$query .= " where qt_id = ".$qt_id."";
			 }
			$query .= "	order by qt_id asc";
           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		
/************************************************************************************ 								**** Get Category All Type *****

************************************************************************************/

		public static function GetCatgory(){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from category order by cid asc";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 

/************************************************************************************ 								**** Get Selected Category *****

************************************************************************************/

		public static function GetCatgoryDetail($cid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from category";
			
			if($cid != "") 
			{
			 	$query .= " where cid = ".$cid."";
			 }
			$query .= "	order by cid asc";
           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		
/************************************************************************************ 								**** Get All Groups *****

************************************************************************************/

		public static function GetGroup(){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from groups order by gid asc";
            //echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 

/************************************************************************************ 								**** Get Selected Group *****

************************************************************************************/

		public static function GetGroupDetail($gid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from groups";
			
			if($gid != "") 
			{
			 	$query .= " where gid = ".$gid."";
			 }
			$query .= "	order by gid asc";
           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		
		
/************************************************************************************ 								**** Add New Question *****

************************************************************************************/
		public static function Add() {
		
			extract($_REQUEST);
			global $config;
			//print_r($_REQUEST);die;
		
			$dbconn=db::singleton();
			//echo $score; die;
			//$arr = Utility::ClearSqlInjection($_REQUEST);
			//extract($arr);
			if(empty($no_of_opt)) {$no_of_opt=0;}
			$query = "insert into questions(qt_id,gid,question,description,cid,no_of_opt,created_by,created_on) 
					 values($question_type_id,$group_id,'".addslashes($question)."','".addslashes($description)."',$category_id,$no_of_opt,".$_SESSION['sess_admin_id'].",now())";
						//echo $query; die;

					$dbconn->SetQuery($query);

				$qid=$dbconn->GetLastID();
			
			if (!empty($option)) 
			{	
				
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

		public static function Update($qid) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
		
			$dbconn=db::singleton();
			//echo $score; die;
			//$arr = Utility::ClearSqlInjection($_REQUEST);
			
			
			$query = "update questions set question='".addslashes($question)."',description='".addslashes($description)."',cid= ".$category_id." where qid=".$qid; 
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
		
		public static function Delete($qid) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
		
			$dbconn=db::singleton();

			
			$query = "update questions set question_status='D' where qid=".$qid; 
			//echo $query; die;		 
			$dbconn->SetQuery($query);
			

			return $qid;
			
			
		}		
}