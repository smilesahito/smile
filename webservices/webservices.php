<?
include("../classes/common.class.php"); 
extract($_REQUEST);

//$param= unserialize(urldecode($_GET['param']));
	
switch($action)
{

	// case "login":

	// 	if(isset($uname) && isset($pwd))
	// 	{	


	// 		$user=array();
	// 		$user['status']=0;

	// 		if(Admin::GetLogin()) 
	// 		{
	// 			if(isset($_SESSION['sess_admin_access_level']) && $_SESSION['sess_admin_access_level']<>1)
	// 			{

	// 				$user['status']=1;
	// 				$user['info']['type']=$_SESSION['sess_admin_access_level'];

	// 				if(isset($_SESSION['sess_admin_id']))
	// 				{
	// 					$user['info']['id']=$_SESSION['sess_admin_id'];
	// 				}
	
	// 				if(isset($_SESSION['sess_admin_name']))
	// 				{
	// 					$user['info']['name']=$_SESSION['sess_admin_name'];
	// 				}
	// 				if($_SESSION['sess_admin_access_level'] == 4)
	// 				{
	// 				$truck = Driver::GetDriverTruck($_SESSION['sess_admin_id']); 

	// 					$user['info']['truck_type_id']=$truck->truck_type_id;
	// 					$user['info']['truck_company']=$truck->truck_company;
	// 					$user['info']['truck_model']=$truck->truck_model;
	// 					$user['info']['truck_capacity']=$truck->truck_capacity;
	// 					$user['info']['owner_id']=$truck->owner_id;
	// 					$user['info']['owner_name']=$truck->owner_name;

	// 				}
			
	// 				if($_SESSION['sess_admin_access_level']==2)
	// 				{
	// 					$truck = ''; 
	// 					$user['info']['truck_type_id']='NULL';
	// 					$user['info']['truck_company']='NULL';
	// 					$user['info']['truck_model']='NULL';
	// 					$user['info']['truck_capacity']='NULL';
	// 					$user['info']['owner_id']='NULL';
	// 					$user['info']['owner_name']='NULL';
	// 				}
	// 				if($_SESSION['sess_admin_access_level']==3)
	// 				{
	// 					$truck = ''; 
	// 					$user['info']['truck_type_id']='NULL';
	// 					$user['info']['truck_company']='NULL';
	// 					$user['info']['truck_model']='NULL';
	// 					$user['info']['truck_capacity']='NULL';
	// 					$user['info']['owner_id']='NULL';
	// 					$user['info']['owner_name']='NULL';
	// 				}
	// 			}
	// 		}

	
	// 		$login=json_encode($user);

	// 		echo $login;
	// 	}
	// break;

	case "login":

		if(isset($uname) && isset($pwd))
		{	
			$user=array();
			$user['status']=0;

			if(Admin::GetLogin()) 
			{
				if(isset($_SESSION['sess_admin_access_level']) && $_SESSION['sess_admin_access_level']<>1)
				{
					$user['status']=1;
					$user['info']['type']=$_SESSION['sess_admin_access_level'];

					if(isset($_SESSION['sess_admin_id']))
					{
						$user['info']['id']=$_SESSION['sess_admin_id'];
					}

					if(isset($_SESSION['sess_admin_name']))
					{
						$user['info']['name']=$_SESSION['sess_admin_name'];
					}
					if($_SESSION['sess_admin_access_level']==4)
					{
					$truck = Driver::GetDriverTruck($_SESSION['sess_admin_id']); 
						$user['info']['truck_type_id']=$truck->truck_type_id;
						$user['info']['truck_company']=$truck->truck_company;
						$user['info']['truck_model']=$truck->truck_model;
						$user['info']['truck_capacity']=$truck->truck_capacity;
					}
					if($_SESSION['sess_admin_access_level']==2)
					{
						$truck = ''; 
						$user['info']['truck_type_id']='NULL';
						$user['info']['truck_company']='NULL';
						$user['info']['truck_model']='NULL';
						$user['info']['truck_capacity']='NULL';
					}
					if($_SESSION['sess_admin_access_level']==3)
					{
						$truck = ''; 
						$user['info']['truck_type_id']='NULL';
						$user['info']['truck_company']='NULL';
						$user['info']['truck_model']='NULL';
						$user['info']['truck_capacity']='NULL';
					}
				}
			}
			// print_r("asdasdsad");
			$login=json_encode($user);

			echo $login;
		}
	break;
		
	case "getloadlist": //get all jobs for drivers as per truck_type
		
		if(isset($owner_id) && isset($status))
		{
			$posted_loads = Load::GetLoadList($owner_id,$status); 
		}
		else if(isset($truck_type) && isset($status))
		{

			$posted_loads = Load::GetLoadList('',$status,$truck_type); 
		

		}

		if($posted_loads) 
		{	$a=0;
			foreach($posted_loads as $row)
			{	
				$json[$a]=$row;
				
				$load_details=Load::GetLoadDetails($row->load_id,$status);
				$i=0;
				foreach($load_details as $row1)
				{
					
					$json[$a]->load_detail[]=$row1;
					$i++;
				}


				$pickup_details=Load::GetSerPickupDetails($row->load_id,$status);
				
				$j=0;
				foreach($pickup_details as $row2)
				{
					
					$json[$a]->pickup_detail[]=$row2;
					$j++;
				}
				$a++;
			}
			
			

			$posts=json_encode($json);
			
			
			echo $posts;
		}
	break;
		
	case "jobfinish":
		
		// update driver and truck status after job finish 

		$loadlose=array();

		if(isset($deail_id) && isset($weight) && isset($driver_id))
		{	

			$lose_package=0;
			$lose_amount=0;
			$item_weight=0;
			$lose_weight=0;
			$total_weight=0;
			$invoice=array();
			$invoice['status']=0;
			$detail=Load::_GetLoadDetailById($deail_id,$driver_id);
			
			
			
			
			if($detail->package_type == "CASES" || $detail->package_type == "CARTONS" || $detail->package_type == "BOXES" || $detail->package_type == "BOX" || $detail->package_type == "BUNDLES" || $detail->package_type == "BASKETS" || $detail->package_type == "CARDBOARD" ||$detail->package_type == "BLOCKS"||$detail->package_type == "BILLETS")
			{

				if(empty($detail->no_of_packages)){
					
					$invoice['status']=1;
					$invoice['info']['msg']="empty_package";
					$invoice['info']['goods_type']=null;
					$invoice['info']['brand_name']=null;
					$invoice['info']['package_type']=null;
					$invoice['info']['price_per']=null;				
					$invoice['info']['weight_per_package']=null;
					$invoice['info']['truck_lose_weight']=null;
					$invoice['info']['total_weight']=null;
					$invoice['info']['no_of_packages']=null;
					$invoice['info']['return_weight']=null;
					$invoice['info']['remaining_weight']=null;
					$invoice['info']['lose']=null;

				}else {

				
				if($detail->no_of_packages >= $weight)
				{	
					$lose_package= $detail->no_of_packages - $weight;	
					$total_weight = $detail->truck_weight - $weight;
					$truck=Truck::GetTruckType($detail->truck_type_id);	
					// $lose_amount= $lose_package * $detail->target_price;
					$invoice['status']=1;
					$invoice['info']['msg']="under_package";
					$invoice['info']['goods_type']=$detail->goods_type;
					$invoice['info']['brand_name']=$detail->brand_name;
					$invoice['info']['package_type']=$detail->package_type;
					$invoice['info']['price_per']=$detail->target_price;				
					$invoice['info']['weight_per_package']=$detail->weight;
					$invoice['info']['truck_lose_weight']=$truck->truck_lose_weight;;
					$invoice['info']['total_weight']=$tare_weight;
					$invoice['info']['no_of_packages']=$detail->no_of_packages;
					$invoice['info']['return_weight']=$weight;
					$invoice['info']['remaining_weight']=$total_weight;
					$invoice['info']['lose']=$lose_package;
					
					// $invoice['info']['lose_amount']=$lose_amount;
					$load_invoice=json_encode($invoice);
					echo $load_invoice;
				}
				else
				{
					$lose_package= 0;
					$total_weight = $detail->truck_weight - $weight;	
					$truck=Truck::GetTruckType($detail->truck_type_id);	
					$invoice['status']=1;
					$invoice['info']['msg']="Exceed_package";
					$invoice['info']['goods_type']=$detail->goods_type;
					$invoice['info']['brand_name']=$detail->brand_name;
					$invoice['info']['package_type']=$detail->package_type;
					$invoice['info']['price_per']=$detail->target_price;				
					$invoice['info']['weight_per_package']=$detail->weight;
					$invoice['info']['truck_lose_weight']=$truck->truck_lose_weight;
					$invoice['info']['total_weight']=$detail->truck_weight;
					$invoice['info']['no_of_packages']=$detail->no_of_packages;
					$invoice['info']['return_weight']=$weight;
					$invoice['info']['remaining_weight']=$total_weight;
					$invoice['info']['lose']=$lose_package;
		
					$load_invoice=json_encode($invoice);
					echo $load_invoice;
				}

				 	Load::InsertInvoiceById($detail->user_id,$detail->accept_by,$detail->pickup_id,$detail->job_id,$detail->driver_id,$detail->load_detail_id,$detail->load_id,$detail->truck_type_id,$detail->img_id,$detail->truck_weight,$weight);
			 
			}

			  		
			}else if($detail->package_type == "BAG" || $detail->package_type == "BAGS" || $detail->package_type == "BALES" || $detail->package_type == "BARRELS" || $detail->package_type == "BORAS" || $detail->package_type == "BOTTLES" || $detail->package_type == "BULK" ||$detail->package_type == "CANS"||$detail->package_type == "CASES" ||$detail->package_type == "CASK" ||$detail->package_type == "CONTAINER"||$detail->package_type == "CONTAINERS"||$detail->package_type == "COLLIES"||$detail->package_type == "Loose Cargo")
			{


					$tare_weight= $detail->truck_weight;
					$Curent_Truck_weight=$weight;			
					$total_weight = $tare_weight - $Curent_Truck_weight;
					$truck=Truck::GetTruckType($detail->truck_type_id);
			 		
			 		if(empty($tare_weight)){

					    $invoice['status']=1;
						$invoice['info']['msg']="empty_weight";
						$invoice['info']['goods_type']=null;
						$invoice['info']['brand_name']=null;
						$invoice['info']['package_type']=null;
						$invoice['info']['price_per']=null;
						$invoice['info']['weight_per_package']=null;
						$invoice['info']['truck_lose_weight']=null;
						$invoice['info']['total_weight']=null;
						$invoice['info']['no_of_packages']=null;
						$invoice['info']['return_weight']=null;
						$invoice['info']['remaining_weight']=null;
						$invoice['info']['lose']=null;
						// $invoice['info']['lose_amount']=$lose_amount;
						// $invoice['info']['total_amount']=$detail->total_price;
						// $invoice['info']['payable_amount']=$payable_amount;
						$load_invoice=json_encode($invoice);
						echo $load_invoice;
				}else {

				
			 		if($total_weight >= $truck->truck_lose_weight)
					{	
					
						$lose_weight=$total_weight - $truck->truck_lose_weight;	
						// $lose_amount=$lose_weight * $detail->target_price;	
						// $payable_amount = $detail->total_price - $lose_amount;				
						$invoice['status']=1;
						$invoice['info']['msg']="under_weight";
						$invoice['info']['goods_type']=$detail->goods_type;
						$invoice['info']['brand_name']=$detail->brand_name;
						$invoice['info']['package_type']=$detail->package_type;
						$invoice['info']['price_per']=$detail->target_price;
						$invoice['info']['weight_per_package']=$detail->weight;
						$invoice['info']['truck_lose_weight']=$truck->truck_lose_weight;
						$invoice['info']['total_weight']=$tare_weight;
						$invoice['info']['no_of_packages']=$detail->no_of_packages;
						$invoice['info']['return_weight']=$weight;
						$invoice['info']['remaining_weight']=$total_weight;
						$invoice['info']['lose']=$lose_weight;
						// $invoice['info']['lose_amount']=$lose_amount;
						// $invoice['info']['total_amount']=$detail->total_price;
						// $invoice['info']['payable_amount']=$payable_amount;
						$load_invoice=json_encode($invoice);
						echo $load_invoice;
					

					}
					else
					{	

						$payable_amount = $detail->total_price ;
						$invoice['status']=1;
						$invoice['info']['msg']="Exceed_weight";
						$invoice['info']['goods_type']=$detail->goods_type;
						$invoice['info']['brand_name']=$detail->brand_name;
						$invoice['info']['package_type']=$detail->package_type;
						$invoice['info']['weight_per_package']=$detail->target_price;
						$invoice['info']['price_per']=$detail->weight;
						$invoice['info']['truck_lose_weight']=$truck->truck_lose_weight;
						$invoice['info']['total_weight']=$detail->truck_weight;
						$invoice['info']['no_of_packages']=$detail->no_of_packages;		
						$invoice['info']['return_weight']=$weight;		
						$invoice['info']['remaining_weight']=$total_weight;					
						$invoice['info']['lose']=$lose_weight;						
						// $invoice['info']['lose_amount']=$lose_amount;
						// $invoice['info']['total_amount']=$detail->total_price;
						// $invoice['info']['payable_amount']=$payable_amount;
						$load_invoice=json_encode($invoice);
						echo $load_invoice;

					}
						Load::InsertInvoiceById($detail->user_id,$detail->accept_by,$detail->pickup_id,$detail->job_id,$detail->driver_id,$detail->load_detail_id,$detail->load_id,$detail->truck_type_id,$detail->img_id,$detail->truck_weight,$weight);

				}	
		   
			}	else {

						// $payable_amount = null;
						$invoice['status']=1;
						$invoice['info']['msg']="data_not_found";
						$invoice['info']['goods_type']=$detail->goods_type;
						$invoice['info']['brand_name']=$detail->brand_name;
						$invoice['info']['package_type']=$detail->package_type;
						$invoice['info']['weight_per_package']=$detail->target_price;
						$invoice['info']['price_per']=$detail->weight;
						$invoice['info']['truck_lose_weight']=$truck->truck_lose_weight;
						$invoice['info']['total_weight']=$detail->truck_weight;
						$invoice['info']['no_of_packages']=null;		
						$invoice['info']['return_weight']=null;		
						$invoice['info']['remaining_weight']=null;					
						$invoice['info']['lose']=null;						
						// $invoice['info']['lose_amount']=$lose_amount;
						// $invoice['info']['total_amount']=$detail->total_price;
						// $invoice['info']['payable_amount']=$payable_amount;
						$load_invoice=json_encode($invoice);
						echo $load_invoice;
	
			}
	
		}
	

	break;

	case "acceptload":
		
		
		$loadpost=array();
		$loadpost['status']=0;

		$accept_load=GoodsOwner::AcceptLoad($user_id,$load_id); 

		
		//check if session is set if not 
		if (isset($_SESSION["load_id"])) {
			
			//if session is set and value is present then compare its value 
			$chek_id =$_SESSION["load_id"];
			
			if ($chek_id!=$load_id) {
				$loadpost['status']=$accept_load;
				
				$_SESSION["load_id"]=$load_id;

			}else{
				$loadpost['status']=3;
			}



		}else{

			 $loadpost['status']=$accept_load;
			 $_SESSION["load_id"] = $load_id;
		}

		
		

		$loadpost_status=json_encode($loadpost);

		echo $loadpost_status;

	break;

	case "security_code":
		
		$securitycode=array();
		$securitycode['status']=0;

		$code=GoodsOwner::SecurityCodeCheck($load_id,$security_code); 
		if($code!="")
		{
			$securitycode['status']=1;
			
		}
		
		$securitycode_status=json_encode($securitycode);

		echo $securitycode_status;

	break;

	case "acceptedload":

		if(isset($user_id))
		{
		  $loads = GoodsOwner::GetAcceptedLoad($user_id);
		}
		else if(isset($owner_id))
		{
		  $loads = GoodsOwner::GetAcceptedLoad("",$owner_id);
		}
		
		if($loads) 
		{
			foreach($loads as $row)
			{
				$json[]=$row;
			}
			
			$posts=json_encode($json);
			echo $posts;
		}
	break;
		
	case "load":

		if(isset($user_id) && isset($status))
		{
		  $loads = Load::GetLoad($user_id,"",$status);
		}
		else if(isset($owner_id) && isset($status))
		{
		  $loads = Load::GetLoad("",$owner_id,$status);
		}
		
		if($loads) 
		{
			foreach($loads as $row)
			{
				$json[]=$row;
			}
			
			$posts=json_encode($json);
			echo $posts;
		}
	break;	
		
	case "ownerload":


		  $loads = GoodsOwner::GetOwnerLoad($owner_id);
		
		if($loads) 
		{
			foreach($loads as $row)
			{
				$json[]=$row;
			}
			
			$posts=json_encode($json);
			echo $posts;
		}
	break;		
		
	case "addpickup":

	// print_r($_REQUEST);die;	
	  Load::AddLoadPickup($load_id,$driver_id,$job_id,$latitude,$longitude,$status);
	  
	  
	break;
		
	case "getpickup":

	 $load=Load::GetLoadPickup($load_id);
		if($load) 
		{
				$json=(array) $load;
			
			$maxpicpoint=json_encode($json);
			echo $maxpicpoint;
		}
	break;
		
	case "addmsg":

	  Load::AddLoadMsg($load_id,$text);
	break;
		
	case "getmsg":

	 $load=Load::GetLoadMsg($load_id);
		if($load) 
		{
			foreach($load as $row)
			{
				$json[]=$row;
			}
			
			$msg=json_encode($json);
			echo $msg;
		}
	break;
		
	case "server_key":
		
		$serverkey=array();
		$serverkey['goodsowner']=$goodsowner;
		$serverkey['driver']=$driver;
		$serverkey['token']=$token;
		$serverkey['server_key']=$config["server_key"];
			
		
		$serverkey_detail=json_encode($serverkey);

		echo $serverkey_detail;

	break;

		
	case "addtoken":
		
		$loadpost['status']=0;

		$add_token=GoodsOwner::AddToken($owner_id,$token); 
		
		if($add_token==1)
		{
			$add_token['status']=1;
		}
		
		$token_status=json_encode($add_token);

		echo $token_status;

	break;
		
	case "pushnotification":
		
		header("location: pushnotification.php?owner_id=$owner_id&title='".$title."'&body='".$body."'");
	break;

	case 'uplaodimg':
		
		$response = array();
 
		$server_ip = gethostbyname(gethostname());
		 
		$file_upload_url = 'http://' . $server_ip . '/' . 'lorrynlorry/images/invoice_img';
		 
		echo $file_upload_url;die();

		if (isset($_FILES['image']['name'])) {
		    $target_path = $target_path . basename($_FILES['image']['name']);
		 
		    $email = isset($_POST['email']) ? $_POST['email'] : '';
		    $website = isset($_POST['website']) ? $_POST['website'] : '';
		 
		    $response['file_name'] = basename($_FILES['image']['name']);
		    $response['email'] = $email;
		    $response['website'] = $website;
		 
		    try {
		        // Throws exception incase file is not being moved
		        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
		            // make error flag true
		            $response['error'] = true;
		            $response['message'] = 'Could not move the file!';
		        }
		 
		        // File successfully uploaded
		        $response['message'] = 'File uploaded successfully!';
		        $response['error'] = false;
		        $response['file_path'] = $file_upload_url . basename($_FILES['image']['name']);
		    } catch (Exception $e) {
		        // Exception occurred. Make error flag true
		        $response['error'] = true;
		        $response['message'] = $e->getMessage();
		    }
		} else {
		    // File parameter is missing
		    $response['error'] = true;
		    $response['message'] = 'Not received any file!F';
		}
		 
		// Echo final json response to client
		echo json_encode($response);	



		break;
		case 'acceptbid':
			
			//print_r($_REQUEST); die;
			Load::updateTruckNo($bid_id,$no_truck,$load_id,$lo_id,$amount);

			$title = "lorrynlorry";
			$body = "bid";

			// echo $body;die();
			header("location: notification.php?owner_id=$lo_id&title=".$title."&body=".$body."");

			break;

		case 'getDriverJob':
			if(isset($driver_id) && isset($status))
			{
				$posted_loads = LorryOwner::GetDriverJobList($driver_id,$status); 
				
			}
			
			if($posted_loads) 
			{	$a=0;
				foreach($posted_loads as $row)
				{	
					$json[$a]=$row;
					
					$load_details=Load::GetLoadDetails($row->load_id,$status);
					$i=0;
					foreach($load_details as $row1)
					{
						
						$json[$a]->load_detail[]=$row1;
						$i++;
					}

					$pickup_details=Load::GetSerPickupDetails($row->load_id,$status);
					
					$j=0;
					foreach($pickup_details as $row2)
					{
						
						$json[$a]->pickup_detail[]=$row2;
						$j++;
					}

					$container_details=Load::fetchContainerLoc($row->load_id);
					$k=0;
					foreach($container_details as $row3)
					{
						
						$json[$a]->container_detail[]=$row3;
						$k++;
					}
					$a++;
				}

				$posts=json_encode($json);
				
				
				echo $posts;
			}
		break;	
		case 'driverJobAcc':
				
				if(isset($job_id))
				{
					
					LorryOwner::GetDriverAccJobList($job_id); 
					
				}	


			break;

			case 'revertbid':
					
					LorryOwner::revertBid($bid_id,$lo_id); 

					
					$title = "alert";
					$body = $body ;

					header("location: revert_notification.php?owner_id=$lo_id&title=".$title."&body=".$body."");



				break;


			case 'jobCompleted':
			if(isset($driver_id) && isset($truck_id))
			{
				
				LorryOwner::UpdateDriverTruck($driver_id,$truck_id); 
				
			}
			
		break;	
		case 'loryyOwnerDriver':
				
			if(isset($owner_id))
			{
				
				$active_driver = LorryOwner::GetLorryOwnerActiveDriver($owner_id); 
				$posts=json_encode($active_driver);
				echo $posts;

			}

			break;
			// http://localhost/webservices/webservices.php?action=loryyOwnerDriver&owner_id=2

		case 'inprocess':
				
			if(isset($owner_id))
			{
				
				$active_driver = Load::inProcessJobs($owner_id); 
				$posts=json_encode($active_driver);
				echo $posts;

			}

			break;	
			// http://localhost/webservices/webservices.php?action=inprocess&owner_id=1

			case 'complete':
				
			if(isset($owner_id))
			{
				
				$active_driver = Load::completeJobs($owner_id); 
				$posts=json_encode($active_driver);
				echo $posts;

			}
			break;
			// http://localhost/webservices/webservices.php?action=complete&owner_id=1
			case 'complain':
				
			if(isset($owner_id))
			{
				
				$active_driver = Load::fetchComplain($owner_id); 
				$posts=json_encode($active_driver);
				echo $posts;

			}
			break;

			case 'insert_issue':
				
		if(isset($load_id,$job_id,$owner_id,$user_id,$complain_name,$lat,$lng,$status))
		{
				
				$issue = Load::insert_issue($load_id,$job_id,$owner_id,$user_id,$complain_name,$lat,$lng,$status); 
				
				$user['info']['status']=$issue;
				$posts=json_encode($user);
				echo $posts;

			}

			break;

			case 'LO_tracks_drivers':
					
				if(isset($owner_id))
				{
				$current_cordinate = LorryOwner::fetch_Drivers_Cordinate_Lo($owner_id); 
				$posts=json_encode($current_cordinate);
				echo $posts;
				}	
			break;

			case 'GO_live_tracking':
					
				if(isset($owner_id))
				{
				$current_cordinate = Load::fetch_Drivers_Cordinate_GO($owner_id); 
				$posts=json_encode($current_cordinate);
				echo $posts;
				}	
			break;	

			case 'LO_fetch_complain':
					
				if(isset($owner_id))
				{
				$complain_data = LorryOwner::fetch_complain_Lo($owner_id); 
				
				foreach($complain_data as $row)
				{

					foreach ($row->complains_details as $row1) {
					
				$user['info']['complain_id']=$row1->complain_id;
				$user['info']['load_id']=$row1->load_id;
				$user['info']['job_id']=$row1->job_id;
				$user['info']['owner_id']=$row1->owner_id;
				$user['info']['user_id']=$row1->user_id;
				$user['info']['complain_name']=$row1->complain_name;
				$user['info']['start_time']=$row1->start_time;
				$user['info']['start_date']=$row1->start_date;
				$user['info']['complete_time']=$row1->complete_time;
				$user['info']['complete_date']=$row1->complete_date;
				$user['info']['lat']=$row1->lat;
				$user['info']['lng']=$row1->lng;
				$user['info']['status_com']=$row1->status_com;
				$user['info']['seen']=$row1->seen;
				$user['info']['contact_no']=$row1->contact_no;
				$user['info']['name']=$row1->name;
				}	

				}
				$posts=json_encode($user);
				echo $posts;
					// print_r($row);die;
				}	
			break;


			case 'codintes':
					
				if(isset($load_id))
				{
				$current_cordinate = LorryOwner::fetch_cordinate($owner_id); 
				$posts=json_encode($current_cordinate);
				echo $posts;
				}	
			break;	

			case 'truck_weight':
				
				if(isset($load_id,$detail_id,$job_id,$driver_id,$truck_weight))
				{

					$_weight = Load::_imgDescUpdate_($load_id,$detail_id,$job_id,$driver_id,$truck_weight);

					if($_weight == "successfully_insert"){
						
						$user['info']['msg']=$_weight;						
						$posts=json_encode($user);
						echo $posts;
					} else {

						$user['info']['msg']=$_weight;						
						$posts=json_encode($user);
						echo $posts;
					}
					
				}
			break;
}


?>



