<?php
          $load = Load::getDetailLoadList($_SESSION["sess_admin_id"],'Active');
          include("rem_sorting.css"); ?>

<style type="text/css">
 body{
    padding:0 !important;
  }
</style>
    
    <div class="breadcrumbs">
    <div class="col-sm-4">
    <div class="page-header float-left">
    <div class="page-title">
         <h1>Pending Jobs List</h1>
    </div>
    </div>
    </div>
    
    <div class="col-sm-8">
    <div class="page-header float-right">
    <div class="page-title">
        <ol class="breadcrumb text-right">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active">Pending Jobs List</li>
        </ol>
    </div>
    </div>
    </div>
    </div>
    
    <div class="content mt-3">
    <div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="p-3 mb-2 bg-info text-white">
          <button type="button" class="alert alert-primary btn-sm float-right" onclick="location.href='add_load.php';"><i class="fa fa-plus"></i>&nbsp; Create New Job</button>
    </div>
    <div class="card-body  table-responsive">
         <table id="table1" class="table table-striped table-bordered table1">
              <thead>
                    <tr class="bg-info text-white">
                      <th width="9%" >Load ID</th>
                      <th width="13%" >Truck Type</th>
                      <th width="13%">Load Date</th>
                      <th class="a-n b-n" width="13%">View</th>
                      <!-- <th class="a-n b-n" width="10%">Action</th> -->
                    </tr>
              </thead>
        <tbody>
        <?php 
        if($load) {
          foreach($load as $val){ ?> 
          <tr> 
            <td> <?php echo "LP-".$val->load_id;?>   </td> 
            <td><strong> <?php echo $val->truck_type_name;?> </strong> </td>
            <td> <?php echo $val->load_date;?>       </td> 
            <td>
            <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#<?=$val->load_id?>" >Details
            </button>

<!-- *************************************************************************************************** -->
<!--                                  Model Open in Button Click                                         -->
<!--  ************************************************************************************************** -->

            <div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="mediumModalLabel"><b> Pending Jobs  Details</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12">
            <div class="row">        
            <div class="col-md-12" style="margin-top: 12.5px">
            <div class="col-md-12" style="margin-top: 12.5px">
            <div class="row mt-12 mt-2 ">
                        
<!-- ====================================================================================================== 
                            If  Pick-Up Location is Single then Active
    ======================================================================================================  -->

         <?  $i = 0;
             $len = count($val->load_detail);
             if($len == 1){           
             foreach ($val->load_detail as $item) { ?>
            
           <div class="col-sm-12 text-center"><strong><u>PickUp Location</u></strong></div>     
           <div id="single_iteration_pickUp_<?=$val->load_id;?>" >

           <div class="col-md-4 bg-light p-2 mt-3 text-center"> Pick-Up Location :</div>  
           <div class="col-md-8 text-center  p-2 mt-3"><b><?=$item->load_to?></b></div>
           <div class="col-md-4 bg-light p-2   text-center"> Job Type :</div>
           <div class="col-md-8 text-center  p-2 "><b><?=$item->job_type?></b></div>
           
             <?if($item->job_type =="Import" || $item->job_type=="Export"){?>  
        
           <div class="col-md-4 text-center bg-light p-2"> Agent Name :</div>
              <? if(!empty($item->agent_name)){?>
                <div class="col-md-8 text-center p-2"><b><?=$item->agent_name?></b></div>
           <?   }else { ?>
             <div class="col-md-8 text-center p-2"><b>----</b></div>
            <?} }?>
           <div class="col-md-4 text-center bg-light p-2"> Agent Mobile No:</div>
           <? if(!empty($item->agent_mobile_no)){?>
           <div class="col-md-8 text-center p-2"><b><?=$item->agent_mobile_no?></b></div>           
          <? }else { ?>
             <div class="col-md-8 text-center p-2"><b>----</b></div>
            <?}?>                          
           
           <div class="col-md-4 text-center bg-light p-2"> Goods Type</div>
           <div class="col-md-8 text-center   p-2 " ><b><?=$item->goods_type?></b></div>
           <div class="col-md-4 text-center bg-light p-2"> Brand Name</div>
           <div class="col-md-8 text-center   p-2  " ><b><?=$item->brand_name?></b></div>
           <div class="col-md-4 text-center bg-light p-2"> No of Packages :</div>
           <div class="col-md-8 text-center   p-2  " ><b><?=$item->no_of_packages?></b></div>
           <div class="col-md-4 text-center bg-light p-2"> Total Weight of Goods :</div>
           <div class="col-md-8 text-center p-2"><b><?=$item->total_luggage?></b></div>   
           <div class="col-md-4 text-center bg-light p-2"> Total Weight of Unit:</div>
           <div class="col-md-8 text-center p-2"><b><?=$item->luggage_unit?></b></div>      
           <div class="col-md-4 text-center bg-light p-2"> Package Type:</div>
           <div class="col-md-8 text-center p-2"><b><?=$item->package_type?></b></div>      
           <div class="col-md-4 text-center bg-light p-2"> Officer Name :</div>
           <div class="col-md-8 text-center p-2"><b><?=$item->destination_name?></b></div>  
           <div class="col-md-4 text-center bg-light p-2"> Contact No :</div>
           <div class="col-md-8 text-center p-2"><b><?=$item->destination_contactno?></b></div>
           <div class="col-md-4 text-center bg-light p-2"> Security Code :</div>
           <?$code = $item->security_code;?>
           <div class="col-md-8 text-center  p-2"><b><?=substr($code, 0, 6);?></b></div>      
           <?$i++;?>
           </div>

<!-- ==================================================================================================== -->
                    
         <?} } else {?>
  
           <script>   
             document.getElementById("single_iteration_pickUp_<?=$val->load_id;?>").style.display="none";
          </script>
          <div class="col-sm-4 text-center"><strong> Please Select  </strong></div> 
              <select class="col-md-7 form-control mr-3 " style="height: 35px;" onchange="showPickUp(<?=$val->load_id;?>,this.value)" id="slct_id1">
                  <option value="" disabled selected >Select Pick-Up Points</option>
                  <?foreach($val->load_detail as $row3){?>                  
                  <option value="<?=$row3->load_detail_id?>"><?=$row3->load_to?></option>
                  <?}?>
              </select> 
          
          <div id="txtHint_<?=$val->load_id;?>"></div>
          <?} ?>                        
          </div>
      </div>

<!--  =============================== Destination ==================================================== -->
                  
      <div class="col-sm-12 text-center mt-4"><strong><u>Destination Location</u></strong></div> 
      <div class="row mt-12 mt-2">
        <?
        $j = 0;
        $len = count($val->pickup_detail);    
        if($len == 1){
        foreach ($val->pickup_detail as $row2) {

         ?>
      
      <div id="single_iteration_destination_<?=$val->load_id;?>">

      <div class="col-md-4 text-center bg-light p-2 mt-3"> Destination  :</div>
      <div class="col-md-8 text-center p-2 mt-3"><b><?=$row2->load_from?></b></div>  
      <div class="col-md-4 text-center bg-light p-2 "> Receiver Email :</div>
        <? if(!empty($row2->source_email)){?>
      <div class="col-md-8 text-center p-2 "><b><?=$row2->source_email?></b></div>  
        <?}else {?>
      <div class="col-md-8 text-center p-2"><b>----</b></div>  
         <?}?>
      <div class="col-md-4 text-center bg-light p-2"> Receiver Name :</div>
         <? if(!empty($row2->source_name)){?>
      <div class="col-md-8 text-center p-2"><b><?=$row2->source_name?></b></div>  
         <?} else {?>
      <div class="col-md-8 text-center p-2"><b>----</b></div>  
        <?}?>                        
      <div class="col-md-4 text-center bg-light p-2"> Contact No :</div>
        <? if(!empty($row2->source_contactno)){?>        
      <div class="col-md-8 text-center p-2"><b><?=$row2->source_contactno?></b></div>      
        <?}else {?>
      <div class="col-md-8 text-center p-2 mt-3"><b>----</b></div>       
        <?}?>        
 
      <div class="col-md-4 text-center bg-light p-2"> Drop Weight :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->weight_drop?></b></div>  
      <div class="col-md-4 text-center bg-light p-2"> No of Packages :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->no_of_packages?></b></div>  
      <div class="col-md-4 text-center bg-light p-2"> Weight  :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->weight?></b></div>  
      <div class="col-md-4 text-center bg-light p-2"> Total Luggage :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->total_luggage?></b></div>  
      <div class="col-md-4 text-center bg-light p-2"> Unit :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->luggage_unit?></b></div>
      <div class="col-md-4 text-center bg-light p-2"> Package Type :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->package_type?></b></div>  
      <div class="col-md-4 text-center bg-light p-2"> Target Price :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->target_price?></b></div>  
      <div class="col-md-4 text-center bg-light p-2"> Receiver Name :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->destination_name?></b></div>  
      <div class="col-md-4 text-center bg-light p-2"> Contact No :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->destination_contactno?></b></div>
      <div class="col-md-4 text-center bg-light p-2"> Goods Type :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->goods_type?></b></div>  
      <div class="col-md-4 text-center bg-light p-2"> PickUp Point :</div>
      <div class="col-md-8 text-center p-2"><b><?=$row2->load_to?></b></div> 
      <div class="col-md-4 text-center bg-light p-2"> Security Code :</div>
        <? if(!empty($row2->security_code)){
        $code = $row2->security_code;?>                                        
      <div class="col-md-8 text-center p-2"><b><?=substr($code, 0, 6);?></b></div>      
        <?}else {?>
      <div class="col-md-4 text-center p-2 mt-3"><b>----</b></div>        
        <?}?> 
      </div>
      <?} }else {?>

      <script>   
          document.getElementById("single_iteration_destination_<?=$val->load_id;?>").style.display="none";
      </script>
                              
      <div class="col-sm-4 text-center mt-2"><strong> Please Select </strong></div> 
        <select class="col-md-7 form-control mr-4 mt-2" style="height: 35px;" onchange="showDestinaiton(<?=$val->load_id;?>,this.value)" id="slct_id1">
           <option value="" disabled selected >Select Destination Points</option>
           <?foreach($val->pickup_detail as $row3){?>                  
           <option value="<?=$row3->pickup_id?>"><?=$row3->load_from?></option>
           <?}?>
        </select> 

      <div id="destination_model_<?=$val->load_id;?>"></div>
      <? }?>
      </div>
      </div>
      </div>                    
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
      </div>

<!--            ------------- Model Close --------------------------------------------------------- -->
      </td>
      <!-- <td>
      <a href="#" class="on-default edit-row text-primary" title="Edit"><i class="fa fa-pencil"></i></a>
      <a href="#" class="on-default remove-row text-danger ml-3" title="Delete"><i class="fa fa-trash-o"></i></a>

      </td> -->
      </tr>
      <?} }?>
      </tbody>
      </table>
    
    </div>
    </div>
    </div>
    </div>
    </div>

   

 <script type="text/javascript">
    function showPickUp(id,val) {

    if (id == "") {
        document.getElementById("txtHint_"+id).innerHTML = "";
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
                document.getElementById("txtHint_"+id).innerHTML = this.responseText;
             
            }
        };
        xmlhttp.open("GET","includes/pending_detailspp.php?q="+val,true);
        xmlhttp.send();
    }
}


</script>

 <script>
  
    function showDestinaiton(id,val) {
  
  console.log(id,val);
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
        xmlhttp.open("GET","includes/pend_details_ds.php?q="+val,true);
        xmlhttp.send();
    }
}


</script>
<script src="../assets/js/lib/data-table/datatables.min.js"></script>
<script type="text/javascript">
  

    $(document).ready( function () 
        {
            $('#table1').DataTable
             ({
               
                "language": {"emptyTable":  "<center>No Pending Jobs Available </center>"}
             });
           
            
        } );         
</script>