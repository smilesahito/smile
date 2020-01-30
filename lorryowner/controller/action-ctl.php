<? 
	include("../../classes/common.class.php");
	extract($_REQUEST);

	switch($command){

		case "adddriver":
		
	       // echo $_GET['ansid'];die;
			LorryOwner::AddDriver(); 			
			header("Location: ../driver_registration.php?param=1");

			break;
			
		case "addtruck":
		
	       // echo $_GET['ansid'];die;
			LorryOwner::AddTruck(); 			
			header("Location: ../truck_add.php?param=1");

			break;

		// case "adddriver":
		
	 //       // echo $_GET['ansid'];die;
		// 	LorryOwner::AddDriver(); 			
		// 	header("Location: ../driver_registration.php?param=1");

		// 	break;	
			
			
		case "acceptload":
		
			GoodsOwner::AcceptLoad($_SESSION["sess_admin_id"],$load_id); 			
			header("Location: ../accepted_post.php?param=1");

			break;
		case "addbid":
				$result = LorryOwner::addBid();
				
				if($result==1){
					header("Location: ../load_post.php?param2&user_id=$lo_id");
				}else{
					header("Location: ../load_post.php?param3&user_id=$lo_id");
				}
				

			break;
		case 'acceptBid':
				
					
			break;	
		case "downloadfile":

			Attachment::DownloadFile($filename,$foldername); 			
			//header("Location: ../medical_record_add.php?param=1");

			break;


		case "assignjob":

			// print_r ($driver);die();
		
			LorryOwner::assignDriverJob($job_id,$bid_id,$lo_id,$go_id,$driver,$truck);

			header("location: ../load_post.php?user_id=$lo_id");
			

			break;	

			case 'cancleJob':
									
				LorryOwner::cancleJob($job_id,$bid_id,$driver_id,$truck_id,$msg);

				header("Location: ../load_post.php?param4&user_id=$lo_id");	

				break;

			
		

		

	 			 
	}
	
	

?>