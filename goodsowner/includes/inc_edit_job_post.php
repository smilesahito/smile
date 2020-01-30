<?
   
    extract($_REQUEST);
    $load_id = $_REQUEST['load_id'];
    $drop_ = $_REQUEST['drop'];
    $dest_id = $_REQUEST['dest_id'];
    $pickUp = $_REQUEST['pickUp'];
    $pickUp_id = $_REQUEST['pickUp_id'];
    $basic_info = $_REQUEST['basic_info'];
    $truck_type_ = $_REQUEST['truck_type'];
 
    if($load_id !==FALSE){

     // echo "not";
    $Info_basic = GoodsOwner::_getBasicInfo_($load_id);

    }else {

      echo "string";
    }
    
  

   if(!empty($pickUp)&&!empty($pickUp_id)){

       $pickUp_details = GoodsOwner::_getPickUp_info_($load_id,$pickUp_id);

        $goods_classify =Load::getGoodsClassification();
        $goods_natur =Load::getGoodsNature();

   }
    if(!empty($drop_)&&!empty($dest_id)){
    
     $drop_details = GoodsOwner::_getDrop_detail_info_($load_id,$dest_id);

   }

  $commodities_lists = Load::fetchCommoditiesList();
  $packages=Load::getchPackages();
    ?>


<style type="text/css">
#map-1 {
  height: 150px;
  width: 500px;
}
#_align_{
    margin-left: 40px;
    margin-right: 40px;
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 70%;
  border-top: 16px solid #007bff;
  width: 30px;
  height: 30px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}
/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}




</style>

