<?php 
      include 'custome.css';
        $commodities_lists = Load::fetchCommoditiesList();
        $officer_name = Load::fetch_Officer_name();
        $fetch_Officer_contactno = Load::fetch_Officer_contactno();
        $packages=Load::getchPackages();?> 
      
<style type="text/css">
    
#map-1 {
  height: 150px;
  width: 500px;
}


</style>

    <div class="breadcrumbs p-3 mb-2 bg-info">
    <div class="col-sm-4">
    <div class="page-header float-left bg-info">
    <div class="page-title bg-info text-white">
        <h1><b><i class="fa fa-briefcase style="margin-right: 8px"></i>
        New Job Post</b></h1>
    </div>
    </div>
    </div>

    <div class="col-sm-8 bg-info">
    <div class="page-header float-right bg-info">
    <div class="page-title bg-info">
        <ol class="breadcrumb text-right bg-info">
          <li><a href="index.php" class="text-dark"><b>Dashboard</b></a></li>
          <li><a href="load_list.php" class="text-dark"><b>Pending Jobs List</b></a></li>
          <li class="active text-white"><b>New Job </b></li>
        </ol>
    </div>
    </div>
    </div>
    </div>
    
<!-- ====================================================================================================== -->
<!--                                             Create Tabs                                          -->
<!-- ====================================================================================================== -->


    <div class="container">   
    <div class="row">
    <div class="col-md-12 ">
        <ul class="nav nav-tabs faq-cat-tabs">
            <li class="active"><a href="#load_info" data-toggle="collapse"><i class="fa fa-info"></i> Basic Load Information</a></li>
            <li><a href="#pick_up" data-toggle="collapse"><i class="fa fa-map-marker"></i> Pickup Point</a></li>
            <li><a href="#detail" data-toggle="collapse"><i  class="fa fa-hospital-o"></i> Load Detail</a></li>
            <li><a href="#insurance" data-toggle="collapse"><i class="fa fa-money"></i> Insurance </a></li>

        </ul>
    <div class="pull-right" style="margin-top: 10px">
          <button onclick="location.href='add_load.php';" class="btn btn-warning btn-sm">
              <i class="fa fa-home"></i> Home
          </button>
    </div> 
    <br>


<!-- ================================================================================================ -->
<!--                                 Add  Basic Load Information                                      -->
<!-- ================================================================================================ -->

    <!-- Tab panes -->

    <div class="tab-content faq-cat-content">
    <div class="tab-pane active in fade" id="row_tab">
    <div class="panel-group" id="accordion-cat-1">
    
    <div class="panel panel-default panel-faq">
    <div class="panel-heading">
        <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#load_info">
          <h4 class="panel-title">
            <strong>Basic Load Information</strong>
              <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
          </h4>
        </a>
    </div>
    
    <div id="load_info" class="panel-collapse collapse">
    <div class="panel-body">
    <div class="row form-group">
    <form action="controller/action-ctl.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="command" value="addload">
    <div class="col-xs-12 col-sm-12">     
    <div class="card-body card-block">
    <div class="form-group col-md-3">
         <label class="form-control-label">Job Type</label>
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
        <select size="1" name="job_type" id="job_type" class="form-control">
             <option value="" disabled selected>Please select</option>
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
                <select size="1" name="truck_type" id="truck_type" class="form-control">
                  <option value="">Please select</option>
                  <?php $truck=Truck::GetTruckTypeList();
                  foreach($truck as $row) { ?>
                  <option value="<?=$row->truck_type_id?>"><?=$row->truck_type_name?></option>
                  <?php } ?>
                </select>
            </div>
            </div>

            <div class="form-group col-md-3">
                <label class=" form-control-label">Capacity</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-rebel"></i>   </div>
                 <select  class="form-control" name="capacity" id="capacity" style="height: 30px"> 
                     <option value="<?=$row->truck_type_id?>" hidden="true">----Select Capacity---</option>    
                 </select> 

            </div>
            </div>   
            
            <div class="form-group  col-md-3">
                <label class=" form-control-label">Date</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                <input type="date" name="load_date" class="form-control" value="<? echo date('Y-m-d')?>">
            </div>
            </div>

            <div class="form-group col-md-3">
                  <label class=" form-control-label">Expected Prices Per Trip </label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                  <input class="form-control" name="expected_price" type="text" required="required" value="0000">
            </div>
            </div>
            
            <div class="form-group col-md-3" id="container_req_div">
                <label class=" form-control-label">No Of Container Required</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-truck"></i></div>
                <input type="number" name="container_no" class="form-control" value="0" required="required">
            </div>
            </div>
            
            <div class="form-group col-md-3">
                <label class=" form-control-label">No Of Truck Required</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                <input type="number" name="truck_no" class="form-control" value="0" required="required">
            </div>
            </div>

            <div class="form-group col-md-3">
                <label class=" form-control-label">Bid Date Start</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                <input type="date" name="bid_date_start" class="form-control " placeholder="mm/dd/yyyy">
            </div>
            </div>

            <div class="form-group col-md-3">
                <label class=" form-control-label">Bid Date End</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                 <input type="date" name="bid_date_end" class="form-control " placeholder="mm/dd/yyyy">
            </div>
            </div>

            <div class="form-group col-md-3" id="agent_name" >
                 <label class=" form-control-label">Agent Name</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                 <input class="form-control text-center" name="agent_name" type="text" placeholder="Agent Name">
            </div>  
            </div>
           
            <div class="form-group col-md-3" id="agent_mobileno">
               <label class=" form-control-label">Agent Mobile No</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                <input class="form-control text-center" name="agent_mobileno" type="number" placeholder="Agent Mobile No" maxlength="11" >
          
            </div>
            </div>
            </div>
            </div>


