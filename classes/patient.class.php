<?php



	class Patient {		

		private $dbconn;

				
/************************************************************************************ 								**** view all BP *****

************************************************************************************/

		public static function GetBP($patient_id="",$doctor_id="",$caretaker=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "select bp.*, u.* from bp_hb_sugar bp
			inner join user u on bp.user_id = u.user_id
			where u.status='A'";
			
			if($patient_id != "") 
			{
			 	$query .= " and u.user_id = ".$patient_id."";
			 }
			
			elseif($doctor_id != "")
			{
			$query .= " and u.user_id in (SELECT u.user_id FROM user u  INNER JOIN patient_doctor pd ON u.user_id = pd.patient_id
						WHERE pd.doctor_id =".$doctor_id.")";
			}
			
			elseif($caretaker != "")
			{
			$query .= " and u.user_id in (SELECT u.user_id FROM user u INNER JOIN patient_caretaker ck ON u.user_id = ck.patient_id WHERE ck.caretaker_id=".$caretaker.")";
			}
			
			$query .= " ORDER BY bp.datetime desc";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
		
/************************************************************************************ 								**** Add New BP *****

************************************************************************************/
		public static function AddBP() {
			
		
			extract($_REQUEST);
			
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$query = "insert into load_post
			(truck_type,user_id,capacity,goods_type,load_date,from_date,to_date,expected_price,posting_type,
			No_of_packages, dimenson, weight, quality, total_price, bid_date_start, bid_date_end,
			source_name, source_contactno, source_email, destination_name, destination_contactno,
			destination_email, accept_by, distance, appx_traveling_time, status, datetime) 
			
			values('$truck_type','0','$capacity','$goods_type','$load_date','$from_date','$to_date','$expected_price','$posting_type','
			$No_of_packages','$dimenson','$weight','$quality','$total_price','$bid_date_start','$bid_date_end','
			$source_name','$source_contactno','$source_email','$destination_name','$destination_contactno','
			$destination_email','$accept_by','$distance','$appx_traveling_time','$status','$datetime') ";
						//echo $query; die;

					$dbconn->SetQuery($query);

				$classid=$dbconn->GetLastID();
				
					
			
			return $dbconn->LoadObject();
			
			
		} //function
		
/********************************************************Add**************************** 								**** view all Patient *****/

		public static function GetGoods($patient_id=""){

			
		
			
			global $config;

			$dbconn=db::singleton();
			
			$query = "select * from load_post";
			
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
		
/********************************** Get Patient Medical*****************************************/

		public static function GetMedicalRecord($doctor_id="",$patient_id=""){

			global $config;

			$dbconn=db::singleton();
			
			if($doctor_id != "") 
			{
				$query = "select concat(u.first_name,' ', u.last_name) name, concat(u2.first_name,' ', u2.last_name) patient_name, mr.* from medical_records mr";
			}
			elseif($patient_id != "") 
			{
				$query = "select u.user_id, concat(u.first_name,' ', u.last_name) name, mr.* from medical_records mr";
			}
			
			if($doctor_id != "") 
			{
			 	$query .= " inner join user u on u.user_id = mr.recommended_by";
			 	$query .= " inner join user u2 on u2.user_id = mr.patient_id";
				$query .= "  where u2.user_id in (SELECT u.user_id FROM user u INNER JOIN patient_doctor pd ON u.user_id = pd.patient_id WHERE pd.doctor_id=".$doctor_id.")";

			 }
			elseif($patient_id != "") 
			{
			 	$query .= " inner join user u on u.user_id = mr.recommended_by WHERE mr.patient_id =".$patient_id;
			 }
		//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		} 
		
/******************************* Add Medical Report *****

************************************************************************************/
		public static function UploadMedicalReport() {
		
			extract($_REQUEST);
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			
			if($_FILES['reports']['size'] > 0){
			 	$file_path = $config["site_root_path"].$config["reports_path"];
				$code = Attachment::UploadFile("reports", $file_path, $_FILES['reports']['name']);
				$file_name = Attachment::$file_name;
				
				/** UploadFile may return following code		

				  1 = There is no attachment or error in file

				  2 = If extension is not valid

				  3 = If file uploaded successfull

				  4 = Error while uploading. It may be due to wrong path in Config File or folder permission.

				 * */

				}//file is !empty
			
			$query = "insert into medical_records
			(patient_id,recommended_by,test_name,test_datetime,test_image,purpose_of_test,datetime,status) 
			values(".$_SESSION['sess_admin_id'].",".$recomanded_by.",'".$test_for."','".$test_date."','".$file_name."','".$test_purpose."',now(),'A')";
						//echo $query; die;

					$dbconn->SetQuery($query);

				$bookid=$dbconn->GetLastID();
			
			return $bookid;
			
			
		} //function	
/********************************************************Add**************************** 								**** view all publisher *****

************************************************************************************/

		public static function ViewPublisher($pubid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "select * from book_publisher pub where pub.book_publisher_status='A'";
			
			if($pubid != "") 
			{
			 	$query .= " and pub.book_publisher_id = ".$pubid."";
			 }
			 	$query .= " order by pub.book_publisher_name asc ";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
		
/************************************************************************************ 								**** Add New Publisher *****

************************************************************************************/
		public static function AddPublisher() {
		
			extract($_REQUEST);
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$query = "insert into book_publisher
			(book_publisher_name,user_id,book_publisher_status,book_publisher_datetime) 
			values('".$publishername."',".$_SESSION['sess_admin_id'].",'A',now())";
						//echo $query; die;

					$dbconn->SetQuery($query);

				$pubid=$dbconn->GetLastID();
			
			return $pubid;
			
			
		} //function		
		
		
		
/************************************************************************************ 								**** view all books *****

************************************************************************************/

		public static function ViewBook($bookid="",$subject_id=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "SELECT b.*,p.*,s.*,c.class_name  FROM `book` b 
inner join book_publisher p on p.book_publisher_id=b.book_publisher_id
inner join book_subject s on s.book_sub_id=b.book_sub_id
inner join class c on c.class_id=b.class_id
where b.book_status='A'";
			
			if($bookid != "") 
			{
			 	$query .= " and b.book_id = ".$bookid."";
			 }
			
			if($subject_id != "") 
			{
			 	$query .= " and s.book_sub_id = ".$subject_id."";
			 }
			 	$query .= " order by b.book_id desc ";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 

		
/************************************************************************************ 								**** Add New Book *****

************************************************************************************/
		public static function AddBook() {
		
			extract($_REQUEST);
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			
			if($_FILES['book_image']['size'] > 0){
		
			 	$file_path = $config["site_root_path"].$config["books-image_path"];
				$code = Attachment::UploadFile("book_image", $file_path, $_FILES['book_image']['name']);
				$file_name = Attachment::$file_name;
				
				/** UploadFile may return following code		

				  1 = There is no attachment or error in file

				  2 = If extension is not valid

				  3 = If file uploaded successfull

				  4 = Error while uploading. It may be due to wrong path in Config File or folder permission.

				 * */

				}//file is !empty
			
			$query = "insert into book
			(product_type_id,class_id,book_sub_id,book_name,book_publisher_id,book_edition,book_price,book_image,book_status,book_datetime,user_id) 
			values(1,".$class.",".$subject.",'".$bookname."',".$publisher.",'".$edition."',".$price.",'".$file_name."','A',now(),".$_SESSION['sess_admin_id'].")";
						//echo $query; die;

					$dbconn->SetQuery($query);

				$bookid=$dbconn->GetLastID();
			
			return $bookid;
			
			
		} //function		
				
/*************************************View Caretaker************************************/

		public static function GetCaretaker($patient_id=""){

			global $config;
			
			$dbconn=db::singleton();
			$query = "select u.*, ck.* from patient_caretaker ck
			inner join user u on ck.caretaker_id = u.user_id where ck.patient_id=".$patient_id;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		} 
		/************************************************************************************ 								
		Delete Class
		************************************************************************************/

		public static function DeleteClass($class_id) {
			
			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "update class set class_status='D' where class_id=".$class_id; 
			$dbconn->SetQuery($query);
			

			return $class_id;
			
			
		}		
		
		
		/************************************************************************************ 								
		Delete Publisher
		************************************************************************************/

		public static function DeletePublisher($publisher_id) {
			
			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "update book_publisher set book_publisher_status='D' where book_publisher_id=".$publisher_id; 
			$dbconn->SetQuery($query);
			

			return $publisher_id;
			
			
		}	
		
		/************************************************************************************ 								
		Delete Publisher
		************************************************************************************/

		public static function DeleteSubject($subject_id) {
			
			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "update book_subject set book_sub_status='D' where book_sub_id=".$subject_id; 
			$dbconn->SetQuery($query);
			

			return $subject_id;
			
			
		}	
		
		/************************************************************************************ 								
		Delete Publisher
		************************************************************************************/

		public static function DeleteBook($book_id) {
			
			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "update book set book_status='D' where book_id=".$book_id; 
			$dbconn->SetQuery($query);
			

			return $book_id;
			
			
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
			$query = " select * from load_post order by load_id asc";
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