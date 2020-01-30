<? 
	include("../classes/common.class.php");
	extract($_REQUEST);
	//echo $command; die;
	switch($command){



		case "addtocart":
		
	       // echo $_GET['ansid'];die;
			$cart_id=Order::AddCart(); 			
			header("Location: ../cart-view.php?cart_id=$cart_id");

			break;

		case "checkout":
		
			$cart_id=Order::UpdateCart(); 			
			header("Location: ../order-view.php?cart_id=$cart_id");

			break;
		
		case "ordersubmitted":
		
			$cart_id=Order::OrderSubmit(); 			
			header("Location: ../thankyou.php?cart_id=$cart_id");

			break;
			
		case "deleteproduct":
			
			$cart_id=Order::DeleteProduct($cart_id,$cart_prod_id); 			
			header("Location: ../cart-view.php?cart_id=$cart_id");
			break;	


	}
	
	

?>