<!-- ===============================================================================================  -->
<!--                        Add Container Location Information Section                               -->
<!-- =============================================================================================== -->
            

            <div class="form-group col-md-12" id="container_div">    
                <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#container_pickupoint">
            <div class="form-group col-md-6" id="container_locat" >
                 <label class=" form-control-label" id="container_lable">Please First Select Job  Type</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i>
            </div>
            </div>

            <input id="query-0" class="query col-md-12" style="height: 70px;" type="text" name="con_location" placeholder="Container Location" />
                                            
            </div>
            </a> 

                <input type="hidden" class="form-control text-center" name="container_lat"  id="con_lat" placeholder="From Latitude" >
 
                <input type="hidden" class="form-control text-center" name="container_lng"  id="con_lng" placeholder="From Longitude" >
                
            <div class="form-group col-md-6"></div>
            <div class="form-group col-md-4" id="cro_doc">
                <label class=" form-control-label">Upload CRO</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input type="file"  name="con_cro" id="cro" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            </div>
            </div>

<!--================================================================================================== -->
<!--                                Document Upload  Section                                          -->
<!-- ================================================================================================ -->
            
              <div class="form-group col-md-4" id="delivery_order_doc">
                <label class=" form-control-label">Upload Delivery Doc</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input type="file"  name="delivery_doc" id="delivery_order_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            </div>
            </div>

           
              <div class="form-group col-md-4" id="guarantee_doc">
                <label class=" form-control-label">Upload Gurantee Doc</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input type="file"  name="guarantee_doc" id="guarantee_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            </div>
            </div>

           
                <div class="form-group col-md-4" id="gd_doc">
                <label class=" form-control-label">Upload GD Doc</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input type="file"  name="gd_doc" id="gd_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            </div>
            </div>

            
              <div class="form-group col-md-4" id="bl_doc">
                <label class=" form-control-label">Upload BL Doc </label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input type="file"  name="bl_doc" id="bl_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            </div>
            </div>

     
               <div class="form-group col-md-4" id="invoice_doc">
                <label class=" form-control-label">Upload Invoice</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input type="file"  name="invoice_doc" id="invoice_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
            
            </div>
            </div>
            </div>  


<!--------------------------------------Submit Button-------------------------------------------      -->
            
            <div class="form-group col-md-12">
            <div align="right" style="padding-right: 10px;">
                <button type="submit" id="info_btn" class="btn btn-success btn-sm">
                    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>


