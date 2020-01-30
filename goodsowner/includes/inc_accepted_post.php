    <?php

        $goods = Load::GetAcceptedLoad($_SESSION["sess_admin_id"]);
        include("rem_sorting.css");?>



    <div class="breadcrumbs  p-3 mb-2">
    <div class="col-sm-4">
    <div class="page-header float-left">
    <div class="page-title">
          <h1><b><i class="fa fa-dot-circle-o" style="margin-right: 8px"></i>Bids Accepted List</b></h1>
    </div>
    </div>
    </div>
    
    <div class="col-sm-8 ">
    <div class="page-header float-right">
    <div class="page-title ">
          <ol class="breadcrumb text-right ">
              <li><a href="index.php" class="text-dark"><b>Dashboard</b></a></li>
              <li class="active "><b>Bids Accepted List</b></li>
          </ol>
    </div>
    </div>
    </div>
    </div>


    <div class="content mt-3">
    <div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-body  table-responsive">
      <table id="bootstrap-data-table" class="table table-striped table-bordered"> 
           <thead>
      
              <tr class="text-white bg-danger">
                    <th class="text-center a-n b-n">#</th>
                    <!-- <th>Transporter Name</th> -->
                    <th>Job Type</th>
                    <!-- <th class="a-n b-n">Images</th> -->
                    <th class="a-n b-n">Gates Pass</th>
                    <th class="a-n b-n">Upload Document</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    if($goods){
                    foreach($goods as $val){  
                    if($val->job_type=="Import"){
                    foreach($val->document_details as $value) {
                    if($value->gd_doc =="" || $value->bl_doc =="" || $value->invoice_doc =="" || $value->delivery_doc =="" || $value->guarantee_doc =="" ){?>  
        <tr> 
            <td><?php echo "LP-".$val->load_id;?></td>    
            <td><b><?php echo $val->job_type;?></b></td>  
           <!--  <td>
                <a href="./load_image.php?load_id=<?=$val->load_id?>" style="border-radius: 10px;" class="on-default  text-default ml-3 btn btn-info" >Images</a>
            </td>  -->   
            <td>    
                 <a href="./gate_pass.php?load_id=<?=$val->load_id?>" style="border-radius: 10px;" class="on-default  text-default ml-3 btn btn-warning text-dark">Gate Pass</a>
            </td>

            <td>
               <button type="button" id="PopoverCustomT-1" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#<?=$val->load_id?>">Upload Document</button>
                <form action="controller/action-ctl.php" method="POST" enctype="multipart/form-data">
                       <input type="hidden" class="form-control" name="command" value="update_doc">
                       <input type="hidden" class="form-control" name="load_id" value="<?=$val->load_id?>"> 
                       <div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     
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
    
                    
                        <!-- ---------- -->
                        <?foreach ($val->document_details as  $value) {
                          
                         if($value->gd_doc =="" ){?>
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
                        <?} }?>
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

            </td>
        </tr>

       <?} }  } else if($val->job_type=="Export"){
         foreach($val->document_details as $value) {
        if($value->con_cro =="" || $value->gd_doc =="" || $value->bl_doc =="" || $value->invoice_doc =="" || $value->delivery_doc =="" || $value->guarantee_doc =="" ){?>  
       

        <tr> 
            <td><?php echo "LP-".$val->load_id;?></td>
       
            <td><b><?php echo $val->job_type;?></b></td>  
           <!--  <td>
                <a href="./load_image.php?load_id=<?=$val->load_id?>" style="border-radius: 10px;" class="on-default  text-default ml-3 btn btn-info" >Images</a>
            </td>  -->   
            <td>    
                 <a href="./gate_pass.php?load_id=<?=$val->load_id?>" style="border-radius: 10px;" class="on-default  text-default ml-3 btn btn-warning text-dark">Gate Pass</a>
            </td>

            <td>
             
                        <button type="button" id="PopoverCustomT-1" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#<?=$val->load_id?>">UPDATE Document</button>
                       <form action="controller/action-ctl.php" method="POST" enctype="multipart/form-data">
                       <input type="hidden" class="form-control" name="command" value="update_doc">
                       <input type="hidden" class="form-control" name="export" value="Export">
                       <input type="hidden" class="form-control" name="load_id" value="<?=$val->load_id?>"> 
                       <div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     
                       <div class="modal-dialog modal-lg" role="document">
                       <div class="modal-content">
                      <!--  <div class="modal-header bg-primary text-white">
                         <h5 class="modal-title" id="mediumModalLabel"><b>UPDATE Documents</b></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div> -->
                        
                       <div class="col-md-12">
                       <div class="row">        
                     
                       <hr>
  
                       <div class="col-md-12">
                       <div class="row">                       
                       <!--  <?if($val->agent_name =="" ){?>
                        
                        <div class="col-md-1"></div>    

                        <h6 class="col-md-5 border-bottom p-2 mt-4">UPDATE Agent Name</h6> 
                        <div class="form-group col-md-6" id="agent_mobileno" style="margin-top: 30px">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input class="form-control text-center" name="agent_name" type="text" placeholder="Agent Name" required="required">
                        </div>
                        </div>
                        <?}?>   -->
                        
                        <?if($val->agent_mobile_no =="" ){?>
                        <div class="col-md-1"></div>     
                        <h6 class="col-md-5 border-bottom p-2 mt-4">UPDATE Agent Number</h6> 
                        <div class="form-group col-md-6" id="agent_mobileno" style="margin-top: 30px">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            <input class="form-control text-center" name="agent_mobileno" type="number" placeholder="Agent Mobile No" required="required">
                        </div>
                        </div>
                        <?}?>  
                        <!-- ---------- -->
                        <?foreach ($val->document_details as  $value) {
                          
                        if($value->con_cro == "" ){?>
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


                        <?if($value->gd_doc == "" ){?>
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

                         <?if($value->bl_doc == "" ){?>
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

                         <?if($value->invoice_doc == "" ){?>
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

                         <?if($value->delivery_doc == "" ){?>
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

                         <?if($value->guarantee_doc == "" ){?>
                        <div class="col-md-1"></div> 
                        <input type="hidden" class="form-control" name="hid_guarantee_doc" value="guarantee_doc">    
                        <h6 class="col-md-5 border-bottom p-2 mt-4">UPDATE Guarantee Document</h6> 
                        <div class="form-group col-md-6" id="guarantee_doc" style="margin-top: 30px">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file"></i></div>
                        <input type="file"  name="guarantee_doc" id="guarantee_doc" style="color: red" class="form-control" accept=".jpg,.png,.jpeg,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt" required="required" />
                        </div>
                        </div>
                        <?} }?>
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


            </td>
          </tr>

        <?  }  } }?>
        <?php } }?>
                 
         </tbody>
        </table>
    
    </div>
    </div>
    </div>
    </div>
    </div>





    <div class="content mt-3">
    <div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-body  table-responsive">
       <table id="bootstrap-data-table" class="table table-striped table-bordered">
           <thead>
            


          <tr class="bg-success text-white ">
                <th class="text-center a-n b-n">#</th>
                <!-- <th>Transporter </th> -->
                <!-- <th>Load Date</th> -->
                <th>Job Type</th>
                <!-- <th  class="a-n b-n">Insurance Details</th> -->
                <!-- <th class="a-n b-n">View</th> -->
                <!-- <th class="a-n b-n">Images</th> -->
                <th class="a-n b-n">Gates Pass</th>
                <!-- <th>Upload Document</th> -->
              </tr>
            </thead>
            <tbody>
            <?php 
            if($goods) {
            foreach($goods as $val){ 
            if($val->job_type=="Local" || $val->job_type=="UpCountry" ){ ?>
     
            <tr> 
            <td class="text-center"> <?php echo "LP-".$val->load_id;?></td>
          
            <td><b><?php echo $val->job_type;?></b></td>  
 
            <td>    
                 <a href="./gate_pass.php?load_id=<?=$val->load_id?>" style="border-radius: 10px;" class="on-default  text-default ml-3 btn btn-info text-white">Gate Pass</a>
            </td>

 
        </tr>
     
           <?} 
           else if($val->job_type =="Import"){
           foreach ($val->document_details as  $value) {
              if($value->gd_doc !="" && $value->bl_doc !="" && $value->invoice_doc !="" & $value->delivery_doc !="" && $value->guarantee_doc !="" ){?>

            <tr> 
            <td class="text-center"><?php echo "LP-".$val->load_id;?></td>
   
            <td><b><?php echo $val->job_type;?></b></td>  
            <td>    
                 <a href="./gate_pass.php?load_id=<?=$val->load_id?>" style="border-radius: 10px;" class="on-default  text-default ml-3 btn btn-info text-white">Gate Pass</a>
            </td>

        </tr>


           <?} }  }

         else if($val->job_type =="Export"){
         foreach ($val->document_details as  $value) {
         if($value->con_cro!="" && $value->gd_doc !="" && $value->bl_doc !="" && $value->invoice_doc !="" & $value->delivery_doc !="" && $value->guarantee_doc !="" ){?>

            <tr> 
            <td class="text-center"><?php echo "LP-".$val->load_id;?></td>
         
            <td><b><?php echo $val->job_type;?></b></td>  

            <td>    
                 <a href="./gate_pass.php?load_id=<?=$val->load_id?>" style="border-radius: 10px;" class="on-default  text-default ml-3 btn btn-info text-white">Gate Pass</a>
            </td>


        </tr>


           <? } } } } }?>
                 
            </tbody>
        </table>

 </div>
    </div>
    </div>
    </div>
    </div>


<!-- <script src="../assets/js/lib/data-table/datatables.min.js"></script>
<script type="text/javascript">
  

    $(document).ready( function () 
        {
            $('#bootstrap-data-table').DataTable
             ({
               
                "language": {"emptyTable":  "<center>No Pending Jobs Available </center>"}
             });
           
            
        } );         
</script> -->