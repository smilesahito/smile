<? 
	include("../../classes/common.class.php");
	extract($_REQUEST);
	
	switch($command){

		case "addload":
			
			$load_id = Load::AddLoadPost(); 
		
			if(isset($load_id) && $load_id != "")
				
				header("Location: ../add_load.php?param=".base64_encode($load_id)."&info=basic_info");
			
			break;

		
		case "addContainer_pickpoint":
		
		   $con_latid= Load::addContainerLocation($load_id); 
		   
			// print_r($load_id);die;
			// if(isset($lastCon_id) && $lastCon_id != "")
			header("Location: ../add_load.php?param=".base64_encode($load_id)."&info=basic_info");

			break;		



			
		case "addloaddetail":
			
		
			$load_id=Load::AddLoadDetail(); 

			header("Location: ../add_load.php?param=".base64_encode($load_id)."&info=pickup_info");
			
			break;
		case "addpickpoint":
			
			$load_id = Load::AddpickPoint(); 
			
			header("Location: ../add_load.php?param=".base64_encode($load_id)."&info=drop_info");

			break;

		case "adddesigpoint":
		
			$laod_id = Load::AddDesigPoint(); 
			header("Location: ../add_load.php?param=".base64_encode($load_id)."");

			break;	

		case "delloaddetail":
		
			Load::DeleteLoadDetail(); 
			header("Location: ../add_load_detail.php?param=".base64_encode($load_id)."");

			break;

		case "imageDes":
				
				
			Load::imgDescUpdate($description,$img_id_,$truck_Weight);

				header("Location: ../jobin_process.php");

				break;

			case "truckCurrent_weight":
				// echo "string";die();
				// echo "string";
			  	// print_r($_GET[$truck_Weight]);die;
				Load::AddTruckWeight();				
				

				header("Location: ../accepted_post.php");

				break;			
		
				case 'add_insu':
					
					$load_id=Load::AddInsurance(); 

			header("Location: ../add_load.php?param=".base64_encode($load_id)."");
					
				break;

			case "fetchCapacity":
			
			// print_r($truck_type);die;
			$truck = Load::fectCapacity($truck_type); 
			if(!empty($truck)){
				// print_r($truck);die;
				echo '<option value="" hidden="true">----Select Capacity---</option>';
				foreach ($truck as $row) {
					echo '<option value="'.$row->truck_type_id.'" >'.$row->truck_capacity.'</option>';	
				}
			}else{
				echo '<option style="color: red" value="" hidden="true">-----No Capacity Found-----</option>';
			}	


			break;


			case "driverCordinate":

			$drivers_data = Load::get_lat_lng($owner_id);
		
			echo json_encode($drivers_data);
			
			break;
	 		
	 		case 'delpickpoint':

	 			$load_id = Load::disable_PickUp();
	 			header("Location: ../add_load.php?param=".base64_encode($load_id)."");	
	 		break;

	 		case 'update_doc':

	 			$load_id=Load::Update_Documnt(); 
			// echo $load_id;die();
			if(isset($load_id) && $load_id != "")
				
				header("Location: ../accepted_post.php?");

	 		break;	


	 		case 'upload_doc_inprocess':

	 			$load_id=Load::Update_Documnt(); 
			// echo $load_id;die();
			if(isset($load_id) && $load_id != "")
				
				header("Location: ../jobin_process.php?");

	 		break;	 


	 		case 'driver_Current_Loc':

	 		break;

	 		case 'update_basic_info':
	 			$load_id = GoodsOwner::update_basic_info();
	
	 			header("Location: ../confirmation_post.php?param=".$load_id);
	 		break;

	 		case 'update_pickUp_info':
	 			$load_id = GoodsOwner::_updatePickUp_info_();
				
	 			header("Location: ../confirmation_post.php?param=".$load_id);
	 		break;
	 		case 'update_drop_details':
	 			$load_id = GoodsOwner::_update_Destination_info_();
		
	 			header("Location: ../confirmation_post.php?param=".$load_id);
	 		break;
	 		case 'job_active':
	 			$load_id = GoodsOwner::job_active();
			
	 			header("Location: ../load_list.php");
	 		break;
			
			case 'addInsuranceDetail':
	 			
				Load::updateTruckNo($HdnInsuBidId,$HdnInsuNoOfTruck,$HdnInsuLoadId,$HdnInsuUserId,$HdnInsuBidAmt);
				
				Load::AddInsuranceDetail();

				Load::sendInsuranceEmail();

				$title = "lorrynlorry";
				$body = "bid";

				// echo $body;die();
				header("location: /webservices/notification.php?owner_id=$lo_id&title=".$title."&body=".$body."");

				break;

	 		
	}
	
	

?>