<?

	class Customer{
		
	private $dbconn;
	
/************************************************************************************ 								**** ADD Customer  *****
************************************************************************************/
		public static function Add(){
			global $config;
			
			$dbconn = db::singleton();
			
			$arr = utility::ClearSqlInjection($_REQUEST);
			
			//$c_agent = "0";
			extract($arr);
			//print("add to ship".$c_ship); die;
			$sql = " insert into tbl_customer
					(customer_type , customer_name ,
					 sales_agent_discount , customer_adress1 , customer_addres2 , customer_addres3 , 
					 customer_addres4 ,customer_addres5 , vat_no,			
					 country , currency , email ,
					 fax , phone ,ip_address , added_on,updated_on)
					 values
					('$c_type','$c_title' ,
					 '$c_agent' ,'$c_address1' , '$c_address2' ,  '$c_address3' ,  '$c_address4' ,  '$c_address5' 
					 ,'$vat_no' ,'$c_coutry' , '$c_currency' , '$c_email' ,
					'$c_fax' , '$c_phone','$c_ip_address' , now(),now())";
					
			//print($sql); exit;	
			$dbconn->SetQuery($sql);	
			$aid = $dbconn->GetLastID();
			
			if($c_ship == 'Y'){
			
				$sql = " insert into tbl_shipping_address
				
						(customer_id , shipping_address1, shipping_address2, shipping_address3, shipping_address4 ,
						shipping_address5 , country,
						fax , phone , 
						email ,added_on )
						value
						('$aid' , '$c_address1', '$c_address2', '$c_address3', '$c_address4',
						'$c_address5' , '$c_coutry' ,  
						'$c_fax' , '$c_phone' , '$c_email', now())";		
			
				$dbconn->SetQuery($sql);
			}
			
		 
		
		}//  fuction add

/************************************************************************************ 								
						**** List customer *****
************************************************************************************/
	
		public static function GetCustomerList($filter=""){
		
		global $config;
		
			$dbconn = db::singleton();

			$sql = " select * from tbl_customer 
					 where 
					 status = 'A'";
			if($filter!=""){ 
			$sql .= $filter;
			}
			$sql .= " order by id desc ";
			$dbconn->SetQuery($sql);
			// print($sql);
			return  $dbconn->LoadObjectList(); 		
			
		
		}// fucntion get customer list 
	
		
			
		public static function GetCustomerCountry($c_id){
		
		global $config;
		
			$dbconn = db::singleton();

			$sql = "SELECT c.customer_name,ct.name FROM tbl_customer c
					join country ct on c.country=ct.count_id where c.id='$c_id'";
			//print($sql);
			$dbconn->SetQuery($sql);
			 
			return  $dbconn->LoadObjectList(); 	
				
			
		
		}// fucntion get customer list 

/************************************************************************************ 								
				**** delete Customer *****
************************************************************************************/
	
		public static function Delete($param){
		
			global $config;
			
			$dbconn = db::singleton();
			
			$sql = " update  tbl_customer  set
					 status = 'D' ,
					 updated_on = now()
					where id = '$param'";
			
			$dbconn->SetQuery($sql);
			$sql = " update  tbl_shipping_address  set
					 status = 'D' ,
					 updated_on = now()
					where customer_id = '$param'";
			
			$dbconn->SetQuery($sql);
			
			return ; 
			
		}// function delete 

/************************************************************************************ 								
	
	 Get Customer Info  by customer id or by shipping id 
	 
	 type 1 = Get Customer info by Customer id
	 type 2 = Get Custoemr Info by Shipping id
					
************************************************************************************/
			
		public static function GetCustomerInfo($id,$type="1"){
		
			global $config;
			$dbconn = db::singleton();
			
			if($type == "1") {
	
				$sql = " select c.*,ct.code from tbl_customer c inner join tbl_customer_type ct on 
						ct.id=c.customer_type where c.id = '$id' ";
			
			} else {
				
				$sql = " select c.*,ct.code,ct.id as ct_id,sa.contact_person_name,sa.shipping_address1 as s_address1,
						sa.shipping_address2 as s_address2, sa.country as s_country,sa.post_code as s_post_code,
						sa.fax as s_fax,sa.phone as s_phone,sa.email as s_email from tbl_shipping_address sa 
						inner join tbl_customer c on c.id=sa.customer_id inner join tbl_customer_type ct 
						on ct.id = c.customer_type where sa.id = '$id' ";	
			}
			
			
			$dbconn->SetQuery($sql); 
			
			return $dbconn->LoadObject();
		
		
		} // function get customer info
		
/************************************************************************************ 						

						****Edit  Customer  *****
************************************************************************************/ 
	 public static function Edit(){
	 
		 global $config;
		 $dbconn = db::singleton();
		 
		 $arr = Utility::clearSqlInjection($_REQUEST);
		 extract($arr);
				 
	//	if($c_type != 7){
	//		$c_agent = 0;
	//	}
	
		 $sql = "update tbl_customer set 
				 customer_type = '$c_type', 
				 customer_name = '$c_name',
				 
				 sales_agent_discount = '$c_agent', 
				 
				 customer_adress1 = '$c_address1', 
				 customer_addres2 = '$c_address2',
				 customer_addres3 = '$c_address3',
				 customer_addres4 = '$c_address4',
				 customer_addres5 = '$c_address5', 
				 vat_no 		  =	 '$vat_no' ,			
				 country = '$c_coutry', 
				 currency = '$c_currency', 
				 email = '$c_email',
				 fax = '$c_fax', 
				 phone = '$c_phone', 
				 ip_address = '$c_ip_address',
				 updated_on = now() 
				 where id = $cid";
				 
		 $dbconn->SetQuery($sql);
		 
		 
	  if($c_ship == 'Y'){
			
			$sql = " insert into tbl_shipping_address
			
					(customer_id , shipping_address1, shipping_address2, shipping_address3, shipping_address4,
					shipping_address5 , country,
					fax , phone , 
					email ,added_on )
					value
					('$cid', '$c_address1', '$c_address2', '$c_address3', '$c_address4',
					'$c_address5' , '$c_coutry' ,  
					'$c_fax' , '$c_phone' , '$c_email', now())";		
			//print($sql); exit;
			$dbconn->SetQuery($sql);
		}
		 
		 return;
	 
	 }// edit function end  
	 
	 /************************************************************************************ 						

						**** complete  Customer  , Country , type list  *****
************************************************************************************/
	 
	 public  function GetCustomerCompleteList($filter="",$pageno="",$pagesize=""){
	 	
		global $config;
		$this->dbconn = db::singleton();
	 
	 	$sql = "SELECT  tbl_customer.* , tbl_customer_type.customer_type ,
				country.name , tbl_customer.email ,
				tbl_customer.phone 
				
				FROM    tbl_customer
				INNER JOIN tbl_customer_type
				ON tbl_customer_type.id = tbl_customer.customer_type 

				left JOIN country
				ON country.count_id  =  tbl_customer.country
				
				where  
				tbl_customer.status = 'A' " ;
				
			$orderby =	"ORDER BY tbl_customer.customer_name asc"; 
	 
		if($filter!=""){
			$sql .= $filter;
		}				

		$sql.= " ".$orderby; 
	
		//print $sql;	
		$this->dbconn->SetQuery($sql);
			 
		return  $this->dbconn->LoadObjectList($pageno,$pagesize); 	
	  
	 
	 }//  function  get custome complete list 
	 
/************************************************************************************ 								**** paging Custoemr VOLUME  *****
************************************************************************************/


	public function GetNumRows() {
 		return $this->dbconn->GetNumRows(); 
		
	}
	
	public function GetNumberOfPages() {
		return $this->dbconn->GetNumberOfPages(); 
	}
		 
	 
/**************************************************************************************** 			

					Add Shipping   *****
************************************************************************************/ 
 
	public static function AddShipping(){
	
		global $config;
		$dbconn = db::singleton();
		
		$arr = Utility::ClearSqlinjection($_REQUEST);
		extract($arr);
		
		$sql = "insert into tbl_shipping_address
				(customer_id ,contact_person_name, shipping_address1 , shipping_address2,shipping_address3 , shipping_address4 ,
				shipping_address5 , country , post_code ,
				fax , phone , email ,added_on,updated_on )
					value
				('$customer_id','$cp_name' , '$s_address1', '$s_address2', '$s_address3', '$s_address4',
				'$s_address5' , '$s_coutry' , '$s_postal' , 
				'$s_fax' , '$s_phone' , '$s_email',now(),now())";
		

		$dbconn->SetQuery($sql);
		$cid = $customer_id;
		
		return $cid;
	
	} // function add shippping
	
	
	
	/************************************************************************************ 									
							**** Get Shipping List  wi customer   *****
************************************************************************************/ 
	
	public function GetShippingList($filter="",$pageno="",$pagesize="",$param){
	
		global $config;
		$this->dbconn = db::singleton();
		
		$sql = " select tbl_shipping_address.*,
				 tbl_customer.customer_name

				from tbl_shipping_address
				inner join tbl_customer
				on tbl_shipping_address.customer_id = tbl_customer.id
				where 
				tbl_shipping_address.status = 'A'
				and customer_id =$param
				order by tbl_shipping_address.id desc; ";
		 
		$this->dbconn->SetQuery($sql);
		 
		return $this->dbconn->LoadObjectList($pageno,$pagesize);
	}// function end shipping list
	
	
	/************************************************************************************ 									
							**** Delete Shipping    *****
************************************************************************************/ 
	
	public static function DeleteShipping($param,$cu_id){
	
		global $config;
		$dbconn = db::singleton();
		
		$sql = "update tbl_shipping_address set  
				status = 'D' ,
				updated_on = now() 
				where id =$param";
		 
		$dbconn->SetQuery($sql);
		
		return  $cu_id;
	}// function delete 

	/************************************************************************************ 									
							**** Get Shipping Info   *****
************************************************************************************/
	 public static function GetShippingInfo($s_id){
	 
	 	global $config;
	 
	 	$dbconn = db::singleton();
	 
	 	$sql =  " select * from tbl_shipping_address s
				  where id = $s_id";
	 	//print($sql);
				$dbconn->SetQuery($sql);		
				return $dbconn->LoadObjectList();	
	 
	 } //  function info 
	 
	 
	 	/************************************************************************************ 									
							**** Edit Shipping Info   *****
************************************************************************************/
	 
	 public static function EditShipping(){
	 	
		global $config;
		
		$dbconn = db::singleton();
		
		$arr = Utility::ClearSqlInjection($_REQUEST);
		extract($arr);
		
	
	 
	 	$sql = "update tbl_shipping_address set 				 
				contact_person_name = '$cp_name' ,  
				shipping_address1 = '$s_address1' , 
				shipping_address2 = '$s_address2' , 
				shipping_address3 = '$s_address3' , 
				shipping_address4 = '$s_address4' , 
				shipping_address5 = '$s_address5' , 
				country = '$s_coutry' , 
				post_code = '$s_postal' ,
				fax = '$s_fax' , 
				phone = '$s_phone' , 
				email = '$s_email' ,
				updated_on = now()
				where id = $shipping_id	";
		
		$dbconn->SetQuery($sql);
		
		return $customer_id;
	 
	 }// end function edit
	 
	 
/************************************************************************************ 									
							**** Get customer type list   *****
************************************************************************************/	 
	 public static function GetCustomerTypeList(){
	    global $config;
		$dbconn = db::singleton();
				
		$sql = "select * from tbl_customer_type";
		$dbconn->SetQuery($sql);
		
		return  $dbconn->LoadObjectList();	 
	 
	 }// function customer type list 
	 
/************************************************************************************ 									
							**** Get Country  list   *****
************************************************************************************/	 
	 
	  public static function GetCountryList(){
	    global $config;
		$dbconn = db::singleton();
				
		$sql = "select * from country";
		$dbconn->SetQuery($sql);
		
		return  $dbconn->LoadObjectList();	 
	 
	 } // Function country
	 
	 
	 
	 public static function GetCustomerType($filter="") {

		$dbconn=db::singleton();
	
		$query = "select concat(IFNULL(c.customer_adress1,''), ' ',
										IFNULL(c.customer_addres2,''), ' ',
										IFNULL(c.customer_addres3,''),' ',
                    IFNULL(c.customer_addres4,''),' ',
                    IFNULL(c.customer_addres5,'')) as address,cty.iso as country, c.id as id ,ct.code as code,c.customer_type as customer_type,
					c.id as customer_type_id, c.customer_name as customer_name from tbl_customer c join tbl_customer_type ct
					on c.customer_type = ct.id
        			join country cty on c.country=cty.count_id where c.status='A'";	
		
		if($filter != "") {
			
			$query .= $filter;		
		}
		
		$query .=" order by c.customer_name ";
		//print($query);
		$dbconn->SetQuery($query);		
		
		return $dbconn->LoadObjectList();	
				
	}	
			
		public static function GetShippingAddress($s_id) {

				$dbconn=db::singleton();								
				$query = "select * from tbl_shipping_address";	
				if($s_id!=""){
					$query .= " where id='$s_id'";
				}
				//print($query);
				$dbconn->SetQuery($query);		
				return $dbconn->LoadObjectList();	
						
			}
			
	 public static function GetCustomerShippingAddress($id) {

		$dbconn=db::singleton();
	
		$query = "SELECT c.id,sa.id as s_id,
				concat(IFNULL(sa.shipping_address1,''), ' ',
										IFNULL(sa.shipping_address2,''), ' ',
										IFNULL(sa.shipping_address3,''),' ',
          	 							IFNULL(sa.shipping_address4,''),' ',
            							IFNULL(sa.shipping_address5,'')) as address,
										c.customer_name ,cnt.iso3, cnt.name
		 		from tbl_customer c join tbl_shipping_address sa on sa.customer_id=c.id inner join country cnt

				on sa.country= cnt.count_id where sa.id=$id and sa.status='A'";	
		
		$query .=" order by c.customer_name ";
		//print($query);
		$dbconn->SetQuery($query);		
		
		return $dbconn->LoadObject();	
				
	}			
		
	 
	}// class end 


?>