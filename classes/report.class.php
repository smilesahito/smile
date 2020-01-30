<?php


 class Report{

	private $dbconn;
	//       get all date  where  print online = "Print"
	public function GetPrintOrderList($filter="",$type,$pageno="",$pagesize=""){

			global $config;

			$this->dbconn = db::Singleton();
		
		$query = " select distinct od.* ,o.*, s.* , jv.* ,c.customer_name, s.contact_person_name, j.journal_code ,  ct.name from tbl_order_detail od 
					left join tbl_order o on od.order_no=o.id 
					left join tbl_customer c on od.end_user=c.id 
					left join tbl_shipping_address s on od.shipment_address_id = s.id 
					left join tbl_journal j on od.product = j.id 
					left join tbl_journal_volume jv on od.volume = jv.id 
					left join country ct on s.country = ct.count_id 					
					where  o.list_date !='0000-00-00' and o.status!='D' and o.order_cat=0 and
					(od.print_online='$type' or od.print_online='both' ) ";
			$orderby = 	" order by o.invoice_no+0 desc " ;
		if($filter != ""){
			$query .= $filter;
		}
			$query .=$orderby;
	//	print($query); die();
	
		$this->dbconn->SetQuery($query);
		if($pageno!=""){	
			return $this->dbconn->LoadObjectList($pageno,$pagesize);
	}else{
			return $this->dbconn->LoadObjectList();
		}

	}// END FUNCTION 
	//       get all date  where  print online = "Print"
	public function GetPrintList($filter="",$type,$pageno="",$pagesize=""){

			global $config;

			$this->dbconn = db::Singleton();
		
		$query = " select distinct od.* ,o.*, s.* , jv.* ,c.customer_name, s.contact_person_name, j.journal_code ,  ct.name from tbl_order_detail od 
					left join tbl_order o on od.order_no=o.id 
					left join tbl_customer c on o.customer_id=c.id 
					left join tbl_shipping_address s on od.shipment_address_id = s.id 
					left join tbl_journal j on od.product = j.id 
					left join tbl_journal_volume jv on od.volume = jv.id 
					left join country ct on s.country = ct.count_id 					
					where  o.list_date !='0000-00-00' and o.status!='D' and o.order_cat=0 and
					(od.print_online='$type' or od.print_online='both' ) ";
			$orderby = 	" order by o.invoice_no+0 desc " ;
		if($filter != ""){
			$query .= $filter;
		}
			$query .=$orderby;
	//	print($query); die();
	
		$this->dbconn->SetQuery($query);
		if($pageno!=""){	
			return $this->dbconn->LoadObjectList($pageno,$pagesize);
	}else{
			return $this->dbconn->LoadObjectList();
		}

	}// END FUNCTION 

		public function GetBundlePrintList($filter="",$type,$pageno="",$pagesize="",$oid=""){

			global $config;

			$this->dbconn = db::Singleton();
		
		$query = " select distinct o.*, s.* ,c.customer_name, s.contact_person_name,j.journal_code ,ct.name, od.end_user ,
					(
					select group_concat(distinct(bjv.volume_year)) from  tbl_order bo 
					inner join tbl_order_detail bod on bod.order_no=bo.id
					inner join tbl_journal_volume bjv on bjv.id=bod.volume 
					where bjv.status='A' "; 
					if($oid!=""){
						$query .= " and bo.invoice_no=".$oid;			
					}
			$query .= " ) as journal_volume_year 
					from tbl_order o
					left join tbl_order_detail od on o.id = od.order_no
					left join tbl_customer c on o.customer_id=c.id
					left join tbl_shipping_address s on od.shipment_address_id = s.id
					left join country ct on s.country = ct.count_id
					left join tbl_journal j on od.product = j.id
					where o.order_cat!=0 and o.list_date !='0000-00-00' and o.status!='D'
					and (od.print_online='electronic' or od.print_online='both' )";
			$orderby = 	" order by o.invoice_no+0 desc " ;
		if($filter != ""){
			$query .= $filter;
		}
			$query .=$orderby;
		
		$this->dbconn->SetQuery($query);
		if($pageno!=""){	
			return $this->dbconn->LoadObjectList($pageno,$pagesize);
	}else{
			return $this->dbconn->LoadObjectList();
		}

	}// END FUNCTION 
 		
	
	//--------------------Imran----------------------
	
		public function GetBundlePrintListBundle($filter="",$type,$pageno="",$pagesize="",$oid=""){

			global $config;

			$this->dbconn = db::Singleton();
		
		$query = "select distinct o.*,o.id order_id, s.* ,c.customer_name, s.contact_person_name, j.journal_code, j.id Journal_id ,ct.name, od.end_user from tbl_order o
					left join tbl_order_detail od on o.id = od.order_no
					left join tbl_customer c on o.customer_id=c.id
					left join tbl_shipping_address s on od.shipment_address_id = s.id
					left join country ct on s.country = ct.count_id
					left join tbl_journal j on od.product = j.id
					where o.order_cat!=0 and o.list_date !='0000-00-00' and o.status!='D'
					and (od.print_online='electronic' or od.print_online='both' )";
			$orderby = 	" order by o.invoice_no+0 desc " ;
		if($filter != ""){
			$query .= $filter;
		}
			$query .=$orderby;
		
		//echo $query;
		$this->dbconn->SetQuery($query);
		if($pageno!=""){	
			return $this->dbconn->LoadObjectList($pageno,$pagesize);
	}else{
			return $this->dbconn->LoadObjectList();
		}

	}// END FUNCTION 

	//-----------------------Imran-----------------
	public function GetBundlePrintListVolume($filter=""){
			
			global $config;

			$this->dbconn = db::Singleton();
		
		$query = "SELECT GROUP_CONCAT( DISTINCT (
bjv.volume_year
) ) as journal_volume_year
FROM tbl_order bo
INNER JOIN tbl_order_detail bod ON bod.order_no = bo.id
INNER JOIN tbl_journal_volume bjv ON bjv.id = bod.volume
WHERE bjv.status =  'A'" ;
			if($filter != ""){
				$query .= $filter;
			}
		//echo $query."--------";	
		
		$this->dbconn->SetQuery($query);
		return $this->dbconn->LoadObject();
		
		}
