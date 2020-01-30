<? 
	include("../../classes/common.class.php");
	extract($_REQUEST);

	switch($command){

		case "addload":
		
	       // echo "sss";die;
			$classid = patient::AddBP(); 	
		
			header("Location: ../load_list.php?param=''");

			break;	

         case "addowner":

			$last_id=User::AddUser($user_type); 		
			// echo $last;die;
			if ($user_type == "GO")
			{
				header("Location: ../owner_type.php?param=$last_id");	
			}
			elseif($user_type == "LO")
			{
			// 	header("Location: ../owner_list.php?param=1");	
				header("Location: ../owner_type.php?param=$last_id");
			}
			elseif($user_type == "D")
			{
				header("Location: ../driver_list.php?param=1");	
				// header("Location: ../owner_type.php?param=1");
			}
			

			break;
		
		case "updateGoodOwner":
			User::updateUserInfo(); 			
			header("Location: ../goods_list.php?param=4");
			
			break;
		
		case "adddriver":
		

	       // echo $_GET['ansid'];die;
			LorryOwner::AddDriver(); 			
			header("Location: ../driver_list.php?param=1");

			break;
			
		case "addtruck":
		
	       // echo $_GET['ansid'];die;
			LorryOwner::AddTruck_admin(); 			
			header("Location: ../truck_list.php?param=1");

			break;
			
		case "downloadfile":

			Attachment::DownloadFile($filename,$foldername); 			
			//header("Location: ../medical_record_add.php?param=1");

			break;
		case 'makedriver':
				
				$user_type = "D";
				User::setUserRole($user_type,$user_id);
				header("Location: ../owner_list.php?param=1");
			break;	
			
		case 'deleteGoodOwner':
				
				User::DeleteUser($userId);
				header("Location: ../goods_list.php?param=2");
			break;	

		case "user_role":			
			// print_r($user_role);die;
			$counter =1;
			$document = Load::fetch_Document($user_role); 
			if(!empty($document))
			{ 
				
				echo '<table  id="bootstrap-data-table" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="bootstrap-data-table_info" >
					<tr>
						<th class="bg-info text-dark">#</th>
						<th class="bg-info text-dark">Document</th>
						<th class="bg-info text-dark">Upload File</th>
					</tr>';
				foreach ($document as $row)
				{	
					// print_r($row);	
					echo '<tr>
							<td> D-'.$counter.' </td>
							<td>'. htmlspecialchars($row->document_name,ENT_QUOTES).'</td>
							<td ><input type="file" name="upload_file_'.$row->document_id.'" 
							 accept=".doc, .docx, .jpg,text/plain, application/pdf, image/*"><input type="hidden" name="document_id[]" value="'.$row->document_id.'"></td>	
						</tr>';
				 $counter++;
				}
			// echo '<option value="'.$row->truck_type_id.'" >'.$row->truck_capacity.'</option>';	
			
			echo '</table>';			
			

			 }else
			{
				
			}	
				// print_r($document_id);die;
				// return $document_id;
			break;	
	 		
	 		case "add_document_and_role":
	 				// print_r($_REQUEST);die; 	
	 			$add_document = User::insert_document();  	
	 			// echo $add_document;die;
	 			if($add_document == "GO")
	 			{
	 				header("Location: ../goods_list.php?param=2");
	 			}
	 			else if($add_document == "LO")
	 			{	
	 			header("Location: ../owner_list.php?param=2");
	 			}
	 		break;	

	 		case 'activeOwner':
	 			
	 			$add_document = User::active_User(); 
	 			
	 			if($add_document=="GO")
	 			{

				header("Location: ../goods_list.php?param=1");


	 			}else if($add_document=="LO")
	 			{
				header("Location: ../owner_list.php?param=1");
	 			}
	 		 	break; 

	 		 	case 'activeDriver':
	 			// echo "asdasdsa";die;
	 			$add_document = User::active_Driver(); 
	 		 	header("Location: ../driver_list.php");
	 		 	break; 

	 		 	case 'active_truck':
				$add_document = User::active_Truck(); 
	 		 	header("Location:../truck_list.php?");
	 		 	break;
	}
	
	

?>