<?
	include("../classes/common.class.php"); 

	$bid_id = $_REQUEST["bid_id"];
	
	$dbconn=db::singleton();
	
	$USER_ID = $_SESSION["sess_admin_id"];
	
	$query="select bd.load_id, bd.no_of_truck, bd.bid_amount, lp.job_type, u.name, tt.truck_type_name  from tbl_bid  bd
			inner join load_post lp on lp.load_id = bd.load_id
			inner join truck_type tt on tt.truck_type_id = lp.truck_type_id
			inner join user u on u.user_id = bd.user_id
	
		where bd.bid_id = ".$bid_id;
	
	$dbconn->SetQuery($query);
	$data = $dbconn->LoadObject();
	
	$ins_html = "";
	
	if(!empty($data))
	{
		$load_id = $data->load_id; 
		$no_of_truck = $data->no_of_truck; 
		$bid_amt = $data->bid_amount; 
		$insurance_rate = $config['insurance_rate'];
		
		$ins_html = "
				<table class='table table-bordered'>
					<thead>
						<th> Job Type</th>
						<th> Transporter </th>
						<th> Truck Type </th>
					</thead>
					<tbody>
						<tr>
							<td> ".$data->job_type." </td>
							<td> ".$data->name." </td>
							<td> ".$data->truck_type_name." </td>
						</tr>
					</tbody>
				</table>
				";
				
		$load_query ="select *  from load_post_details  lpd
			inner join tbl_loadpickup_point lp on lp.pickup_id = lpd.pickup_id and lp.status='Active'
			where lpd.lpd_status='Active' and lpd.load_id = ".$load_id;
		
		$dbconn->SetQuery($load_query);
		$result = $dbconn->LoadObjectList();
		
		//print_r($result); die;
		
		$pickup_html = "";
		if(!empty($result))
		{
			$pickup_html = "
				<table class='table table-bordered'>
					<thead>
						<th> Goods Type </th>
						<th> Goods Price </th>
						<th> Weight </th>
						<th> PickUp Location </th>
						<th> Drop Location </th>
					</thead>
					<tbody> ";
			
			$total_goods_price = 0;
			foreach($result as $res)
			{
				$total_goods_price = $total_goods_price + $res->total_price;
				
				$pickup_html .= "
					
					<tr>
						<td> ".$res->goods_type." </td>
						<td> ".$res->total_price." </td>
						<td> ".$res->total_luggage." </td>
						<td> ".$res->load_to." </td>
						<td> ".$res->load_from." </td>
					</tr>
					";
			}
			
			$pickup_html .= "
							<tr>
								<td colspan='5'><b>Total Goods Price: </b> ".$total_goods_price."</td>
							</tr>
						";
			
			$pickup_html .= " </tbody>
					</table>";
		}
		
		$res_html = "<div class='row'>
						
						<div class='col-md-5' style='padding-top: 5px;'>
							<b>Enter Insurance Cover Percentage:</b> 
						</div>
						<div class='col-md-2'>
							<input type='number' name='txt_insu' id='txt_insu' value='' class='form-control'>
							
							<input type='hidden' name='HdnUserId' id='HdnUserId' value='$USER_ID'>
							<input type='hidden' name='HdnLoadId' id='HdnLoadId' value='$load_id'>
							<input type='hidden' name='HdnNoOfTruck' id='HdnNoOfTruck' value='$no_of_truck'>
							<input type='hidden' name='HdnBidId' id='HdnBidId' value='$bid_id'>
							<input type='hidden' name='HdnBidAmt' id='HdnBidAmt' value='$bid_amt'>
							<input type='hidden' name='HdnGoodsAmt' id='HdnGoodsAmt' value='$total_goods_price'>
							<input type='hidden' name='HdnInsuCover' id='HdnInsuCover' value=''>
							<input type='hidden' name='HdnInsuAmt' id='HdnInsuAmt' value=''>
							<input type='hidden' name='HdnInsuRate' id='HdnInsuRate' value='$insurance_rate'>
						</div>
						<div class='col-md-5' id='divInsuAmt' style='padding-top: 5px; display:none;'>
							<b>Insurance Amount: </b> <span id='InsuranceDiv'> </span>
						</div>
						
				";
		
		
	}
	
	echo $ins_html."<br>".$pickup_html."<br>".$res_html ;
	
?>