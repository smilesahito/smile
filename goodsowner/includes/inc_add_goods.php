<?php 
        include 'custome.css';
        $OWNER_ID = $_SESSION["sess_admin_id"];
        $commodities_lists = Load::fetchCommoditiesList();
        $officer_name = Load::fetch_Officer_name($OWNER_ID);
        $packages=Load::getchPackages();
		    $goods_classify =Load::getGoodsClassification();
		    $goods_natur =Load::getGoodsNature();
		
		?>
<style type="text/css">
#map-1 {
	height: 150px;
	width: 500px;
}
#_align_ {
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
 0% {
-webkit-transform: rotate(0deg);
}
 100% {
-webkit-transform: rotate(360deg);
}
}
 @keyframes spin {
 0% {
transform: rotate(0deg);
}
 100% {
transform: rotate(360deg);
}
}
</style>

<!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>

<div class="breadcrumbs p-3 mb-2 bg-info">
  <div class="col-sm-4">
    <div class="page-header float-left bg-info">
      <div class="page-title bg-info text-white">
        <h1><b><i class="fa fa-briefcase style="margin-right: 8px"></i> New Job Post</b></h1>
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

<!-- =========================================================================================== --> 
<!--                                       Create Tabs                                          --> 
<!-- ========================================================================================== -->

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-tabs faq-cat-tabs">
        <li class="active"> <a href="#load_info" data-toggle="collapse">
          <? 
                 $val = $_GET['info'];
                 if(isset($val))
                 {                        
                 if($val == "basic_info" || $val == "pickup_info" || $val == "drop_info"){?>
          <i class="fa fa-check-circle" style="color:green"></i>
          <?}else {?>
          <i class="fa fa-info"></i>
          <?} }else{?>
          <i class="fa fa-info"></i>
          <?}?>
          Basic Load Information</a> </li>
        <li> <a href="#detail" data-toggle="collapse">
          <? 
                 $val = $_GET['info'];
                 if(isset($val))
                 {     
                 if($val == "pickup_info" || $val == "drop_info"){?>
          <i class="fa fa-check-circle" style="color:green"></i>
          <?}else {?>
          <i class="fa fa-map-marker"></i>
          <?} }else{?>
          <i class="fa fa-map-marker"></i>
          <?}?>
          Pickup Point </a> </li>
        <li> <a href="#pick_up" data-toggle="collapse">
          <? 
                 $val = $_GET['info'];
                 if(isset($val))
                 {     
                 if($val == "drop_info"){?>
          <i class="fa fa-check-circle" style="color:green"></i>
          <?}else {?>
          <i class="fa fa-hospital-o">
          <?} }else{?>
          <i class="fa fa-hospital-o"></i>
          <?}?>
          </i> Destination Point </a> </li>
      </ul>
      <!--    <div class="pull-right" style="margin-top: 10px">
          <button onclick="location.href='add_load.php';" class="btn btn-warning btn-sm">
              <i class="fa fa-home"></i> Home
          </button>
    </div> 
    <br> --> 
      
    </div>
  </div>
</div>

<!-- ================================================================================================ --> 
<!--                                 Add  Basic Load Information                                      --> 
<!-- ================================================================================================ -->

<div class="tab-content faq-cat-content">
  <div class="tab-pane active in fade" id="row_tab">
    <div class="panel-group" id="accordion-cat-1"> </div>
  </div>
