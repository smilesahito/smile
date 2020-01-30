<?
	
	//print_r($_REQUEST); exit;
	include("../classes/common.class.php");
	//print_r($_REQUEST); exit;
	
	$user_name= array_key_exists("uname",$_REQUEST)?$_REQUEST["uname"]:0;
	$user_pwd= array_key_exists("pwd",$_REQUEST)?$_REQUEST["pwd"]:0;
/*	$old_pwd= array_key_exists("old_pwd",$_REQUEST)?$_REQUEST["old_pwd"]:0;
	$new_pwd= array_key_exists("new_pwd",$_REQUEST)?$_REQUEST["new_pwd"]:0;
*/	$action = array_key_exists("action",$_REQUEST)?$_REQUEST["action"]:0;
	
	// print($action); exit;
	$arr=Utility::ClearSqlInjection($_REQUEST);
	extract($arr);

	
	$obj = db::singleton();
	
	if(isset($_SESSION['sess_login']))
	
		$user_name = $_SESSION['sess_login'];
		$obj_login=new Admin();
	
	//switch
	
	switch($action) {
		case 1:
			//if($obj_login->is_login($user_name,$user_pwd)) {
			if(Admin::GetLogin()) {
				if($_SESSION['sess_admin_access_level']==1)
				{	
					header("Location: ../admin/index.php");
					exit;

				}
				elseif($_SESSION['sess_admin_access_level']==2)
				{	
					header("Location: ../goodsowner/index.php");
					exit;

				}
				elseif($_SESSION['sess_admin_access_level']==3)
				{	
					header("Location: ../lorryowner/index.php");
					exit;

				}
				elseif($_SESSION['sess_admin_access_level']==4)
				{	
					header("Location: ../driver/index.php");
					exit;

				}
				else
				{
					header("Location: ../index.php?action=22");
					exit;
				}
				
			}
			
		case 2:
		
				$indexpagepath="Location: ../";
				Admin::Logout($indexpagepath);
				exit;
			
		case 3:
		
			if(Admin::ChangePassword($user_name,$old_pwd,$new_pwd)){
			
				header("Location: ../dboard.php?action=11");
				exit;
				
			}else{
			
				header("Location:  ../change_pwd.php?action=10");
				exit;
			
			}
			
		case 4:
			list($uname,$pwd)=User::Add();
			header("Location: /controller/login_ctl.php?action=1&uname=".$uname."&pwd=".$pwd);
			exit;
				

		
	}
?>