<!-- ================================================================================================ -->
<!--                         Second Tab Section Pickup Information                                    -->
<!-- ================================================================================================-->


    <div class="panel panel-default panel-faq">
    <div class="panel-heading">
        <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#pick_up">
          <h4 class="panel-title">
          <strong>Add Pick-Up Information</strong>
          <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
          </h4>
        </a>
    </div>

    <div  id="pick_up"  class="panel-collapse collapse">
    <div  class="panel-body">
    <form method="post" action="controller/action-ctl.php"  id="pickup_form" enctype="multipart/form-data" >
    <div  class="row form-group">   
    <div class="col-xs-12 col-sm-12">
        
            <input type="hidden" class="form-control" name="command" value="addpickpoint" >  
            <input type="hidden" name="load_id" value="<?php if($param){echo $param;}?>" >   
            <div class="form-group col-md-6" style="height: 180px"  >
                <label class=" form-control-label">Load From</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i>
            </div>
            </div>  
               <input id="query-1" class="query form-control col-xs-12"  name="load_from"  type="text" required="required" placeholder="Enter Pickup location" />
            <div id="map-1" class="map-1"></div>
            <div id="infowindow-content">
            
            </div>
            </div>
            
            <input type="hidden" class="form-control text-center col-md-3" name="lat" id="pickup_lat"  placeholder="From Latitude" >

            <input  class="form-control text-center col-md-3" name="lng"  id="pickup_lng" type="hidden" placeholder="From Longitude">


<!-- -----------------------------------    Add Officer Details             ---------------------- -->
            
            <div class="form-group col-md-6">
                 <label class=" form-control-label col-md-12" style="margin-left: 5px">Warehouse Officer Name</label>
            
            <div class="dropdown-content col-md-8">
            
            <select data-placeholder="Select Existing Officer Name..." size="1" name="source_name" id="source_name" class=" standardSelect form-control " tabindex="1" >
                <option></option>
                    <? foreach($officer_name as $row) { ?>  
                    <option value="<?=$row->source_name?>"><?=$row->source_name?></option>
                    <?}?>
                </select> 
            </div>

                <input type="text" id="source_name1" name="source_name" placeholder="Name" class="form-control col-md-6" style="margin-left: 20px"  >
                
            <div id="add_user" class="col-md-3">
              <button type="button" id="add_btn" class="btn btn-success btn-sm">
                        <i class="fa fa-plus" style="margin-right: 5px"></i>New Name
              </button>
            
            </div> 
            </div>

            <div class="form-group col-md-6">
                 <label for="text-input" class=" form-control-label" style="margin-left: 20px"> Warehouse Officer  Contact No </label>
            <div class="dropdown-content col-md-8">
                   
                <select data-placeholder="Select Existing Contact No..." size="1" name="source_contactno" id="source_contactno" class=" standardSelect form-control "  tabindex="1" >
                <option></option>
                    <? foreach($fetch_Officer_contactno as $row) {?>  
                    <option value="<?=$row->source_contactno?>"><?=$row->source_contactno?></option>
                    <?}?>
                </select> 
            </div>

            <input type="number" id="source_contactno1" name="source_contactno" placeholder="Enter Number" class="form-control col-md-6" style="margin-left: 20px" required="required" >
        

            <div id="add_contct_no" class="col-md-3">
                  <button type="button" id="add_btn_contct" class="btn btn-success btn-sm">
                        <i class="fa fa-plus" style="margin-right: 5px"></i>Contact No
                 </button>
            
            </div> 
            </div>

            <div class="form-group col-md-6"></div>
            <div class="form-group col-md-4">
                
                <label for="text-input" class=" form-control-label" style="margin-left: 20px">Warehouse Officer Email</label>
            
            <div class="input-group" style="margin-left: 15px">
                  <input type="Email" id="" name="source_email" placeholder="Email@abc.com " class="form-control" ><small class="form-text text-muted" required="required"></small>
            </div>
            </div>
            </div>
            </div>
            
            <div style="text-align: right;margin-top: ">
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="fa fa-plus"></i> Add Another PickUp Location
                </button>
               
                <button type="submit"  class="btn btn-success btn-sm">
                  <i class="fa fa-check"></i> Submit
                </button>                                          
            
            </div>
            </form>              
            <br> 
           
            <?php  
            $pick_point=Load::GetPickupDetails($param);
            if($pick_point)
            {?>
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">PickUp Location</th>
                      <th scope="col">Source Name</th>
                      <th scope="col">Contact #</th>
                      <th scope="col">Source Mail</th>
                      <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $a=1;
                foreach($pick_point as $row)
                { 
                ?>
                  <tr>
                      <th scope="row"><?=$a?></th>
                      <td><?=$row->load_from?></td>
                      <td><?=$row->source_name?></td>
                      <td><?=$row->source_contactno?></td>
                      <td><?=$row->source_email?></td>
                      <td>
                          <a href="controller/action-ctl.php?command=delpickpoint&load_id=<?=$param?>&load_detail_id=<?=$row->pickup_id?>" class="btn btn-danger btn-sm mt-2" role="button"><i class="fa fa-trash-o"></i></a>
                            
                      </td>
                  </tr>
                  <?php $a++; } } ?>    
                </tbody>
            </table>
    </div>    
    </div>
    </div>   

