    <?         $complain_list = Load::fetchComplain($_SESSION["sess_admin_id"]); 
               include("rem_sorting.css"); 
               // echo "<pre>";
               // print_r($complain_list);
               // echo "<pre>";
               ?>    

    
<style type="text/css">
 body{
    padding:0 !important;

  }
</style>
    <div class="breadcrumbs">
    <div class="col-sm-4">
    <div class="page-header float-left">
    <div class="page-title ">
         <h1><b><i class=" fa fa-podcast " style="margin-right: 8px"></i>Complains Lists</b></h1>
    </div>
    </div>
    </div>
    
    <div class="col-sm-8">
    <div class="page-header float-right">
    <div class="page-title">
        <ol class="breadcrumb text-right">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active">Complains Lists</li>
        </ol>
    </div>
    </div>
    </div>
    </div>

    <div class="row mt-4 mb-3 ml-1">
    <div class="col-md-12">
    <div class="main-card mb-3 card">

    <div class="table-responsive">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
            <thead>
                <tr>
              
                    <th class="text-center">#</th>
                    <th>User Name</th>
                    <th class="text-center">Complain Name</th>
                    <th class="text-center">Starting  Time</th>
                    <th class="text-center">Complete Time</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">View</th>
                </tr>
            </thead>
            <tbody>
               <?php if($complain_list){ 
                foreach($complain_list as $val){?>
                <tr>
                    <td class="text-center text-muted">C-<?=$val->complain_id?></td> 
                    <td>
                        <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                        <div class="widget-content-left flex2">                    
                        <?foreach($val->drivers_details as $row3){?>                  
                        <div class="widget-subheading opacity-7"><?=$row3->name?>  (<b>DRIVER</b>)</div>
                        <?}?>
                        </div>
                        </div>
                        </div>
                    </td>
                 
                    <td class="text-center"><b><?=$val->complain_name?></b></td>
                    <td class="text-center">
                    <?if($val->status_com =="Active"){?> 
                          <div class="badge badge-warning" style="padding: 8px"><?=$val->start_date." -- ".$val->start_time?></div>
                    <?}else if($val->status_com =="Complete"){?>  
                          <div class="badge badge-info" style="padding: 8px"><?=$val->start_date." -- ".$val->start_time?></div>
                    <?}?> 
                    </td>
                    <td class="text-center">
                    <?if($val->status_com =="Active" AND $val->complete_time=="0" ){?> 
                      
                         <div class="badge badge-warning" style="padding: 8px">---</div>
                    
                    <?}else if($val->status_com =="Complete"){?> 
                            <div class="badge badge-info" style="padding: 8px"><?=$val->start_date." -- ".$val->complete_time?></div> 
                    <?}?>
                    </td>
                    <td class="text-center">
                    <?if($val->status_com =="Active"){?> 
                           <div class="badge badge-warning" style="padding: 8px" >Still-Working</div>
                    <?}else if($val->status_com =="Complete"){?>   
                            <div class="badge badge-info"style="padding: 8px"><b>Problem Solved</b></div>
                    <?}?> 
                    </td>
                  
                      <td class="text-center">
                        <?if($val->status_com =="Active"){?> 
                        
                        <button type="button" id="PopoverCustomT-1" class="btn btn-warning btn-sm" 
                        data-toggle="modal" data-target="#<?=$val->load_id?>">Details</button>

                        <?}else if($val->status_com =="Complete"){?> 
                        
                        <button type="button" id="PopoverCustomT-1" class="btn btn-info btn-sm" data-toggle="modal" data-target="#<?=$val->load_id?>">Details</button>
                        <?}?>

                        <div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog modal-lg" role="document">
                       <div class="modal-content">
                       <div class="modal-header bg-primary text-white">
                         <h5 class="modal-title" id="mediumModalLabel"><b>   Details</b></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" >&times;</span>
                        </button>
                        </div>
                       <div class="modal-body">
                       <div class="col-md-12">
                       <div class="row">        
                       <div class="col-md-12" style="margin-top: 7.5px">
                       <div class="row">
                             <h5 class="w-100 pb-2">Destination Details </h5>
                       <div class="col-md-4 bg-light p-2"><b>SELECT DESTINATION :</b></div>
                           
                            <select class="col-md-6 form-control ml-2" style="height: 35px;" onchange="showDestination(this.value,<?=$val->load_id?>)" id="slct_id">
                                <option value="" disabled selected >Select Drop-Off Points</option>
                                <?foreach($val->destination_details as $row2){?>                  
                                <option value="<?=$row2->load_detail_id?>"><?=$row2->load_to?></option>
                                <?}?>
                            </select>  

                        <div id="txtHint_<?=$val->load_id?>">
                     
                       </div>
                       </div>
                       <hr>
                       </div>
                      
                       <div class="col-md-12">
                       <div class="row">                       
                             <h5 class="w-100 border-bottom p-2 mt-4">PickUp Point Details</h5> 
                       
                        <div class="col-md-4 bg-light p-2"><b>SELECT PICK-UP POINT:</b></div>
                        <select class="col-md-6 form-control ml-2" style="height: 35px;" onchange="showPickUp(this.value,<?=$val->load_id?>)" id="slct_id">
                                <option value="" disabled selected >Select Pick-Up Points</option>
                                <?foreach($val->pickup_details as $row3){?>                  
                                <option value="<?=$row3->pickup_id?>"><?=$row3->load_from?></option>
                                <?}?>
                        </select> 
                        
                        <div id="pickup_<?=$val->load_id?>">
                     
                        </div>

                    
                       
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
             
                </tr>
                 <?} }?> 
            </tbody>
        </table>
    </div>
    
    <div class="d-block text-center card-footer">
    <!--     <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"></i></button> -->
        <!-- <button class="btn-wide btn btn-success">Save</button> -->
    </div>
    </div>
    </div>
    </div>

    <script>
    function showDestination(str,div_id) {
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