<?php
        $CompleteJobs = Load::completeJobs($_SESSION["sess_admin_id"]);
         include("rem_sorting.css");
         // echo "<pre>";
         // print_r($CompleteJobs);
         // echo "</pre>";
          ?>

<style type="text/css">
 body{
    padding:0 !important;
  }

</style>
    
  
    <div class="breadcrumbs">
    <div class="col-sm-4">
    <div class="page-header float-left">
    <div class="page-title">
         <h1><i class="menu-icon fa fa-check-square-o" style="margin-right: 8px"></i>Complete Jobs</h1>
    </div>
    </div>
    </div>
    
    <div class="col-sm-8">
    <div class="page-header float-right">
    <div class="page-title">
        <ol class="breadcrumb text-right">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active">Jobs Complete</li>
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
              
                    <th class="text-center">#</th>
                    <th class="text-center">Commodities</th>
                    <th class="text-center">Job Type</th>
                    <th class="text-center">Destination Point</th>
                    <th class="text-center">PickUp  Point</th>
                    <!-- <th class="text-center">Details</th> -->
                    <th class="text-center">Status</th>
                    <th class="text-center">Images</th>
         
                    
                </tr>
            </thead>
            <tbody>
             <?php if($CompleteJobs){ 
             foreach($CompleteJobs as $val){?>  
                <tr>
                   <td class="text-center" style="width: 6%;">CJ-<?=$val->load_id?></td>
                   <td class="text-center" style="width: 13%;">
                    <?foreach($val->dest_detail as $row3){?>                  
                    <div class="widget-subheading opacity-7"><?=$row3->goods_type?></div><br>
                    <?}?>
                  </td>
                   <td class="text-center"><b><?=$val->job_type?></b></td>
                  <td class="text-center" style="width: 25%;">
                 
                      <!-- <select class="col-md-8 form-control ml-5" style="height: 35px;" data-toggle="modal" data-target="#<?=$val->user_id?>">
                            <option value="" disabled selected >Select PickUp Points</option>
                            <?foreach($val->pp_detail as $row4){?>                  
                            <option value=""><?=$row4->load_from?></option>
                            <?}?>
                        </select> -->

                        <button type="button" class="ml-15  form-control bg-info text-center text-white" data-toggle="modal" data-target="#CJ_<?=$val->load_id?>">Destiantion Details
                        
                        </button> 

                        <div class="modal fade" id="CJ_<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                       <div class="row">                       
                             <h5 class="w-100 border-bottom p-2 mt-4">Drop-Off Point Details</h5> 
                       
                        <div class="col-md-4 bg-light p-2"><b>SELECT Drop Point:</b></div>
                        <select class="col-md-6 form-control ml-2" style="height: 35px;" onchange="showPickUp(this.value,<?=$val->load_id;?>)" id="slct_id1">
                                <option value="" disabled selected > Drop-Off Points</option>
                                <?foreach($val->pp_detail as $row3){?>                  
                                <option value="<?=$row3->pickup_id?>"><?=$row3->load_from?></option>
                                <?}?>
                        </select> 
                        
                        <div id="pickup_<?=$val->load_id;?>">
                     
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

                   <td class="text-center" style="width: 20%;">

                     <!-- Model Open by Select Option... -->
                     
                     <!--    <select class="col-md-9 form-control ml-2"  style="height: 35px;"  data-toggle="modal" data-target="#<?=$val->load_id?>">
                            <option value="" disabled selected >Select Drop-Off </option>
                            <?foreach($val->dest_detail as $row5){?>                  
                            <option value="<?=$row2->load_detail_id?>"><?=$row5->load_to?></option>
                            <?}?>
                        </select> -->

                         <button type="button" class="ml-15  form-control bg-info text-center text-white" data-toggle="modal" data-target="#PD_<?=$val->load_id?>"> Details
                        
                        </button>

                        <div class="modal fade" id="PD_<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                             <h5 class="w-100 pb-2">PickUp Details </h5>
                       <div class="col-md-4 bg-light p-2"><b>SELECT PickUp :</b></div>
                           
                            <select class="col-md-6 form-control ml-2" style="height: 35px;" onchange="showDestinationDetails(this.value,<?echo $val->load_id;?>)" id="slct_id2">
                               <option value="" disabled selected >Select PickUp Points</option>
                               <?foreach($val->dest_detail as $row2){?>                  
                               <option value="<?=$row2->load_detail_id?>"><?=$row2->load_to?></option>
                                <?}?>
                            </select>  

                        <div id="txtHint_<?=$val->load_id;?>">
                     
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
                      </div>

                   </td>
                   <td class="text-center"><center>
                     <?if($val->status=="finish"){?>
                      <div class="badge badge-success"style="padding: 12px" > Completed</div>
                     <?}?>
                    </div>
                    </center>
                   </td>

                   <td>
                    <center>  <a href="./complete_images.php?load_id=<?=$val->load_id?>" style="border-radius: 5px;" class="on-default  text-default ml-2 btn btn-info" >Images</a></center>
                   </td>  

                  
         

                    <!--Close Model   -->
                   
                   
               

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
     // alert("str_val"+str,"div"+div_id);
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
        
        xmlhttp.open("GET","includes/getdestinationdetail.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<script>
    function showPickUp(str,div_id) {
    
    if (str == "") {
        alert(str,div_id);
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