<!-- ====================================================================================================== -->
<!-- --------------------------------- Third Tab Add Drop Off Information --------------------------------- -->
<!-- ====================================================================================================== -->

    <div class="panel panel-default panel-faq">
    <div class="panel-heading">
        <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#detail">
          <h4 class="panel-title">
            <strong>Add Drop-Off Information</strong>
            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
          </h4>
        </a>
    </div>
        
    <div id="detail" class="panel-collapse collapse form-group">
    <div class="panel-body form-group">
    <form method="post" action="controller/action-ctl.php"  id="to_form" enctype="multipart/form-data" >    
    <div class="row">
    <div class="col-xs-12 col-sm-12" style="height:130px;">
          
            <div class="col-md-6">
                <label class=" form-control-label">Destination Point</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i>
            </div>
            </div>
           
            <div id="pac-container_addressto">
          
               <input id="query2" class="query col-md-12"  type="text" name="load_from" placeholder="Enter a Drop-Off  location" style="height: 50px"/>
            </div>
           
            <div id="map-1" class="map-1"></div>
            <div id="infowindow-content">

            </div>

               <input type="hidden" class="form-control text-center" name="lat" id="drop_lat_" type="text" placeholder="From Latitude">
 
                <input type="hidden" class="form-control text-center" name="lng" id="drop_lng_" type="text" placeholder="From Longitude">

            </div>
                
                <input type="hidden" class="form-control" name="command" value="addloaddetail">  
                <input type="hidden" name="load_id"  value="<?php if($param){echo $param;}?>" >   
            
            <div class="col-md-3" style="margin-top: 35px;">
                  <label for="select" class=" form-control-label">Select Pickup Point</label>
            
            <div class="input-group"> 
                 <div class="input-group-addon"><i class="fa fa-map-marker"></i> </div>
                 <select size="1" name="pickup_id" id="pickup_id" class="form-control" required="required">
                    <option value="" disabled selected>Please select</option>
                    <?php $truck=Load::GetPickupPointList($param);
                    foreach($truck as $row) { ?>
                    <option value="<?=$row->pickup_id?>"><?=$row->load_from?></option>
                    <?php } ?>
                </select>
            </div>
            </div>


            <div class=" col-md-3" style="margin-top: 35px;">
                <label class=" form-control-label">Goods Type</label>
          
            <div class="dropdown-content">
                <select data-placeholder="Select  a Commodities..." size="1" name="goods_type" id="goods_type" class="standardSelect form-control"  tabindex="1" required="required" >
                    <option></option>
                    <? foreach($commodities_lists as $row) { ?>  
                    <option value="<?=$row->commodities_name?>"><?=$row->commodities_name?></option>
                    <?}?>
                </select> 
            </div>
            </div>   
       
         </div> <!-- Close row ... -->       
         <div class="col-xs-12 col-sm-12">

            <div class=" col-md-3" >
                <label for="select" class=" form-control-label">Type of Packages</label>
            <div class="input-group"> 
                <select size="1" name="package_type" id="package_type" class="standardSelect form-control" required="required">
                    <option value="" disabled selected>Please select</option>
                    <? foreach($packages as $row) { ?>  
                    <option value="<?=$row->packages_name?>"><?=$row->packages_name?></option>
                    <?}?>
                </select>
            </div>
            </div>


            <div class=" col-md-3">
                 <label class=" form-control-label">No of packages</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-paste"></i> </div>
                 <input class="form-control" name="no_of_packages" type="text" required="required" placeholder="Enter No of Packages" >
            </div>              
            </div>


            <div class=" col-md-3">
                 <label class=" form-control-label">Brand Name</label>
            <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-bandcamp"></i> </div>
                 <input class="form-control" name="brand_name" type="text" required="required" placeholder="Brand Name">
            </div>              
            </div>
     
  
                        
            <div class=" col-md-3">
                 <label for="text-input" id="weight_per_package" class=" form-control-label">
                 Weight  Per Piece</label> 
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-circle-o-notch"></i> </div>
                 <input type="text" id="weight" name="weight" placeholder="Enter Value" class="form-control" ><small class="form-text text-muted" required="required"></small>
           </div>              
           </div>
                
         </div> <!-- Close row ... -->       
         <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">

           <div class=" col-md-3">
                <label for="text-input" class=" form-control-label">Price  Per Unit</label>
           <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-money"></i> </div> 
                <input type="text" id="target_price" name="target_price" placeholder="Enter Price" class="form-control"  required="required"><small class="form-text text-muted"></small>                     
          </div>
          </div>
         
         <div class=" col-md-3">
                <label for="text-input" class=" form-control-label"><b>Total Weight of Goods</b></label>
         <div class="input-group">
         <div class="input-group-addon"><i class="fa fa-balance-scale"></i> </div>               
                <input type="number" id="total_luggage" name="total_luggage" placeholder="Enter Total Luggage" class="form-control" required="required"><small class="form-text text-muted"></small>
          </div>
          </div>

        <div class=" col-md-3">
        <label for="text-input" class=" form-control-label">Total Weight of Unit</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-rebel"></i> </div>   
            <select size="1" name="luggage_unit" id="luggage_unit" class="form-control" required="required">
              <option value="" disabled selected>Please select</option>
              <option value="KGS">KGS</option>
              <option value="TON">TON</option>
              <option value="GM">GM</option>
              <option value="MAUND">MAUND</option>
              <option value="CBM">CBM</option>


            </select>
        </div>
        </div>

        <div class=" col-md-3">
            <label for="text-input" class=" form-control-label">Delivery Receiver  Name</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i> </div>            
            <input type="text" id="destination_name" name="destination_name" placeholder="Enter Name" class="form-control" required="required" ><small class="form-text text-muted"></small>
        </div>
        </div>

       </div> <!-- Close row ... -->       
       <div class="col-xs-12 col-sm-12" style="margin-top: 20px;"> 

      <div class=" col-md-6">
          <label for="text-input" class=" form-control-label">Delivery Receiver Contact No</label>
      <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i> </div>
          <input type="number" id="destination_contactno" name="destination_contactno" placeholder="03171234567" class="form-control" required="required"><small class="form-text text-muted"></small>
      </div>           
      </div>
      
      <div class=" col-md-6">
          <label for="text-input" class=" form-control-label"> Delivery Receiver Email</label>
      <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-envelope"></i>   </div>
          <input type="text" id="destination_email" name="destination_email" placeholder="Email@abc.com" class="form-control"  required="required"><small class="form-text text-muted"></small>
      </div>
      </div>
      </div>        
      </div>


      <div align="right" style="margin-top: 20px;">
          <button type="submit" class="btn btn-danger btn-sm">
              <i class="fa fa-check"></i> Add Another Drop-Off Location
          </button>
          <button type="submit" class="btn btn-success btn-sm">
              <i class="fa fa-check"></i> Submit
          </button>
      </div>
      </form>     
      </div>
      <?php  
      $destination=Load::GetDetails($param);
      if($destination)
      {?>
      <table class="table">
          <thead class="thead-dark">
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Good Type</th>
                  <th scope="col">To</th>
                  <th scope="col">No. of Packages</th>
                  <th scope="col">Weight</th>
                  <th scope="col">Package Type</th>
                  <th scope="col">Load Type</th>
                  <th scope="col">Target Price</th>
                  <th scope="col">Destination Name</th>
                  <th scope="col">Mobile No.</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
          <?php 
          $a=1;
          foreach($destination as $row)
          { ?>
              <tr>
                <td scope="row"><?=$a?></td>
                <td><?=$row->goods_type?></td>
                <td><?=$row->load_to?></td>
                <td><?=$row->no_of_packages?></td>
                <td><?=$row->weight?></td>
                <td><?=$row->package_type?></td>
                <td><?=$row->load_type?></td>
                <td><?=$row->target_price?></td>
                <td><?=$row->destination_name?></td>
                <td><?=$row->destination_contactno?></td>
                <td>
                    <a href="controller/action-ctl.php?command=delpickpoint&load_id=<?=$param?>&load_detail_id=<?=$row->load_detail_id?>" class="btn btn-danger btn-sm mt-2" role="button"><i class="fa fa-trash-o"></i></a>
                    
                </td>
              </tr>
              <?php $a++; }  }?>    
          </tbody>
      </table>
    </div>
    </div>   
                           
