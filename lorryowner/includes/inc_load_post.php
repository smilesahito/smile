 <div id="refresh_page">
<style type="text/css">
 #urdu {
    font-family: "Urdu Nastaliq";
    }

 th{
    color: white;
    font-size: 10px
  }
  td{
    font-size: 10px
  }
  thead{
      background-image: linear-gradient(to left top, #1f4f4f, #1c666d, #157d8e, #1494b3, #28abda);
  }
  .card{
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);border-radius: 25px;
  }

  ul.tree, ul.tree ul { list-style-type: none; background: #fff url(http://odyniec.net/articles/turning-lists-into-trees/vline.png) repeat-y; margin: 0; padding: 0; } ul.tree ul { margin-left: 10px; } ul.tree li { margin: 0; padding: 2px 12px; line-height: 15px; background: url(http://odyniec.net/articles/turning-lists-into-trees/node.png) no-repeat; color: #369; font-weight: bold; } ul.tree li.last {
     background: #fff url(http://odyniec.net/articles/turning-lists-into-trees/lastnode.png) no-repeat;
   }

</style>
 <?php
    
     $user_id = $_GET['user_id'];
     $jobList = LorryOwner::getloadlist('Active',$user_id);
     $bidList = LorryOwner::getbidlist($user_id);
     $inProcessBids = LorryOwner::_GetInProcessBids_($user_id);
  
     $bid_list_array=array();?>
     </div>
     <?
     if(!empty($bidList))
     {
       foreach ($bidList as $val) 
       {
          if(!empty($val->load_id))
          {
              array_push( $bid_list_array,$val->load_id) ;   
          }
       }
     }
            
      $bid_user_list_array=array();
      
      if(!empty($bidList))
      {
        foreach ($bidList as $val) 
        {
          if(!empty($val->load_id))
          {
              array_push( $bid_user_list_array,$val->user_id) ;   
          }
        }
      }
     
      $accept_bid_list = Load::GetLoadAcceptBidList($user_id,'A'); 
      $accept_driverjob_list = Load::GetAccpDriverJobList($user_id);
      include("laodpost_style.css"); ?>

      <link rel="stylesheet" href="includes/bootstrap.min.css">
      <link rel="stylesheet" href="includes/w3.css">
      <header id="header" class="header">
      <div class="header-menu">
      <div class="col-sm-12">
          <img src="../images/lorrycheck.svg"  class="pull-left ml-4 mt-2" style="height:25px;">
         
      
      <div class="container">
          <ul class="nav nav-tabs">
            <li style="margin-left: 20px" class="active"><a data-toggle="tab" href="#home"><span style="font-size: 12px"> Jobs</span></a></li>
            <li><a data-toggle="tab" href="#menu4"><span style="font-size: 12px"> Bid In-Process </span></a></li>
            <li><a data-toggle="tab" href="#menu1"><span style="font-size: 12px"> Bid Accepted </span></a></li>
            <li><a data-toggle="tab" href="#menu2"><span style="font-size: 12px">In Process </span></a></li>
    
          </ul>
      </div>

      <div class="col-sm-5">
      <div class="user-area dropdown">                                          
      </div>
      </div>
      </div>
      </header>
      
      <?if(isset($param2))
      {?>

      <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
      You have successfully Bid this job.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">×</span>
         </button>
      </div>
      <?}?>  

    <?if(isset($param3))
    {?>

    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            Invalid number of truck(s)! Please try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
    </div>
    <?}?>

    <?if(isset($param4))
    {?>
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            You have removed this job.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?}?>
    <div class="content mt-1">
    <div class="row">
    <div class="col-md-12">  
    <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    <div class="col-md-12" >    
    <?php 
    $i=0;
    $j=0;
    if(!empty($jobList)){
    foreach ($jobList as $row) { 
      if(!in_array($row->load_id,$bid_list_array)){ 
      ?>      

    <div class="card"  id="" >
    <div class="card-header" style="border-radius: 25px;">
         <img class="float-left " src="../images/truck_img.png" width="30px" height="25px" > <span  class="float-left" style="color: black;margin-left: 3px;"><strong><?=$row->truck_type_name?></strong></span>
          <span class="float-right"><?=$row->datetime?></span>
    </div>
    <div class="card-body">

     <br>
    <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
        <i class="float-left fa fa-briefcase" style="margin-top: 5px; margin-right:10px" ></i>  
    <span  class="float-left" style="margin-left: 3px; margin-right: 30px;" ><strong>Job Type : <?=$row->job_type?></strong></span>
    <br>
    <?
   $iteration = 0;
   $iteration = count($row->load_detail);
   if($iteration == "1"){?>

      <div id="S_P_<?$value->load_detail_id?>">
        <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
          <i class="float-left fa fa-map-marker" style="margin-right:10px; margin-top: 5px;" ></i>  
           <span  class="float-left" style="margin-left: 3px; margin-right: 30px;">
              <strong>PickUp Location : Single</strong>
           </span>
          <br>
      </div>

   <?}else {?>

      <div id="S_P_">
        <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
          <i class="float-left fa fa-map-marker" style="margin-right:10px; margin-top: 5px;" ></i>  
            <span  class="float-left" style="margin-left: 3px; margin-right: 30px;">
              <strong>PickUp Location : Multiple</strong></span>
            <br>
      </div>
<!--       <script>  
         document.getElementById("S_P_<?$value->load_detail_id?>").style.display="none";
      </script> -->
   <?}?>   


<!-- ******************************************************************************************** -->
      <!--                   For checking Multiple Destnaion is Available or NOT         -->
<!-- ******************************************************************************************** -->

   <?
   $bool_ = 0;
   $bool = count($row->pickup_detail);
   if($bool == "1"){?>
    
    <div id="S_D_<?$value->pickup_id?>">
      <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
        <i class="float-left fa fa-thumb-tack" style="margin-right:10px; margin-top: 5px;" ></i>  
          <span  class="float-left" style="margin-left: 3px; margin-right: 30px;">
          <strong>Destination  : Single</strong>
      </span>
    <br>
    </div>


   <?}else{?>
      
      <div>
        <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
          <i class="float-left fa fa-thumb-tack" style="margin-right:10px; margin-top: 5px;"></i>  
            <span  class="float-left" style="margin-left: 3px; margin-right: 30px;">
              <strong>Destination  : Multiple</strong></span>
          <br>
      </div>
<!-- 
      <script>  
         document.getElementById("S_D_<?$value->pickup_id?>").style.display="none";
      </script> -->
   <?}?>

   
    <?if($row->job_type=="Import"){?>  
    <hr style="height: 1px;">
    <h4><u><center> Container Location</center></u></h4>
    <span class="float-right" style="color: red" id="urdu"><strong>کنٹینر بھیجنے کی جگہ </strong></span>
    <br> 
    <div class="input-group">
       <ul class="ml-4 tree">
          <?php foreach($row->container_detail as $containerLoc ){  ?>
              <li><?=$containerLoc->con_location?></li>
          <?}?>    
         </ul>   
    </div>

    <?}else if($row->job_type=="Export"){?>
       <hr style="height: 1px;">
    <h4><u><center> Container Location</center></u></h4>
    <span class="float-right" style="color: red" id="urdu">
      <strong> جس جگہ  سے  کنٹینر لانا ہیں</strong>
    </span>
    <br> 
    <div class="input-group">
      <ul class="ml-4 tree">
        <?php foreach($row->container_detail as $containerLoc ){  ?>
          <li><?=$containerLoc->con_location?></li>
        <?}?>         
      </ul>   
    </div>

    <?}?>
    
    <hr style="height: 1px;">
    <h4><u><center> PickUp Location</center></u></h4>
    <span class="float-right" style="color: red" id="urdu"><strong> جھاں سے سامان اٹھانا ھے   </strong> </span>
    <br> 
    <div class="input-group">
        <ul class="ml-4 tree">
        <?php foreach($row->load_detail as $laod_row){?>
        <li><?=$laod_row->load_to?></li>
        <?}?>         
        </ul>
    </div>
    <br>
    <hr style="height:  1px;">
    <h4><u><center> Drop Location</center></u></h4>
    <span class="float-right" style="color: red" id="urdu"><strong> جھاں سامان لے جانا ھے </strong> </span>
    <br>                    

        <div class="input-group">
        <ul class="ml-4 tree">
        <?php foreach($row->pickup_detail as $pickup_row ){  ?>
        <li><?=$pickup_row->load_from?></li>
        <?php }?>  
        </ul>
        </div>
        <br>
        <hr>
        <span class="float-right" style="color: red" id="urdu"><strong>اس کام کے پيسے</strong> </span>
            <img   class="float-left" src="../images/cash.png" width="30px" height="25px" > 
        <span  class="float-left" style="margin-left: 3px;" ><strong>RS. <?=$row->expected_price?></strong></span>
        <br><br>
    <div class="input-group">
    <span class="float-right" style="color: red" id="urdu"><strong>درکار ٹرکوں کی تعداد </strong> </span>
        <img   class="float-left" src="../images/truck.png" width="30px" height="25px" > 
    <span  class="float-left" style="margin-left: 3px;" ><strong> <?=$row->remaining_truck?></strong></span>
    </div>
    </div>

    <div align="center" style="margin-bottom: 10px">
    <form action="jobs_detail.php" method="GET">
      <input type="hidden" name="job_id" value="<?=$row->load_id?>">
      <input type="hidden" name="go_id" value="<?=$row->user_id?>">
      <input type="hidden" name="lo_id" value="<?=$user_id?>">
      <button  type="submit" style="background-image: linear-gradient(to left, #209bd6, #2b87b7, #307398, #31607b, #304d5f);border-radius: 25px; width:95%;" class="btn btn-primary ;" id="urdu"><strong>کام کی تفصيل ديکھیں  </strong>
      </button>
    </form>
    </div>   
    </div>
    <?php } } }?> 
    </div>
    </div>