<!-- =====================================================================================================
                                        Header With Bread Crums
     ==============================================================================================-->

    <div class="breadcrumbs p-3 mb-2 bg-info">
    <div class="col-sm-4">
    <div class="page-header float-left bg-info">
    <div class="page-title bg-info text-white">
        <h1><b><i class="fa fa-briefcase style="margin-right: 8px"></i>
        Edit  Section</b></h1>
    </div>
    </div>
    </div>

    <div class="col-sm-8 bg-info">
    <div class="page-header float-right bg-info">
    <div class="page-title bg-info">
        <ol class="breadcrumb text-right bg-info">
          <li><a href="index.php" class="text-dark"><b>Dashboard</b></a></li>
          <li><a href="load_list.php" class="text-dark"><b>Pending Jobs List</b></a></li>
          <li class="active text-dark ">

            <a href="confirmation_post.php?param=<?=$load_id?>" class="text-dark"><b>Confirmation</b></a></li>
          <li class="active text-white"><b>Edit </b></li>
        </ol>
    </div>
    </div>
    </div>
    </div>


    <div class="col-lg-12" id="basic_info">
    <div class="card">
    <div class="card-header">
        <i class="pull-right fa fa-check-circle" style="color:green;"></i>
        <strong class="card-title">Basic Information</strong>
    </div>

    <div class="card-body">
      <form action="controller/action-ctl.php" method="POST" enctype="multipart/form-data">
       <?foreach ($Info_basic as $row) {?>
        <input type="hidden" class="form-control" name="command" value="update_basic_info">
        <input type="hidden" class="form-control" name="_load_id_" value="<?=$load_id?>">    
        <div class="col-xs-12 col-sm-12">     
        <div class="card-body card-block">

            <div class="form-group col-md-3">
                    <label class="form-control-label">Job Type</label>
            <div class="input-group">    
            <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                <select size="1" name="job_type" id="job_type" class="form-control" class="option_" required="true">
                     <option value="<?=$row->job_type?>"><?=$row->job_type?></option>
                     <option value="Import">Import</option>
                     <option value="Export">Export</option>
                     <option value="Local">Local</option>
                     <option value="UpCountry">UpCountry</option>
                </select>
            </div>
            </div>

            <div class="form-group col-md-3">
                <label class="form-control-label">Truck Type Needed</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-truck"></i>   </div>
                <select size="1" name="truck_type" id="truck_type" class="form-control" required="true" >
                  <option value="<?=$row->truck_type_id?>"><?=$row->truck_type_name?></option>
                  <?php $truck=Truck::GetTruckTypeList();
                  foreach($truck as $row1) { ?>
                  <option value="<?=$row1->truck_type_id?>"><?=$row1->truck_type_name?></option>
                  <?php }?>
                </select>
            </div>
            </div>

            <div class="form-group col-md-3">
                <label class=" form-control-label">Capacity</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-rebel"></i>   </div>
                 <select  class="form-control" name="capacity" id="capacity" style="height: 35px"  required="true"> 
                     <option value="<?=$row->truck_type_id?>" hidden="true"><?=$row->truck_capacity?></option>    
                 </select> 
            </div>
            </div>   
            
            <div class="form-group  col-md-3">
                <label class=" form-control-label">Date</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                <input type="date" name="load_date"  min="12/25/2019" class="form-control" value="<?=$row->load_date?>">
            </div>
            </div>

            <div class="form-group col-md-3">
                  <label class=" form-control-label">Expected Prices Per Trip </label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                  <input class="form-control" min ="1" name="expected_price" type="Number"  required="true" value="<?=$row->expected_price?>" style="font-weight: bold;" >
            </div>
            </div>
            
            <div class="form-group col-md-3" id="container_req_div">
                <label class=" form-control-label">No Of Container Required</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-truck"></i></div>
                <input type="number" name="container_no" min="1" style="font-weight: bold;" class="form-control" value="<?=$row->container_no?>">
            </div>
            </div>
            
            <div class="form-group col-md-3">
                <label class=" form-control-label">No Of Truck Required</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                <input type="number" min="1" name="truck_no" class="form-control" value="<?=$row->total_truck?>"  style="font-weight: bold;" required="true">
            </div>
            </div>

            <div class="form-group col-md-3">
                <label class=" form-control-label">Bid Date Start</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                <input type="date" name="bid_date_start"  class="form-control " placeholder="mm/dd/yyyy" value="<?=$row->bid_date_start?>">
            </div>
            </div>

            <div class="form-group col-md-3">
                <label class=" form-control-label">Bid Date End</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                 <input type="date" name="bid_date_end"  class="form-control" placeholder="mm/dd/yyyy" value="<?=$row->bid_date_end?>">
            </div>
            </div>

           
            <div class="form-group col-md-3 mt-3" id="agent_name" >
                 <label class=" form-control-label">Agent Name</label>
            <div class="input-group">
            <div class="input-group-addon "><i class="fa fa-user"></i></div>
              
              <input class="form-control text-center" name="agent_name" type="text" placeholder="Agent Name"value="<?=$row->agent_name?>">
              </div>
            </div>


            <div class="form-group col-md-3 mt-3" id="agent_mobileno">
               <label class=" form-control-label">Agent Mobile No</label>
            <div class="input-group">
            <div class="input-group-addon "><i class="fa fa-phone"></i></div>               
             <input class="form-control text-center" name="agent_mobileno" type="phone"  placeholder="Agent Mobile No" maxlength="11" minlength="11" value="<?=$row->agent_mobile_no?>">
          </div>
            </div>

            
           
            </div>
            </div>

<!-- ===============================================================================================  -->
<!--                        Add Container Location Information Section                               -->
<!-- =============================================================================================== -->
            
            <div class="form-group col-md-12" id="container_div">    
               

            <div class="form-group col-md-6 mt-3" id="container_locat" >
                 <label class=" form-control-label">Please Select Container Location</label>
            <div class="input-group">
            <div class="input-group-addon col-md-12" style="height: 35px;"><i class="fa fa-map-marker "></i>
            </div>
            </div>
            <input id="query-0" class="query col-md-12"  type="text" style="height: 45px;" name="con_location" value="<?=$row->con_location?>" placeholder="Container Location" />
            </div>

            

           <input type="hidden" class="form-control text-center" name="container_lat" value="<?=$row->con_latitude?>"  id="con_lat" placeholder="From Latitude" >
 
            <input type="hidden" class="form-control text-center" name="container_lng"  value="<?=$row->con_longitude?>" id="con_lng" placeholder="From Longitude" >
                
        
            
           
<!--======================================================================================== -->
<!--                                Document Upload  Section                                 -->
<!-- ======================================================================================== -->
            
            <div class="form-group col-md-6"></div>
          <div class="form-group col-md-6" id="delivery_order_doc">
            <?if(!empty($row->delivery_doc)){?>                   
              <i class="pull-right fa fa-check-circle" style="color:green;"> (Received)</i>
            <?}else {?>
              <i class="pull-right fa fa-minus-circle" style="color:red;">(Not-Received)</i>
            <?} ?>
              <label class=" form-control-label">Upload Delivery Doc</label>
          <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
            <input type="file"  name="delivery_doc" value="<?=$row->delivery_doc?>" id="delivery_order_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
          </div>
          </div>

           
            <div class="form-group col-md-6" id="guarantee_doc">
              <?if(!empty($row->guarantee_doc)){?>                   
                <i class="pull-right fa fa-check-circle" style="color:green;"> (Received)</i>
              <?}else {?>
                <i class="pull-right fa fa-minus-circle" style="color:red;">(Not-Received)</i>
              <?} ?>
              <label class=" form-control-label">Upload Gurantee Doc</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
              <input type="file"  name="guarantee_doc" id="guarantee_doc" value="<?=$row->guarantee_doc?>" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            </div>
            </div>

           
          <div class="form-group col-md-6" id="cro_doc">
            <?if(!empty($row->con_cro)){?>                   
              <i class="pull-right fa fa-check-circle" style="color:green;"> (Received)</i>
            <?}else {?>
              <i class="pull-right fa fa-minus-circle" style="color:red;">(Not-Received)</i>
            <?} ?>
              <label class=" form-control-label">Upload CRO</label>
          <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
            <input type="file"  name="con_cro" id="cro" value="<?=$row->con_cro?>" style="color: red"  class="form-control " accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
          </div>
          </div>
                <div class="form-group col-md-6" id="gd_doc">
                  <?if(!empty($row->gd_doc)){?>                   
                  <i class="pull-right fa fa-check-circle" style="color:green;"> (Received)</i>
                  <?}else {?>
                  <i class="pull-right fa fa-minus-circle" style="color:red;">(Not-Received)</i>
                  <?} ?>
                <label class=" form-control-label">Upload GD Doc</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input type="file"  name="gd_doc" id="gd_doc" value="<?=$row->gd_doc?>" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            </div>
            </div>

            
              <div class="form-group col-md-6" id="bl_doc">
                <?if(!empty($row->bl_doc)){?>                   
                <i class="pull-right fa fa-check-circle" style="color:green;"> (Received)</i>
                <?}else {?>
                <i class="pull-right fa fa-minus-circle" style="color:red;">(Not-Received)</i>
                <?} ?>
                <label class=" form-control-label">Upload BL Doc </label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input type="file"  name="bl_doc" id="bl_doc" value="<?=$row->bl_doc?>" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            </div>
            </div>

     
               <div class="form-group col-md-6" id="invoice_doc">
                  <?if(!empty($row->invoice_doc)){?>                   
                  <i class="pull-right fa fa-check-circle" style="color:green;"> (Received)</i>
                  <?}else {?>
                  <i class="pull-right fa fa-minus-circle" style="color:red;">(Not-Received)</i>
                  <?} ?>
                <label class=" form-control-label">Upload Invoice</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
            
                <input type="file"  name="invoice_doc" id="invoice_doc" value="<?=$row->invoice_doc?>" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            
            </div>
            </div>
            </div>  


<!-- =====================================================================================================
                                               Submit Button     
     =========================================================================================    -->
            
       
            <div class="form-group col-md-12">
            <div align="right" style="padding-right: 40px;">
        
                <button type="submit"   id="info_btn" class="btn btn-info bg-info ">
                    <i class="fa fa-check"></i> Save
                </button>
            
            </div>
            </div>

             <?}?>  
        </form>        
    </div>
    </div>
    </div>








	  <div class="col-lg-12" id="pickUp">
    <div class="card">
    <div class="card-header">
        <i class="pull-right fa fa-check-circle" style="color:green;"></i>
        <strong class="card-title">Pick-Up Information</strong>
    </div>

    <div class="card-body">
      <form action="controller/action-ctl.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="command" value="update_pickUp_info">
    <div class="col-xs-12 col-sm-12">     
       