</div>
<div class="panel panel-default panel-faq" id="_align_">
  <div class="panel-heading"> <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#load_info">
    <h4 class="panel-title"> <strong>Basic Load Information</strong>
      <? 
            $val = $_GET['info'];
            if(isset($val))
            { 
            if($val == "basic_info" || $val == "pickup_info" || $val == "drop_info"){?>
      <span class="pull-right"> <i class="fa fa-check-circle" style="color:green"></i></span>
      <?}else {?>
      <span class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></span>
      <?} }else {?>
      <span class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></span>
      <?}?>
    </h4>
    </a> </div>
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
                  <select size="1" name="job_type" id="job_type" class="form-control" required="true" >
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
                  <div class="input-group-addon"><i class="fa fa-truck"></i> </div>
                  <select size="1" name="truck_type" id="truck_type" class="form-control" required="true" >
                    <option value="">Please select</option>
                    <?php $truck=Truck::GetTruckTypeList();
                  foreach($truck as $row) { ?>
                    <option value="<?=$row->truck_type_id?>">
                    <?=$row->truck_type_name?>
                    </option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label class=" form-control-label">Capacity</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-rebel"></i> </div>
                  <select  class="form-control" name="capacity" id="capacity" style="height: 30px"  required="true">
                    <option value="<?=$row->truck_type_id?>" hidden="true">----Select Capacity---</option>
                  </select>
                </div>
              </div>
              <div class="form-group  col-md-3">
                <label class=" form-control-label">Date</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                  <input type="date" name="load_date" id="load_date" min="12/25/2019" class="form-control" value="<? echo date('Y-m-d')?>">
                </div>
              </div>
              <div class="form-group col-md-3">
                <label class=" form-control-label">Expected Prices Per Trip </label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-money"></i></div>
                  <input class="form-control" min ="1" name="expected_price" type="Number"  required="true" value="0" style="font-weight: bold;" >
                </div>
              </div>
              <div class="form-group col-md-3" id="container_req_div">
                <label class=" form-control-label">No Of Container Required</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-truck"></i></div>
                  <input type="number" name="container_no" min="1" style="font-weight: bold;" class="form-control" value="1">
                </div>
              </div>
              <div class="form-group col-md-3">
                <label class=" form-control-label">No Of Truck Required</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                  <input type="number" min="1" name="truck_no" class="form-control" value="0"  style="font-weight: bold;" required="true">
                </div>
              </div>
              <div class="form-group col-md-3">
                <label class=" form-control-label">Bid Date Start</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                  <input type="date" name="bid_date_start"  id="bid_date_start" class="form-control " placeholder="mm/dd/yyyy" >
                </div>
              </div>
              <div class="form-group col-md-3">
                <label class=" form-control-label">Bid Date End</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                  <input type="date" name="bid_date_end" id="bid_date_end"  class="form-control" placeholder="mm/dd/yyyy">
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
                  <input class="form-control text-center" name="agent_mobileno" type="phone"  placeholder="Agent Mobile No" maxlength="11" minlength="11">
                </div>
              </div>
            </div>
          </div>
          
          <!-- ===============================================================================================  --> 
          <!--                        Add Container Location Information Section                               --> 
          <!-- =============================================================================================== -->
          
          <div class="form-group col-md-12" id="container_div"> <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#container_pickupoint">
            <div class="form-group col-md-6" id="container_locat" >
              <label class=" form-control-label" id="container_lable">Please First Select Job  Type</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-map-marker"></i> </div>
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
          
          <!-- ===============================================================================================
                                               Submit Button     
     =========================================================================================    -->
          
          <?
        $val = $_GET['info'];
        if(isset($val))
        { 
           if($val =="basic_info"){?>
          <div class="form-group col-md-12">
            <div align="right" style="padding-right: 30px;">
              <button type="submit" disabled="true"  id="info_btn" class="btn btn-success btn-sm"> <i class="fa fa-check"></i> Save </button>
            </div>
          </div>
          <?}else if($val == "drop_info" || $val == ''  || $val == "pickup_info"){?>
          <div class="form-group col-md-12">
            <div align="right" style="padding-right: 30px;">
              <button type="submit"  id="info_btn" class="btn btn-success btn-sm" disabled="true" disabled="true">
              <i class="fa fa-check"></i> Save
              </button>
            </div>
          </div>
          <? } }else{?>
          <div class="form-group col-md-12">
            <div align="right" style="padding-right: 30px;">
              <button type="submit"  id="info_btn" class="btn btn-success btn-sm"> <i class="fa fa-check"></i> Save </button>
            </div>
          </div>
          <?}  ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ================================================================================================ --> 
<!--                  Second Tab Section Pickup Information                                    --> 
<!-- ================================================================================================-->

<div class="panel panel-default panel-faq" id="_align_">
  <div class="panel-heading"> <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#detail">
    <h4 class="panel-title"> <strong>Add Pick-Up Information</strong>
      <? 
                $val = $_GET['info'];
                if(isset($val))
                { 

                if($val =="pickup_info" || $val == "drop_info"){?>
      <span class="pull-right"> <i class="fa fa-check-circle" style="color:green"></i></span>
      <?}else {?>
      <span class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></span>
      <?} }else {?>
      <span class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></span>
      <? }?>
    </h4>
    </a> </div>
  <div id="detail" class="panel-collapse collapse form-group">
    <div class="panel-body form-group">
      <form method="post" action="controller/action-ctl.php"  id="to_form" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="command" value="addloaddetail">
        <input type="hidden" name="load_id"  value="<?php if($param){echo $param;}?>" >
        <div class="row">
          <div class="col-xs-12 col-sm-12" style="height:130px;">
            <div class="col-md-6">
              <label class=" form-control-label">PickUp Point</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-map-marker"></i> </div>
              </div>
              <div id="pac-container_addressto">
                <input id="query2" class="query col-md-12"  type="text" name="load_from" placeholder="Enter a PickUp  location" style="height: 50px" required="true" />
              </div>
              <input type="hidden" class="form-control  text-center" name="lat" id="drop_lat_" placeholder="From Latitude" />
              <input type="hidden" class="form-control  text-center" name="lng" id="drop_lng_" placeholder="From Longitude" />
            </div>
			
			<div class="col-md-6">
				&nbsp;
			</div>
		</div>
		 <div class="col-xs-12 col-sm-12" >
			
			<div class=" col-md-3">
          <label for="text-input" class=" form-control-label">Classification of the Goods</label>
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-rebel"></i> </div>
            <select size="1" name="good_classification" id="good_classification" class="form-control" required="true">
              <option value="" disabled selected>Please select</option>
              <? foreach($goods_classify as $row) { ?>
			           <option value="<?=$row->g_id?>"> <?=$row->good_type?> </option>
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
			           <option value="<?=$row->nature_id?>"> <?=$row->good_nature_name?> </option>
              <?}?>
            </select>
          </div>
      </div>
			
            <div class=" col-md-3" >
              <label class=" form-control-label">Goods Type</label>
              <div class="dropdown-content" >
                <select data-placeholder="Select  a Commodities..."  size="1" name="goods_type" id="goods_type" class="standardSelect form-control" tabindex="1" required="true">
                  <option></option>
                  <? foreach($commodities_lists as $row) { ?>
                  <option value="<?=$row->commodities_name?>">
                  <?=$row->commodities_name?>
                  </option>
                  <?}?>
                </select>
              </div>
            </div>
            <div class=" col-md-3"  >
              <label for="select" class=" form-control-label">Type of Packages</label>
              <div class="input-group">
                <select size="1" name="package_type" id="package_type" class="standardSelect form-control" required="true">
                  <option value="" disabled selected>Please select</option>
                  <? foreach($packages as $row) { ?>
                  <option value="<?=$row->packages_name?>">
                  <?=$row->packages_name?>
                  </option>
                  <?}?>
                </select>
              </div>
            </div>
          </div>
          <!-- Close row ... --> 
          
          <!-- ----------------------------Create New Row --------------------------------------------------- -->
          
          <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
            <div class=" col-md-3">
              <label class=" form-control-label">Brand Name</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-bandcamp"></i> </div>
                <input class="form-control" name="brand_name" type="text"  placeholder="Brand Name" required="true">
              </div>
            </div>
            <div class=" col-md-3">
              <label class=" form-control-label">No of packages</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-paste"></i> </div>
                <input class="form-control" name="no_of_packages"  onchange="getVules()" id="_no_of_packages_" type="Number" step="any" min="1" required="true" placeholder="Enter No of Packages"  style="font-weight: bold;" >
              </div>
            </div>
            <div class=" col-md-3">
              <label for="text-input" id="weight_per_package" class=" form-control-label"> Weight  Per Piece</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-circle-o-notch"></i> </div>
                <input type="number" id="weight"  onchange="getVules()" step="any" min="1" name="weight" placeholder="Enter Value" class="form-control"style="font-weight: bold;" >
                <small class="form-text text-muted" required="true"></small> </div>
            </div>
            <div class=" col-md-3">
              <label for="text-input" class=" form-control-label">Unit</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-rebel"></i> </div>
                <select size="1" name="luggage_unit" id="luggage_unit" class="form-control" required="true">
                  <option value="" disabled selected>Please select</option>
                  <option value="KGS">KGS</option>
                  <option value="TON">TON</option>
                  <option value="GM">GM</option>
                  <option value="MAUND">MAUND</option>
                  <option value="CBM">CBM</option>
                </select>
              </div>
            </div>
          </div>
          <!-- Close row ... --> 
          
          <!-- =====================================Create a New Row=============================== -->
          
          <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
            <div class=" col-md-3">
              <label for="text-input" class=" form-control-label"><b>Total Weight of Goods</b></label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-balance-scale"></i> </div>
                <input type="number" id="total_luggage" step="any" name="total_luggage" placeholder="Enter Total Luggage" class="form-control" required="true" min="1" style="font-weight: bold;" readonly>
                <small class="form-text text-muted"></small> </div>
            </div>
            <div class=" col-md-3">
              <label for="text-input" class=" form-control-label">Price  Per Unit</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-money"></i> </div>
                <input type="number" step="any" min="1" id="target_price" name="target_price" placeholder="Enter Price" class="form-control"  required="required" style="font-weight: bold;" >
                <small class="form-text text-muted"></small> </div>
            </div>
            <div class=" col-md-3">
              <label for="text-input" class=" form-control-label">Warehouse Officer  Name</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i> </div>
                <input type="text" id="destination_name" name="destination_name" placeholder="Enter Name" class="form-control" required="true" >
                <small class="form-text text-muted"></small> </div>
            </div>
            <div class=" col-md-3">
              <label for="text-input" class=" form-control-label">Warehouse Officer Contact No</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i> </div>
                <input type="tel" id="destination_contactno" name="destination_contactno" maxlength="11" minlength="11" placeholder="(000) 000-0000"  class="tel form-control" required="true">
                <small class="form-text text-muted"></small> </div>
            </div>
          </div>
          <!-- Close row ... --> 
          
          <!-- ====================Create a New Row=========================================================== --> 
          
        </div>
        <div align="right" style="margin-top: 20px;">
          <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-check"></i> Add Another PickUp Location </button>
          <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-check"></i> Save </button>
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
          <th scope="col-md-2">#</th>
          <th scope="col-md-3">Good Type</th>
          <th scope="col-md-2">To</th>
          <th scope="col-md-2">No. of Packages</th>
          <th scope="col-md-2">Weight</th>
          <th scope="col-md-1">Package Type</th>
          <th scope="col-md-2">Target Price</th>
          <th scope="col-md-2">Mobile No.</th>
          <!-- <th scope="col-md-2">Action</th> --> 
        </tr>
      </thead>
      <tbody>
        <?php 
          $a=1;
          foreach($destination as $row)
          { ?>
        <tr>
          <td scope="row"><?=$a?></td>
          <td class="col-md-2" ><?=$row->goods_type?></td>
          <td class="col-md-3"><?=$row->load_to?></td>
          <td class="col-md-2"><?=$row->no_of_packages?></td>
          <td class="col-md-2"><?=$row->weight?></td>
          <td class="col-md-2"><?=$row->package_type?></td>
          <td class="col-md-2"><?=$row->target_price?></td>
          <td class="col-md-2"><?=$row->destination_contactno?></td>
          <!--   <td>
                    <a href="controller/action-ctl.php?command=delpickpoint&load_id=<?=$param?>&load_detail_id=<?=$row->load_detail_id?>" class="btn btn-danger btn-sm mt-2" role="button"><i class="fa fa-trash-o"></i></a>
                    
                </td> --> 
        </tr>
        <?php $a++; }  }?>
      </tbody>
    </table>
  </div>
