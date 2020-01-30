<?php 
   
   include("../../classes/common.class.php"); 



    extract($_REQUEST);
   
  
    extract($_REQUEST);
 
    $data = Load::LoadDestinationDetail($q); 

     foreach ($data as $row2) {?>

       <div class="col-md-4 bg-light p-2"> Job Type :</div>
       <div class="col-md-8 p-2"><?=$row2->job_type?></div>
       <?if($row2->job_type =="Import" || $row2->job_type=="Export"){?>  
       <div class="col-md-4 bg-light p-2"> Agent Name :</div>
       <?if(empty($row2->agent_name)){?>
            <div class="col-md-8 p-2">---</div>       
        <?}else {?>
       <div class="col-md-8 p-2"><?=$row2->agent_name?></div>       
       <?}?>
       <div class="col-md-4 bg-light p-2"> Agent Mobile No:</div>
       <?if(empty($row2->agent_name)){?>
            <div class="col-md-8 p-2">---</div>       
        <?}else {?>
       <div class="col-md-8 p-2"><?=$row2->agent_mobile_no?></div>
       <?} }?>     
       <div class="col-md-4 bg-light p-2"> Goods Type</div>
       <div class="col-md-8 p-2"><?=$row2->goods_type?></div>
       <div class="col-md-4 bg-light p-2"> No of Packages :</div>
       <div class="col-md-8 p-2"><?=$row2->no_of_packages?></div>             
       <div class="col-md-4 bg-light p-2"> Total Weight of Goods :</div>
       <div class="col-md-8 p-2"><?=$row2->total_luggage?></div>   
       <div class="col-md-4 bg-light p-2"> Total Weight of Unit:</div>
       <div class="col-md-8 p-2"><?=$row2->luggage_unit?></div>      
       <div class="col-md-4 bg-light p-2"> Package Type:</div>
       <div class="col-md-8 p-2"><?=$row2->package_type?></div>      
     
       <div class="col-md-4 bg-light p-2"> Expected Price :</div>
       <div class="col-md-8 p-2"><?=$row2->expected_price?></div>      
       <div class="col-md-4 bg-light p-2"> Total Price:</div>
       <div class="col-md-8 p-2"><b><?=$row2->total_price?></b></div>
      
       <div class="bg-warning col-md-12 mt-4 text-center  text-white p-2"><h4>Driver Details</h4></div>
                       
       <? $data1 = Load::fetch_dd_Compelte($row2->load_detail_id);
                
         foreach ($data1 as $row3) {

          $D_extra_details = Load::fetch_Driver_Extra_Details($row3->owner_id,$row3->driver_id,$row3->truck_type_id);
         foreach ($D_extra_details as $row4) {?>
         
        <div class="col-md-4 bg-light p-2"><b>Receipt#</b></div>
        <div class="col-md-8"><b><?=$row2->load_id?></b></div><div class="col-md-12 "></div> 

        <div class="col-md-4 bg-light p-2">Driver Name :</div>
        <div class="col-md-8"><?=$row4->driver_name?></div><div class="col-md-12 "></div>

        <div class="col-md-4 bg-light p-2">Driver Contact No :</div>
        <div class="col-md-8"><?=$row4->driver_contct_no?></div><div class="col-md-12"></div>

        <div class="col-md-4 bg-light p-2">Truck Name :</div>
        <div class="col-md-8"><?=$row4->truck_name?></div><div class="col-md-12"></div>

        <div class="col-md-4 bg-light p-2 ">Truck Current Load :</div>
        <div class="col-md-8"><?=$row3->truck_current_load?></div><div class="col-md-12"></div>

        <div class="col-md-4 bg-light p-2">Deliver Load :</div>
        <div class="col-md-8"><?=$row3->return_weight?></div><div class="col-md-12"></div>

        <div class="col-md-4 bg-light p-2">Transporter Name :</div>
        <div class="col-md-8"><?=$row4->Owner_name?></div><div class="col-md-12"></div>

        <div class="col-md-4 bg-light p-2">Contact No :</div>
        <div class="col-md-8"><?=$row4->Owner_contct_no?></div><div class="col-md-12"></div>

<?php } } }?>


 <script>
  
    function showDestinaiton(id) {

    if (id == "") {
        document.getElementById("destination_model_"+id).innerHTML = "";
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
                document.getElementById("destination_model_"+id).innerHTML = this.responseText;
             
            }
        };
        xmlhttp.open("GET","includes/pend_details_ds.php?q="+id,true);
        xmlhttp.send();
    }
}


</script>