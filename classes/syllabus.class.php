<?php



	class Syllabus {		

		private $dbconn;

				
/********************************************************Add**************************** 								**** view all Sylabbu *****

************************************************************************************/

		public static function ViewSyllabus($user_id="",$class_id=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "select s.*,c.* from syllabus s
			inner join class c on c.class_id=s.class_id
			inner join user u on u.user_id = s.user_id";
			
			if($user_id != "") 
			{
			 	$query .= " and s.user_id = ".$user_id."";
			 }
			
			if($class_id != "") 
			{
			 	$query .= " and s.class_id = ".$class_id."";
			 }
			 	$query .= " order by s.syllabus_year, s.class_id asc ";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
			
/************************************************************************************ 								**** view all Syllabus Detail *****

************************************************************************************/

		public static function ViewSyllabusDetail($syllabus_id=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "select syl.syllabus_year,syd.book_id,b.product_type_id,b.book_name,b.book_image,b.book_edition,b.book_price,p.book_publisher_name,s.book_sub_name from syllabus syl
inner join syllabus_detail syd on syd.`syllabus_id`=syl.`syllabus_id`
inner join book b on b.book_id=syd.book_id
inner join book_publisher p on p.book_publisher_id=b.book_publisher_id
inner join book_subject s on s.book_sub_id=b.book_sub_id
where syl.syllabus_id=".$syllabus_id."";
			$dbconn->SetQuery($query);
			//print ($query); 
			return $dbconn->LoadObjectList();

		

		} 

/********************************************************Add**************************** 								**** view Syllbus *****

************************************************************************************/

		public static function GetSyllabus($syllabus_id=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "select s.*,c.* from syllabus s
			inner join class c on c.class_id=s.class_id
			inner join user u on u.user_id = s.user_id where syllabus_id=".$syllabus_id."";
			
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		}
		
/************************************************************************************ 								**** Add Syllabus *****

************************************************************************************/
		public static function AddSyllabus() {
		
			extract($_REQUEST);
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
				$query = "insert into syllabus
				(syllabus_year,class_id,user_id,syllabus_datetime,syllabus_status) 
				values(".$year.",'".$class."',".$_SESSION['sess_admin_id'].",now(),'A')";
					$dbconn->SetQuery($query);

				$syllabus_id=$dbconn->GetLastID();

			
			return $syllabus_id;
			
			
		} //function		
				
/************************************************************************************ 								**** Update Syllabus *****

************************************************************************************/
		public static function UpdateSyllabus($syllabus_id) {
		
			extract($_REQUEST);
			global $config;
			
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
				$query = "update syllabus
				set syllabus_year=".$year.",
				class_id='".$class."',
				user_id=".$_SESSION['sess_admin_id'].",
				syllabus_datetime=now() where syllabus_id=".$syllabus_id."";
					$dbconn->SetQuery($query);

			
			return $syllabus_id;
			
			
		} //function		

/************************************************************************************ 								**** Add New Book *****

************************************************************************************/
		public static function AddSyllabusBooks() {
		
			extract($_REQUEST);
			global $config;
			//print_r($_REQUEST); die;
			$dbconn = db::singleton();
			$arr = utility::ClearSqlInjection($_REQUEST);
			extract($arr);
				$query = "insert into syllabus_detail
				(syllabus_id,book_id,user_id,syllabus_detail_datetime) 
				values(".$param.",".$book.",".$_SESSION['sess_admin_id'].",now())";
				
				$dbconn->SetQuery($query);

			
			return $param;
			
			
		} //function	
		

		
		
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