</div>

<!-- ===================================================================== --> 
<!--                     Third Tab Add Drop Off Information                --> 
<!-- ===================================================================== -->

<div class="panel panel-default panel-faq" id="_align_">
  <div class="panel-heading"> <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#pick_up">
    <h4 class="panel-title"> <strong>Add Drop-Off Information</strong>
      <? 
            $val = $_GET['info'];
            if(isset($val))
            { 

            if($val =="drop_info"){?>
      <span class="pull-right"> <i class="fa fa-check-circle" style="color:green"></i></span>
      <?}else {?>
      <span class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></span>
      <?} }else{?>
      <span class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></span>
      <?}?>
    </h4>
    </a> </div>
  <div  id="pick_up"  class="panel-collapse collapse">
    <div  class="panel-body">
      <form method="post" action="controller/action-ctl.php"  id="pickup_form" enctype="multipart/form-data">
        <div  class="row form-group">
          <div  class="col-xs-12 col-sm-12">
            <input type="hidden" class="form-control" name="command" value="addpickpoint" >
            <input type="hidden" name="load_id" value="<?php if($param){echo $param;}?>" >
            <input type="hidden" name="owner_id" value="<?php echo $OWNER_ID?>" >
            <div class="form-group col-md-6 mt-3">
              <label class=" form-control-label">Destination</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-map-marker"></i> </div>
              </div>
              <input id="query-1" class="query form-control col-xs-12"  name="load_from"  type="text" required="required" placeholder="Please Enter Destination Point"/>
            </div>
            <input type="hidden" class="form-control text-center col-md-3" name="lat" id="pickup_lat"  placeholder="From Latitude" >
            <input  class="form-control text-center col-md-3" name="lng"  id="pickup_lng" type="hidden" placeholder="From Longitude">
            
            <!-- -----------------------------------    Add Officer Details             ---------------------- -->
            
            <div class="col-md-5 for"  style="margin-top: 10px; margin-left: 20px;">
              <label for="select" class=" form-control-label">Select Pickup point for this Destination</label>
              <div class="input-group">
                <div class="input-group-addon form-control"><i class="fa fa-map-marker"></i> </div>
                <select size="1" name="dest_detail_id" id="dest_detail_id" class="form-control" required="true">
                  <option value="" disabled selected>Please select</option>
                  <?php $pickup_points = Load::GetPickupPointList($param);
                    foreach($pickup_points as $row) {?>
                  <option value="<?=$row->load_detail_id?>">
                  <?=$row->load_to?>
                  </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div>
            <div class="form-group col-md-6 " style="margin-top: 20px;" >
              <label class=" form-control-label col-md-12" style="margin-left: 5px">Receiver Name</label>
              <div class="dropdown-content col-md-7" >
                <select data-placeholder="Select Existing Officer Name..." size="1" name="source_name" id="source_name" class="form-control standardSelect " tabindex="1">
                  <option>Please Select</option>
                  <? foreach($officer_name as $row) { ?>
                  <option value="<?=$row->source_name?>">
                  <?=$row->source_name?>
                  </option>
                  <?}?>
                </select>
              </div>
              <input type="text" id="source_name1" name="source_name" placeholder="Name" class="form-control col-md-6" style="margin-left: 20px">
              <div id="add_user" class="col-md-4">
                <button type="button" id="add_btn" class="btn btn-success btn-sm"> <i class="fa fa-plus" style="margin-right: 5px"></i>New Name </button>
              </div>
            </div>
            <div class="form-group col-md-6" style="margin-top: 20px;">
              <div>
                <label for="text-input" class="form-control-label" style="margin-left: 10px"> Receiver   Contact No </label>
              </div>
              <div class="dropdown-content col-md-6">
                <select data-placeholder="Select Existing Contact No..." size="1" name="source_contactno" id="source_contactno" class=" standardSelect form-control "  tabindex="1">
                  <option></option>
                  <? foreach($officer_name as $row) {?>
                  <option value="<?=$row->source_contactno?>">
                  <?=$row->source_contactno?>
                  </option>
                  <?}?>
                </select>
              </div>
              <input type="number" id="source_contactno1" name="source_contactno" placeholder="Enter Number" class="form-control col-md-6" style="margin-left: 20px" required="true" >
              <div id="add_contct_no" class="col-md-3">
                <button type="button" id="add_btn_contct" class="btn btn-success btn-sm"> <i class="fa fa-plus" style="margin-right: 5px"></i>Contact No </button>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="text-input" class=" form-control-label" style="margin-left: 20px">Please Enter Drop Weight </label>
              <div class="input-group" style="margin-left: 15px">
                <div class="input-group-addon"><i class="fa fa-bandcamp"></i> </div>
                <input type="number" id="drop_weight" name="drop_weight" placeholder="000" class="form-control"  step="any" min="1" required="ture">
                <small class="form-text text-muted"></small> </div>
            </div>
            <div class="form-group col-md-6">
              <label for="text-input" class=" form-control-label" style="margin-left: 20px">Receiver  Email</label>
              <div class="input-group" style="margin-left: 15px">
                <div class="input-group-addon"><i class="fa fa-envelope"></i> </div>
                <input type="Email" id="" name="source_email" placeholder="Email@abc.com" class="form-control col-md-10" required="true">
                <small class="form-text text-muted"></small> </div>
            </div>
          </div>
        </div>
        <div style="text-align: right;margin-top: ">
          <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-plus"></i> Add Another Drop Location </button>
          <button type="submit"  class="btn btn-success btn-sm"> <i class="fa fa-check"></i> Save </button>
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
            <th scope="col">Drop Location</th>
            <th scope="col">Source Name</th>
            <th scope="col">Contact #</th>
            <th scope="col">Source Mail</th>
            <th scope="col">Drop Weight</th>
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
            <td><?=$row->weight_drop?></td>
            <!--  <td>
                          <a href="controller/action-ctl.php?command=delpickpoint&load_id=<?=$param?>&load_detail_id=<?=$row->pickup_id?>" class="btn btn-danger btn-sm mt-2" role="button"><i class="fa fa-trash-o"></i></a>
                            
                      </td> --> 
          </tr>
          <?php $a++; } } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- =======================================================================================--> 