<!--============================Insurance Panel===============================================  -->              
    <div class="panel panel-default panel-faq">
    <div class="panel-heading">
        <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#insurance">
        <h4 class="panel-title">
          <strong>Add Insurance Information</strong>
          <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
        </h4>
        </a>
    </div>
        
    <div id="insurance" class="panel-collapse collapse">
    <div class="panel-body">
       <!--  <center id="heading"><h3><b> Do You Want Insurance.??</b></h3> </center>  
        <center> -->
        <!-- <input type="button" name="accept_insurnce" value="Yes" class="btn btn-outline-success btn-sm p-3 mb-2" id="show" style="margin-top: 0px"> -->
        <!-- <input type="button" name="denied_insurnce" value="No" class="btn btn-outline-danger btn-sm p-3 mb-2" id="hide" data-toggle="modal" data-target="#myModal"> -->
        <!-- </center>       -->
    <!-- <div class="row form-group"  id="insurance" class="panel-collapse collapse"> -->
    <!-- <div class="col-xs-12 col-sm-12" id="abc"> -->
         <form action="controller/action-ctl.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="command" value="add_insu">
            <input type="hidden" name="load_id" value="<?php if($param){echo $param;}?>" > 
         <div class="card-body card-block">
                               
<!-- **************** User Want to Insurance  for GOODS ********************************************* -->

        <div class="form-group col-md-3">
            <label class=" form-control-label">Name</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i></div>  
            <label class=" form-control-label form-control">Rashid Ali</label>
        </div>
        </div> 

        <div class="form-group col-md-3">
            <label class=" form-control-label">Contact No</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-phone-square"></i></div>  
            <label class=" form-control-label form-control">03158371494</label>
        </div>
        </div> 

        <div class="form-group col-md-3">
              <label class=" form-control-label">Email</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa  fa-mail-reply-all"></i></div>  
              <label class=" form-control-label form-control">rashidali_1@gmail.com</label>
        </div>
        </div>  

        <div class="form-group col-md-3">
              <label class=" form-control-label">Today-Date</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>  
              <label class=" form-control-label form-control">15-Nov-2019</label>
        </div>
        </div> 

        <div class="form-group col-md-3">
            <label class=" form-control-label">Pickup-Points</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>  
             <select size="1"  class="form-control">
                  <option value="">Nipa Chorangi</option>
                  <option value="">Nazimabad No 4</option>
                  
              </select>
        </div>
        </div>

        <div class="form-group col-md-3">
            <label class=" form-control-label">Destination-Points</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa  fa-location-arrow"></i></div>  
             <select size="1"  class="form-control">
                  <option value="">Port Qasim</option>
                  <option value="">Dhabejii</option>
              
              </select>
        </div>
        </div>

        <div class="form-group col-md-3">
            <label class=" form-control-label">Commodities</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa  fa-suitcase"></i></div>  
             <select size="1"  class="form-control">
                  <option value="">Brown Rice</option>
                  <option value="">Plane Rice</option>
              
              </select>
        </div>
        </div>


        <div class="form-group col-md-3">
            <label class=" form-control-label">Brand Name</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa  fa-bullseye"></i></div>  
             <select size="1"  class="form-control">
                  <option value="">Jazza</option>
                  <option value="">Falak Rice</option>
              
              </select>
        </div>
        </div>

        <div class="form-group col-md-3">
            <label class=" form-control-label">Packages Types</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa  fa-bullseye"></i></div>  
             <select size="1"  class="form-control">
                  <option value="">BAG</option>
                  <option value="">BORA</option>
              
              </select>
        </div>
        </div>

        <div class="form-group col-md-3">
            <label class=" form-control-label">Total Weight of Goods</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-suitcase"></i></div>  
            <label class=" form-control-label form-control">110</label>
        </div>
        </div> 

        <div class="form-group col-md-3">
            <label class=" form-control-label">Total Weight of Unit</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-bullseye"></i></div>  
            <label class=" form-control-label form-control">KGS</label>
        </div>
        </div> 

        <div class="form-group col-md-3">
            <label class=" form-control-label">Total-Price</label>
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-money"></i></div>  
            <input class="form-control" name="total_price_goods" type="text" required="required" placeholder="Enter Price">
        </div>
        </div>

        <div class="form-group col-md-4">
              <label class=" form-control-label">Insurance Value</label>
        <div class="input-group">
        <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-money"></i></div>  
              <select size="1" name="insurance_amount" id="insurane_amount" class="form-control">
                  <option value="">Please select</option>
                  <option value="plus_ten_precnt_value">10% percent above value</option>
                  <option value="minus_ten_precnt_value">10% percent below value</option>
              </select>
        </div>
        </div>
        </div>
                                      
      <div class="form-group col-md-4 " >
            <label class=" form-control-label">Insurance Number</label>
      <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-square"></i></div>
            <label class=" form-control-label form-control">insurance number</label>
      </div>
      </div>

 <!-- *********** New Form Edit of Insurance ************************************************ -->

                <div class="form-group col-md-3 p-2">
                    <label class=" form-control-label"></label>
                <div class="input-group">
                <div class="pull-right">
                    <button type="submit" id="insu_btn" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Add Insurance
                    </button>
                </div>
                </div>
                </div>                                              
                </div>
            </form>
        </div>
        </div>                                                                
        </div>
        <!-- </div> -->
        <!-- </div> -->