//-----------------------------------------------------	
	public function GetEndUser($filter=""){
			
			global $config;

			$this->dbconn = db::Singleton();
		
		$query = "SELECT t.customer_name as enduser, t.ip_address FROM tbl_customer t" ;
			if($filter != ""){
				$query .= $filter;
			}
		//echo $query."<hr />";
		$this->dbconn->SetQuery($query);
		return $this->dbconn->LoadObject();
		
		}
/************************************************************************************ 									
							**** Get Shipping Info   *****
************************************************************************************/
	 public static function GetShippingInfo($s_id){
	 
	 	global $config;
	 
	 	$dbconn = db::singleton();
	 
	 	$sql =  " select * from tbl_shipping_address s
				left join country ct on s.country = ct.count_id  
				  where s.id = '$s_id' ";
	 	//print($sql."<hr>");
				$dbconn->SetQuery($sql);		
				return $dbconn->LoadObject();	
	 
	 } //  function info 
	/************************************************************************************ 							
				**** paging Order   *****
************************************************************************************/

	public function GetNumRows() {
 		return $this->dbconn->GetNumRows(); 
	}


	public function GetNumberOfPages() {
		return $this->dbconn->GetNumberOfPages(); 
	}


	/************************************************************************************ 									
						****  Export List  of Journal module   *****
	************************************************************************************/
	public function GetExportPrintOrderList($type,$filter){
		global $config;
		$this->dbconn = db::Singleton();
		$query = " select distinct od.id as item_no ,od.* ,o.*, s.* , jv.* ,

					c.customer_name, s.contact_person_name,

					j.journal_code ,  ct.name 

					from tbl_order_detail od 

			left join tbl_order o on od.order_no=o.id 
			left join tbl_customer c on od.end_user=c.id 
			left join tbl_shipping_address s on od.shipment_address_id = s.id 
			left join tbl_journal j on od.product = j.id 
			left join tbl_journal_volume jv on od.volume = jv.id 
			left join country ct on s.country = ct.count_id 
					where  o.order_cat=0 and o.list_date !='0000-00-00' and  o.status!='D' and
						(od.print_online='$type' or od.print_online='both' ) ";
			$orderby = 	" order by o.invoice_no+0 desc " ;
			if($filter != ""){
			$query .= $filter;
			 }
				  $query .= $orderby ;

				//   print_r($query);die();

				  $this->dbconn->SetQuery($query);

				  return $this->dbconn->LoadObjectList();

	}  // end function 
	
	public function GetExportList($type,$filter){
		global $config;
		$this->dbconn = db::Singleton();
		$query = " select distinct od.id as item_no ,od.* ,o.*, s.* , jv.* ,

					c.customer_name, s.contact_person_name,

					j.journal_code, j.journal_title ,  ct.name 

					from tbl_order_detail od 

			left join tbl_order o on od.order_no=o.id 
			left join tbl_customer c on o.customer_id=c.id 
			left join tbl_shipping_address s on od.shipment_address_id = s.id 
			left join tbl_journal j on od.product = j.id 
			left join tbl_journal_volume jv on od.volume = jv.id 
			left join country ct on s.country = ct.count_id 
					where  o.order_cat=0 and o.list_date !='0000-00-00' and  o.status!='D' and
						(od.print_online='$type' or od.print_online='both' ) ";
			$orderby = 	" order by o.invoice_no+0 desc " ;
			if($filter != ""){
			$query .= $filter;
			 }
				  $query .= $orderby ;

				  // print_r($query);die();

				  $this->dbconn->SetQuery($query);

				  return $this->dbconn->LoadObjectList();

	}  // end function 
	
	public function GetBundleIngentaAccessExportList($type,$filter){
		global $config;
		$this->dbconn = db::Singleton();
		$query = " select distinct od.id as item_no ,od.* ,o.*, s.* , jv.* ,

					c.customer_name, s.contact_person_name,

					j.journal_code, j.journal_title ,  ct.name 

					from tbl_order_detail od 

			left join tbl_order o on od.order_no=o.id 
			left join tbl_customer c on o.customer_id=c.id 
			left join tbl_shipping_address s on od.shipment_address_id = s.id 
			left join tbl_journal j on od.product = j.id 
			left join tbl_journal_volume jv on od.volume = jv.id 
			left join country ct on s.country = ct.count_id 
					where  o.order_cat!=0 and o.list_date !='0000-00-00' and  o.status!='D' and
						(od.print_online='$type' or od.print_online='both' ) ";
			$orderby = 	" order by o.invoice_no+0 desc " ;
			if($filter != ""){
			$query .= $filter;
			 }
				  $query .= $orderby ;

				  // print_r($query);die();

				  $this->dbconn->SetQuery($query);

				  return $this->dbconn->LoadObjectList();

	}  // end function 

	public function GetBundleExportList($type,$filter,$product,$access_for,$start,$end,$order_no){
		global $config;
		$this->dbconn = db::Singleton();
		/*$query = " select distinct o.*, s.* ,c.customer_name, s.contact_person_name,j.journal_code ,ct.name, od.end_user ,
					(select group_concat(distinct(jv.volume_year) order by jv.volume_year) from tbl_journal j
					left join tbl_journal_volume jv on j.id=jv.journal_id
					where j.id=od.product) as journal_volume_year from tbl_order o
					left join tbl_order_detail od on o.id = od.order_no
					left join tbl_customer c on o.customer_id=c.id
					left join tbl_shipping_address s on od.shipment_address_id = s.id
					left join country ct on s.country = ct.count_id
					left join tbl_journal j on od.product = j.id
					where  o.list_date !='0000-00-00' and o.status!='D'
					and (od.print_online='electronic' or od.print_online='both' ) ";
			$orderby = 	" order by o.invoice_no+0 desc " ;*/
		
		$query = "select distinct o.id as order_no , o.invoice_no, j.id as journal_id,group_concat(distinct jv.volume_no ORDER BY jv.volume_no SEPARATOR ',') as volume_no,
					group_concat(distinct jv.issue_f ORDER BY jv.volume_no SEPARATOR ',') as start_issue,
					group_concat(distinct jv.issue_t ORDER BY jv.volume_no SEPARATOR ',') as end_issue,
					group_concat(DISTINCT jv.volume_year order by jv.volume_no SEPARATOR ',') as volume_year,
					c.customer_name,j.journal_code ,od.end_user,od.shipment_address_id from tbl_order o
					left join tbl_order_detail od on o.id=od.order_no
					left join tbl_journal_volume jv on od.product=jv.journal_id
					left join tbl_journal j on jv.journal_id=j.id
					left join tbl_customer c on od.end_user=c.id					
					where od.order_no='$order_no' and j.id='$product' and
						jv.volume_year between '$start' and '$access_for'  ";
		
		/*$query = "select distinct o.id as order_no , o.invoice_no, j.id as journal_id,
					(SELECT group_concat(distinct volume_no order by volume_year SEPARATOR ',') FROM tbl_journal_volume where journal_id='$product' and status='A' and volume_year between $start and $access_for) as volume_no,
					(SELECT group_concat(distinct issue_f order by volume_year SEPARATOR ',') FROM tbl_journal_volume where journal_id='$product' and status='A' and volume_year between $start and $access_for) as start_issue,
					(SELECT group_concat(distinct issue_t order by volume_year SEPARATOR ',') FROM tbl_journal_volume where journal_id='$product' and status='A' and volume_year between $start and $access_for) as end_issue,
					(SELECT group_concat(distinct volume_year order by volume_year SEPARATOR ',') FROM tbl_journal_volume where journal_id='$product' and status='A' and volume_year between $start and $access_for) as volume_year
					, s.* ,c.customer_name, s.contact_person_name,j.journal_code ,ct.name, od.end_user, od.ip_address
					from tbl_order o left join tbl_order_detail od on o.id=od.order_no
					left join tbl_journal_volume jv on od.product=jv.journal_id
					left join tbl_journal j on jv.journal_id=j.id
					left join tbl_customer c on o.customer_id=c.id
					left join tbl_shipping_address s on od.shipment_address_id = s.id
					left join country ct on s.country = ct.count_id where j.id='$product' and o.id='$order_no' ";*/
			if($filter != ""){
			$query .= $filter;
			 }
				  $query .= ' order by j.id' ;
				 
				//echo $query."<br /><hr />";
				  $this->dbconn->SetQuery($query);

				  return $this->dbconn->LoadObjectList();

	}  // end function 

	/************************************************************************************ 									

						****  Display  List  of ebook module   *****
************************************************************************************/
	public function GetEbookList($filter="",$type,$pageno="",$pagesize=""){


			global $config;
			$this->dbconn = db::Singleton();

			$query = " select distinct od.* ,o.*, s.* , ev.* ,
						c.*, 
						e.ebook_title ,  ct.name, s.contact_person_name 
						from tbl_ebook_order_detail od 
						left join tbl_ebook_order o on od.order_no=o.id 
						left join tbl_customer c on o.customer_id=c.id 
						left join tbl_shipping_address s on od.shipment_address_id = s.id 
						left join tbl_ebook e on od.product = e.id 
						left join tbl_ebook_volume ev on od.volume = ev.id 
						
						left join country ct on c.country = ct.count_id 
						where  o.list_date !='0000-00-00' and o.status!='D' and o.order_cat=0
						and (od.print_online='$type' or od.print_online='printelectronic' ) ";
			$orderby = " order by o.invoice_no+0 desc ";
			if($filter != ""){
				$query .= $filter;
			} 
			$query .=$orderby;
			//print($query);
		
			$this->dbconn->SetQuery($query);
			if($pageno!=""){	
				return $this->dbconn->LoadObjectList($pageno,$pagesize);
			}else{
				return $this->dbconn->LoadObjectList();
			}

	}// END FUNCTION 
	
	public function GetBundleEbookList($filter="",$type,$pageno="",$pagesize=""){


			global $config;
			$this->dbconn = db::Singleton();

			$query = "select distinct o.*, s.* ,c.customer_name, s.contact_person_name,e.ebook_title ,e.eisbn, ct.name, od.end_user ,
						(select group_concat(distinct(ev.volume_year) order by ev.id) from tbl_ebook e
						left join tbl_ebook_volume ev on e.id=ev.ebook_id
						where e.id=od.product) as ebook_volume_year,
            			(select group_concat(distinct(ev.volume_no) order by ev.id) from tbl_ebook e
						left join tbl_ebook_volume ev on e.id=ev.ebook_id
						where e.id=od.product) as volume_no
						from tbl_ebook_order o
						left join tbl_customer c on o.customer_id=c.id
						left join tbl_ebook_order_detail od on o.id = od.order_no
						left join tbl_ebook e on od.product = e.id
						left join tbl_shipping_address s on od.shipment_address_id = s.id
						left join country ct on s.country = ct.count_id
						where o.order_cat!=0 and o.list_date !='0000-00-00' and o.status!='D'
						and (od.print_online='electronic' or od.print_online='printelectronic') ";
			$orderby = " order by o.invoice_no+0 desc ";
			if($filter != ""){
				$query .= $filter;
			} 
			$query .=$orderby;
			//print($query);
		
			$this->dbconn->SetQuery($query);
			if($pageno!=""){	
				return $this->dbconn->LoadObjectList($pageno,$pagesize);
			}else{
				return $this->dbconn->LoadObjectList();
			}

	}// END FUNCTION 

	/************************************************************************************ 									
						****  Export List  of Ebook module   *****
************************************************************************************/
	public function GetExportEbookList($type,$filter){
		global $config;
		$this->dbconn = db::Singleton();
		$query = " select distinct od.id as item_no, od.* ,o.*, s.* , ev.* ,
						 
						e.ebook_title ,ev.eisbn,
						ct.name, s.contact_person_name  
						from tbl_ebook_order_detail od 
						left join tbl_ebook_order o on od.order_no=o.id 
						left join tbl_customer c on o.customer_id=c.id 
						left join tbl_shipping_address s on od.shipment_address_id = s.id 
						left join tbl_ebook e on od.product = e.id 
						left join tbl_ebook_volume ev on od.volume = ev.id 
						left join country ct on c.country = ct.count_id 
						where  o.list_date !='0000-00-00' and o.status!='D' and
						(od.print_online='$type' or od.print_online='printelectronic' ) ";
			$orderby = " order by o.invoice_no+0 desc ";
			if($filter != ""){
			$query .= $filter;
			 }	
			$query .=$orderby;	  
				
		 $this->dbconn->SetQuery($query);
			 return $this->dbconn->LoadObjectList();


	}  // end functin 
	
	public function GetBundleExportEbookList($type,$filter){
		global $config;
		$this->dbconn = db::Singleton();
		$query = " select distinct o.*, s.* ,c.customer_name, s.contact_person_name,e.ebook_title ,e.eisbn, ct.name, od.end_user ,od.ip_address,
						(select group_concat(distinct(ev.volume_year) order by ev.id) from tbl_ebook e
						left join tbl_ebook_volume ev on e.id=ev.ebook_id
						where e.id=od.product) as ebook_volume_year,
            			(select group_concat(distinct(ev.volume_no) order by ev.id) from tbl_ebook e
						left join tbl_ebook_volume ev on e.id=ev.ebook_id
						where e.id=od.product) as volume_no
						from tbl_ebook_order o
						left join tbl_customer c on o.customer_id=c.id
						left join tbl_ebook_order_detail od on o.id = od.order_no
						left join tbl_ebook e on od.product = e.id
						left join tbl_shipping_address s on od.shipment_address_id = s.id
						left join country ct on s.country = ct.count_id
						where o.order_cat!=0 and o.list_date !='0000-00-00' and o.status!='D'
						and (od.print_online='electronic' or od.print_online='printelectronic') ";
			$orderby = " order by o.invoice_no+0 desc ";
			if($filter != ""){
			$query .= $filter;
			 }	
			$query .=$orderby;	  
				
		 $this->dbconn->SetQuery($query);
			 return $this->dbconn->LoadObjectList();


	}  // end functin 

		public function filter($arr,$print){

			extract($arr);
		//	print_r($arr);
			if($datef != "") {
			$datef2 = strftime("%Y-%m-%d",strtotime($datef));
			$datet2 = strftime("%Y-%m-%d",strtotime($datet));

			

			$filter .= " and  o.list_date between  '$datef2' and '$datet2 23:59:59'";

			//print $filter; die();

						}

		

			if($product !=""){

				$journal_volume = explode('_',$product);

	

				$product = $journal_volume[0];

	

				$volume = $journal_volume[1];

				

			$filter .=	"and j.id = '$product' and jv.id = '$volume' " ;

				

				 }

		

			if($oid != ""){	$filter .= "and o.invoice_no = $oid ";		}

		

			if($customer != ""){ $filter .= "and o.customer_id = '$customer'";}

		

		

		

			$type = 'print';

			$obj = new Report();

			

			 return $result = $obj->GetExportList($type,$filter);

		

	}  // end filter

	

	

	

	/************************************************************************************ 									

						****  Export List  P,PC List  Journal  *****

************************************************************************************/



		public function GetNotPaidList($filter="",$pageno="",$pagesize="",$orderby="order by o.id desc"){



		global $config;



		$this->dbconn = db::Singleton();



		//where  o.due_date < (now() - INTERVAL '30' DAY) ";

		$sql = "select  o.* ,c.customer_name ,c.customer_adress1, ct.customer_type , ot.order_type 

				from tbl_order o  left join tbl_customer c on c.id = o.customer_id 

				left join tbl_customer_type ct on c.customer_type = ct.id 

				left join tbl_order_type ot on o.order_type_id = ot.id

				where  1 and o.status!='D' ";



				

		if($filter!="") {  

		

			$sql .= $filter; 

			

		}

		$sql.= " ".$orderby; 
		
		
		$this->dbconn->SetQuery($sql);		
		return $this->dbconn->LoadObjectList($pageno,$pagesize);	

	} // end function
