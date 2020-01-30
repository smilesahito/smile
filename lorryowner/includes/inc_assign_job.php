<?php  include("laodpost_style.css");
	
	$driver_list = LorryOwner::getDriverList($lo_id);
  $truc_list = LorryOwner::getTruckList($lo_id,$job_id);
 ?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  
}

td, th {
  text-align: left;
  padding: 8px;
}
</style>

    <div class="card" style="background-image: linear-gradient(to left, #209bd6, #2b87b7, #307398, #31607b, #304d5f);" class="btn btn-primary col-md-12;">
        <span class="pull-right"><i onclick="window.history.back();" style="color: white;padding: 15px" class="fa  fa-arrow-left"></i></span>
    </div>

    <div class="content ">
    <div class="row">
    <div class="col-md-12">  
    <div class="tab-content">
    <div id="vehicle" style="display: none;">
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    Please Select Vehicle(s).
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    </div>  


    <div id="driver_tab" style="display: none;">
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    Please Select Driver(s).
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    </div>
    </div>

    <div id="msg" style="display: none;">
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    Number of driver and truck should be equal !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
    </button>
    </div>
    </div>  


    <div class="card" style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);border-radius: 25px;">
    <div class="card-header" style="border-radius: 25px;">
        <span style="margin-left: 10px"> <b> Assign Job </b></span>
    </div>
    <div class="card-body">
         <form action="./controller/action-ctl.php" id="jobassign" method="GET">     
              <div class="form-group col-md-12">
                  <label class=" form-control-label pull-right" ><span style="color:#16B0BE" ><strong>ڈرائیور کا انتخاب کريں</strong></span></label>
              <div class="input-group">
              <div class="input-group-addon"><i class="fa  fa-wheelchair"></i></div>
                  <select  name="driver[]" id="driver" class="form-control" multiple="multiple">
                      <option value="">Please select driver</option>
                      <?php foreach ($driver_list as $row) { ?>
                      <option value="<?=$row->user_id?>"><?=$row->name?><?php
                      if($row->user_id==$user_id){ echo "  (Lorry Owner)";} ?>  </option>
                      <?php } ?> 
                  </select>
              </div>
              </div>

              <div class="form-group col-md-12">
                  <label class=" form-control-label pull-right" ><span style="color:#16B0BE" ><strong>ٹرک کا انتخاب کريں  </strong></span></label>
              <div class="input-group">
              <div class="input-group-addon"><i class="fa  fa-truck"></i></div>
                  <select  name="truck[]" id="truck" class="form-control" multiple="multiple">
                      <option value="">Please select truck</option>
                      <?php foreach ($truc_list as $val){?>
                      <option value=<?=$val->truck_id?>><?php echo $val->truck_type_name. " ( " . $val->truck_no . " )" ?></option>
                      <?php } ?> 
                  </select>
              </div>
              </div>
              <div style="text-align: center;">
                  <input type="hidden" name="job_id" value="<?=$job_id?>">
                  <input type="hidden" name="go_id" value="<?=$go_id?>">
                  <input type="hidden" name="bid_id" value="<?=$bid_id?>">
                  <input type="hidden" name="lo_id" value="<?=$lo_id?>">
                  <input type="hidden" name="command" value="assignjob">
                  <button id="submit" style="background-image: linear-gradient(to left, #209bd6, #2b87b7, #307398, #31607b, #304d5f);border-radius: 25px; width:95%;" class="btn btn-primary"><strong>OK</strong></button>	
              </div>
              </form>
              </div>
              </div>
              </div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script >

$(document).ready(function(){


$("#submit").click(function(event)
{
var driver = $('#driver').val();
var truck = $('#truck').val();


if(driver==null){
$('#driver_tab').css('display','block');
return false;
}

if(truck==null){
$('#vehicle').css('display','block');
return false;
}

if(driver.length != truck.length){
$('#msg').css('display','block');
return false;
}

});           


});

</script>

