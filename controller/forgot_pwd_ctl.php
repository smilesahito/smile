<?
	include("../../classes/classes.php");
	
	$email="";
	
	extract($_REQUEST);
	$obj = db::singleton();
	
	
	if(Admin::ForgotPassword($email)) {
		
		print("../forgotpwd.php?action=2");
		exit;
	
	} else {
	
		header("Location:../forgotpwd.php?action=1");
		exit;
	
	}

?>

