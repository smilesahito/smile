<?
	class Employee {
	
		private static $obj;
		private static $image_code;
		private static $login_obj;
		private $dbconn;	
		
		
		/*************************************************************************************
		// this function will check that image is exist or not
		/*************************************************************************************/
		
		public static function ShowImage($empcode,$width="",$height=80,$attribute="") {
			//print("image name =".$imagename);
			global $config;
			
			$empcode = trim($empcode);
			$imagename = $empcode.".jpg";
			
		//	print($config["user_image_path"].$imagename); 
			if(file_exists($config["user_image_path"].$imagename)) { 
				
				$param = Utility::encrypt($empcode);
				
				//if($width != "")
				//	$str ='<img  src="/classes/showimage.php?param='.$param.'" border="0"  height='.$height.' width='.$width.' '.$attribute. '  />';
				//else
					$str ='<img  src="/classes/showimage.php?param='.$param.'" border="0"  height='.$height. ' '.$attribute. '  />';
				
			 } else { 
				
				$param = Utility::encrypt("no-preview");
				$str ='<img  src="/classes/showimage.php?param='.$param.'" border="0"  height='.$height.' width='.$width.' '.$attribute. '  />';
				
			 } 
		 
		 	 print($str);
		 
		}
		
		//Gettign captcha image
		public static function IsExist($email,$flag="true") {
			
			//it will return true or false
			return User::IsEmailExist($email,$flag);
			
		}  //get
		
		/*************************************************************************************
		// this function will Check the availability of Email address.
		/*************************************************************************************/
		public static function IsEmailExist($email,$flag="true") {
			
			extract($_REQUEST);
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			
			$arr = Utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			
			//$email = Constrain::ClearSqlInjection($email);
			$query = "select * from tbl_employee where email_address='$email' and emp_status !='D'";
			
			if(Employee::IsUserLoggedIn()) {
				
				$empid = Employee::GetSessionEmployeeId();
				if($flag=="true") {
					$query .= " and emp_id != '$empid'";
				}
			}
			
			//print($query); exit;
			$dbconn->SetQuery($query);
			
			if($dbconn->GetNumRows()) {
				
				Employee::$obj = $dbconn->LoadObject();
				
				return true;
				
			} else {
			
				return false;
			
			}
	
			
		}  //get
		
		/*************************************************************************************
		// this function will Check the availability of Login Id .
		/*************************************************************************************/
		public static function IsUserNameExist($uname="null") {
			
			extract($_REQUEST);
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			
			$arr = Utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			$query = "select * from tbl_employee where emp_username='$uname'";
			
			$dbconn->SetQuery($query);
			
			if($dbconn->GetNumRows()) {
				
				User::$obj = $dbconn->LoadObject();
				
				return true;
				
			} else {
			
				return false;
			
			}
	
			
		}  //IsUserNameExist
		
		/*************************************************************************************
		// this function will Update user
		/*************************************************************************************/		
				
		public static function Update() {
		
			
			global $config;
			
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			extract(Utility::ClearSqlInjection($_REQUEST));		
			
			$loginid = $email;
						
			$query = " update  tbl_employee set jtype='$jtype' ,emp_name ='$emp_name',
					per_hour_charge='$phc',phone = '$phone',updated_on=now()  where emp_id='$empid'";
			//print($query); exit;
			$dbconn->SetQuery($query);
			
			
			
		} //function
		
		
		
		/*************************************************************************************
		// this function will Add new Employee
		/*************************************************************************************/
		
		public static function AddNew() {
		
			extract($_REQUEST);
			global $config;
			
			
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			
			$arr = Utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			
			
			$loginid = $email;
			$password = md5($password);
			
			$query = "insert into tbl_employee(jtype ,emp_name,per_hour_charge,phone,created_on) 
					 values('$jtype','$emp_name','$phc','$phone',now())";
			//print($query); exit;
			
			$dbconn->SetQuery($query);
			
			$empid = $dbconn->GetLastID();
			
			
		} //function
		
		/*****************************************************************************************************
		* This function will return upload image status. It must be call after Register method of this class	
		/*****************************************************************************************************/
		
		public static function GetUploadedImageStatus() {
			
			
			/**	UploadFile may return following code
	
			1 = There is no attachment or error in file 
			2 = If extension is not valid
			3 = If file uploaded successfull
			4 = Error while uploading. It may be due to wrong path in Config File or folder permission.
			
			**/
			
			return User::$image_code;
		
		} //GetUploadedImageStatus
		
		
		
		/*********************************************************************************************
		* This function will login to registerd user
		/********************************************************************************************/
		public static function GetLogin($email="",$password="") {
		
			extract($_REQUEST);
			
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			
			
			$arr = Utility::ClearSqlInjection($_REQUEST);
			extract($arr);
			
			$pwd = md5($pwd);
			
			$query = "select * from tbl_employee where (emp_username='$uname' and emp_password='$pwd') and (emp_status='A')";
			$dbconn->SetQuery($query);
			//print($query); exit;
			if($dbconn->GetNumRows()) {
				
				Employee::$login_obj = $dbconn->LoadObject();
				
				Employee::SetUserSession();
				
				return true;
				
			} else {
			
				return false;
				
			}
			
		} //getlogin
		
		
		
		/************************************************************************************************
			Returing User status either verified or not verified. It must be called after GetLoggedIn()
		/************************************************************************************************/
		public static function IsVerified() { 
			
			if(User::$login_obj->Status=="A") {
				return true;
			}
			
			if(User::$login_obj->Status=="U") {
				return false;
			}
		
		} //IsVerified
		
		/************************************************************************************************
			Set Login User Session
		/************************************************************************************************/
		public static function SetUserSession() { 
			
			$_SESSION['sess_emp_dept_id'] = trim(Employee::$login_obj->dept_id);
			$_SESSION['sess_emp_id'] = Employee::$login_obj->emp_id;
			$_SESSION['sess_emp_username'] = Employee::$login_obj->emp_name; //." ".User::$login_obj->Lname;
			$_SESSION['sess_emp_email'] = Employee::$login_obj->email_address;
			$_SESSION['sess_emp_jtype'] = Employee::$login_obj->journal_type;
			$_SESSION['sess_emp_ebm_access'] = Employee::$login_obj->ebm_access;
			//$_SESSION['sess_emp_role'] = Employee::$login_obj->role;
	
		} //IsVerified
		
		/************************************************************************************************
			checking wheather user session is set or not. if it is set then it means user is logged in 
			otherwise he is not logged in
		/************************************************************************************************/
		public static function IsUserLoggedIn() {
			
			if(!isset($_SESSION['sess_emp_id']) && !isset($_SESSION['sess_emp_username']) && !isset($_SESSION['sess_emp_status']) ) {
			
				return false;
				
			} else {
				
				return true;
			
			}
		
		}
		
		public static function GetSessionEmployeeDeptId() { return $_SESSION['sess_emp_dept_id'];  } //
		public static function GetSessionEmployeeId() { return @$_SESSION['sess_emp_id'];  } //
		public static function GetSessionEmployeeName() { return ucwords($_SESSION['sess_emp_username']);  } //
		public static function GetSessionEmployeeJournalType() { return $_SESSION['sess_emp_jtype'];  } //
		public static function GetSessionEmployeeEmail() { return $_SESSION['sess_emp_email'];  } //
		public static function GetSessionEmployeeEBMAccess() { return $_SESSION['sess_emp_ebm_access']; } //
						
		//public static function GetSessionEmployeeRole() { return $_SESSION['sess_emp_role'];  } //
		
		
		/************************************************************************************************
			It will return complete user information
		/************************************************************************************************/
		
		public static function GetEmployeeInfo($emp_id="",$emp_code="") { 
		
			
			$dbconn=db::singleton();
			
			$query = "select * from tbl_employee e 
						 where emp_status != 'D' ";
			
			if($emp_id != "") {			 
				
				$query .= " and emp_id='$emp_id' ";
			} 
			
			if($emp_code != "") {			 
				
				$query .= " and emp_code='$emp_code' ";
			} 
			
			
			$dbconn->SetQuery($query);
			//print($query); exit;
			if($dbconn->GetNumRows()) {
				
				 
				return $dbconn->LoadObject();
				
			} else {
			
				return false;
				
			}
		
		}
		
		
		public static function GetJournalChecker($jid) { 
		
			
			$dbconn=db::singleton();
			
			//3 is graphics department id in tbl_department table
			$query = "select emp_name,email_address,journal_code,journal_name from tbl_employee e inner join 
						tbl_journal j on j.jtype = e.journal_type
						where dept_id = 3 and jid = '$jid'";
			
			$dbconn->SetQuery($query);


			if($dbconn->GetNumRows()) {
				 
				return $dbconn->LoadObject();
				
			} else {
			
				return false;
				
			}
		
		}
		
		/************************************************************************************************
			This function will get Employee Departement Head Role of employee
		************************************************************************************************/
		
		public static function GetDepartmentHead($empid) {
			
			$dbconn=db::singleton();
			
			$query = "select * from tbl_employee where (role='3' or designation='dept_head') and dept_id in (
						SELECT dept_id FROM `tbl_employee` WHERE emp_id='$empid' )  ";
			//
			$dbconn->SetQuery($query);	
			
			if($dbconn->GetNumRows()) {
				return $dbconn->LoadObject();
			} else {
				return 0;
			}
			
		}
		
		/************************************************************************************************
			It will return complete Employee information
		/************************************************************************************************/
		
		public function GetEmployeeList($filter="",$pageno="null",$pagesize="null") { 
		
			$this->dbconn=db::singleton();
			
			$query = "select * from tbl_employee e where emp_status != 'D' ";
						 
			if($filter != "") {
				$query .= $filter;
			}			 
			
			$query .= " order by trim(emp_name)";
					
			
			//print($query);  exit;
			$this->dbconn->SetQuery($query);
				
			return $this->dbconn->LoadObjectList($pageno,$pagesize);
		
		}//list
		
		public function GetNumRows() { return $this->dbconn->GetNumRows(); }
		public function GetNumberOfPages() { return $this->dbconn->GetNumberOfPages(); }
		
		/*//////////////////////////////////////////////////////////////////////////*/
		
		public static function IsCurrentPasswordOk($loginid,$pwd) {
		
			//singleton function returning database object to local variable $dbconn
			$dbconn=db::singleton();
			
			$query = "select * from tbl_employee where Loginid='$loginid' and Loginpassword='$pwd'";
			$dbconn->SetQuery($query);
			
			if($dbconn->GetNumRows()) {

				return true;
				
			} else {
			
				return false;
				
			}
			
		} //IsCurrentPasswordOk
		
		
		public static function GetForgotPassword() {
		
			extract($_REQUEST);
			
			$dbconn = db::singleton();
			
			$query = "select emp_password from tbl_employee where email_address='$email' and emp_status='A'";
			//print($query); exit;
			$dbconn->SetQuery($query);
			
			if($dbconn->GetNumRows()) {
			
				return $dbconn->LoadObject();
				
			} else {
			
				return false;
			
			}

			
		} //GetLogin
		
		
		
		/*************************************************************************************
		// this function will upload User Profile Image
		/*************************************************************************************/	
		public function UploadImage($memberid) {
			//this variable is defined in
			global $config;
			
			$dbconn=db::singleton();	
			
			
			if($_FILES['profileimg']['size']>0) {
				
							
				$pro_pic_path = "../..".$config["user_image_path"];
				$code = Attachment::UploadFile("profileimg",$pro_pic_path,$memberid);
				$pro_pic_name = Attachment::$file_name;
				
				/**	UploadFile may return following code		
				1 = There is no attachment or error in file 
				2 = If extension is not valid
				3 = If file uploaded successfull
				4 = Error while uploading. It may be due to wrong path in Config File or folder permission.
				
				**/										
				if($code == "3") {			
					$upd_query = "update tbl_employee set ProfileImage='$pro_pic_name' where Memberid='$memberid'";
					$dbconn->SetQuery($upd_query);
				
				}
			
			}
			
	
		}//UploadImages
		
		/*************************************************************************************
		// this function will upload User Favorite Photos
		/*************************************************************************************/	
		public function UploadFavPhoto($memberid) {
			//this variable is defined in
			global $config;
		
			$dbconn=db::singleton();	
			
			
			if($_FILES['profileimg']['size']>0) {
				
				$query = "insert into tbl_employee_favphoto (Memberid,LastUpdated,Status) values('$memberid',now(),'A')";
				$dbconn->SetQuery($query);
				$pid=$dbconn->GetLastID();
							
				$pro_pic_path = "../..".$config["userfav_image_path"];				
				$code = Attachment::UploadFile("profileimg",$pro_pic_path,$pid);
				$pro_pic_name = Attachment::$file_name;
				
				/**	UploadFile may return following code		
				1 = There is no attachment or error in file 
				2 = If extension is not valid
				3 = If file uploaded successfull
				4 = Error while uploading. It may be due to wrong path in Config File or folder permission.
				
				**/		
							
				if($code == "3") {			
					$upd_query = "update tbl_employee_favphoto set ImagePath='$pro_pic_name' where PID='$pid'";
					$dbconn->SetQuery($upd_query);
				
				}
			
			}
			
	
		}//UploadImages
		
		
	/*************************************************************************************
		// this function will Update the status of Employee
		/*************************************************************************************/
		
		public function ChangeStatus() {
		
			$dbconn=db::singleton();
				
				$chk_value=0;
				extract($_REQUEST);			
				
				$chk_val = substr($chk_value,0,strlen($chk_value)-1);
				$arr = explode(",",$chk_val);
				
				for($i=0;$i<count($arr);$i++) {
				
					if($chk_value!=0){
						$empid = $arr[$i];
					}else{
					  //otherwise from query string	
					}
				
					$query="update tbl_employee set emp_status='$status',updated_on=now() where emp_id='$empid'";
					print($query); exit;
					$dbconn->SetQuery($query);;	
				}
				
				return true;					
			
	
		}//Block
		
		/*************************************************************************************
		// this function will Delete Selected categories
		/*************************************************************************************/
		
		public function Delete() {
	
			global $config;
			
			$dbconn=db::singleton();
			extract($_REQUEST);
			
			$chk_val = substr($chk_value,0,strlen($chk_value)-1);
			$arr = explode(",",$chk_val);
			
				for($i=0;$i<count($arr);$i++) {
				
					$empid = $arr[$i];
					
					$query1="select * from tbl_employee where emp_id='$empid'";
					$dbconn->SetQuery($query1);			
		
					$imgpath = $dbconn->LoadObject()->Image;
			
					//delete image from the physicle drive/ Root path			
					//unlink($config["site_home_path"].$config["category_image_path"].$imgpath);
					
					
					$query = "update tbl_employee set emp_status='D', updated_on=now() where emp_id='$empid'";
					$dbconn->SetQuery($query);
				
				}	
				
			header("Location: ../index.php?pagesize=$pagesize&pageno=$pageno");
			return;
			
	
		}//Delete
		
		
		public function Logout($indexpagepath) {
	
			session_destroy();
			header($indexpagepath);
			exit;
			
		}
		
		public function ChangePassword($emp_id,$old_pwd,$new_pwd) {
	
			$dbconn=db::singleton();
			
			$old_pwd = md5($old_pwd);
			$query = "SELECT * FROM tbl_employee WHERE emp_password='$old_pwd'
					  and emp_id='$emp_id'";
			$dbconn->SetQuery($query);
			
			if($dbconn->GetNumRows()) {
			
				$new_pwd = md5($new_pwd);
				$upt_query = "UPDATE tbl_employee SET emp_password = '$new_pwd' 
							  where emp_id='$emp_id'";
				$dbconn->SetQuery($upt_query);
				return true;
				
			} else {
				
				return false;
			}
			
		}//ChangePassword
	
	//FUCNTION to change user password
	
	public function ForgotPassword($user_name) {
		
		$dbconn=db::singleton();
		
		$query = "select * from tbl_employee where emp_username='$user_name' and emp_status='A'";
		$dbconn->SetQuery($query);
		
		if($dbconn->GetNumRows()) {
			
			//if($config["send_email_flag"]==true) {
			
				$rs = $dbconn->LoadObject();
				$pwd = $rs->pwd;
				$to = $config["from_email"];
				$from = $config["from_email"];
				$subject = $config["email_subject_for_user_forgot_pwd"];	
				$message = "Here is your Password:<b>".$pwd."</b>";
				
				Utility::SendMail($to,$from,$subject,$message,$cc='0',$bcc='0');
				
			//} 
			
			return true;
				
			} else {
				
				return false;
			}
				
		}
	
	
	
		
	} //constrain  class
?>