/************************************************************************************ 									
						****  Export List  P,PC List   Ebook *****
************************************************************************************/

		public function GetEbookPending($filter="",$pageno="",$pagesize="",$orderby="order by o.id desc"){
		global $config;
		$this->dbconn = db::Singleton();
		
		$sql = "select  o.* ,c.customer_name ,c.customer_adress1, ct.customer_type , ot.order_type 				from tbl_ebook_order o  
				left join tbl_customer c on c.id = o.customer_id 
				left join tbl_customer_type ct on c.customer_type = ct.id 

				left join tbl_order_type ot on o.order_type_id = ot.id
				where  1 and o.status!='D' ";

		if($filter!="") {  

			$sql .= $filter; 
		}
		$sql.= " ".$orderby; 
		$this->dbconn->SetQuery($sql);		
		return $this->dbconn->LoadObjectList($pageno,$pagesize);	
	} // end function


/************************************************************************************ 									
						****  Journal revenue*****
************************************************************************************/
		public function GetJournalRevenue($filter="",$pageno="1",$pagesize="15",$groupby=" group by d.product "){

		global $config;
		$this->dbconn = db::Singleton();
/*		
		$sql = "SELECT o.order_cat order_cat, j.id, journal_code, SUM( CASE WHEN order_cat IN (0) THEN d.total_price- ( (o.agent_discount/100) * d.total_price) ELSE d.total_price
		END) AS total_price
		FROM tbl_order o
		INNER JOIN tbl_order_detail d ON d.order_no = o.id
		INNER JOIN tbl_journal j ON j.id = d.product
		WHERE o.status !=  'D' ";
*/
		$sql = "   
					select j.id , journal_code ,
					sum(d.total_price- ( (o.agent_discount/100) * d.total_price) ) as total_price  				
					from tbl_order o 
					inner join tbl_order_detail d on d.order_no = o.id
					inner join tbl_journal j on j.id = d.product 
					where o.status != 'D' 	
					";
					
		if($filter!="") {  
			$sql .= $filter; 
		}
		$sql.= " ".$groupby; 
		//print($sql."<hr>");  //exit;
		$this->dbconn->SetQuery($sql);		
		$result = $this->dbconn->LoadObjectList($pageno,$pagesize);
		return $result;	
	} // end function