<!-- =========== -->
      <?foreach ($pickUp_details as  $value) {?>
     
     <input type="hidden" class="form-control" name="_load_id_" value="<?=$load_id?>">
      <input type="hidden" class="form-control" name="load_detail_id_" value="<?=$value->load_detail_id?>">
      <div class="col-xs-12 col-sm-12" style="height:130px;">    
      
        <div class="col-md-6">
            <label class=" form-control-label">PickUp Point</label>
          <div class="input-group">
            <div class="input-group-addon col-sm-12"><i class="fa fa-map-marker"></i>
            </div>
          </div>
          
          <div id="pac-container_addressto">          
             <input id="query2" class="query col-md-12"  type="text" name="load_from" placeholder="Enter a PickUp  location" style="height: 50px" required="true" value ="<?=$value->load_to?>" />
          </div>
                 

          <input type="hidden" class="form-control text-center" name="lat" id="drop_lat_" type="text" placeholder="From Latitude">

          <input type="hidden" class="form-control text-center" name="lng" id="drop_lng_" type="text" placeholder="From Longitude">
        </div>
        <div class="col-md-6">
          &nbsp;
        </div>         
      

      </div> <!-- Close row ... -->  
    <div class="col-xs-12 col-sm-12" style="margin-top: 15px;"> 

      <div class=" col-md-3">
          <label for="text-input" class=" form-control-label">Classification of the Goods</label>
        <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-rebel"></i> </div>
          <select size="1" name="good_classification" id="good_classification" class="form-control" required="true">
            <option value="" disabled selected>Please select</option>
            <? foreach($goods_classify as $row) { ?>
               <option value="<?=$row->g_id?>" <?= ($row->g_id == $value->goods_classification) ? "selected" : "" ?> > <?=$row->good_type?> </option>
            <?}?>
          </select>
        </div>
      </div>

      <div class=" col-md-3">
              <label for="text-input" class=" form-control-label">Nature of the Goods</label>
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-rebel"></i> </div>
            <select size="1" name="good_nature" id="good_nature" class="form-control" required="true">
              <option value="" disabled selected>Please select</option>
              <? foreach($goods_natur as $row) { ?>
                 <option value="<?=$row->nature_id?>" <?= ($row->nature_id == $value->goods_nature) ? "selected" : "" ?> > <?=$row->good_nature_name?> </option>
              <?}?>
            </select>
          </div>
      </div>

      <div class=" col-md-3">
          <label class=" form-control-label">Goods Type</label>
      <div class="dropdown-content">
          <select data-placeholder="Select  a Commodities..."  size="1" name="goods_type" id="goods_type" class="standardSelect form-control" tabindex="1" required="true">
              <option value="<?=$value->goods_type?>"><?=$value->goods_type?></option>
              <? foreach($commodities_lists as $row1) { ?>  
              <option value="<?=$row1->commodities_name?>"><?=$row1->commodities_name?></option>
              <?}?>
          </select> 
      </div>
      </div>   
       
      <div class=" col-md-3" >
        <label for="select" class=" form-control-label">Type of Packages</label>
        <div class="input-group"> 
            <select size="1" name="package_type" id="package_type" class="standardSelect form-control" required="true">
                <option value="<?=$value->package_type?>"><?=$value->package_type?></option>
                <? foreach($packages as $row1) { ?>  
                <option value="<?=$row1->packages_name?>"><?=$row1->packages_name?></option>
                <?}?>
            </select>
        </div>
      </div>
      

    </div>     
<!-- ----------------------------Create New Row --------------------------------------------------- -->

         <div class="col-xs-12 col-sm-12" style="margin-top: 15px;">
            
            <div class=" col-md-3">
              <label class=" form-control-label">Brand Name</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-bandcamp"></i> </div>
             
                 <input class="form-control" name="brand_name" type="text"   value="<?=$value->brand_name?>" required="true" placeholder="Brand Name">
              </div>              
            </div>

            <div class=" col-md-3">
                 <label class=" form-control-label">No of packages</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-paste"></i> </div>
                 <input class="form-control" name="no_of_packages"  onchange="getVules()" id="_no_of_packages_" type="Number" step="any" min="1" required="true" placeholder="Enter No of Packages"  value="<?=$value->no_of_packages?>" style="font-weight: bold;" >
            </div>              
            </div>

      
            <div class=" col-md-3">
                 <label for="text-input" id="weight_per_package" class=" form-control-label">
                 Weight  Per Piece</label> 
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-circle-o-notch"></i> </div>
                 <input type="number" id="weight" value="<?=$value->weight?>" onchange="getVules()" step="any" min="1" name="weight" placeholder="Enter Value" class="form-control"style="font-weight: bold;" ><small class="form-text text-muted" required="true"></small>
           </div>              
           </div>
              

            <div class=" col-md-3">
                <label for="text-input" class=" form-control-label">Price  Per Unit</label>
               <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-money"></i> </div> 
                    <input type="number" step="any" min="1" id="target_price" value="<?=$value->target_price?>" name="target_price" placeholder="Enter Price" class="form-control"  required="required" style="font-weight: bold;" ><small class="form-text text-muted"></small>                     
              </div>
            </div>
            

         </div> <!-- Close row ... -->       

<!-- =====================================Create a New Row=============================== -->

         <div class="col-xs-12 col-sm-12" style="margin-top: 15px;">

         <div class=" col-md-3">
                <label for="text-input" class=" form-control-label"><b>Total Weight of Goods</b></label> 
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-balance-scale"></i> </div>               
                  <input type="number" id="total_luggage" step="any" name="total_luggage"  value="<?=$value->total_luggage?>" placeholder="Enter Total Luggage" class="form-control" required="true" min="1" style="font-weight: bold;" readonly><small class="form-text text-muted"></small>
            </div>
          </div>
         

        <div class=" col-md-3">
        <label for="text-input" class=" form-control-label">Unit</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-rebel"></i> </div>   
            <select size="1" name="luggage_unit" id="luggage_unit" class="form-control" required="true">
              <option value="<?=$value->luggage_unit?>"><?=$value->luggage_unit?></option>
              <option value="KGS">KGS</option>
              <option value="TON">TON</option>
              <option value="GM">GM</option>
              <option value="MAUND">MAUND</option>
              <option value="CBM">CBM</option>


            </select>
        </div>
        </div>

        <div class=" col-md-3">
            <label for="text-input" class=" form-control-label">Warehouse Officer  Name</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i> </div>            
            <input type="text" id="destination_name" name="destination_name" value ="<?=$value->destination_name?>" placeholder="Enter Name" class="form-control" required="true" ><small class="form-text text-muted"></small>
        </div>
        </div>

        <div class=" col-md-3">
          <label for="text-input" class=" form-control-label">Warehouse Officer Contact No</label>
      <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i> </div>
          <input type="tel" id="destination_contactno" name="destination_contactno" value="<?=$value->destination_contactno?>" maxlength="11" minlength="11" placeholder="(000) 000-0000"  class="tel form-control" required="true"><small class="form-text text-muted"></small>
          
      </div>           
      </div>
       </div> <!-- Close row ... -->       

       <?}?>
  <!-- ========= -->
      </div>
      
      <div align="right" style="padding-right: 45px;" >
          <button type="submit"   class="btn btn-info  mt-4">
              <i class="fa fa-plus"></i> Save
          </button>     
      </div>     
        </form>
    </div>
    </div>
    </div>








	  
    <div class="col-lg-12" id="drop_">
    <div class="card">
    <div class="card-header">
        <i class="pull-right fa fa-check-circle" style="color:green;"></i>
        <strong class="card-title">Drop-Off Information</strong>
    </div>

    <div class="card-body">
    <? foreach ($drop_details as  $value) {?>  
    <form method="post" action="controller/action-ctl.php"  id="pickup_form" enctype="multipart/form-data">
    <div  class="row form-group">   
    <div  class="col-xs-12 col-sm-12">
    
        <input type="hidden" class="form-control" name="command" value="update_drop_details" >  
        <input type="hidden" name="load_id" value="<?php if($load_id){echo $load_id;}?>" > 
        <input type="hidden" name="dest_id" value="<?php echo $value->pickup_id?>" >   
    <div class="form-group col-md-6 mt-3">
        <label class=" form-control-label">Destination</label>
    <div class="input-group">
    <div class="input-group-addon col-sm-12"><i class="fa fa-map-marker"></i>
    </div>
    </div>  

        <input id="query-1" class="query form-control col-xs-12"  value="<?=$value->load_from?>" name="load_from"  type="text" required="required" placeholder="Please Enter Destination Point"/>
    
    </div>

        <input type="hidden" class="form-control text-center col-md-3" name="lat" id="pickup_lat" value="<?=$value->from_latitude?>"     placeholder="From Latitude">

        <input  class="form-control text-center col-md-3" name="lng" value="<?=$value->from_longitude?>" id="pickup_lng" type="hidden" placeholder="From Longitude">


<!-- -----------------------------------    Add Officer Details             ---------------------- -->
           
     <div class="col-md-5 for mt-3"  style=" margin-left: 20px;">
          <label for="select" class=" form-control-label">Select Pickup point for this Destination</label>
            
     <div class="input-group"> 
     <div class="input-group-addon form-control col-sm-1"><i class="fa fa-map-marker"></i> </div>
          <select size="1" name="dest_detail_id" id="dest_detail_id" class="form-control" required="true">
              <option value="<?=$value->dest_detail_id?>"><?=$value->load_to?></option>
                  <?php $pickup_points = Load::GetPickupPointList($load_id);
                  foreach($pickup_points as $row) {?>
                  <option value="<?=$row->load_detail_id?>"><?=$row->load_to?></option>
                  <?php } ?>
          </select>
    </div>
    </div>
    </div>
    
     <div class="form-group col-lg-12 " style="margin-top: 20px;">   


    <div class=" col-md-6 ">
    <label for="text-input" class=" form-control-label">Receiver Name</label>
    <div class="input-group">
    
    <input type="tel" id="source_name1" name="source_name"  value="<?=$value->source_name?>"  placeholder="User"  class="tel form-control" required="true">
    <div class="input-group-addon"><i class="fa fa-user"></i> </div>
    <small class="form-text text-muted"></small>

    </div>           
    </div>


    <div class=" col-md-6 ">
    <label for="text-input" class=" form-control-label">Receiver Contact No</label>
    <div class="input-group">
    
    <input type="tel" id="source_contactno1" name="source_contactno" minlength="11" maxlength="11" value="<?=$value->source_contactno?>"  placeholder="03002255437"  class="tel form-control" required="true">
    <div class="input-group-addon"><i class="fa fa-phone"></i> </div>
    <small class="form-text text-muted"></small>

    </div>           
    </div>


    <div class=" col-md-6 mt-4 ">
    <label for="text-input" class=" form-control-label">Drop Weight </label>
    <div class="input-group">
    
    <input type="number" id="drop_weight" name="drop_weight"  placeholder="000" value="<?=$value->weight_drop?>" class="tel form-control" required="true">
    <div class="input-group-addon"><i class="fa fa-rebel"></i> </div>
    <small class="form-text text-muted"></small>

    </div>           
    </div>


     <div class=" col-md-6 mt-4">
    <label for="text-input" class=" form-control-label">Receiver Email </label>
    <div class="input-group">
    
    <input type="Email" name="source_email"   placeholder="Email@abc.com" value="<?=$value->source_email?>"  class="tel form-control" required="true">
    <div class="input-group-addon"><i class="fa fa-rebel"></i> </div>
    <small class="form-text text-muted"></small>

    </div>           
    </div>
    </div>
    </div>
  
    <div align="right" style="padding-right: 45px;" >
      <button type="submit"   class="btn btn-info  mt-4">
        <i class="fa fa-plus"></i> Save
      </button>     
    </div>  

    </form> 

    <?}?>
  <!-- ========= -->
   
    </div>
    </div>
    </div>


