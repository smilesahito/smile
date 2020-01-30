
<link rel="stylesheet" type="text/css" href="../assets/css/info_css.css">
<?php 
    include 'info_css.css';
    extract($_REQUEST);
    
    if(!empty($_REQUEST['load_id']) ){

        $load_id = $_REQUEST['load_id'];   
        $OWNER_ID = $_SESSION["sess_admin_id"];
        $commodities_lists = GoodsOwner::fetchConfimation_data($load_id); 
    }    
    else if(!empty($param)){
        
        $load_id = $param;  
        $OWNER_ID = $_SESSION["sess_admin_id"];
        $commodities_lists = GoodsOwner::fetchConfimation_data($load_id);

 
    }else {
     
     header('Location: index.php', true);
     die;
    }
   
    
    
   
 
    $total_weight=0;
    $drop_weight=0;
    $collect_Weight = 0;
        foreach ($commodities_lists as $key) {
            foreach ($key->pickUp_details as $data=>$value){
               
                $collect_Weight+= $value->total_luggage;
            }
        }

        foreach ($commodities_lists as $key) {
              foreach ($key->drop_details as $value){

                $drop_weight+= $value->weight_drop;
            }
        } 
   ?>
<style type="text/css">
  ul.tree, ul.tree ul { 
        list-style-type: none;
        background: #fff 
        url(http://odyniec.net/articles/turning-lists-into-trees/vline.png)
        repeat-y; 
        margin: 0; 
        padding: 0; 
    
    } 
    ul.tree ul { 
        margin-left: 10px;

        } 
    ul.tree li { 
         margin: 0; 
        
         padding: 0px 20px; 
         line-height: 10px; 
         background: url(http://odyniec.net/articles/turning-lists-into-trees/node.png) 
         no-repeat; 
         margin-bottom: 55px;
         /*color: #369; */
         font-weight: bold; 
         } 
    ul.tree li.last {
        background: #fff url(http://odyniec.net/articles/turning-lists-into-trees/lastnode.png) 
        no-repeat;
  
   }
</style>


<!--  ==============================================================================================
                                        Header With Bread Crums
     ============================================================================================ -->

    <div class="breadcrumbs p-3 mb-2 bg-info">
    <div class="col-sm-4">
    <div class="page-header float-left bg-info">
    <div class="page-title bg-info text-white">
        <h1><b><i class="fa fa-briefcase style="margin-right: 8px"></i>
        Job Confirmation</b></h1>
    </div>
    </div>
    </div>

    <div class="col-sm-8 bg-info">
    <div class="page-header float-right bg-info">
    <div class="page-title bg-info">
        <ol class="breadcrumb text-right bg-info">
          <li><a href="index.php" class="text-dark"><b>Dashboard</b></a></li>
          <li><a href="load_list.php" class="text-dark"><b>Pending Jobs List</b></a></li>
          <li class="active text-dark"><a href="add_load.php" class="text-dark"><b>New Job </b></a></li>
          <li class="active text-white"><b>Confirmation Job </b></li>
        </ol>
    </div>
    </div>
    </div>
    </div>

    <?php
        if($collect_Weight != $drop_weight){?>
    
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
           <span class="badge badge-pill badge-danger">Alert</span>
                 Please make sure PickUp Weight and Dispatch  Weight are  Equal.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
           </button>
        </div>
 
        <?php } ?>
    
      
    <?if(!empty($param)){?>

   <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
           <span class="badge badge-pill badge-success">Success</span>
                 Succesfully changes update.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
           </button>
  </div>
  <?}?>
<!-- ======================================================================================= -->
<!--                        Basic Information Display Panel                                  -->
<!-- ======================================================================================== -->
    

    <div class="content mt-3">
    <div class="animated fadeIn">
    <div class="row">
    <div class="col-lg-12">
    <div class="card">

    <div class="card-header">
             <i class="pull-right fa fa-check-circle" style="color:green;"></i>
        <strong class="card-title">Basic Information</strong>
    </div>

    <div class="card-body">
    <div id="pay-invoice">
    <div class="card-body">
    <div class="card-title">
        <h3 class="text-center">Please Confirm this Information</h3>
    </div>
    <hr class="h1px">
    <?foreach ($commodities_lists as $data) {
        
        ?>
    <div class="form-group col-md-3">
            <label class="form-control-label">Job Type</label>
    <div class="input-group">       
    <input type="text" name="load_date"  class="form-control" value="<?=$data->job_type?>" readonly="true">
     <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
    </div>
    </div>

    <?$type = GoodsOwner::fetch_Truck_Name_Cap($data->truck_type_id);?>
    <div class="form-group col-md-3">
            <label class="form-control-label">Vehicle Type</label>
    <div class="input-group"> 
         <?foreach ($type as $row) {?>      
        <input type="text" name="load_date" value="<?=$row->truck_type_name?>" class="form-control"  readonly="true">
         <?}?>
         <div class="input-group-addon"><i class="fa fa-truck"></i></div>
    </div>
    </div>

    <div class="form-group col-md-3">
            <label class="form-control-label">Vehicle Capacity</label>
    <div class="input-group">    
        <?foreach ($type as $row) {?>
        <input type="text" name="load_date"  value="<?=$row->truck_capacity?>" class="form-control" readonly="true">
        <?}?>
    <div class="input-group-addon"><i class="fa fa-rebel"  ></i></div>
    </div>
    </div>

    <div class="form-group col-md-3">
            <label class="form-control-label">Date</label>
    <div class="input-group">    
    
        <input type="date" name="load_date"  class="form-control" value="<?=$data->load_date?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
    </div>
    </div>

    <div class="form-group col-md-3">
            <label class="form-control-label">Expected Prices</label>
    <div class="input-group">    
    
        <input type="text" name="load_date"  class="form-control" value="<?=$data->expected_price?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-money"></i></div>      
    </div>
    </div>

        <div class="form-group col-md-3">
            <label class="form-control-label">No Of Truck Required</label>
    <div class="input-group">    
    
        <input type="text-dark" name="load_date"   class="form-control" value="<?=$data->total_truck?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>    
    </div>
    </div>

        <div class="form-group col-md-3">
            <label class="form-control-label">Bid Date Start</label>
    <div class="input-group">    
    
        <input type="date" name="load_date"  min="12/25/2019" class="form-control" value="<?=$data->bid_date_start?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>    
    </div>
    </div>

        <div class="form-group col-md-3">
            <label class="form-control-label">Bid Date End</label>
    <div class="input-group">    
   
        <input type="date" name="load_date"  min="12/25/2019" class="form-control" value="<?=$data->bid_date_end?>" readonly="true">
         <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
    </div>
    </div>

    <?php $containerInfo = GoodsOwner::getContainerInfo($load_id);
       if(!empty($containerInfo)){
          foreach ($containerInfo as  $value) {?>

    <div id="container_info_">
    <div class="form-group col-md-3">
            <label class="form-control-label">Container Location Name</label>
    <div class="input-group">    
  
    <input type="text" name="load_date"  class="form-control" value="<?=$value->con_location?>" readonly="true">
      <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
    </div>
    </div>

      <div class="form-group col-md-3">
            <label class="form-control-label">Agent Name </label>
    <div class="input-group">    
   
        <input type="text" name="load_date"   class="form-control" value="<?=$data->agent_name?>" readonly="true">
         <div class="input-group-addon"><i class="fa fa-user"></i></div>
    </div>
    </div>

      <div class="form-group col-md-3">
            <label class="form-control-label">Agent Mobile No</label>
    <div class="input-group">    
    
        <input type="text" name="load_date"  class="form-control" value="<?=$data->agent_mobile_no?>" readonly="true">
        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
    </div>
    </div>

    <div class="form-group col-md-3">
            <label class="form-control-label"> No Of Container </label>
    <div class="input-group">    
    
        <input type="text" name="load_date"  class="form-control" value="<?=$data->container_no?>" readonly="true">
        <div class="input-group-addon"><i class="fa fa-archive"></i></div>
    </div>
    </div>

    <div class="form-group  mt-4"><h5 ><u>Document Details</u></h5></div>

    <ul style="list-style: none; " class="tree">
        <li >
            <?php if(!empty($value->con_cro)){?>  
                <i class=" fa fa-check-circle mr-2" style="color:green;"></i>
                  <b style="color: #369;">(Received) CRO Document </b>
            <?php }else{?>
                 <i class="fa fa-times-circle mr-2" style="color:red;"></i>
                   <b style="color: red"> (Not - Received) CRO Document </b>
            <?php } ?>  
          
      </li>
      
      <li>
            <?php if(!empty($value->guarantee_doc)){?>  
                <i class=" fa fa-check-circle mr-2" style="color:green;"></i>
               <b style="color: #369;"> (Received)Gurantee Document</b>
            <?php }else{?>
                  <i class="fa fa-times-circle mr-2" style="color:red;"></i>
                   <b style="color: red"> (Not - Received) Gurantee Document</b>
            <?php } ?>  
            
      </li>
      
      <li>
            <?php if(!empty($value->invoice_doc)){?>  
                <i class=" fa fa-check-circle mr-2" style="color:green;"></i>
                <b style="color: #369;">(Received) InVoice Document</b>
            <?php }else{?>                
                  <i class="fa fa-times-circle mr-2" style="color:red;"></i>(Not - Received)
                  <b style="color: red">InVoice Document</b>
            <?php } ?>  
            
      </li>
      
      <li>
            <?php if(!empty($value->bl_doc)){?>  
                <i class=" fa fa-check-circle mr-2" style="color:green;"></i>
                <b style="color: #369;">(Received) Bl  Document</b>
            <?php }else{?>
                 <i class="fa fa-times-circle mr-2" style="color:red;"></i>
                 <b style="color: red">(Not - Received) Bl  Document</b>
            <?php } ?>  
            
      </li>
      
      <li>
            <?php if(!empty($value->gd_doc)){?>  
                <i class=" fa fa-check-circle mr-2" style="color:green;"></i>
                  <b style="color: #369;">(Received) GD  Document</b>
            <?php }else{?>
                <i class="fa fa-times-circle mr-2" style="color:red;"></i>
               <b style="color: red"> (Not - Received) GD  Document</b>
            <?php } ?>  
           
      </li>

      <li>
            <?php if(!empty($value->delivery_doc)){?>  
                <i class=" fa fa-check-circle mr-2" style="color:green;"></i>
                <b style="color: #369;">(Received) Delivery  Document</b>
            <?php }else{?>
                <i class="fa fa-times-circle mr-2" style="color:red;"></i>
                 <b style="color: red"> (Not - Received) Delivery  Document</b>
            <?php } ?>  
            
      </li>
    </ul>


     <? } }?>

</div>
    <div align="right" style="padding-right: 15px;">
      <form method="post" action="edit_job_post.php">
     
        <input type="hidden" name="basic_info"  value="basic_info">
        <input type="hidden" name="load_id" value="<?php if($load_id){echo $load_id;}?>">  
        <input type="hidden" name="truck_type"  value="<?php if($data->truck_type_id){echo $data->truck_type_id;}?>">  
         <a href="edit_job_post.php" class="text-dark  col-sm-2">
          <button align="right" type="submit"   class="btn btn-info  block mt-3">
                <i class="fa fa-plus"></i> Edit
          </button>
        </a>
    </form>
    </div>   
<?}?>


 
    <div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>



    <div class="content mt-3">
    <div class="animated fadeIn">
    <div class="row">
    <div class="col-lg-12">
        <?php 
       if($collect_Weight ==$drop_weight){?>
            <div class="card">
        <?php }else {?>
            <div class="card" id="alert">
        <?php } ?>   
    <div class="card-header">
         <?
       if($collect_Weight == $drop_weight){?>
          <i class="pull-right fa fa-check-circle" style="color:green;"></i>
        <?php }else {?>
            <i class="pull-right fa fa-exclamation-triangle"  style="color:red;" aria-hidden="true"></i>
        <?php } ?>
        
                 
    <strong class="card-title">Pick-Up Information</strong>
    </div>
    <div class="card-body">

    <div id="pay-invoice">
    <div class="card-body">
    <div class="card-title">
    <h3 class="text-center">Please Confirm this Information</h3>
    </div>
    <hr class="h1px">
    
    <?php foreach ($commodities_lists as $dat) {
        foreach ($dat->pickUp_details as $data){?> 

      <div class="row">

        <div class="form-group col-md-6">
            <label class="form-control-label">Pick Up Name</label>
          <div class="input-group">      
            <input type="text"   class="form-control" value="<?=$data->load_to?>" readonly="true">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
          </div>
        </div>

      </div>
     
      <div class="row">
        <div class="form-group col-md-3">
          
          <label class="form-control-label">Classification of the Goods</label>
          <div class="input-group">       
            <input type="text"  value="<?=$data->good_type?>" class="form-control" readonly="true">
               <div class="input-group-addon"><i class="fa fa-eercast"></i></div>
          </div>
        </div>

        <div class="form-group col-md-3">
          
          <label class="form-control-label">Nature of the Goods</label>
          <div class="input-group">       
            <input type="text"  value="<?=$data->good_nature_name?>" class="form-control" readonly="true">
               <div class="input-group-addon"><i class="fa fa-eercast"></i></div>
          </div>
        </div>

        <div class="form-group col-md-3">
          <label class="form-control-label">Commodities Type</label>
          <div class="input-group">       
            <input type="text"  value="<?=$data->goods_type?>" class="form-control" readonly="true">
               <div class="input-group-addon"><i class="fa fa-eercast"></i></div>
          </div>
        </div>

        <div class="form-group col-md-3">
        <label class="form-control-label">Package Type</label>
        <div class="input-group">    
       
            <input type="text"   value="<?=$data->package_type?>" class="form-control" readonly="true">
          <div class="input-group-addon"><i class="fa fa-th-large"></i></div>
        </div>
      </div>

      </div>

      

      

      <div class="form-group col-md-3">
            <label class="form-control-label">Brand Name</label>
    <div class="input-group">    
    
        <input type="text"    class="form-control" value="<?=$data->brand_name?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-bandcamp"></i></div>
    </div>
    </div>

    <div class="form-group col-md-3">
            <label class="form-control-label">No Of Packages</label>
    <div class="input-group">    
    
        <input type="text"   class="form-control" value="<?=$data->no_of_packages?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-paste"></i></div>      
    </div>
    </div>

        <div class="form-group col-md-3">
            <label class="form-control-label">Weight Per Piece</label>
    <div class="input-group">    
    
        <input type="text"    class="form-control" value="<?=$data->weight?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-circle-o-notch"></i></div>    
    </div>
    </div>

        <div class="form-group col-md-3">
            <label class="form-control-label">Price Per Unit</label>
    <div class="input-group">    
    
        <input type="text"    class="form-control" value="<?=$data->target_price?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-money"></i></div>    
    </div>
    </div>

        <div class="form-group col-md-3">
            <label class="form-control-label">Total Weight of Goods</label>
    <div class="input-group">      
         <input type="text"    class="form-control" value="<?=$data->total_luggage?>" readonly="true">
         <div class="input-group-addon"><i class="fa fa-balance-scale"></i></div>
    </div>
    </div>

     <div class="form-group col-md-3">
            <label class="form-control-label">Unit</label>
    <div class="input-group">    
  
    <input type="text"    class="form-control" value="<?=$data->luggage_unit?>" readonly="true">
      <div class="input-group-addon"><i class="fa fa-rebel"></i></div>
    </div>
    </div>

      <div class="form-group col-md-3">
            <label class="form-control-label">Warehouse Officer Name </label>
    <div class="input-group">    
   
        <input type="text"  class="form-control" value="<?=$data->destination_name?>" readonly="true">
         <div class="input-group-addon"><i class="fa fa-user"></i></div>
    </div>
    </div>

      <div class="form-group col-md-3">
            <label class="form-control-label">Warehouse Officer Contact No</label>
      <div class="input-group">        
        <input type="text"   class="form-control" value="<?=$data->destination_contactno?>" readonly="true">
        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
    </div>
    </div>
    
     <div align="right" style="padding-right: 15px;">
     <form method="post" action="edit_job_post.php">
      <input type="hidden" name="pickUp"    value="pickUp?>">
      <input type="hidden" name="load_id"  value="<?php if($load_id){echo $load_id;}?>">  
      <input type="hidden" name="pickUp_id"  value="<?php if($data->load_detail_id){echo $data->load_detail_id;}?>">   
      
        <a href="edit_job_post.php" class="text-dark  col-sm-2">
      
          <button align="right" type="submit"   class="btn btn-info  block mt-3">
                <i class="fa fa-plus"></i> Edit
          </button>
        </a>
    </form>  
    </div> 
     <hr class="h1px">
    <? } }?>
    

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  </div>
    




    <div class="content mt-3" >
    <div class="animated fadeIn">
    <div class="row">
    <div class="col-lg-12">
    <?php 
       if($collect_Weight == $drop_weight){?>
            <div class="card">
        <?}else {?>
            <div class="card" id="alert">
        <?} ?>    
    <div class="card-header">
            <?php 
       if($collect_Weight == $drop_weight){?>
          <i class="pull-right fa fa-check-circle" style="color:green;"></i>
        <?}else {?>
            <i class="pull-right fa fa-exclamation-triangle"  style="color:red;" aria-hidden="true"></i>
        <?} ?>  
                
    <strong class="card-title text-dark">Drop-Off Information</strong>
    </div>
    <div class="card-body" >
    <div id="pay-invoice">
    <div class="card-body">
    <div class="card-title">
    <h3 class="text-center">Please Confirm this Information</h3>
    </div>
    <hr class="h1px">
      <?foreach ($commodities_lists as $dat) {
        foreach ($dat->drop_details as $data){?>    

     <div class="form-group col-md-6">
            <label class="form-control-label">Destination  Name</label>
    <div class="input-group">       
    <input type="text" name="load_date"  class="form-control" value="<?=$data->load_from?>" readonly="true">
     <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
    </div>
    </div>

      <div class="form-group col-md-6">
            <label class="form-control-label">Pickup point for this Destination</label>
    <div class="input-group">       
        <input type="text" name="load_date" value="<?=$data->load_to?>" class="form-control"  readonly="true">
         <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
    </div>
    </div>

     <div class="form-group col-md-3" >
            <label class="form-control-label" > Drop Weight</label>
    <div class="input-group">        
        <input type="text" name="load_date"   class="form-control" value="<?=$data->weight_drop?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-caret-down"></i></div>      
    </div>
    </div>


      <div class="form-group col-md-3">
            <label class="form-control-label">Receiver Name</label>
    <div class="input-group">    
   
        <input type="text" name="load_date"  value="<?=$data->source_name?>" class="form-control" readonly="true">
    <div class="input-group-addon"><i class="fa fa-user"></i></div>
    </div>
    </div>

      <div class="form-group col-md-3">
            <label class="form-control-label">Receiver Contact No</label>
    <div class="input-group">    
    
        <input type="text" name="load_date"   class="form-control" value="<?=$data->source_contactno?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
    </div>
    </div>

        <div class="form-group col-md-3">
            <label class="form-control-label">Receiver Email</label>
    <div class="input-group">    
    
        <input type="text" name="load_date"  class="form-control" value="<?=$data->source_email?>" readonly="true">
    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>    
    </div>
    </div>
 <div align="right" style="padding-right: 15px;">
    <form method="post" action="edit_job_post.php">
      <input type="hidden" name="drop"    value="drop_off">
      <input type="hidden" name="load_id"  value="<?php if($load_id){echo $load_id;}?>">  
      <input type="hidden" name="dest_id"  value="<?php if($data->pickup_id){echo $data->pickup_id;}?>">   
        <a href="edit_job_post.php" class="text-dark  col-sm-2">
          <button align="right" type="submit"   class="btn btn-info  block mt-3">
                <i class="fa fa-plus"></i> Edit
          </button>
        </a>
    </form>   
</div>
  <hr>
    <? } }?>
    
     
    
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  </div>


    <div class="mt-4 mb-5"> 
        <h4 class="c"><center><b>CONFIRM POST JOB</b></center></h4>
    <div class="col-sm-12">
        <center>
            <? if($collect_Weight == $drop_weight){?>

                <form action="controller/action-ctl.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="command"    value="job_active">
                <input type="hidden" name="load_id"  value="<?php if($load_id){echo $load_id;}?>">  
                <a href="../load_list.php" class="text-dark col-sm-2 ">
                <button align="right" type="submit"   class="btn btn-info  block mt-3 mb-4">
                    <i class="fa fa-check"></i>  POST JOB
                </button>
              </a>
          </form>
            <?}else {?>
                 
                 <button type="submit" disabled="true" class="btn bg-info text-dark mt-3 mb-4">
                     <i class="fa fa-check mr-2"></i>CONFIRM POST JOB
                 </button>
            <?} ?>      

        </center>
    </div>
    </div>



<style>


.block:hover {
  background-color: #ddd;
  color: black;
}
h4.c {
  text-decoration-line: underline;
  text-decoration-style: double;
}

</style>

  <?php foreach ($commodities_lists as $data) {
  
    if($data->job_type == "Import" || $data->job_type == "Export"){?>
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script >
       document.getElementById('container_info_').style.display='block';
      </script>
    
    <?php }else{?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>           
            document.getElementById('container_info_').style.display='none';
    </script>
    <?php } }?>