/************************************************************************************ 									
						****  gET JOURNAL SUBCRIPTION*****
************************************************************************************/

	public function GetJournalSubscriptionReport($filter="",$pageno="",$pagesize=""){

		global $config;
		
		$this->dbconn = db::Singleton();

		$query = " select j.id,j.journal_title,

					count(case when od.print_online = 'print' then od.print_online end)  AS print_count,
										
					count(case when od.print_online = 'electronic' then od.print_online end)  AS electronic_count,
										
					count(case when od.print_online = 'both' then od.print_online end)  AS both_count				
										
					from tbl_journal j 
										
					left join tbl_order_detail od on od.product=j.id 
										
					left join tbl_order o on o.id=od.order_no
										
					where o.list_date!='0000-00-00 00:00:00' and o.status!='D'
										
					 ";		

		$orderby = 	" group by j.id order by j.journal_title " ;

		if($filter != ""){				

			$query .= $filter;		

		}	
			$query .=$orderby;				
		//print($query); 
		//die;
		$this->dbconn->SetQuery($query);
		if($pageno!=""){	
			
			return $this->dbconn->LoadObjectList($pageno,$pagesize);

		}else{
			
			return $this->dbconn->LoadObjectList();

		}

		
	}//GetJournalSubscriptionReport


/************************************************************************************ 									
						****  gET JOURNAL SUBCRIPTION BREAK UP REPORT *****
************************************************************************************/
	
	
	public function GetJournalSubscriptionBreakUpReport($filter="",$pageno="",$pagesize=""){

		global $config;
		
		$this->dbconn = db::Singleton();

		$query = " select j.id,j.journal_title,

					count(case when od.print_online = 'print' then od.print_online end)  AS print_count,										
					count(case when od.print_online = 'electronic' then od.print_online end)  AS electronic_count,										
					count(case when od.print_online = 'both' then od.print_online end)  AS both_count,
					
					count(case when od.price_class = 'personal' and od.print_online = 'print' and od.end_user=o.customer_id then od.price_class end)  AS personal_print_count,
					count(case when od.price_class = 'personal' and od.print_online = 'electronic' and od.end_user=o.customer_id then od.price_class end)  AS personal_electronic_count,
					count(case when od.price_class = 'personal' and od.print_online = 'both' and od.end_user=o.customer_id then od.price_class end)  AS personal_both_count,
					
					count(case when od.price_class = 'academic' and od.print_online = 'print' and od.end_user=o.customer_id then od.price_class end)  AS academic_print_count,
					count(case when od.price_class = 'academic' and od.print_online = 'electronic' and od.end_user=o.customer_id then od.price_class end)  AS academic_electronic_count,
					count(case when od.price_class = 'academic' and od.print_online = 'both' and od.end_user=o.customer_id then od.price_class end)  AS academic_both_count,
					
					count(case when od.price_class = 'institutional' and od.print_online = 'print' and od.end_user=o.customer_id then od.price_class end)  AS institutional_print_count,
					count(case when od.price_class = 'institutional' and od.print_online = 'electronic' and od.end_user=o.customer_id then od.price_class end)  AS institutional_electronic_count,
					count(case when od.price_class = 'institutional' and od.print_online = 'both' and od.end_user=o.customer_id then od.price_class end)  AS institutional_both_count,
															
					count(case when od.price_class = 'academic' and od.print_online = 'print' and od.end_user!=o.customer_id then od.price_class end)  AS agent_academic_print_count,
					count(case when od.price_class = 'academic' and od.print_online = 'electronic' and od.end_user!=o.customer_id then od.price_class end)  AS agent_academic_electronic_count,
					count(case when od.price_class = 'academic' and od.print_online = 'both' and od.end_user!=o.customer_id then od.price_class end)  AS agent_academic_both_count,
										
					count(case when od.price_class = 'institutional' and od.print_online = 'print' and od.end_user!=o.customer_id then od.price_class end)  AS agent_institutional_print_count,
					count(case when od.price_class = 'institutional' and od.print_online = 'electronic' and od.end_user!=o.customer_id then od.price_class end)  AS agent_institutional_electronic_count,
					count(case when od.price_class = 'institutional' and od.print_online = 'both' and od.end_user!=o.customer_id then od.price_class end)  AS agent_institutional_both_count
										
					from tbl_journal j 
										
					left join tbl_order_detail od on od.product=j.id 
										
					left join tbl_order o on o.id=od.order_no
										
					where o.list_date!='0000-00-00 00:00:00' and o.status!='D'
										
					 ";		

		$orderby = 	" group by j.id order by j.journal_title " ;

		if($filter != ""){				

			$query .= $filter;		

		}	
			$query .=$orderby;				
		//print($query); 
		//die;
		$this->dbconn->SetQuery($query);
		if($pageno!=""){	
			
			return $this->dbconn->LoadObjectList($pageno,$pagesize);

		}else{
			
			return $this->dbconn->LoadObjectList();

		}

		
	}//GetJournalSubscriptionBreakUpReport

