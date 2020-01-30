<? 
	include("../../classes/common.class.php");
	extract($_REQUEST);

	switch($command){

		case "adddriver":
		
	       // echo $_GET['ansid'];die;
			LorryOwner::AddDriver(); 			
			header("Location: ../driver_list.php?param=1");

			break;
			
		case "addtruck":
		
	       // echo $_GET['ansid'];die;
			LorryOwner::AddTruck(); 			
			header("Location: ../truck_list.php?param=1");

			break;
			
		case "downloadfile":

			Attachment::DownloadFile($filename,$foldername); 			
			//header("Location: ../medical_record_add.php?param=1");

			break;

		case "acceptload":
		
			GoodsOwner::AcceptLoad($_SESSION["sess_admin_id"],$load_id); 			
			header("Location: ../accepted_post.php?param=1");

			break;
			
		case "addpublisher":
		
	       // echo $_GET['ansid'];die;
			$pubid=book::AddPublisher(); 			
			header("Location: ../publisher-list.php?param=$pubid");

			break;
			
		case "acceptload":
		
			$bookid=GoodsOwner::AcceptLoad(); 			
			header("Location: ../accepted_post.php?param=1");

			break;

		case "addaccessoriestype":
		
	       // echo $_GET['ansid'];die;
			$accessories_type_id=Accessories::AddAccessoriesType(); 			
			header("Location: ../accessories-type-list.php?param=$accessories_type_id");

			break;

		case "addaccessories":
		
	       // echo $_GET['ansid'];die;
			$accessories_id=Accessories::AddAccessories(); 			
			header("Location: ../accessories-list.php?param=$accessories_id");

			break;
		
		case "deleteclass":
			
			$class_id=Book::DeleteClass($class_id); 			
			header("Location: ../class-list.php?param1=".sha1($class_id)."");
			break;	

		case "deletepublisher":
			
			$publisher_id=Book::DeletePublisher($publisher_id); 			
			header("Location: ../publisher-list.php?param1=".sha1($publisher_id)."");
			break;	

		case "deletesubject":
			
			$subject_id=Book::DeleteSubject($subject_id); 			
			header("Location: ../subject-list.php?param1=".sha1($subject_id)."");
			break;
			
		case "deletebook":
			
			$book_id=Book::DeleteBook($book_id); 			
			header("Location: ../book-list.php?param1=".sha1($book_id)."");
			break;	

		case "deleteaccessoriestype":
			
			$accessories_type_id=Accessories::DeleteAccessoriesType($accessories_type_id); 			
			header("Location: ../accessories-type-list.php?param1=".sha1($accessories_type_id)."");
			break;	

		case "deleteaccessories":
			
			$accessories_id=Accessories::DeleteAccessories($accessories_id); 			
			header("Location: ../accessories-list.php?param1=".sha1($accessories_id)."");
			break;	

		case "updateanswer":
					
	       
			$ans=Quiz::UpdateSaveAnswers(); 	
			$catno = $_REQUEST['catno']+1;
			 header("Location: ../viewtest.php?param=".$_REQUEST['qsid']."&rid=".$rid."");
			

			break;

		case "multi":
		
	       // echo $_GET['ansid'];die;
			$qid=Quiz::Multilineans($ansid); 			
			//header("Location: ../quiz-add.php?param=$qid");

			break;

		case "viewtest":
					
	
			$qid=Quiz::ViewUserAnswers(); 			
			//header("Location: ../quiz-add.php?param=$qid");

			break;
	
		case "updatequiz":
					
	
			$qid=Quiz::UpdateQuiz($quid); 			
			header("Location: ../quiz.php?param=$quid");

			break;
			
	
		case "deletequiz":
					
	
			$qid=Quiz::DeleteQuiz($quid); 			
			header("Location: ../quiz.php?param1=$quid");

			break;
			
		case "addquiz":
					
	
			$qid=Quiz::Add(); 			
			header("Location: ../quiz-add.php?param=$qid");

			break;
		
		case "adduser":
					

			$uid=User::Add(); 			
			header("Location: ../registration.php?param=$uid");

			break;


		case "updateuser":
		
			$uid=User::UpdateUser($uid); 			
			header("Location: ../user.php?param=$uid");
			exit;
			break;
		
		case "deleteuser":
			
			$uid=User::DeleteUser($uid); 			
			header("Location: ../user.php?param1=$uid");
			exit;
			break;	
	
		case "add":
	 			 
	}
	
	

?>