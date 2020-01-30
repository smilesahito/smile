<?
	include("../classes/common.class.php"); 
	extract($_REQUEST);
    	//Call Function where you want to send Push Notification.
	// print_r( );die();

	$owner_token=GoodsOwner::CheckToken($owner_id); 
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

    // echo $body;die;

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
    header("location: ../goodsowner/bidding_list.php");
?>

