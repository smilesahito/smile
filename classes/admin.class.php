<?
class Admin
{

	private static $login_obj;
	
	
	/*****************************************************************************************************
	* This function will login to registerd user
	/*****************************************************************************************************/
	public static function GetLogin() {
	
		//singleton function returning database object to local variable $dbconn
		$dbconn=db::singleton();
		//
		extract(Utility::ClearSqlInjection($_REQUEST));
		
		$password=sha1($pwd);
		
		$query ="SELECT * FROM admin WHERE admin_login='$uname'
				 AND admin_password='$password'";
		$dbconn->SetQuery($query);
		//print($query); exit;
		if($dbconn->GetNumRows()) {
			
			Admin::$login_obj = $dbconn->LoadObject();
			
			Admin::SetUserSession(1);
			
			return true;
			
		} else {
		
				$query ="SELECT * FROM user WHERE login_id='$uname'
						 AND login_pass='$password'";
				$dbconn->SetQuery($query);
				//print($query); exit;
				if($dbconn->GetNumRows()) {

					Admin::$login_obj = $dbconn->LoadObject();

					Admin::SetUserSession(Admin::$login_obj->user_type);

					return true;

				} else {

					return false;

				}
			
		}
		
	} //getlogin
	
	
	//FUNCTION to logout user
	
	public static function Logout($indexpagepath) {
	
		session_destroy();
		header($indexpagepath);
		exit;
			
	}
	
	//FUCNTION to change user password
	
	public static function ChangePassword($user_name,$old_pwd,$new_pwd) {
	
		$dbconn=db::singleton();
		
		$old_pwd = md5($old_pwd);
		$query = "SELECT * FROM admin_info WHERE pwd='$old_pwd'
				  and email='$user_name'";
		$dbconn->SetQuery($query);
		
		if($dbconn->GetNumRows()) {
		
			$new_pwd = md5($new_pwd);
			$upt_query = "UPDATE admin_info SET pwd = '$new_pwd' 
						  where email='$user_name'";
			$dbconn->SetQuery($upt_query);
			return true;
			
		} else {
			
			return false;
		}
			
	}//ChangePassword
	
	//FUCNTION to change user password
	
	public function ForgotPassword($user_name) {
	
		$query = "select * from admin_info where email='$user_name' and Status='A'";
		$dbconn->SetQuery($query);
		
		if($dbconn->GetNumRows()) {
			
			if($config["send_email_flag"]==true) {
				$rs = $dbconn->LoadObject();
				$pwd = $rs->pwd;
				$to = $config["from_email"];
				$from = $config["from_email"];
				$subject = $config["email_subject_for_user_forgot_pwd"];	
				$message = "Here is your Password:<b>".$pwd."</b>";
				
				Utility::SendMail($to,$from,$subject,$message,$cc='0',$bcc='0');
				
			} 
			
			return true;
			
		} else {
			
			return false;
		}
			
	}
	
	
	/************************************************************************************************
			Set Login User Session
		/************************************************************************************************/
		public static function SetUserSession($access) { 
			$dbconn=db::singleton();
			/*$query ="SELECT r.role_name FROM user_role ur
			inner join role r on ur.role_id = r.role_id
			inner join user u on u.user_id = ur.user_id	
			 WHERE u.user_id=".Admin::$login_obj->user_id;
			$dbconn->SetQuery($query);
			if($dbconn->GetNumRows())
			{	$role = array();
				$role = $dbconn->LoadObjectList();
				foreach($role as $user_role) {
				   $_SESSION['sess_role'][] =  $user_role->role_name;
				}
			}*/
			if($access==1)
			{
				$_SESSION['sess_admin_id'] = Admin::$login_obj->admin_id;
				$_SESSION['sess_admin_name'] = Admin::$login_obj->admin_name;
				$_SESSION['sess_admin_access_level'] = Admin::$login_obj->access_level;
				$_SESSION['sess_admin_status'] = Admin::$login_obj->admin_status;
			}
			elseif($access=='GO')
			{
				$_SESSION['sess_admin_id'] = Admin::$login_obj->user_id;
				$_SESSION['sess_admin_name'] = Admin::$login_obj->name;
				$_SESSION['sess_admin_access_level'] = 2;
				$_SESSION['sess_admin_status'] = Admin::$login_obj->user_status;
			}
			elseif($access=='LO')
			{
				$_SESSION['sess_admin_id'] = Admin::$login_obj->user_id;
				$_SESSION['sess_admin_name'] = Admin::$login_obj->name;
				$_SESSION['sess_admin_access_level'] = 3;
				$_SESSION['sess_admin_status'] = Admin::$login_obj->user_status;

			}
			elseif($access=='D')
			{
				$_SESSION['sess_admin_id'] = Admin::$login_obj->user_id;
				$_SESSION['sess_admin_name'] = Admin::$login_obj->name;
				$_SESSION['sess_admin_access_level'] = 4;
				$_SESSION['sess_admin_status'] = Admin::$login_obj->user_status;

			}
	
		} //IsVerified
		
		/************************************************************************************************
			checking wheather user session is set or not. if it is set then it means user is logged in 
			otherwise he is not logged in
		/************************************************************************************************/
		public static function IsUserLoggedIn() {
			
			if(!isset($_SESSION['sess_admin_id']) && !isset($_SESSION['sess_admin_name']) && !isset($_SESSION['sess_admin_access_level']) ) {
			
				return false;
				
			} else {
				
				return true;
			
			}
		
		}
		

		public static function GetSessionAdminId() { return @$_SESSION['sess_admin_id'];  } //
		public static function GetSessionAdminName() { return ucwords($_SESSION['sess_admin_name']);  } //
		public static function GetSessionAdminAccessLevel() { return $_SESSION['sess_admin_access_level'];  } //
		public static function GetSessionAdminStatus() { return $_SESSION['sess_admin_status'];  } //
	
	
	
}//admin
?>