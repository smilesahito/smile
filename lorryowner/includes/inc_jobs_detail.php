<?php  include("laodpost_style.css");
	
	$job_detail = LorryOwner::getloaddetail($job_id);
 ?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  
}

td, th {
  text-align: left;
  padding: 8px;
}
</style>

	<div class="card" style="background-image: linear-gradient(to left, #209bd6, #2b87b7, #307398, #31607b, #304d5f);" class="btn btn-primary col-md-12;">
		<span class="pull-right"><i onclick="window.history.back();" style="color: white;padding: 15px" class="fa  fa-arrow-left"></i></span>
	</div>

	<div class="content ">
	<div class="row">
	<div class="col-md-12">  
	<div class="tab-content">
   			
	<?php foreach ($job_detail as $row) {	 ?>	
	<div class="card" style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);border-radius: 25px;">
	<div class="card-header" style="border-radius: 25px;">
		<img  class="float-left ml-3" src="../images/truck_img.png" width="30px" height="25px" > 
		<span  class="float-left ml-3" style="color: black;margin-left: 3px;"><strong><?=$row->truck_type_name?></strong></span>
		<span class="float-right mr-3"><b><?=$row->datetime?></b></span>
	</div>

	<div class="card-body">
		<table>
			<span style="color:#16B0BE" class="pull-right"><strong>تفصيلات</strong></span><br>
			<tr>
				<td><strong> Job Type</strong></td>
				<td> </td>
				<td> </td>
				<td><b><?=$row->job_type?></b></td>
			</tr>
			<?if(!empty($row->agent_name)){?>
			<tr>
				<td><strong> Agent Name</strong></td>
				<td> </td>
				<td> </td>
				<td><b><?=$row->agent_name?></b></td>
			</tr>
			<tr>
				<td><strong> Agent Mobile No </strong></td>
				<td> </td>
				<td> </td>
				<td><b><?=$row->agent_mobile_no?></b></td>
			</tr>
			<?}?>	
			<tr>	
				<td><strong> Truck Name</strong></td>
				<td> </td>
				<td> </td>
				<td><strong><?=$row->truck_type_name?></strong></td>
				</tr>
				<tr>
				<td><strong> Expected Price</strong></td>
				<td> </td>
				<td> </td>
				<td><strong><?=$row->expected_price?></strong></td>
				</tr>
				<tr>
				<td><strong>Truck Capacity</strong></td>
				<td> </td>
				<td> </td>
				<td><strong><?=$row->truck_capacity?></strong></td>
			</tr>

			<tr>
				<td><strong>Required Truck </strong></td>
				<td> </td>
				<td> </td>
				<td><strong><?=$row->remaining_truck?></strong></td>
			</tr>
				 
				  
		</table>
		<hr>
				<!-- load from -->

		
<!-- 		<table>
			<br>
			<span style="color:#16B0BE" class="pull-right"><strong> جھاں سے سامان اٹھانا ھے  </strong></span>
			<?php $i=0; 
			foreach($row->load_detail as $pickup_row){ 
			?>
		    <tr>
		    	<td>
		    		<span class="badge badge-success"><?=++$i?></span></td>
			</tr>
			<tr>
		 		<td><strong>From</strong></td>
		    	<td> </td>
		    	<td> </td>
		    	<td><?=$pickup_row->load_to?></td>
		  	</tr>		
		    <tr>
			    <td><strong>Goods Type</strong></td>
			    <td> </td>
			    <td> </td>
			    <td><?=$pickup_row->goods_type?></td>
		     </tr>
			  <tr>
			  	 <tr>
			    <td><strong>Total Luggage</strong></td>
			    <td> </td>
			    <td> </td>
			    <td><?=$pickup_row->total_luggage?></td>
			  </tr>
			  <tr>
			  	 <tr>
			    <td><strong>Total Weight of Unit</strong></td>
			    <td> </td>
			    <td> </td>
			    <td><?=$pickup_row->luggage_unit?></td>
			  </tr>
			  <tr>
			    <td><strong>Officer Name</strong></td>
			    <td> </td>
			    <td> </td>
			    <td><?=$pickup_row->destination_name?></td>
			  </tr>
				  
				  <tr>
				    <td><strong>Mobile Number</strong></td>
				    <td> </td>
				    <td> </td>
				    <td><?=$pickup_row->destination_contactno?></td>
				  </tr>
				 
				 <?php } ?>
				
				</table>
				<hr> -->

	<!-- 			<table>
					<span style="color:#16B0BE" class="pull-right"><strong> جھاں سامان لے جانا ھے </strong></span>
					<br>
				 <?php $i=0; 
				 	
				 	foreach($row->pickup_detail as $laod_row){ 
				  	 
				  ?>

				  <tr><td><span class="badge badge-success"><?=++$i?></span></td>
				    </tr>
				 <tr>
				 	<td><strong>TO</strong></td>
				    <td> </td>
				    <td> </td>
				    <td><?=$laod_row->load_from?></td>
				  </tr>		
				  <tr>
				    <td><strong>Person Name</strong></td>
				    <td> </td>
				    <td> </td>
				    <td><?=$laod_row->source_name?></td>
				  </tr>
				  
				  <tr>
				    <td><strong>Mobile Number</strong></td>
				    <td> </td>
				    <td> </td>
				    <td><?=$laod_row->source_contactno?></td>
				  </tr>
				 
				 <?php } ?>
				
				</table>
				 -->
                