<!--                                   Insurance panel                                      --> 
<!--========================================================================================  --> 

<!-- ======================================================================================
                            IF GO OPT Insurance for this JOb SHow Details
 ==========================================================================================   -->

<div class="row form-group"  id="_insurance_" class="panel-collapse collapse">
<div class="col-xs-12 col-sm-12" id="disp_Info"></div>
</div>

<!-- =================================================================================================== --> 
<!-- =================================================================================================== --> 
<!--                                Final Button Of this JOb Posting                                     --> 
<!-- =================================================================================================== --> 
<!-- =================================================================================================== -->

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
<div class="mt-4">
  <h4 class="c">
    <center>
      <b>POST JOB</b>
    </center>
  </h4>
  <div class="col-sm-12 ">
    <center>
      <?
              if($param){
               $id_exist = GoodsOwner::_id_exist_($param);
              
               if($id_exist !== FALSE)
              {?>
      <form method="post" action="confirmation_post.php">
        <input type="hidden" name="load_id"  value="<?php if($param){echo $param;}?>">
        <a href="confirmation_post.php" class="text-dark">
        <button type="submit"  class="btn btn-success  block mt-3 mb-4"> <i class="fa fa-check mr-2"></i> POST JOB </button>
        </a>
      </form>
      <?}
              else
              {?>
      <button type="submit" disabled="true" class="btn bg-info bg-info block mt-3 mb-4"> <i class="fa fa-check mr-2" style="color: black;"></i> POST JOB </button>
      <?} }else{ ?>
      <button type="submit"  disabled="true" class="btn bg-info bg-info block mt-3 mb-4"> <i class="fa fa-check mr-2" style="color: black;"></i> POST JOB </button>
      <?}?>
    </center>
  </div>
</div>

<!-- ==================================================================================================== 
                                            Script Tag
     ====================================================================================================  -->

<style type="text/css">
   .modal-dialog {
    z-index: 10001;
  }
</style>
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

 // document.getElementById("_insurance_").style.display="none";
 // document.getElementById("loader").style.display="none";
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
  //   $("_insurance_").hide();
    
  //        var x = document.getElementById("_insurance_");
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
  //   $("_insurance_").show();
   
  //    var x = document.getElementById("_insurance_");
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
<!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAEvbxqpoNa3C-CvxuIXP7xFAq0iPKPB5Q"></script> --> 

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

        document.getElementById("load_date").setAttribute("min", today);
        document.getElementById("load_date").setAttribute("value", today);
        document.getElementById("bid_date_start").setAttribute("min", today);
        document.getElementById("bid_date_start").setAttribute("value", today);
        document.getElementById("bid_date_end").setAttribute("min", today);
        document.getElementById("bid_date_end").setAttribute("value", today);
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