<!-- =================================================================================================== -->
<!--                                    Second Tab In-Process Bid                                        -->
<!-- =================================================================================================== -->

      <div id="menu4" class="tab-pane fade">


<!-- --------------- -->
    <div class="col-md-12" >    
    <?php 
    $i=0;
    $j=0;
    
    if(!empty($inProcessBids)){
    foreach ($inProcessBids as $row) { 

      ?>      

    <div class="card">
    <div class="card-header bg-warning "  style="border-radius: 25px; height: 35px;">
         <img class="float-left ml-3  " src="../images/truck_img.png" width="30px" height="25px"> 
          <span  class=" text-dark bg-warning" style="text-align: center">
          <strong><center>Pending</center></strong></span>
          <span class="float-right"><?=$row->datetime?></span>
    </div>
    <div class="card-body">

     <br>
    <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
        <i class="float-left fa fa-briefcase" style="margin-top: 5px; margin-right:10px" ></i>  
    <span  class="float-left" style="margin-left: 3px; margin-right: 30px;" ><strong>Job Type : <?=$row->job_type?></strong></span>
    <br>
    <?
   $bool = 0;
   $bool = count($row->load_detail);
   if($bool == "1"){?>

      <div id="S_P_<?$value->load_detail_id?>">
        <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
          <i class="float-left fa fa-map-marker" style="margin-right:10px; margin-top: 5px;" ></i>  
            <span  class="float-left" style="margin-left: 3px; margin-right: 30px;"><strong>PickUp Location : Single</strong></span>
          <br>
      </div>

   <?}else {?>
      
      <div id="S_P_">
        <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
          <i class="float-left fa fa-map-marker" style="margin-right:10px; margin-top: 5px;" ></i>  
          <span  class="float-left" style="margin-left: 3px; margin-right: 30px;"><strong>PickUp Location : Multiple</strong></span>
          <br>
      </div>
   
   <?}?>
   

<!--                        -------------------------------------------------------
                              For checking Multiple Destnaion is Available or NOT
                            -------------------------------------------------------    -->
   <?
   $val = 0;
   $val = count($row->pickup_detail);
   if($val == "1"){?>
      
      <div id="S_D_<?$value->pickup_id?>">
        <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
          <i class="float-left fa fa-thumb-tack" style="margin-right:10px; margin-top: 5px;" ></i>  
        <span  class="float-left" style="margin-left: 3px; margin-right: 30px;">
          <strong>Destination  : Single</strong>
        </span>
        <br>
      </div>
   
   <?}else {?>

    <div>
      <span class="float-right" style="color: red" id="urdu"><strong>  جاب  کی قسم</strong> </span>
        <i class="float-left fa fa-thumb-tack" style="margin-right:10px; margin-top: 5px;"></i>  
        <span  class="float-left" style="margin-left: 3px; margin-right: 30px;">
          <strong>Destination  : Multiple</strong></span>
        <br>
    </div>
   <?}?>

   
    <?if($row->job_type=="Import"){?>  
    <hr>
    <span class="float-right" style="color: red" id="urdu"><strong>کنٹینر بھیجنے کی جگہ </strong></span>
    <br> 
    <div class="input-group">
    <div class="input-group-addon"><i class="fa  fa-map-marker"></i></div>
         <ul class="ml-4 tree">
          <?php foreach($row->container_detail as $containerLoc ){  ?>
             <li><?=$containerLoc->con_location?></li>
          <?}?>    
           </ul>
    </div>

    <?}else if($row->job_type=="Export"){?>
     <hr>
    <span class="float-right" style="color: red" id="urdu"><strong> جس جگہ  سے  کنٹینر لانا ہیں</strong> </span>
       <br> 
    <div class="input-group">
    <div class="input-group-addon"><i class="fa  fa-map-marker"></i></div>
          <ul class="ml-4 tree">
          <?php foreach($row->container_detail as $containerLoc ){  ?>
               <li><?=$containerLoc->con_location?></li>
          <?}?>    
          </ul>
    </div>

    <?}?>
    



    <hr style="height: 1px;">
    <h4><u><center> PickUp Location</center></u></h4>
    <span class="float-right" style="color: red" id="urdu"><strong> جھاں سے سامان اٹھانا ھے   </strong> </span>
    <br> 
    <div class="input-group">
        <ul class="ml-4 tree">
         
        <?php foreach($row->load_detail as $laod_row){?>
        <li><?=$laod_row->load_to?></li>
        <?}?>         
        </ul>
    </div>
    <br>



    <hr style="height: 1px;">
    <h4><u><center> Drop Location</center></u></h4>
    <span class="float-right" style="color: red" id="urdu"><strong> جھاں سامان لے جانا ھے </strong> </span>
    <br>                    

        <div class="input-group">
        <ul class="ml-4 tree">
        <?php foreach($row->pickup_detail as $pickup_row ){  ?>
        <li><?=$pickup_row->load_from?></li>
        <?php }?>  
        </ul>
        </div>
        <br>
    
        <hr>
        <span class="float-right" style="color: red" id="urdu"><strong>اس کام کے پيسے</strong> </span>
            <img class="float-left" src="../images/cash.png" width="30px" height="25px" > 
        <span  class="float-left" style="margin-left: 3px;" ><strong>RS. <?=$row->expected_price?></strong></span>
        <br><br>
        
        
        <span class="float-right" style="color: red" id="urdu"><strong>
        بولی کی قیمت</strong> </span>
         <div class=" col-md-2 float-left"><i class="fa fa-money"></i>

        <span   ><strong>RS. <?=$row->bid_amount?></strong></span>
        </div>
        
        <br><br>
    
    <div class="input-group">
    <span class="float-right" style="color: red" id="urdu"><strong>د
ٹرک کی فراہمی
  </strong> </span>
    
        <img   class="float-left" src="../images/truck.png" width="30px" height="25px" > 
    <span  class="float-left" style="margin-left: 3px;" ><strong> <?=$row->no_of_truck?></strong></span>
    </div>
    </div>

    <div align="center" style="margin-bottom: 10px">
    <form action="jobs_detail.php" method="GET">
      <input type="hidden" name="job_id" value="<?=$row->load_id?>">
      <input type="hidden" name="go_id" value="<?=$row->user_id?>">
      <input type="hidden" name="lo_id" value="<?=$user_id?>">
    
     
    </form>
    </div>   
    </div>
    <?php }  }?> 
    </div>