<!-- ---------------------------------------------------------------- -->


               <div class="row">        
                  <div class="col-md-12" style="margin-top: 7.5px">
                  <div class="row">
                  <div class="row1 col-md-12">
                  
                   <h5 class="w-100 pb-2 ml-5"><b>Pick-Up Details </b>
                  	<span style="color:#16B0BE" class="pull-right mr-5"><strong> جھاں سے سامان اٹھانا </strong>ھے  
                 
                   </h5>
                   </div>	
                   <div class="col-md-4 bg-light p-2 mt-3"><center><b>SELECT PickUp :</b></center></div>
                  
                    <select class="col-md-6 form-control ml-2 mt-3" style="height: 35px;" onchange="showDestinationDetails(this.value,<?echo $row->load_id;?>)" id="slct_id2">
                      <option value="" disabled selected >Select Pick-up Points</option>
                      <?foreach($row->load_detail as $row2){?>                  
                      <option value="<?=$row2->load_detail_id?>"><?=$row2->load_to?></option>
                      <?}?>
                 </select>  

                  

                  <div id="txtHint_<?=$row->load_id;?>">

                  </div> 

                  </div>
                  </div>
                  </div> 


                  <!-- ***************************** Destination Details ************************* -->
                  <hr>

               <div class="row" style="margin-top: 35px;">        
                  <div class="col-md-12 " >
                  <div class="row">
                  <div class="row1 col-md-12">
                  
                   <h5 class="w-100 pb-2 ml-5"><b>Drop-Off Details </b>
                  		<span style="color:#16B0BE" class="pull-right mr-5"><strong> جھاں سامان لے جانا ھے </strong></span>
                 
                   </h5>
                   </div>	

                   <div class="col-md-4 bg-light p-2 mt-3"><center><b>SELECT Drop :</b></center></div>
                  
                    <select class="col-md-4 form-control ml-2 mt-3" style="height: 35px;" onchange="showPickUp(this.value,<?echo $row->load_id;?>)" id="slct_id2">
                      <option value="" disabled selected >Select Drop Points</option>
                      <?foreach($row->pickup_detail as $row2){?>                  
                      <option value="<?=$row2->pickup_id?>"><?=$row2->load_from?></option>
                      <?}?>
                 </select>  

                  

                  <div id="pickup_<?=$row->load_id;?>" class="col-md-12">

                  </div> 

                  </div>
                  </div>
                  <hr>
                  </div> 

<!-- -------------------------------------------------------------------- -->


           <?php } ?> 
           </div>
				<span style="text-align: center">
           		<form action="bid_job.php" method="GET">
					<input type="hidden" name="job_id" value="<?=$job_id?>">
					<input type="hidden" name="go_id" value="<?=$go_id?>">
					<input type="hidden" name="truck" value="<?=$row->remaining_truck?>">
					<input type="hidden" name="lo_id" value="<?=$lo_id?>">
					<button type="submit" style="background-image: linear-gradient(to left, #209bd6, #2b87b7, #307398, #31607b, #304d5f);border-radius: 25px;  width:95%;" class="btn btn-primary col-md-12;"><strong>بولی لگائیں</strong>
					</button>

            	</form>
            	<br>
            	</span>
            </div>
      </div>
 </div>


          

 
<script>
	function showDestinationDetails(str,div_id) {
		console.log(str,div_id);
			if (str == "") {
			document.getElementById("txtHint_"+div_id).innerHTML = "";
			return;
			} else { 
				if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
			} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			document.getElementById("txtHint_"+div_id).innerHTML = this.responseText;
			}
			};

		// xmlhttp.open("GET","http://lorrynlorry.xolva.com/lorryowner/includes/destintn_details.php?q="+str,true);
		xmlhttp.open("GET","includes/destintn_details.php?q="+str,true);
		xmlhttp.send();
		}
	}
</script>       


<script>

    function showPickUp(str,div_id) {
    
    if (str == "") {
        
        document.getElementById("pickup_"+div_id).innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("pickup_"+div_id).innerHTML = this.responseText;
            }
        };

     
        // xmlhttp.open("GET","http://lorrynlorry.xolva.com/lorryowner/includes/pickup_details.php?q="+str,true);
        xmlhttp.open("GET","includes/pickup_details.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>