<!-- ------------------------------Relaibilty Form about Insurance------------------------------- -->

<style type="text/css">
   .modal-dialog {
    z-index: 10001;
  }
</style>
    

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Reliability form</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
    </div>
    <div class="modal-body">
        ...
    </div>
    <div class="modal-footer">
         <button type="button" class="btn btn-primary" data-dismiss="modal">Agree</button>
    </div>
    </div>
    </div>
    </div>
      


<!-- --------------------------------Relaibilty Form about Insurance----------------->
<!--====================================Insurance Policy========================  -->
                               
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>









<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

 // document.getElementById("abc").style.display="none";
 document.getElementById("container_div").style.display="none";
 document.getElementById("container_req_div").style.display="none";
 document.getElementById("agent_name").style.display="none";
 document.getElementById("agent_mobileno").style.display="none";
 document.getElementById("source_name1").style.display="none";
 document.getElementById("source_name1").setAttribute("disabled","disabled");
 document.getElementById("source_contactno1").setAttribute("disabled","disabled");
 document.getElementById("source_contactno1").style.display="none";


  $("#add_user").click(function(){
    // $("add_user").hide();
    var x_ = document.getElementById("source_name_chosen").style.display="none";
    var z = document.getElementById("source_name_chosen").setAttribute("disabled","disabled");
    var a = document.getElementById("source_name1").removeAttribute("disabled");
    var y = document.getElementById("source_name1").style.display="block";
    var btn_val = document.getElementById("add_btn").style.display="none";

    
  });

  $("#add_contct_no").click(function(){
    // $("add_user").hide();
    var x_ = document.getElementById("source_contactno_chosen").style.display="none";
    var z = document.getElementById("source_name_chosen").setAttribute("disabled","disabled");
    var y = document.getElementById("source_contactno1").style.display="block";
     var a = document.getElementById("source_contactno1").removeAttribute("disabled");
    var btn_val = document.getElementById("add_btn_contct").style.display="none";

    
  });




  // $("#hide").click(function(){
  //   $("abc").hide();
    
  //        var x = document.getElementById("abc");
  //        var y = document.getElementById("hide");
  //        var z = document.getElementById("show");
  //        var h = document.getElementById("heading");
  // if (x.style.display === "none" ) {
  //   x.style.display = "none";

  //   h.style.display = "none";
  //   y.style.display = "none";
  //   z.style.display = "none";

  // } else {
    
  //   h.style.display = "none";
  //   y.style.display = "none";
  //   z.style.display = "none";

  // }});
  // $("#show").click(function(){
  //   $("abc").show();
    
  //    var x = document.getElementById("abc");
  //    var y = document.getElementById("hide");
  //    var z = document.getElementById("show");
  //    var h = document.getElementById("heading");
  // if (x.style.display === "none") {
  //     x.style.display = "block";
  //     h.style.display = "none";
  //     y.style.display = "none";
  //     z.style.display = "none";
  // } else {
  //     h.style.display = "none";
  //     y.style.display = "none";
  //     z.style.display = "none";
  // }
  // });



});

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script>
      
      $(document).ready(function() {

        $('#row_tab a:first').tab('show');
        
});

