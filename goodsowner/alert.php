<?
	include("../classes/common.class.php"); 

	echo "asd";die;
	$current_date = time();
	$query="SELECT * FROM `tbl_bid` WHERE `status`='A'";

	$result  = "SELECT u.name
	 from `load_post` lp 
	INNER JOIN `user` u on lp.user_id=u.user_id 
	inner join tbl_bid b on lp.user_id=b.user_id where b.status = 'A' ";

	$job_date = mysql_query($result) or die(mysql_error());
	

	if($current_date == $job_date){

		//  execute jon
			Load::updateTruckNo($bid_id,$no_truck,$load_id,$lo_id,$amount);
		
			$title = "lorrynlorry";
			$body = "Job_is_arrived";

			// echo $body;die();
			header("location: notification.php?owner_id=$lo_id&title=".$title."&body=".$body."");


	}else{	

	$query  = "SELECT `bid_date_end`  from `load_post` WHERE `user_id`= 1 ";
	$result = mysql_query($query) or die(mysql_error());

		if($current_date <= $result){

		// Run notification
		echo "run notification...";	
		$title = "Reminder Notice";
		$body  =  "About this Job..";	

		$owner_token=GoodsOwner::CheckToken($id); 
		    
		    // print_r($owner_token);die
			
			$url = "https://fcm.googleapis.com/fcm/send";
		/*
		    $token = "flcrLlbk_5I:APA91bFOdb61O0UAUsXJY_ks0TXgfySPVhOG_-_67bYkdv6j-SHIx-wgLOZ6wy0PuduczAhFdGjDpCQ_XhcW3h-iM6O61xDBKSThHsbBiA5HsALhWiwPxofEzT-S75DbwxxJN2nVNTiz";
		*/
			$token=$owner_token->user_token;
		    $serverKey = 'AAAAWw4AfHI:APA91bF2ttOJ8rU-2K83bX5mVNX1hmPozrcS2G_u1A_ox10q7Bmp_QnLUVp5BBCBxhRzLbYxVHs2G1Nfkv39jOQd8f2JNz9gY52d3tGYeAH9Kc992kABMVEP9z_HZ1Tof55Laho9RWxn';
		/*
			$title = "Notification title";

		    $body = "Hello I am from Your php server";
		*/
			$notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
		    
			$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
		    
			$json = json_encode($arrayToSend);
		    
			$headers = array();
		    $headers[] = 'Content-Type: application/json';
		    $headers[] = 'Authorization: key='. $serverKey;
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
		    //Send the request
		    $response = curl_exec($ch);
		    //Close request
		    if ($response === FALSE) {
		    die('FCM Send Error: ' . curl_error($ch));
		    }
		    curl_close($ch);
			echo $response;
		}
 }

?>