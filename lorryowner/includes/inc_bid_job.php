<?php  include("laodpost_style.css");
	
	$job_detail = LorryOwner::getloaddetail($job_id);
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
<div class="content">
    <div class="row">
<div class="col-md-12">  
        <div class="tab-content">
   			<?php foreach ($job_detail as $row) { ?>	
            <div class="card" style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);border-radius: 25px;">
                <div class="card-header" style="border-radius: 25px;">
					<span  class="float-left" style="color: black;margin-left: 3px;"><strong>Amount Detail</strong></span>
                </div>
                <div class="card-body">
                   
				<span style="color:#16B0BE" class="pull-right"><strong> درکار ٹرکوں کی تعداد  </strong></span>
				<span style="color:#16B0BE" class="pull-left"><strong> <?=$truck?> </strong></span>
				<br><hr>
				
				<form action="controller/action-ctl.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="command" value="addbid">
					<input type="hidden" name="job_id" value="<?=$job_id?>">
					<input type="hidden" name="go_id" value="<?=$go_id?>">
					<input type="hidden" name="lo_id" value="<?=$lo_id?>">
					<span style="color:#16B0BE" class="pull-right"><strong> ٹرک کی تعداد  *</strong></span>
					
					<input type="number" class="form-control" name="truck_no" type="text" required="required" placeholder="enter number of truck(s)" required="required">
					<span style="color:#16B0BE" class="pull-right"><strong>رقم  *</strong></span>
					<input class="form-control" name="amount" type="number" required="" placeholder="enter amount" required="required">
					<br>
					<div style="text-align: center;">
					<button  style="background-image: linear-gradient(to left, #209bd6, #2b87b7, #307398, #31607b, #304d5f);border-radius: 25px;  width:95%;" class="btn btn-primary col-md-12; " ><strong>OK</strong>
					</button>
					</div>
                </div>
					
			</form>
            </div>
           <?php } ?> 

      </div>

 </div>

    
          
       