<?
 if(!empty($drop_)){?>   

    <script>  
      
        document.getElementById("basic_info").style.display="none";
        document.getElementById("pickUp").style.display="none";
    </script>

    <? }if(!empty($pickUp)) {?>
      
      <script>  
  
        document.getElementById("drop_").style.display="none";
        document.getElementById("basic_info").style.display="none";
    </script>

    <?} if(!empty($basic_info)) {?>

  <script>  
 
        document.getElementById("drop_").style.display="none";
        document.getElementById("pickUp").style.display="none";
    </script>
  
    <?}?>



    <!-- ==================================================== -->

      
<script type="text/javascript">
    
function getVules() {
   var x = document.getElementById("_no_of_packages_").value;
   var y = document.getElementById("weight").value;
   console.log("value of no of packages:"+x+"--"+"values of weight"+y);
   var result = +x* +y;
       document.getElementById("total_luggage").value = result;
 }

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

  <? 
    if($truck_type_ == "9" || $truck_type_ == "10"){?>
      
       document.getElementById("agent_name").style.display="block";
       document.getElementById("agent_mobileno").style.display="block";
       document.getElementById("container_div").style.display="block";
        document.getElementById("container_req_div").style.display="block";
 
    <?}else{?>

       document.getElementById("container_div").style.display="none";
        document.getElementById("agent_name").style.display="none";
       document.getElementById("agent_mobileno").style.display="none";
        document.getElementById("container_req_div").style.display="none";

    <?}?>
 

  $("#add_user").click(function(){
    // $("add_user").hide();
    var x_ = document.getElementById("source_name_chosen").style.display="none";
    var z = document.getElementById("source_name_chosen").setAttribute("disabled","disabled");
    // var a = document.getElementById("source_name1").removeAttribute("disabled");
    // var y = document.getElementById("source_name1").style.display="block";
    var btn_val = document.getElementById("add_btn").style.display="none";
  });

  $("#add_contct_no").click(function(){
    // $("add_user").hide();
    var x_ = document.getElementById("source_contactno_chosen").style.display="none";
    var z = document.getElementById("source_name_chosen").setAttribute("disabled","disabled");
    // var y = document.getElementById("source_contactno1").style.display="block";
     // var a = document.getElementById("source_contactno1").removeAttribute("disabled");
    var btn_val = document.getElementById("add_btn_contct").style.display="none";
  });


  $("#hide").click(function(){
    $("_insurance_").hide();
    
         var x = document.getElementById("_insurance_");
         var y = document.getElementById("hide");
         var z = document.getElementById("show");
         var h = document.getElementById("heading");
  if (x.style.display === "none" ) {
    x.style.display = "none";

    h.style.display = "none";
    y.style.display = "none";
    z.style.display = "none";

  } else {
    
    h.style.display = "none";
    y.style.display = "none";
    z.style.display = "none";

  }});

 
  $("#show").click(function(){
    $("_insurance_").show();
   
     var x = document.getElementById("_insurance_");
     var y = document.getElementById("hide");
     var z = document.getElementById("show");
     var h = document.getElementById("heading");
  if (x.style.display === "none") {
      x.style.display = "block";
      h.style.display = "none";
      y.style.display = "none";
      z.style.display = "none";
  } else {
      h.style.display = "none";
      y.style.display = "none";
      z.style.display = "none";
  }
  });



});

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
      
