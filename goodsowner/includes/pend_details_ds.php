<?php 
   
   include("../../classes/common.class.php"); 


    extract($_REQUEST);
   
    if(!Admin::IsUserLoggedIn()) {
        header("Location: ../index.php");
        exit;
    }

    $data = GoodsOwner::get_pend_dest($_REQUEST['q']); 
  
     foreach ($data as $row2) {?>
                  
                       <div class="col-md-4 text-center bg-light p-2 mt-3"> Receiver Email :</div>
                       <? if(!empty($row2->source_email)){?>
                                
                       <div class="col-md-8 text-center p-2 mt-3"><b><?=$row2->source_email?></b></div>  
                       <?}else {?>

                       <div class="col-md-8 text-center p-2 mt-3"><b>----</b></div>  
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
                                <div class="col-md-8 text-center p-2 "><b>----</b></div>       
                        <?}?>        

                               <div class="col-md-4 text-center bg-light p-2"> Security Code :</div>
                       <? if(!empty($row2->security_code)){
                            $code = $row2->security_code;?>                                        
                                <div class="col-md-8 text-center p-2"><b><?=substr($code, 0, 6);?></b></div>      
                        <?}else {?>
                                <div class="col-md-4 text-center p-2 mt-3"><b>----</b></div>        
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


      
                       
 <?php  }?>

