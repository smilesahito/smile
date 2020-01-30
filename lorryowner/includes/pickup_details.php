

<?php 
    include("../../classes/common.class.php"); 
    extract($_REQUEST);
    $data=Load::fetch_pikcup_($q);
    foreach ($data as $row2) { ?>
                          
                     
                       <div class="col-md-4  bg-light p-2"> Officer Name :</div>
                       <div class="col-md-6 p-2"><?=$row2->source_name?></div>
                       <div class="col-md-4 bg-light p-2"> Officer Contact no</div>
                       <div class="col-md-6 p-2"><?=$row2->source_contactno?></div>
                       <div class="col-md-4 bg-light p-2"> Officer Email :</div>
                       <div class="col-md-6 p-2"><?=$row2->source_email?></div>   
                       <div class="col-md-4 bg-light p-2"> Security Code :</div>
                       <?$newCode = substr($row2->security_code, -3);?>
                       <div class="col-md-6 p-2"><b><?=$newCode?></b></div>

                       <div class="col-md-4 bg-light p-2"> No Of Packages :</div>
                       <div class="col-md-6 p-2"><?=$row2->no_of_packages?></div>  

                       <div class="col-md-4 bg-light p-2"> Weight :</div>
                       <div class="col-md-6 p-2"><?=$row2->weight?></div> 

                       <div class="col-md-4 bg-light p-2"> Total Luggage :</div>
                       <div class="col-md-6 p-2"><?=$row2->total_luggage?></div>  

                       <div class="col-md-4 bg-light p-2"> Unit  :</div>
                       <div class="col-md-6 p-2"><?=$row2->luggage_unit?></div>  

                       <div class="col-md-4 bg-light p-2"> Package Type  :</div>
                       <div class="col-md-6 p-2"><?=$row2->package_type?></div> 

                       <div class="col-md-4 bg-light p-2"> Target Price  :</div>
                       <div class="col-md-6 p-2"><?=$row2->target_price?></div>  

                       <div class="col-md-4 bg-light p-2"> Receiver Name :</div>
                       <div class="col-md-6 p-2"><?=$row2->destination_name?></div> 

                       <div class="col-md-4 bg-light p-2"> Receiver Contactno :</div>
                       <div class="col-md-6 p-2"><?=$row2->destination_contactno?></div> 

                       <div class="col-md-4 bg-light p-2"> Goods Type :</div>
                       <div class="col-md-6 p-2"><?=$row2->goods_type?></div> 
                       <div class="col-md-4 bg-light p-2"> Pick Up :</div>
                       <div class="col-md-6 p-2"><?=$row2->load_to?></div>  
                        <?}?>