const isNumericInput = (event) => {
    const key = event.keyCode;
    return ((key >= 48 && key <= 57) || // Allow number line
        (key >= 96 && key <= 105) // Allow number pad
    );
};

const isModifierKey = (event) => {
    const key = event.keyCode;
    return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
        (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
        (key > 36 && key < 41) || // Allow left, up, right, down
        (
            // Allow Ctrl/Command + A,C,V,X,Z
            (event.ctrlKey === true || event.metaKey === true) &&
            (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
        )
};

const enforceFormat = (event) => {
    // Input must be of a valid number format or a modifier key, and not longer than ten digits
    if(!isNumericInput(event) && !isModifierKey(event)){
        event.preventDefault();
    }
};


</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAEvbxqpoNa3C-CvxuIXP7xFAq0iPKPB5Q"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
          let telEl = document.querySelector('#phoneNum')

      $(document).ready(function() {

        // $('#row_tab a:first').tab('show');
        
});

  // $("#address").geocomplete({details:"form#pickup_form"});
});

</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){

  $('#truck_type').change(function(){

                var id= document.getElementById("container_div");
                var no_container_req = document.getElementById("container_req_div");
                let truck_type= $("#truck_type").val();
               

                if( truck_type == "9" || truck_type == "10"){
                  id.style.display = "block";
                  no_container_req.style.display = "block";
                }else {
                  id.style.display = "none";
                  no_container_req.style.display = "none";
                }

                let command = 'fetchCapacity';
                $.ajax(
                {
                    type:"post",
                    url: "../goodsowner/controller/action-ctl.php",
                    data:{ truck_type:truck_type,command:command},
                    success:function(response)
                    {
                        // console.log(response);
                        $('#capacity').html(response);
                                  
                     }  
                }
               );


            });


    $('#job_type').change(function(){

                var agnt_nme= document.getElementById("agent_name");
                var agent_mobileno = document.getElementById("agent_mobileno");
                var cro_doc = document.getElementById("cro_doc");
                var invoice_doc = document.getElementById("invoice_doc");
                var bl_doc = document.getElementById("bl_doc");
                var delivery_order_doc = document.getElementById("delivery_order_doc");
                var guarantee_doc = document.getElementById("guarantee_doc");
                var gd_doc = document.getElementById("gd_doc");
                var container_locat = document.getElementById("container_locat");
                var container_lat = document.getElementById("container_lat");
                var container_lng = document.getElementById("container_lng");

                

                let job_type= $("#job_type").val();
                
               if(job_type == "Import"){
                  
                  agnt_nme.style.display = "block";
                  agent_mobileno.style.display = "block";
                  // document.getElementById('container_lable').innerHTML = 'Drop Container Location';
                  
                cro_doc.style.display="none";
                invoice_doc.style.display="block";
                bl_doc.style.display="block";
                delivery_order_doc.style.display="block";
                guarantee_doc.style.display="block";
                gd_doc.style.display="block";
                container_lng.style.display="block";
                container_lat.style.display="block";
                container_locat.style.display="block";


                }else if( job_type == "Export"){

                  agnt_nme.style.display = "block";
                  agent_mobileno.style.display = "block";
                  // document.getElementById('container_lable').innerHTML = 'Container PickUp Location From Yard ';

                container_lng.style.display="block";
                container_lat.style.display="block";
                container_locat.style.display="block";
                cro_doc.style.display="block";
                invoice_doc.style.display="block";
                bl_doc.style.display="block";
                delivery_order_doc.style.display="block";
                guarantee_doc.style.display="block";
                gd_doc.style.display="block";
                
                }
                 if(job_type == "Local" || job_type == "UpCountry") {
                 
                  // document.getElementById('container_lable').innerHTML = 'Container Location';
                    agnt_nme.style.display = "none";
                    agent_mobileno.style.display = "none";
                    cro_doc.style.display="none";
                    invoice_doc.style.display="none";
                    bl_doc.style.display="none";
                    delivery_order_doc.style.display="none";
                    guarantee_doc.style.display="none";
                    gd_doc.style.display="none";
                    container_lng.style.display="none";
                    container_lat.style.display="none";
                    container_locat.style.display="none";
                }
            });

});