<!-- ----------------- -->

    </div>



<!-- ========================================================================================= -->
<!--                                Third Tab Accepted bid      -->
<!-- ==================================================================================== -->

      <div id="menu1" class="tab-pane fade">
      <div class="col-md-12">  
      <div class="card">
      <div class="card-header"  style="border-radius: 25px;">
      <strong class="card-title">Accepted Job List</strong>
      </div>
      <div class="card-body">
      <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
              <th>Owner Name</th>
              <th>Truck Bid</th>
              <th>Bid Amount</th>
              <th>Assign</th>
              <th>Download</th>
              <th>Detail</th>
            </tr>
         </thead>
        <tbody>
        <? if(empty($accept_bid_list)){}else{
        foreach ($accept_bid_list as $job) { 
         
           ?>  
        <tr>
        <td><?=$job->name?></td>
        <td><?=$job->no_of_truck?></td>
        <td><?=$job->bid_amount?></td>
        <td>
          <form action="./assign_job.php" id="assign" method="GET">
            <input type="hidden" name="go_id" value="<?=$job->go_id?>">
            <input type="hidden" name="bid_id" value="<?=$job->bid_id?>">
            <input type="hidden" name="load_id" value="<?=$job->load_id?>">
            <input type="hidden" name="user_id" value="<?=$job->user_id?>">
            <button class="btn btn-primary" type="submit"><i class="fa fa-send-o"></i></button>
          </form>  
        </td>
        <td>  
         <a href="./doc_document.php?load_id=<?=$job->load_id?>" style="border-radius: 10px;" class="on-default  text-default ml-3 btn btn-primary" ><i class="fa fa-download"></i></a>

        </td>
        <td>
            <button class="btn btn-warning" type="submit" data-toggle="modal" data-target="#<?=$job->bid_id?>"><i class="fa fa-eye"></i></button>
        
        <!--  ***************************  Model Open *****************************************  -->

        <div class="modal fade" id="<?=$job->bid_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="mediumModalLabel"><b>   Details</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <div class="modal-body">
        <div class="col-md-12">
        <div class="row">        
        <div class="col-md-12" style="margin-top: 7.5px">
        <div class="row">
        <h5 class="w-100 pb-2" style="text-align: center;"><b>Pick-Up Details </b></h5>
        <div class="col-md-4 bg-light p-2"><center><b>SELECT PickUp :</b></center></div>
                  
          <select class="col-md-6 form-control ml-2" style="height: 35px;" onchange="showDetails_pickup(this.value,<?echo $job->load_id;?>)" id="slct_id2">
            <option value="" disabled selected >Select Pick-up Points</option>
            <?foreach($job->load_detail as $row2){?>                                        
            <option value="<?=$row2->load_detail_id?>"><?=$row2->load_to?></option>
            <?}?>
          </select>  

          <div id="Details_pickUp<?=$job->load_id;?>"></div> 

          </div>
          </div>
          <hr>
          </div>                    
          </div>

          <div class="col-md-12">
          <div class="row">                       
          <h5 class="w-100 border-bottom p-2 mt-4" style="text-align: center;"><b>Detination Point Details</b></h5> 

          <div class="col-md-4 bg-light p-2" style="text-align: center;"><b>SELECT Destination:</b></div>
            <select class="col-md-6 form-control ml-2" id="pp" style="height: 35px;" onchange="showDest_details(this.value,<?=$job->bid_id;?>)" id="slct_id1">
            <option value="" disabled selected >Select Drop Points</option>
            <?foreach($job->pickup_detail as $row3){?>                  
            <option value="<?=$row3->pickup_id?>"><?=$row3->load_from?></option>
            <?}?>
            </select> 

          <div id="bid_accpt_drop_<?=$job->bid_id;?>"></div>
          </div>
          </div>


          <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
          </div>
          </div>

          </div>
          </div>

        <!-- ***************************** Model Close **************************************** -->
        </td>
        </tr>


        <!-- <?php include("job_details.php");?> -->
        <? } }?> 
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>    
        </div>

