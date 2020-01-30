<?

	class Quiz{
		
	private $dbconn;

	public static function Add(){
			//echo "hello"; die;
			global $config;
			
			$dbconn = db::singleton();
			
			$arr = utility::ClearSqlInjection($_REQUEST);
			//$c_agent = "0";
			extract($arr);
			//print("add to ship".$c_ship); die;
			$sql = " insert into quiz
					(quiz_name ,description, gid , 	noq , correct_score , incorrect_score,ip_address,duration,pass_percentage,created_on,created_by )
					 values
					('$quiz_name','".addslashes($description)."' ,'$gid' ,'$noq' , '$cscore' , '$incscore','$ip','$duration' ,'$percentage',now(),".$_SESSION['sess_admin_id'].")";
					
			//print($sql); exit;	
			$dbconn->SetQuery($sql);	
			$aid = $dbconn->GetLastID();
		
			return $aid;
		 
		
		}//  fuction add

/************************************************************************************ 								**** Update Selected Quiz  *****

************************************************************************************/

	public static function UpdateQuiz($quid){
			//echo "hello"; die;
			global $config;
			
			$dbconn = db::singleton();
			
			$arr = utility::ClearSqlInjection($_REQUEST);
			//$c_agent = "0";
			extract($arr);
			//print("add to ship".$c_ship); die;
			$sql = "update quiz set
					quiz_name='$quiz_name',
					description='".addslashes($description)."',
					gid='$gid',
					noq='$noq', 
					correct_score='$cscore', incorrect_score='$incscore',
					ip_address='$ip',
					duration='$duration',
					pass_percentage='$percentage',
					created_on=now(),
					created_by=".$_SESSION['sess_admin_id']." where quid=".$quid."";
					
			//print($sql); exit;	
			$dbconn->SetQuery($sql);	
		
			return $quid;
		 
		
		}
		
/************************************************************************************ 								**** Delete Quiz  *****

************************************************************************************/

		public static function DeleteQuiz($quid){

			global $config;

			$dbconn=db::singleton();
			
			$query = "update quiz set quiz_status='D' where quid=".$quid."";
			
			           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		


/************************************************************************************ 								**** Get quiz detail user wise  *****

************************************************************************************/

		public static function GetQuizDetail($uid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select g.group_name,q.*,u.* from quiz as q 
			inner join users as u on q.gid=u.gid 
			inner join groups as g on u.gid=g.gid where quiz_status='A'";
			
			if($uid != "") 
			{
			 	$query .= " and u.uid = ".$uid." and u.user_status='A'";
			 }
           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		
/************************************************************************************ 								**** Get quiz list  *****

************************************************************************************/

		public static function GetQuizList($quid=NULL){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select g.group_name,qz.* from quiz as qz 
			inner join groups as g on qz.gid=g.gid where 1 and quiz_status='A'";
			
			if(isset($quid))
			{
				$query.=" and qz.quid = ".$quid."";
			}
				$query.=" order by quid desc";

			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
		
/************************************************************************************ 								**** Get quiz detail user session wise *****

************************************************************************************/

		public static function GetSessionQuizDetail($qsid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "SELECT g.group_name,qz.quiz_name,qz.correct_score,qz.pass_percentage,u.user_name,qs.`start_time`,r.`percentage_obtained`,r.`result_status` FROM quiz_session qs
INNER JOIN users AS u ON qs.uid=u.uid 
INNER JOIN quiz AS qz  ON qs.quid=qs.quid
INNER JOIN groups AS g ON u.gid=g.gid
INNER JOIN result AS r ON qs.`quiz_session_id`=r.`quiz_session_id`";
			
			if($qsid != "") 
			{
			 	$query .= " WHERE qs.quiz_session_id = ".$qsid." AND u.user_status='A'";
			 }
           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		
/************************************************************************************ 								**** Get quiz detail user session wise for user panel*****

************************************************************************************/

		public static function GetSessionUserQuizDetail($qsid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "SELECT g.group_name,qz.quiz_name,qz.correct_score,qz.pass_percentage,u.user_name,qs.`start_time` FROM quiz_session qs
INNER JOIN users AS u ON qs.uid=u.uid 
INNER JOIN quiz AS qz  ON qs.quid=qs.quid
INNER JOIN groups AS g ON u.gid=g.gid";
			
			if($qsid != "") 
			{
			 	$query .= " WHERE qs.quiz_session_id = ".$qsid." AND u.user_status='A'";
			 }
           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		/************************************************************************************ 								**** Get Quiz Selected Category  *****

************************************************************************************/

		public static function GetQuizCategory($uid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select c.category_name,c.cid,g.group_name,q.*,u.* from questions as q 
			inner join users as u on q.gid=u.gid 
			inner join groups as g on u.gid=g.gid
			inner join category as c on q.cid=c.cid";
			
			if($uid != "") 
			{
			 	$query .= " where u.uid = ".$uid." and u.user_status='A'";
			 }
			 	$query .= " group by c.cid";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
		
/************************************************************************************ 								**** Get sesion quiz catetory Category  *****

************************************************************************************/

		public static function GetSessionQuizCategory($qsid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select c.category_name,c.cid,count(uqq.qid) qids from user_quiz_questions
 as uqq 
			inner join quiz_session as qs on uqq.quiz_session_id=qs.quiz_session_id
			inner join category as c on uqq.cid = c.cid";
			
			if($qsid != "") 
			{
			 	$query .= " where qs.quiz_session_id = ".$qsid."";
			 }
			 	$query .= " group by c.cid";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
/************************************************************************************ 								**** Inser User Quiz Sesion  *****

************************************************************************************/
				 public static function AddUQuizSession($quid,$qz_duration)
		 {
   
		   global $config;
		   $dbconn = db::singleton();

		   extract($_REQUEST); 
		   //print_r($_REQUEST); die;
		   $quizsession= " insert into quiz_session(uid,quid,status,start_time,quiz_start_time,quiz_end_time) values(".$_SESSION['sess_admin_id'].",'$quid' ,'Start',now(),now(),now() + INTERVAL ".$qz_duration." MINUTE)";
			//print($quizsession);die;
		   $dbconn->SetQuery($quizsession);
		   $qsid = $dbconn->GetLastID();
		   return $qsid;

  		}

/************************************************************************************ 								**** Inser Random Question in Quiz  *****

************************************************************************************/
		public static function InsertQuizQuestionByCategory($qsid){

			global $config;

			$dbconn=db::singleton();
			
			$quizdetail = Quiz::GetQuizDetail($_SESSION['sess_admin_id']);		
			$quiz = Quiz::GetQuizCategory($_SESSION['sess_admin_id']); 
			
			if($quiz) { $d=1;
		foreach($quiz as $q2row) {

			$query = "select c.category_name,g.group_name,q.*,u.* from questions as q 
			inner join users as u on q.gid=u.gid 
			inner join groups as g on u.gid=g.gid
			inner join category as c on q.cid=c.cid where u.uid = ".$_SESSION['sess_admin_id']." and c.cid = ".$q2row->cid." and u.user_status='A' and q.question_status='A' order by rand() limit ".$quizdetail->noq."";
			//echo $query."<br />"; 
			$dbconn->SetQuery($query);

			$QuizQuestions=$dbconn->LoadObjectList();
			
			foreach($QuizQuestions as $qqrow)
			{
				//echo $qqrow->cid."-".$qqrow->qid."<br />";
				$sql = " insert into user_quiz_questions
					(quiz_session_id,cid,qid,user_quiz_datetime,user_quiz_status)
					 values
					($qsid,$q2row->cid,$qqrow->qid,now(),'Active')";
					//print($sql);die;
					$dbconn->SetQuery($sql);
				
			}
		}
					  }

		//die;

		} 		
/************************************************************************************ 								**** Get Question category question  *****

************************************************************************************/
		public static function GetQuizQuestionByCategory($uid="",$cid="",$limit=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "select c.category_name,g.group_name,q.*,u.* from questions as q 
			inner join users as u on q.gid=u.gid 
			inner join groups as g on u.gid=g.gid
			inner join category as c on q.cid=c.cid";
			
			if($uid != "" && $cid != "") 
			{
			 	$query .= " where u.uid = ".$uid." and c.cid = ".$cid." and u.user_status='A'";
			 }
			
			$query .= " order by rand() limit ".$limit."";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
		
/************************************************************************************ 								**** Get Sessoin Question category question  *****

************************************************************************************/
		public static function GetSessionQuizQuestionByCategory($qsid="",$cid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "select c.category_name,q.* from quiz_session as qs 
			inner join user_quiz_questions as uqq on qs.quiz_session_id=uqq.quiz_session_id
			inner join category as c on uqq.cid=c.cid
			inner join questions as q on uqq.qid=q.qid";
			
			if($qsid != "" && $cid != "") 
			{
			 	$query .= " where qs.quiz_session_id = ".$qsid." and c.cid = ".$cid."";
			 }
			
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} /************************************************************************************ 								**** Get Question category question options *****

************************************************************************************/
		public static function GetQuizQuestionOption($qid=""){

			global $config;

			$dbconn=db::singleton();
			
		$query = "SELECT qo. * , q . * 
			FROM questions AS q
			LEFT JOIN question_options AS qo ON q.qid = qo.qid";
			
			if($qid != "") 
			{
			 	$query .= " where q.qid = ".$qid."";
			 }
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
	}

/************************************************************************************ 								**** Get Question sumbited options *****

************************************************************************************/
		public static function GetQuizSubmitedOption($qid="",$uid="",$quid=""){

			global $config;

			$dbconn=db::singleton();
			
		$query = "SELECT a.oid
					FROM answers AS a
					INNER JOIN questions AS q ON a.qid = q.qid
					INNER JOIN users AS u ON a.uid = u.uid
					INNER JOIN quiz AS qz ON a.quid = qz.quid";
			
			if($qid != "" && $uid != "" && $quid != "") 
			{
			 	$query .= " where a.qid = ".$qid." and 
				a.uid = ".$uid." and 
				a.quid = ".$quid."";
			 }
			
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();
	}

/************************************************************************************ 								**** Get Session Question Submitted Answer Options *****

************************************************************************************/
		public static function GetSessionQuizSubmitedOption($qid="",$qsid=""){

			global $config;

			$dbconn=db::singleton();
			
		$query = "SELECT a.oid,a.score_u
					FROM answers AS a
					INNER JOIN user_quiz_questions AS uqq ON a.quiz_session_id = uqq.quiz_session_id";
			
			if($qid != "" && $qsid != "") 
			{
			 	$query .= " where a.qid = ".$qid." and 
				a.quiz_session_id = ".$qsid."";
			 }
			
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();
	}
		

/************************************************************************************ 				**** save session quiz answers  *****

************************************************************************************/
		
		public static function SaveSessionAnswers(){

			global $config;
			
			$dbconn = db::singleton();
				extract($_REQUEST); 
		//print_r($_REQUEST); die;
			$qids = explode(',',$hiddenqid);
			//print_r($qids); die;
			
			$sql = " delete from answers where cid=".$cid." and quiz_session_id=".$qsid."";
			$dbconn->SetQuery($sql);

			
			for($i=0;$i<count($qids);$i++){
				$arraykey = "optionsRadios".$qids[$i];
				$longarraykey = "longanswer".$qids[$i];
				//print_r($longarraykey); 
				
				$answerval = array_key_exists($arraykey,$_REQUEST)?$_REQUEST[$arraykey]:0;
				$answervallong = array_key_exists($longarraykey,$_REQUEST)?$_REQUEST[$longarraykey]:"";
			
				//print($answervallong);  
				if($answerval>0){
					
				$query = "SELECT q.qid, qo.oid, qo.score
							FROM question_options AS qo
							INNER JOIN questions AS q ON qo.qid = q.qid
							WHERE qo.score =1
							AND q.qid =$qids[$i]";
					$dbconn->SetQuery($query);
					$res=$dbconn->LoadObject();
					
					if($res->oid == $answerval)
					{
						$correctans=1;
						
					}
					else
					{
						$correctans=0;
						//echo $correctans; die;
					}

					$sql = " insert into answers
					(cid,qid,oid,quiz_session_id,score_u)
					 values
					('$cid','$qids[$i]','$answerval',".$qsid.",'$correctans')";
					//print($sql);die;
					$dbconn->SetQuery($sql);	

				}
				if($answervallong!=""){
					//echo "hello". $answervallong[0]; die;
					$sql = " insert into answers
					(cid,qid,oid,quiz_session_id)
					 values('$cid','$qids[$i]','$answervallong',".$qsid.")";
					
					$dbconn->SetQuery($sql);	
					
				}
				
			} 
			
		if(isset($submit))
		{			
			
			$rid = Quiz::Result($qsid); 
			
			$sql = " update answers set a_status=1,
			rid=".$rid." where quiz_session_id=".$qsid."";
			$dbconn->SetQuery($sql);
			
			$sql2 = " update quiz_session set status='End',
			end_time=now() where quiz_session_id=".$qsid."";
			$dbconn->SetQuery($sql2);
			
		}

	}			
		/************************************************************************************ 				**** update session save answers  *****

************************************************************************************/
		
		public static function UpdateSaveAnswers(){

			global $config;
			
			$dbconn = db::singleton();
				extract($_REQUEST); 
		//print_r($_REQUEST); die;
			$qids = explode(',',$hiddenqid);
			//print_r($qids); die;
			

			
			for($i=0;$i<count($qids);$i++){
				$longarraykey = "longanswer".$qids[$i];
				//print_r($longarraykey); 
				
				$answervallong = array_key_exists($longarraykey,$_REQUEST)?$_REQUEST[$longarraykey]:"";
			
				//print($answervallong);  
				
				if($answervallong!=""){
					//echo "hello". $answervallong[0]; die;
					if(isset($incorrect))
					{$correctans=0;}
					else if(isset($correct))
					{$correctans=1;}
					$sql = " update answers set score_u=".$correctans." 
					where quiz_session_id=".$qsid." and qid=".$qids[$i]." and rid=".$rid."";
					$dbconn->SetQuery($sql);
					
				}
				
			} 
			
			Quiz::UpdateResult($qsid,$rid); 
	}
		
		
		public static function ViewUserAnswers(){
		
		global $config;
		$dbconn = db::singleton();
		$userid= $_GET['id'];

	    $query="SELECT a . * , u.user_name, u.email, q.question, qo.q_option, a.quid, qu.quiz_name
			FROM  `answers` AS a
			INNER JOIN questions AS q ON a.qid = q.qid
			inner JOIN question_options AS qo ON a.qid = qo.qid
			INNER JOIN users AS u ON a.uid = u.uid
			INNER JOIN quiz AS qu ON a.quid = qu.quid
			where qo.score=1 and u.uid=".$userid;
			//print($query);die;
		
	    $dbconn->SetQuery($query);
		$result=$dbconn->LoadObjectList();

		if($result) 
		{
               
         	foreach($result as $row)
         	 {
         	 	if(is_numeric ($row->oid))
         	 	{
		  	 $query_userans="SELECT qo.*
			FROM question_options as qo
			where qo.oid=".$row->oid;

			//print($query_userans);die;
		
			$dbconn->SetQuery($query_userans);
			$userans= $dbconn->LoadObject();
			  }
			  else
			  {
			  	$userans=$row->oid;
			  }
			
			}
		return array($result, $userans);
		}
		
	}



		public static function GetUserResult($qsid=""){
		global $config;
			
			$dbconn = db::singleton();
			$query="SELECT sum(score_u)as marks,qz.noq,(qz.noq * qz.correct_score) as total_marks ,qz.quiz_name,qz.correct_score,qz.incorrect_score,qz.pass_percentage,(qz.correct_score * sum(score_u))as marks_obt ,((qz.correct_score * sum(score_u))/(qz.noq * qz.correct_score))*100 as obt_percentage
			FROM `answers` as a
			inner join quiz_session as qs on a.quiz_session_id
			inner join quiz as qz on qs.quid=qz.quid
			WHERE a.quiz_session_id=".$qsid."";
			//print($query);die;
		
			$dbconn->SetQuery($query);
			return $dbconn->LoadObject();
		
	}

		public static function GetMultilineQuestions($qsid="")
		{
			global $config;
			$dbconn = db::singleton();

			$mlineans="select aid from answers where quiz_session_id=".$qsid." and score_u IS NULL";
			//print($mlineans);die;
			$dbconn->SetQuery($mlineans);
			return $dbconn->LoadObjectList();

}
		public static function Result($qsid=""){

			global $config;
			$dbconn = db::singleton();

			$quizdetail = Quiz::GetSessionUserQuizDetail($qsid);
			$correct_score=$quizdetail->correct_score;
			$pass_percentage=$quizdetail->pass_percentage;
			
			$quiz = Quiz::GetSessionQuizCategory($qsid); 
			$total_questions=0;
			foreach($quiz as $cwarow) 
			{ 
				$total_questions=$total_questions+$cwarow->qids;
			}
			
			$answer = Quiz::CorrectIncorrectAnswers($qsid); 
			$total_answer=$answer->correct;
			
			//echo $total_questions." - ".$total_answer; die;
			//$res = Quiz::GetUserResult($qsid); 
				
			$total_marks=$total_questions*$correct_score;
			$obt_marks=$total_answer*$correct_score;
			$obt_percentage=($obt_marks/$total_marks)*100;
			
				$multilines=Quiz::GetMultilineQuestions($qsid);

			if($multilines)
			{
				
				$result="Pending";

			}
			else
			{
				if($obt_percentage>=$pass_percentage)
					{
						$result="Pass";
					}
					else
					{
						$result="Fail";
					}			
			}
			$sql = " insert into result
						(quiz_session_id, result_status ,total_marks,score_obtained,percentage_obtained,pass_percentage,created_on,created_by )
						 values
						('$qsid' ,'$result' ,'$total_marks' , '$obt_marks' , '$obt_percentage','$pass_percentage',now(),".$_SESSION['sess_admin_id'].")";

			$dbconn->SetQuery($sql);	
			$rid = $dbconn->GetLastID();
			return $rid;
			
	}

		
	public static function UpdateResult($qsid="",$rid=""){
			global $config;
			$dbconn = db::singleton();

			$res = Quiz::GetUserResult($qsid); 

			$quizdetail = Quiz::GetSessionUserQuizDetail($qsid);
			$correct_score=$quizdetail->correct_score;
			$pass_percentage=$quizdetail->pass_percentage;
			
			$quiz = Quiz::GetSessionQuizCategory($qsid); 
			$total_questions=0;
			foreach($quiz as $cwarow) 
			{ 
				$total_questions=$total_questions+$cwarow->qids;
			}
			
			$answer = Quiz::CorrectIncorrectAnswers($qsid); 
			$total_answer=$answer->correct;
			
			//echo $total_questions." - ".$total_answer; die;
			//$res = Quiz::GetUserResult($qsid); 
				
			$total_marks=$total_questions*$correct_score;
			$obt_marks=$total_answer*$correct_score;
			$obt_percentage=($obt_marks/$total_marks)*100;
			
		if($obt_percentage>=$pass_percentage)
			{
				$result="Pass";
			}
			else
			{
				$result="Fail";
			}

			$sql = "update result  set	result_status='$result',
			score_obtained='$total_marks',
			score_obtained='$obt_marks',
			percentage_obtained='$obt_percentage' 
			where quiz_session_id=".$qsid." and rid=".$rid."";
			$dbconn->SetQuery($sql);
			//return $rid;

	}
		
	public static function ViewResult($uid=""){
					global $config;
			
			$dbconn = db::singleton();


		$query="SELECT r.*,u.uid,u.user_name,qz.quiz_name,qz.quid,qs.quiz_session_id,g.group_name
			FROM `result` as r
			inner join quiz_session as qs on r.quiz_session_id=qs.quiz_session_id
			inner join quiz as qz on qs.quid=qz.quid
			inner join users as u on qs.uid=u.uid
			inner join groups as g on u.gid=g.gid";
			if($uid != "")
			{
				$query .= " where u.uid = ".$uid."";
			}
			
			//print($query);die;
		
			$dbconn->SetQuery($query);
			return $dbconn->LoadObjectList();
		
	}
		
/************************************************************************************ 								**** Get sesion quiz catetory answers  *****

************************************************************************************/

		public static function CountCategoryAnswers($qsid="",$cid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "SELECT c.category_name,c.cid,COUNT(a.qid) answers FROM answers
 AS a 
			INNER JOIN quiz_session AS qs ON a.quiz_session_id=qs.quiz_session_id
			INNER JOIN category AS c ON a.cid = c.cid";
			
			if($qsid != "") 
			{
			 	$query .= "  WHERE qs.quiz_session_id = ".$qsid."";
			 }
			
			if($cid != "") 
			{
			 	$query .= "  and c.cid = ".$cid."";
			 }
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		
/************************************************************************************ 								**** Get sesion quiz catetory correct and incorrect answers  *****

************************************************************************************/

		public static function CorrectIncorrectAnswers($qsid="",$cid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = "SELECT uqq.`qid`,c.cid,a.aid,SUM(IF(a.`score_u` = '1', 1,0)) AS correct,SUM(IF(a.`score_u` = '0', 1,0)) AS incorrect  FROM answers AS a
INNER JOIN user_quiz_questions AS uqq ON a.`qid`= uqq.qid
INNER JOIN category AS c ON a.cid = c.cid";
			
			if($qsid != "") 
			{
			 	$query .= "  WHERE a.`quiz_session_id`= ".$qsid." AND uqq.`quiz_session_id`= ".$qsid."";
			 }
			
			if($cid != "") 
			{
			 	$query .= "  and c.cid = ".$cid."";
			 }
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} }   // class end 

?>