/************************************************************************************ 									
						****  gET Ebook Renvenue Report*****
************************************************************************************/

	public function GetEbookRevenue($filter="",$pageno="1",$pagesize="15",$groupby=" group by od.product "){
		
		global $config;
		$this->dbconn = db::Singleton();

		$sql = "  select e.id,e.ebook_title, 

			sum( od.total_price - ( (o.agent_discount/100) * od.total_price) ) as total_price , 
						sum(od.shipping_charges) as shipping_charges 
						from tbl_ebook_order o 
						inner join tbl_ebook_order_detail od on o.id = od.order_no 
						inner join tbl_ebook e on od.product = e.id where o.status != 'D'
					 ";
					 
					 
		

		if($filter!="") {  

			$sql .= $filter; 
			}
		$sql.= " ".$groupby; 
	//print($sql."<hr>");  
//	exit;
		
		$this->dbconn->SetQuery($sql);		
		$result = $this->dbconn->LoadObjectList($pageno,$pagesize);

		return $result;	
	
	}//end function 
	
	
	public function GetJournalByCollection($filter=""){
		
		
		global $config;
		$this->dbconn = db::Singleton();
		
		$query = "SELECT distinct t.order_no,product, bt.access_for, bt.complimentry_start, bt.complimentry_end, o.list_date,bt.end_user,bt.shipment_address_id
					FROM tbl_order_detail t
					join tbl_order_bundle_detail bt on t.collection_id = bt.collection_id
					join tbl_order o on t.order_no=o.id where o.order_cat!=0 and o.list_date !='0000-00-00'
				 	and (t.print_online='electronic' or t.print_online='both') ";
					
		
		if($filter!="") {  

			$query .= $filter; 
			}
		//echo $query."<br /><br />";
		$this->dbconn->SetQuery($query);		
		$result = $this->dbconn->LoadObjectList();

		return $result;	
		
	}

} // end of class 


?>