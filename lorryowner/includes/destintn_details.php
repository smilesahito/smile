<?php 
   
    include("../../classes/common.class.php"); 
    extract($_REQUEST);
    $data = Load::LoadDestinationDetail($q); 
    foreach ($data as $row2) { 
      ?>
                
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
            <?if(empty($row2->goods_type)){?>
       <div class="col-md-8 p-2">---</div>       
            <?}else {?>
       <div class="col-md-8 p-2"><?=$row2->goods_type?></div>
           <?}?>
       <div class="col-md-4 bg-light p-2"> No of Packages :</div>
           <?if(empty($row2->no_of_packages)){?>
       <div class="col-md-8 p-2">---</div>       
           <?}else {?>
       <div class="col-md-8 p-2"><?=$row2->no_of_packages?></div> 
           <?}?>            
       <div class="col-md-4 bg-light p-2"> Total Weight of Goods :</div>
       <div class="col-md-8 p-2"><?=$row2->total_luggage?></div>   
       <div class="col-md-4 bg-light p-2"> Unit:</div>
       <div class="col-md-8 p-2"><?=$row2->luggage_unit?></div>      
       <div class="col-md-4 bg-light p-2"> Package Type:</div>
       <div class="col-md-8 p-2"><?=$row2->package_type?></div>      
       <div class="col-md-4 bg-light p-2"> Security Code:</div>
           <?$newCode = substr($row2->security_code, -3);?>
       <div class="col-md-8 p-2"><b><?=$newCode?></b></div>  
       <div class="col-md-4 bg-light p-2"> Expected Price :</div>
       <div class="col-md-8 p-2"><?=$row2->expected_price?></div>      
                      <!--  <div class="col-md-4 bg-light p-2"> Total Price:</div>
                       <div class="col-md-8 p-2"><b><?=$row2->total_price?></b></div> -->
 <?php } ?>

