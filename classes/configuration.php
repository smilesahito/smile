	<?php
		
		error_reporting(0);
		ini_set('display_errors', 0); 

	//**********************************************
	//		Define constant variables
	/************************************************/

	
	//**********************************************
	//		Configure Database
	/************************************************/
	

/*	$config["server"] = "localhost";

	$config["username"] = "xolva_lorry";

	$config["password"] = "h@,Zj4p77G?R";

	$config["catelog"] = "xolva_lorrynlorry";
*/
	date_default_timezone_set('Asia/Karachi');
	$config["server"] = "localhost";

	$config["username"] = "root";

	$config["password"] = "";

	$config["catelog"] = "lorrynlorry";

	
	//**********************************************
	//		Server Key for Android Notification
	/************************************************/  	

	$config["server_key"] = "AAAAWw4AfHI:APA91bF2ttOJ8rU-2K83bX5mVNX1hmPozrcS2G_u1A_ox10q7Bmp_QnLUVp5BBCBxhRzLbYxVHs2G1Nfkv39jOQd8f2JNz9gY52d3tGYeAH9Kc992kABMVEP9z_HZ1Tof55Laho9RWxn";

	//**********************************************
	//		Configure Path of Admin panel
	/************************************************/  	
	$config["admin_path"] = "/admin";
	
	$config["root_path"] = "E:/wamp/www/lorry/uploads/goodsowner_Cro/";
	
	//**********************************************
	//		Configure Path of Site Root. if there is directory on root then please add / at end. for example /v1/
	/************************************************/  	
	$config["site_root_path"] = "E:/wamp/www/lorry";
	//$config["site_root_path"] = "/home/xolva/public_html/rhm/";
	
	//**********************************************
	//		Configure Path of Site home.
	/************************************************/  	
	$config["site_home_path"] = "e:/project/";

	//**********************************************
		//		Configure Site URL
	/************************************************/
	$config["site_url"] = "http://lorry.localhost.com/";

	//**********************************************
	//		Configure Path of Site Root. if there is directory on root then please add / at end. for example /v1/
	/************************************************/  	
	$config["pagesize"] = "8";


//	$config["books-image_path"] = "e:/projects/school/uploads/books/";
//	$config["accessories-image_path"] = "e:/projects/school/uploads/accessories/";
	$config["license_path"] = "uploads/license/";
	$config["rc_path"] = "uploads/truck_rc/";
	$config["documents_path"] = "uploads/truck_documents/";


	
	//**********************************************
	//		Configure Email
	/************************************************/
	$config["from_email"] = "azhar@benthamscience.net";	
	
	
	// if you dont want send an email to user then set flag to false otherwise set it to true.
	$config["send_email_flag"] = true;
	
	
	$config["user_cv_path"] = "E:/projects/EBM/cv/";
	//$config["user_cv_path"] = "/home/itspk/public_html/ebm_cv/";
	
	$config["image_extension"] = array(".jpg",".jpeg",".gif",".png");
	
	
	//**********************************************
	//		Configure url Rewrite file extension
	/************************************************/
	$config['extension'] =".html";
	
	
	//**********************************************************
	//		Adding +5 in GMT (for pakistan standard time)
	/**********************************************************/
	$offset=5*60*60; //converting 5 hours to seconds.
    $dateFormat="Y-m-d H:i";
	$config['GMT'] = gmdate($dateFormat, time()+$offset);
	
	//**********************************************
	//		Configure Insurance Rate (17 Percentage)
	/************************************************/
	$config['insurance_rate'] =".17";
	$config['insurance_email'] = "ismail@xolva.com";
	
?>