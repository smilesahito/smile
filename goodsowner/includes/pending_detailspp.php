<?php 
   
   include("../../classes/common.class.php"); 


    extract($_REQUEST);
   

    $data = GoodsOwner::fetch_PendingDetails_PP($_REQUEST['q']); 
   
     foreach ($data as $row2) {

      ?>
                      <div class="col-md-4 bg-light p-2 mt-3  text-center" > Job Type :</div>
                       <div class="col-md-8 text-center   p-2 mt-3 " ><b><?=$row2->job_type?></b></div>
                       <?if($row2->job_type =="Import" || $row2->job_type=="Export"){?>  
                       <div class="col-md-4 text-center bg-light p-2"> Agent Name :</div>
                       <?if(!empty($row2->agent_name)){?>
                           <div class="col-md-8 text-center  p-2"><b><?=$row2->agent_name?></b></div>   
                       <?}else{?>
                             <div class="col-md-8 text-center  p-2"><b>----</b></div> 
                       <?}?>       
                       <div class="col-md-4 text-center bg-light p-2"> Agent Mobile No:</div>
                         <?if(!empty($row2->agent_mobile_no)){?>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->agent_mobile_no?></b></div>
                       <?} else {?>  
                         <div class="col-md-8 text-center  p-2"><b>----</b></div> 
                         <?}}?>   
                       <div class="col-md-4 text-center bg-light p-2"> Goods Type</div>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->goods_type?></b></div>
                       <div class="col-md-4 text-center bg-light p-2"> Brand Name</div>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->brand_name?></b></div>
                       <div class="col-md-4 text-center bg-light p-2"> No of Packages :</div>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->no_of_packages?></b></div>             
                       <div class="col-md-4 text-center bg-light p-2"> Total Weight of Goods :</div>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->total_luggage?></b></div>   
                       <div class="col-md-4 text-center bg-light p-2"> Total Weight of Unit:</div>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->luggage_unit?></b></div>      
                       <div class="col-md-4 text-center bg-light p-2"> Package Type:</div>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->package_type?></b></div>      
                
                       <div class="col-md-4 text-center bg-light p-2"> Expected Price :</div>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->expected_price?></b></div>  
                       <div class="col-md-4 text-center bg-light p-2"> Officer Name :</div>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->destination_name?></b></div>  
                       <div class="col-md-4 text-center bg-light p-2"> Contact No :</div>
                       <div class="col-md-8 text-center  p-2"><b><?=$row2->destination_contactno?></b></div>
                       <div class="col-md-4 text-center bg-light p-2"> Security Code :</div>
                       <?$code = $row2->security_code;?>
                       <div class="col-md-8 text-center  p-2"><b><?=substr($code, 0, 6);?></b></div>      
                



      
                       
 <?php  }?>

