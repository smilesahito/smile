<?php
        $inprocess_jobs = Load::inProcessJobs($_SESSION["sess_admin_id"]);
         include("rem_sorting.css"); ?>

<style type="text/css">
   .modal-dialog {
   z-index: 10001;
  }
  table tbody tr td, table thead tr th{
    min-width: 150px;
    height:35px; 
  }

  body{
    padding:0 !important;

  }
  .dataTables_length .form-control{
    padding-top: 2px;
    padding-bottom: 0px;
  }

</style>
    

    <div class="breadcrumbs">
    <div class="col-sm-4">
    <div class="page-header float-left">
    <div class="page-title">
         <h1><i class="fa fa-spinner" style="margin-right: 8px"></i>Jobs In-process</h1>
    </div>
    </div>
    </div>
    
    <div class="col-sm-8">
    <div class="page-header float-right">
    <div class="page-title">
        <ol class="breadcrumb text-right">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active">Inprocess - Jobs</li>
        </ol>
    </div>
    </div>
    </div>
    </div>
  

<!-- ---------------------------------------------------------------- -->


 <div class="row mt-4 mb-3 ml-1">
    <div class="col-md-12">
    <div class="main-card mb-3 card">

    <div class="table-responsive">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
            <thead>
                <tr>
              
                    <th style="min-width: auto;">#</th>
                    <th class="text-center"  > Commodities</th>
                    <th class="text-center">Destination Point</th>
                    <th class="text-center">PickUp Point</th>
                    <th class="text-center">Document</th>
                    <th class="text-center">Images</th>
                    <th class="text-center">Assign Time</th>
                    <!-- <th class="text-center">Map</th> -->
                </tr>
            </thead>
            <tbody>
             <?php if($inprocess_jobs){ 
             foreach($inprocess_jobs as $val){?>  
                <tr>
                   <td style="min-width: auto;">JP-<?=$val->load_id?></td>
                   <td class="text-center">
                    <?foreach($val->inprocess_destination as $row3){?>                  
                    <div class="widget-subheading opacity-7"><?=$row3->goods_type?></div>
                    <?}?>
                  </td>
                   <td class="text-center">
                    <!--   <select class="form-control"  data-toggle="modal" data-target="#<?=$val->job_id?>">
                            <option value="" disabled selected >Select Drop-Off Points</option>
                            <?foreach($val->inprocess_pickuppoint as $row4){?>                  
                            <option value=""><?=$row4->load_from?></option>
                            <?}?>
                        </select>  -->
                          <button type="button" class="btn bg-info btn-sm text-center text-white" data-toggle="modal" data-target="#<?=$val->job_id?>">Destination Details</button>


                        <div class="modal fade" id="<?=$val->job_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                       <div class="modal-dialog modal-lg" role="document">
                       <div class="modal-content">
                       <div class="modal-header bg-primary text-white">
                         <h5 class="modal-title" id="mediumModalLabel"><b>   Details</b></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        
                       <div class="col-md-12">
                       <div class="row">        
                       <hr>
  
                       <div class="col-md-12">
                       <div class="row col-md-12">                       
                             <h5 class="w-100 border-bottom p-2 mt-4">Drop Point Details</h5> 
                       
                       <div class="col-md-4 bg-light p-2 w-100"><b>SELECT Drop Locaiton:</b></div>
                       <select class="col-md-7 form-control ml-2" style="height: 35px;" onchange="showPickUp(this.value,<?=$val->job_id;?>)" id="slct_id1">
                                <option value="" disabled selected >Select Pick-Up Points</option>
                                <?foreach($val->inprocess_pickuppoint as $row3){?>                  
                                <option value="<?=$row3->pickup_id?>"><?=$row3->load_from?></option>
                                <?}?>
                       </select>
                    <!--    <button type="button" class="btn bg-info btn-sm text-center text-white" data-toggle="modal" data-target="#<?=$val->load_id?>">Details</button> 
                         -->
                       <div id="pickup_<?=$val->job_id;?>">
                     
                       </div>
                       </div>                       
                       </div>
                       </div>                    
                       </div>
                       
                       <div class="modal-footer">
                       <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                      
                       </div>
                      </div>
                      </div>
                      </div>

                   </td>

                   <td class="text-center">
                        
                         <!-- <select class="form-control" data-toggle="modal" data-target="#<?=$val->load_id?>">
                            <option value="" disabled selected >Select PickUp </option>
                            <?foreach($val->inprocess_destination as $row5){?>                  
                            <option value="<?=$row2->load_detail_id?>"><?=$row5->load_to?></option>
                            <?}?>
                        </select> -->
                    
                         <button type="button" class="btn bg-info btn-sm text-center text-white" data-toggle="modal" data-target="#<?=$val->load_id?>">PickUp Details</button>


                        <div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                       <div class="modal-dialog modal-lg" role="document">
                       <div class="modal-content">
                       <div class="modal-header bg-primary text-white">
                         <h5 class="modal-title" id="mediumModalLabel"><b>   Details</b></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        
                       <div class="col-md-12">
                       <div class="row">        
                       <div class="col-md-12" style="margin-top: 7.5px">
                       <div class="row">
                             <h5 class="w-100 pb-2">PickUp- Details </h5>
                       <div class="col-md-4 bg-light p-2"><b>SELECT PickUp :</b></div>
                           
                            <select class="col-md-6 form-control ml-2" style="height: 35px;" onchange="showDestinationDetails(this.value,<?echo $val->load_id;?>)" id="slct_id2">
                               <option value="" disabled selected >Select Pick-up Points</option>
                               <?foreach($val->inprocess_destination as $row2){?>                  
                               <option value="<?=$row2->load_detail_id?>"><?=$row2->load_to?></option>
                                <?}?>
                            </select>  

                        <div id="txtHint_<?=$val->load_id;?>" >
                     
                        </div>
                     
                       </div>
                       </div>
                       <hr>
                       </div>                    
                       </div>
                      
                       <div class="modal-footer">
                       <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                       </div>
                      </div>
                      
                      </div>
                      </div>

                   </td>
                   <td class="text-center">

                     <?   foreach ($val->document_details as  $chck) {
                          if(empty($chck) || $chck->gd_doc !="" && $chck->bl_doc != "" && $chck->invoice_doc !=""
                            && $chck->delivery_doc !="" && $chck->guarantee_doc !="" && $chck->con_cro != ""){
                            
                          }else{ ?>

                      <button type="button" id="PopoverCustomT-1" class="btn btn-info btn-sm" data-toggle="modal" data-target="#doc_<?=$val->job_id?>" style="border-radius: 10px;">Upload Document</button>

<!-- ----------------------------------------- < Model >  ------------------------------------------------- -->

                       <form action="controller/action-ctl.php" method="POST" enctype="multipart/form-data">
                       <input type="hidden" class="form-control" name="command" value="upload_doc_inprocess">
                       <input type="hidden" class="form-control" name="load_id" value="<?=$val->load_id?>"> 

                      
                       <div class="modal fade" id="doc_<?=$val->job_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog modal-lg" role="document">
                       <div class="modal-content">
                       <div class="modal-header bg-primary text-white">
                         <h5 class="modal-title" id="mediumModalLabel"><b>Upload Documents</b></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        
                       <div class="col-md-12">
                       <div class="row">        
                     
                       <hr>
  
                       <div class="col-md-12">
                       <div class="row">                       
    
    
                        <?foreach ($val->document_details as  $value) {

                        if($value->gd_doc =="" ){ ?>
                        
                        <div class="col-md-1"></div> 
                        <input type="hidden" class="form-control" name="hid_gd_doc" value="gd_doc">     
                        <h6 class="col-md-5 border-bottom p-2 mt-4">UPDATE GD Document</h6> 
                        <div class="form-group col-md-6" id="gd_doc" style="margin-top: 30px">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file"></i></div>
                        <input type="file"  name="gd_doc" id="gd_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt" required="required" />
                        </div>
                        </div>
                        <?}?>  

                         <?if($value->bl_doc ==""){?>
                        <div class="col-md-1"></div>   
                        <input type="hidden" class="form-control" name="hid_bl_doc" value="bl_doc">    
                        <h6 class="col-md-5 border-bottom p-2 mt-4">UPDATE BL Document</h6> 
                        <div class="form-group col-md-6" id="bl_doc" style="margin-top: 30px">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file"></i></div>
                        <input type="file"  name="bl_doc" id="bl_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt" required="required" />
                        </div>
                        </div>
                        <?}?>  

                         <?if($value->invoice_doc =="" ){?>
                        <div class="col-md-1"></div> 
                        <input type="hidden" class="form-control" name="hid_invoice_doc" value="invoice_doc">    
                        <h6 class="col-md-5 border-bottom p-2 mt-4">UPDATE Invoice </h6> 
                        <div class="form-group col-md-6" id="invoice_doc" style="margin-top: 30px">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file"></i></div>
                        <input type="file"  name="invoice_doc" id="invoice_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt"/>
                        </div>
                        </div>
                        <?}?>  

                         <?if($value->delivery_doc =="" ){?>
                        <div class="col-md-1"></div>     
                         <input type="hidden" class="form-control" name="hid_delivery_doc" value="delivery_doc">
                        <h6 class="col-md-5 border-bottom p-2 mt-4">UPDATE Delivery Document</h6> 
                        <div class="form-group col-md-6" id="delivery_doc" style="margin-top: 30px">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file"></i></div>
                        <input type="file"  name="delivery_doc" id="delivery_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt" required="required" />
                        </div>
                        </div>
                        <?}?>  

                         <?if($value->guarantee_doc =="" ){?>
                        <div class="col-md-1"></div> 
                        <input type="hidden" class="form-control" name="hid_guarantee_doc" value="guarantee_doc">    
                        <h6 class="col-md-5 border-bottom p-2 mt-4">UPDATE Guarantee Document</h6> 
                        <div class="form-group col-md-6" id="guarantee_doc" style="margin-top: 30px">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file"></i></div>
                        <input type="file"  name="guarantee_doc" id="guarantee_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt" required="required" />
                        </div>
                        </div>
                        <?}?>

                        <?if($value->con_cro == "" ){?>
                        <div class="col-md-1"></div> 
                        <input type="hidden" class="form-control" name="hid_con_cro" value="con_cro">     
                        <h6 class="col-md-5 border-bottom p-2 mt-4">UPDATE CRO Document</h6> 
                        <div class="form-group col-md-6" id="con_cro" style="margin-top: 30px">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file"></i></div>
                        <input type="file"  name="con_cro" id="con_cro" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt" required="required" />
                        </div>
                        </div>
                        <?}?> 
                        <?}?>
                        <!--  --------- --> 
                       </div>
                       </div>
                       </div>                    
                       </div>                       

                       <div align="right" style="margin-right: 40px; margin-bottom: 20px; margin-top: 20px">
                        <button type="submit" id="info_btn" class="btn btn-success btn-sm">
                        <i class="fa fa-check"></i> Submit
                        </button>
                        </div>

                       <div class="modal-footer">
                       <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                      
                      </div>
                      </div>
                      </div>
                      </div>
                      </form>
                      <?} }?>  

<!-- ------------------------------------ </Model> -------------------------------------------- -->

                    </div>
                   </td>
                   <td>
                      <a href="./load_image.php?load_id=<?=$val->load_id?>" style="border-radius: 10px;" class="on-default  text-default  btn btn-info btn-sm ml-5" >Images</a>
                   </td>  
                   <td class="text-center">
                    <div class="badge badge-warning"style="padding: 8px" ><?=(strftime("%B %d %Y",$val->assign_time))?></div>
                   </td>   
                  
                  <!-- <td> -->
                    <!-- <center><button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#track_123">Driver</button></center> -->
                  
<!-- =============================   Model open for Single Driver Track ==============================-->
                      
                      <!-- <div class="modal fade" id="track_123" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->

                       <!-- <div class="modal-dialog modal-lg" role="document"> -->
                       <!-- <div class="modal-content"> -->
                       <!-- <div class="modal-header bg-primary text-white"> -->
                        <!-- <h5 class="modal-title" id="mediumModalLabel"><b>   Driver Current Location</b></h5> -->
                       <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                            <!-- <span aria-hidden="true">&times;</span> -->
                        <!-- </button> -->
                        <!-- </div> -->
                        
<!-- ------------------- -->


<!-- -------------------- -->
                       <!-- <div class="col-md-12"> -->
                       <!-- <div class="row">         -->
                       <!-- <div class="col-md-12" style="margin-top: 7.5px"> -->
                      
                       <!-- </div> -->
                       <!-- <hr> -->
                       <!-- </div>                     -->
                       <!-- </div> -->
                      
                       <!-- <div class="modal-footer"> -->
                       <!-- <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button> -->
                       <!-- </div> -->
                      <!-- </div> -->
                      <!-- </div> -->
                      <!-- </div>    -->

                      <!--====================== Model Close ====================================-->




                  <!-- </td> -->
               

                </tr>
            <?} }?> 
               
            </tbody>
        </table>
    </div>
    
    <div class="d-block text-center card-footer">

    </div>
    </div>
    </div>
    </div>




<script>
    function showDestinationDetails(str,div_id) {
     
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
        xmlhttp.open("GET","includes/process_details.php?q="+str,true);
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
        xmlhttp.open("GET","includes/details_pickup.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