</script>

<script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/vendors/chosen/chosen.jquery.min.js"></script>

<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({

            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
      
      let today = new Date(),
    day = today.getDate(),
    month = today.getMonth()+1, //January is 0
    year = today.getFullYear();
         if(day<10){
                day='0'+day
            } 
        if(month<10){
            month='0'+month
        }
        today = year+'-'+month+'-'+day;

        // document.getElementById("load_date").setAttribute("min", today);
        // document.getElementById("load_date").setAttribute("value", today);
        // document.getElementById("bid_date_start").setAttribute("min", today);
        // document.getElementById("bid_date_start").setAttribute("value", today);
        // document.getElementById("bid_date_end").setAttribute("min", today);
        // document.getElementById("bid_date_end").setAttribute("value", today);
</script>

<!--=============================================================================================== -->
<!--                            AutoCOmplete Script                                                -->
<!-- ============================================================================================== -->


<script>
  function initAutocomplete() {

    var map = new google.maps.Map(document.getElementsByClassName('map-1'), {

      center: {
        lat: 24.926294,
        lng: 67.022095
      },
      zoom: 13,
      mapTypeId: 'roadmap'
    });

    var markers = [];

    var searchBoxes = document.getElementsByClassName('query');
   
    for (var i=0; i<searchBoxes.length;i++) {
    
     console.log(searchBoxes[i].id);
      var searchBox = new google.maps.places.SearchBox(searchBoxes[i]);
      map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
      });
      markers.push([]);
      searchBox.searchBoxesid = searchBoxes[i].id;
      searchBox.addListener('places_changed', (function(i) {
        return function() {
          processSearch(i, this)
    
        }
      }(i)));
    }

    function processSearch(uniqueId, searchBox) {
      var places = searchBox.getPlaces();

     // console.log("input_id :"+searchBox.searchBoxesid);


      if (places.length == 0) {
        return;
         alert("0");
         console.log("0");
      }

      markers[uniqueId].forEach(function(marker) {
        marker.setMap(null);
      });
      markers[uniqueId] = [];

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
             alert("NULL Data");
         console.log("NULL DATS");
          // console.log("Returned place contains no geometry");
          return;
        }
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

        // Create a marker for each place.
        if (!markers[uniqueId]) markers.push([]);
        markers[uniqueId].push(new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location
        }));

         // console.log("latitude : "+place.geometry.location.lat());     
         // console.log("longitude : "+place.geometry.location.lng());
        
        if(searchBox.searchBoxesid == "query-0")
        {

        document.getElementById("con_lat").value = place.geometry.location.lat();
        document.getElementById("con_lng").value = place.geometry.location.lng();
        }
        else if(searchBox.searchBoxesid == "query-1") {

        document.getElementById("pickup_lat").value = place.geometry.location.lat();
        document.getElementById("pickup_lng").value = place.geometry.location.lng();

        } else if(searchBox.searchBoxesid == "query2"){

      
        document.getElementById("drop_lat_").value = place.geometry.location.lat();
        document.getElementById("drop_lng_").value = place.geometry.location.lng();

        }


        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
  
     
    }

  }

</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBc0w-AvPE6AWsOdtsvNcRqaRe9R4XfLyE&callback=initAutocomplete" async defer>
    
 </script> 