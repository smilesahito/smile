<?php

    include("../classes/common.class.php"); 
    extract($_REQUEST);

    
    $rand_value = rand();

    $file_name = $rand_value."_".$job_id;


    
   	LorryOwner::imageUpload($load_id,$job_id,$go_id,$driver_id,$file_name);


    $target_dir = $config["root_path"]."/$file_name.jpg";
     
     file_put_contents($target_dir,base64_decode($img));
    
    
     // echo $target_dir;
     // echo "<br>";
     // echo base64_decode($img);
?>