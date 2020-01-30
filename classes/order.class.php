<?php



	class Order {		

		private $dbconn;

				

/************************************************************************************ 								**** View Session ID *****

************************************************************************************/
		public static function ViewSessionID($session_id="") {
		
			extract($_REQUEST);
			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from cart where session_id = '".$session_id."' order by cart_id desc limit 1";
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();
			
			
		} //function	

		
/************************************************************************************ 								**** Add in Cart *****

************************************************************************************/
		public static function AddCart() {
		
			extract($_REQUEST);
			
			//print_r($_REQUEST);
			
			global $config;
			
			$dbconn = db::singleton();
			
			$session_id = Order::ViewSessionID(session_id());
			
			if(!$session_id || (isset($session_id) && $session_id->cart_status == 'Order_Submitted'))
			{
			//------------------------Books insert-------------------
				if(sizeof($book) > 0)
				{
					//$total_amount=0;

					$query = "insert into cart
					(session_id,datetime,cart_status) 
					values('".session_id()."',now(),'In_Check_Out')";
					$dbconn->SetQuery($query);

					$cart_id=$dbconn->GetLastID();					

					for($a=0; $a < sizeof($book); $a++)
					{
					$book_detail = book::ViewBook($book[$a]);
						if($book_detail) 
						{ 
							foreach($book_detail as $row1) 
							{ 
								//$total_amount=$total_amount+($row1->book_price * $qty[$a]);

								$query1 = "insert into cart_product
								(cart_id,product_id,product_type_id,qty,datetime) 
								values(".$cart_id.",".$row1->book_id.",".$row1->product_type_id.",".$qty[$a].",now())";
								$dbconn->SetQuery($query1);
							}
						}
					}
				}	
				
			//------------------------------Accessories Insert------------------
				else if(sizeof($accessories) > 0)
				{
					

					$query2 = "insert into cart
					(session_id,datetime,cart_status) 
					values('".session_id()."',now(),'In_Check_Out')";
					$dbconn->SetQuery($query2);

					$cart_id=$dbconn->GetLastID();					

					for($b=0; $b < sizeof($accessories); $b++)
					{
					$accessories_detail = Accessories::ViewAccessories('',$accessories[$b]);
						//print_r($accessories_detail); die;
						if($accessories_detail) 
						{ 
							foreach($accessories_detail as $row2) 
							{ 
								//$total_amount=$total_amount+($row1->book_price * $qty[$a]);

								$query3 = "insert into cart_product
								(cart_id,product_id,product_type_id,qty,datetime) 
								values(".$cart_id.",".$row2->accessories_id.",".$row2->product_type_id.",".$qty[$b].",now())";
								$dbconn->SetQuery($query3);
							}
						}
					}
				}	
				
			}
			else if($session_id && $session_id->cart_status <> 'Order_Submitted')
			{
				$cart_id=$session_id->cart_id;
				if(sizeof($book) > 0)
				{
					//$total_amount=$session_id->cart_status;

					for($c=0; $c < sizeof($book); $c++)
					{
					$book_detail = book::ViewBook($book[$c]);
						if($book_detail) 
						{ 
							foreach($book_detail as $row3) 
							{ 
								//$total_amount=$total_amount+($row1->book_price * $qty[$a]);

								$query4 = "insert into cart_product
								(cart_id,product_id,product_type_id,qty,datetime) 
								values(".$session_id->cart_id.",".$row3->book_id.",".$row3->product_type_id.",".$qty[$c].",now())";
								$dbconn->SetQuery($query4);
							}
						}
					}
				}
				
				else if(sizeof($accessories) > 0)
				{
					//$total_amount=0;

					for($d=0; $d < sizeof($accessories); $d++)
					{
					$accessories_detail = Accessories::ViewAccessories('',$accessories[$d]);
						if($accessories_detail) 
						{ 
							foreach($accessories_detail as $row4) 
							{ 
								//$total_amount=$total_amount+($row1->book_price * $qty[$a]);

								$query5 = "insert into cart_product
								(cart_id,product_id,product_type_id,qty,datetime) 
								values(".$session_id->cart_id.",".$row4->accessories_id.",".$row4->product_type_id.",".$qty[$d].",now())";
								$dbconn->SetQuery($query5);
							}
						}
					}
				}	
			}

			return $cart_id;
			
			
		} //function		
				

/************************************************************************************ 								**** Update in Cart *****

************************************************************************************/
		public static function UpdateCart() {
		
			extract($_REQUEST);
			global $config;
			
		//	print_r($_REQUEST); die;
			$dbconn = db::singleton();
			
		$cardproduct = Order::ViewCartProduct($cart_id);
		if($cardproduct) 
		{
			$book_amount=0;
			$accessories_amount=0;
			$total_amount=0;
			foreach($cardproduct as $row)
			{ 
				if($row->product_type_id == 1)
				{
					$book_detail = Book::ViewBook($row->product_id);
					foreach($book_detail as $row1) 
					{ 
						$book_amount=$book_amount+($row1->book_price * $row->qty);

						$query = "update cart_product set price=".$row1->book_price." where cart_id=".$cart_id." and product_id=".$row->product_id.""; 
						//echo "<br />Book ".$query. " - ".$book_amount;
						$dbconn->SetQuery($query);
						
					}
				}
				
				if($row->product_type_id == 2)
				{
				$accessories_detail = Accessories::ViewAccessories('',$row->product_id);
					foreach($accessories_detail as $row2) 
					{ 
						$accessories_amount=$accessories_amount+($row2->accessories_price * $row->qty);

						$query2 = "update cart_product set price=".$row2->accessories_price." where cart_id=".$cart_id." and product_id=".$row->product_id."";
						//echo "<br />Accessories ".$query2. " - ".$accessories_amount;
						$dbconn->SetQuery($query2);
						
					}
				}
				
			}
		}			
						$total_amount=$accessories_amount + $book_amount;
			
						$query3 = "update cart set cart_amount=".$total_amount.",
						cart_status='Check_Out' where cart_id=".$cart_id."";
						$dbconn->SetQuery($query3);
			
			return $cart_id;
			
			
		} //function		
				

/************************************************************************************ 								**** New Order Submited *****

************************************************************************************/
		public static function OrderSubmit() {
		
			extract($_REQUEST);
			global $config;
			$dbconn = db::singleton();
			
			$cartuser = User::ViewCartUser($email);
			
			if($cartuser)
			{
				$user_id=$cartuser->user_id;
			}
			else
			{
				$query = "insert into user
				(registration_type_id,user_name,user_login_id,user_contact_no,user_address,user_reg_datetime,user_status) 
				values(3,'".$name."','".$email."','".$phone."','".$address."',now(),'A')";
				$dbconn->SetQuery($query);

				$user_id=$dbconn->GetLastID();					
			}

			
			$query2 = "update cart set cart_status='Order_Submitted',
			user_id=".$user_id." where cart_id=".$cart_id."";
			$dbconn->SetQuery($query2);
			
			
			$query3= "SELECT IFNULL( max( order_id ) +1, 1 ) AS maxordid from orders";
			$result3 = mysql_query($query3)or die(mysql_error());
			$row3 = mysql_fetch_array($result3);
			$ordno =  date('ymd').$row3['maxordid'];

			
			$query4 = "insert into orders
			(cart_id,order_no,order_status,order_datetime) 
			values(".$cart_id.",'".$ordno."','New',now())";
			$dbconn->SetQuery($query4);
			
			return $cart_id;
			
			
		} //function		
				
/************************************************************************************ 								**** View Cart *****

************************************************************************************/
		public static function ViewCart($cart_id="") {
		
			extract($_REQUEST);
			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from cart";
			
			if($cart_id != "") 
			{
			 	$query .= " where cart_id = ".$cart_id."";
			 }

			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
			
			
		} //function	
		

/************************************************************************************ 								**** View Cart Product*****

************************************************************************************/
		public static function ViewCartProduct($cart_id="") {
		
			extract($_REQUEST);
			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from cart_product";
			
			if($cart_id != "") 
			{
			 	$query .= " where cart_id = ".$cart_id."";
			 }

			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
			
			
		} //function	
		
		
/************************************************************************************ 								
**** View Cart/order Product*****

************************************************************************************/
		public static function ViewOrderProduct($cart_id="") {
		
			extract($_REQUEST);
			global $config;

			$dbconn=db::singleton();
			
			$query = "select c.*,cp.*,b.book_name product_name,b.book_image product_image from cart c
					inner join cart_product cp on c.cart_id=cp.cart_id
					inner join book b on cp.product_id=b.book_id
					where c.cart_id=".$cart_id."  and cp.product_type_id=1

					union

					select c.*,cp.*,a.accessories_name product_name,a.accessories_image product_image from cart c
					inner join cart_product cp on c.cart_id=cp.cart_id
					inner join accessories a on cp.product_id=a.accessories_id
					where c.cart_id=".$cart_id."  and cp.product_type_id=2";
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
			
			
		} //function	
		
/************************************************************************************ 								
**** View Order *****

************************************************************************************/
		public static function ViewOrder($order_id="") {
		
			extract($_REQUEST);
			global $config;

			$dbconn=db::singleton();
			
			$query = "SELECT c.*, o.* FROM `orders` o
inner join cart c on c.cart_id=o.cart_id";
			
			if($order_id != "") 
			{
			 	$query .= " where order_id = ".$order_id."";
			 }
			
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
			
			
		} //function	
		

		
		
		/************************************************************************************ 								
		Delete Product
		************************************************************************************/

		public static function DeleteProduct($cart_id,$cart_prod_id) {
			
			extract($_REQUEST);
			global $config;
			
			$dbconn=db::singleton();
			
			$query = "delete from cart_product where cart_prod_id=".$cart_prod_id; 
			$dbconn->SetQuery($query);
			

			return $cart_id;
			
			
		}		
		
		
		
		/************************************************************************************ 								**** Get Question All Type *****

************************************************************************************/

		public static function GetQuestionType(){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from question_type
					order by qt_id asc";
			
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 
		
		
/************************************************************************************ 								**** Get Question Selected Type *****

************************************************************************************/

		public static function GetQuestionTypeDetail($qt_id=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from question_type";
			
			if($qt_id != "") 
			{
			 	$query .= " where qt_id = ".$qt_id."";
			 }
			$query .= "	order by qt_id asc";
           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		
/************************************************************************************ 								**** Get Category All Type *****

************************************************************************************/

		public static function GetCatgory(){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from category order by cid asc";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 

/************************************************************************************ 								**** Get Selected Category *****

************************************************************************************/

		public static function GetCatgoryDetail($cid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from category";
			
			if($cid != "") 
			{
			 	$query .= " where cid = ".$cid."";
			 }
			$query .= "	order by cid asc";
           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		
/************************************************************************************ 								**** Get All Groups *****

************************************************************************************/

		public static function GetGroup(){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from groups order by gid asc";
            //echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();

		

		} 

/************************************************************************************ 								**** Get Selected Group *****

************************************************************************************/

		public static function GetGroupDetail($gid=""){

			global $config;

			$dbconn=db::singleton();
			
			$query = " select * from groups";
			
			if($gid != "") 
			{
			 	$query .= " where gid = ".$gid."";
			 }
			$query .= "	order by gid asc";
           
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

		

		} 
		
		
/************************************************************************************ 								**** Add New Question *****

************************************************************************************/
		public static function Add() {
		
			extract($_REQUEST);
			global $config;
			//print_r($_REQUEST);die;
		
			$dbconn=db::singleton();
			//echo $score; die;
			//$arr = Utility::ClearSqlInjection($_REQUEST);
			//extract($arr);
			if(empty($no_of_opt)) {$no_of_opt=0;}
			$query = "insert into questions(qt_id,gid,question,description,cid,no_of_opt,created_by,created_on) 
					 values($question_type_id,$group_id,'".addslashes($question)."','".addslashes($description)."',$category_id,$no_of_opt,".$_SESSION['sess_admin_id'].",now())";
						//echo $query; die;

					$dbconn->SetQuery($query);

				$qid=$dbconn->GetLastID();
			
			if (!empty($option)) 
			{	
				
			for($a=0;$a<sizeof($option);$a++)
				{
					if($score==$a)
					{
						 $currect=1;
					 } else {
						 $currect=0;
					 }
					
					$query2 = "insert into question_options
					(qid,q_option,score) 
					 values($qid,'".addslashes($option[$a])."',$currect)";
					$dbconn->SetQuery($query2);
				}
			}
			
			
			return $qid;
			
			
		} //function	

		public static function Update($qid) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
		
			$dbconn=db::singleton();
			//echo $score; die;
			//$arr = Utility::ClearSqlInjection($_REQUEST);
			
			
			$query = "update questions set question='".addslashes($question)."',description='".addslashes($description)."',cid= ".$category_id." where qid=".$qid; 
			//echo $query; die;		 
			$dbconn->SetQuery($query);
			

				//$qid=$dbconn->GetLastID();
			
			if (!empty($option)) 
			{	
			
				$query1 = "delete from question_options where qid = ".$qid."";					
					$dbconn->SetQuery($query1);
				
			for($a=0;$a<sizeof($option);$a++)
				{
					if($score==$a)
					{
						 $currect=1;
					 } else {
						 $currect=0;
					 }
					
					$query2 = "insert into question_options
					(qid,q_option,score) 
					 values($qid,'".addslashes($option[$a])."',$currect)";
					$dbconn->SetQuery($query2);
				}
			}
			
			
			return $qid;
			
			
		} //function	
		
		public static function Delete($qid) {
			
			extract($_REQUEST);
			//print_r($_REQUEST);die;
			global $config;
			
		
			$dbconn=db::singleton();

			
			$query = "update questions set question_status='D' where qid=".$qid; 
			//echo $query; die;		 
			$dbconn->SetQuery($query);
			

			return $qid;
			
			
		}		
}