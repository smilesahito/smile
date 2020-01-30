<?

	include("../../classes/common.class.php"); 
	include("../../classes/coupons.class.php"); 
	
	if(!isset($_SESSION['sess_uid'])) {
		header("Location: ../index.php");
		//print("Not Set");
		exit;
	}

	extract($_REQUEST);
	
	$obj_coupons=new Coupons();
	print($obj_coupons->GenerateCode());			
	
	
	?>