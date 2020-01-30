

<?php 
    include("../../classes/common.class.php"); 

    // extract($_REQUEST);
    if(!Admin::IsUserLoggedIn()) {
        header("Location: ../index.php");
        exit;
    }
    extract($_REQUEST); ?>
     <?php $data=Load::fetch_pikcup_($q);
      
     ?>
                        <? foreach ($data as $row2) {?>
                          
                     
                       <div class="col-md-5 bg-light p-2"> Officer Name :</div>
                       <div class="col-md-6 p-2"><?=$row2->source_name?></div>
                     
                       <div class="col-md-5 bg-light p-2"> Officer Contact no</div>
                       <div class="col-md-6 p-2"><?=$row2->source_contactno?></div>
                       <div class="col-md-5 bg-light p-2"> Security Code</div>
                       <div class="col-md-6 p-2"><b><?=$row2->security_code?></b></div>
                    
                        <?}?>