<!-- ==================================================================================================== -->
<!--                                      Fourth Tab In-Process job                                       -->
<!-- ==================================================================================================== -->

        <div id="menu2" class="tab-pane fade">
        <div class="col-md-12">  
        <div class="card">
        <div class="card-header">
            <strong class="card-title">In-Process Jobs</strong>
        </div>
        <div class="card-body">
        <div class="table-responsive">
           <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                  <th>Driver</th>
                  <th>Images</th>
                  <th>Status</th>
                  <th>Detail</th>
              </tr>
            </thead>
            <tbody>
            <?if(!empty($accept_driverjob_list)){?>
            <?php foreach ($accept_driverjob_list as $job) {?>
            <?if($job->status=='P' || $job->status=='A'){ ?>  
            <tr>
                <td><?=$job->name?></td>
            
            <td >


               <a href="./images.php?load_id=<?=$job->load_id?>" style="border-radius: 10px;" class="on-default  text-default ml-3 btn btn-info" ><i class="fa fa-picture-o"></i></a>

            </td> 
            
            <?php if($job->status=='P' ){ ?> 
            <td style="color: red">Pending 
            <br><span style="color: black" id="time<?=$job->job_id?>"></span>
            </td>
            <?php }else{ ?>
            <td style="color: green">In-Process 
            </td>
            <? } ?>
    
            <td style="text-align: left">
            <?php if($job->status=='P'){?>
            <a class="btn btn-danger" href="controller/action-ctl.php?command=cancleJob&job_id=<?=$job->job_id?>&bid_id=<?=$job->bid_id?>&lo_id=<?=$job->owner_id?>&driver_id=<?=$job->driver_id?>&truck_id=<?=$job->truck_id?>&msg=driver_job_cancel" onclick='return confirmDelete();'>
            <i class="fa fa-trash-o" style="font-size:12px"> </i>
            </a>
            <? } else if( $job->status=='A'){?>
            
            <a class="btn btn-danger" href="controller/action-ctl.php?command=cancleJob&job_id=<?=$job->job_id?>&bid_id=<?=$job->bid_id?>&lo_id=<?=$job->owner_id?>&driver_id=<?=$job->driver_id?>&truck_id=<?=$job->truck_id?>&msg=cancel_job" onclick='return confirmDelete();'>
            <i class="fa fa-trash-o" style="font-size:12px"> </i>
            
            </a>


           <?}?>
            <button  class="btn btn-warning" type="submit" data-toggle="modal" data-target="#<?=$job->bid_id?>"><i class="fa fa-eye" style="font-size:12px"></i></button>


                  <div class="modal fade" id="<?=$job->bid_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                  <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="mediumModalLabel"><b>   Details</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </div>

                  <div class="modal-body">
                  <div class="col-md-12">
                  <div class="row">        
                  <div class="col-md-12" style="margin-top: 7.5px">
                  <div class="row">
                  <h5 class="w-100 pb-2" style="text-align: center;"><b>Pick-Up Details </b></h5>
                  <div class="col-md-4 bg-light p-2"><center><b>SELECT PickUp :</b></center></div>
                  
                    <select class="col-md-6 form-control ml-2" style="height: 35px;" onchange="showDestinationDetails(this.value,<?echo $job->load_id;?>)" id="slct_id2">
                      <option value="" disabled selected >Select Pick-up Points</option>
                      <?foreach($job->load_detail as $row2){?>                  
                      <option value="<?=$row2->load_detail_id?>"><?=$row2->load_to?></option>
                      <?}?>
                 </select>  

                  

                  <div id="txtHint_<?=$job->load_id;?>">

                  </div> 

                  </div>
                  </div>
                  <hr>


                  </div>                    
                  </div>
                      


                       <div class="col-md-12">
                       <div class="row">                       
                         <h5 class="w-100 border-bottom p-2 mt-4" style="text-align: center;"><b>Detination Point Details</b></h5> 
                       
                        <div class="col-md-4 bg-light p-2" style="text-align: center;"><b>SELECT Destination:</b></div>
                        <select class="col-md-6 form-control ml-2" id="pp" style="height: 35px;" onchange="showPickUp(this.value,<?=$job->bid_id;?>)" id="slct_id1">
                                <option value="" disabled selected >Select Drop Points</option>
                                <?foreach($job->pickup_detail as $row3){?>                  
                                <option value="<?=$row3->pickup_id?>"><?=$row3->load_from?></option>
                                <?}?>
                        </select> 
                        
                        <div id="pickup_<?=$job->bid_id;?>">
                     
                       </div>
                       </div>
                       </div>


                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                  </div>
                </div>
                  </div>

                  </div>
                  </div>



            </td>
            </tr>
            <!-- <?php //include("job_details.php");?> -->
            <? } } } ?> 
            </tbody>
            </table>
            </div>
            </div>
            </div>
            </div>    
            </div>

            </div>
            </div>      
            </div>
            </div>
            </div>
 


 
    <script>
    function showDestinationDetails(str,div_id) {
    console.log(str,div_id);
    if (str == "") {
        document.getElementById("txtHint_"+div_id).innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint_"+div_id).innerHTML = this.responseText;
            }
        };

        // xmlhttp.open("GET","http://lorrynlorry.xolva.com/lorryowner/includes/destintn_details.php?q="+str,true);
        xmlhttp.open("GET","includes/destintn_details.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
    <script>
    function showDetails_pickup(str,div_id) {
    console.log(str,div_id);
    if (str == "") {
        document.getElementById("Details_pickUp"+div_id).innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Details_pickUp"+div_id).innerHTML = this.responseText;
            }
        };

        // xmlhttp.open("GET","http://lorrynlorry.xolva.com/lorryowner/includes/destintn_details.php?q="+str,true);
        xmlhttp.open("GET","includes/destintn_details.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<script>

    function showPickUp(str,div_id) {
    
    if (str == "") {
        
        document.getElementById("pickup_"+div_id).innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("pickup_"+div_id).innerHTML = this.responseText;
            }
        };

     
        // xmlhttp.open("GET","http://lorrynlorry.xolva.com/lorryowner/includes/pickup_details.php?q="+str,true);
        xmlhttp.open("GET","includes/pickup_details.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<script>

    function showDest_details(str,div_id) {
    
    if (str == "") {
        
        document.getElementById("bid_accpt_drop_"+div_id).innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("bid_accpt_drop_"+div_id).innerHTML = this.responseText;
            }
        };

     
        // xmlhttp.open("GET","http://lorrynlorry.xolva.com/lorryowner/includes/pickup_details.php?q="+str,true);
        xmlhttp.open("GET","includes/pickup_details.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
  
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to cancle this job?');
    }
</script> 

<?if(empty($accept_driverjob_list)){}else{?>
<?php foreach ($accept_driverjob_list as $job) { 
          $time = strftime("%B %d, %Y  %X",$job->assign_time);
         ?> 


<?php } }?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){


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


  // $("#addressto").geocomplete({details:"div#to_div"});

});

</script>