</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAEvbxqpoNa3C-CvxuIXP7xFAq0iPKPB5Q"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

  $("#address").geocomplete({details:"form#pickup_form"});
});

</script>
<script src="/js/chosen.jquery.min.js"></script>
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
                        console.log(response);
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
                
               if( job_type == "Import"){
                  
                  agnt_nme.style.display = "block";
                  agent_mobileno.style.display = "block";
                  document.getElementById('container_lable').innerHTML = 'Drop Container Location';
                  
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
                  document.getElementById('container_lable').innerHTML = 'Container PickUp Location From Yard ';

                container_lng.style.display="block";
                container_lat.style.display="block";
                container_locat.style.display="block";
                cro_doc.style.display="block";
                invoice_doc.style.display="block";
                bl_doc.style.display="block";
                delivery_order_doc.style.display="block";
                guarantee_doc.style.display="block";
                gd_doc.style.display="block";
                }else if(job_type == "Local" ||job_type == "UpCountry" ) {
                 
                  document.getElementById('container_lable').innerHTML = 'Container Location';
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


               //  let command = 'fetchCapacity';
               //  $.ajax(
               //  {
               //      type:"post",
               //      url: "../goodsowner/controller/action-ctl.php",
               //      data:{ truck_type:truck_type,command:command},
               //      success:function(response)
               //      {
               //          console.log(response);
               //          $('#capacity').html(response);
                                  
               //       }  
               //  }
               // );


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
    
     // console.log(searchBoxes[i].id);
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

     console.log("input_id :"+searchBox.searchBoxesid);


      if (places.length == 0) {
        return;
      }

      markers[uniqueId].forEach(function(marker) {
        marker.setMap(null);
      });
      markers[uniqueId] = [];

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
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

         console.log("latitude : "+place.geometry.location.lat());     
         console.log("longitude : "+place.geometry.location.lng());
        
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

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBc0w-AvPE6AWsOdtsvNcRqaRe9R4XfLyE&callback=initAutocomplete" async defer></script>