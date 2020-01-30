 <?php

  $invoice_details = Load::GetInvoice($_SESSION["sess_admin_id"]);
  
  if ($invoice_details) {   
   $a = 0;
   foreach ($invoice_details as $row) {
      
      $json[$a]=$row; 

     $Pickup_details = Load::GetInvoice_Pickup($row->load_id);
         $i=0;
         foreach($Pickup_details as $row1)
         {
        
            $json[$a]->pick_detail[]=$row1;
            $i++;
         }

     $destination_details = Load::GetInvoice_Destination($row->load_id);
         $j=0;
         foreach($destination_details as $row2)
         {
        
            $json[$a]->dest_detail[]=$row2;
            $j++;
         }

     $User_details = Load::GetallDrivers($row->load_id);
         $k=0;
         foreach($User_details as $row3)
         {
        
            $json[$a]->Driver_details[]=$row3;
            $k++;
         }

          $a++;
      
        }  

    }

     
?>

 


       <div class="breadcrumbs bg-info p-3 mb-2">
            <div class="col-sm-4">
                <div class="page-header float-left bg-info">
                    <div class="page-title text-white">
                        <h1><b>Balance Sheet</b></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 ">
                <div class="page-header float-right bg-info">
                    <div class="page-title ">
                        <ol class="breadcrumb text-right bg-info">
                            <li><a href="index.php" class="text-dark"><b>Dashboard</b></a></li>
                            <li class="active text-white"><b>Balance Sheet</b></li>
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
                      <tr class="bg-warning text-white">
                        <th>PickUp-Point</th>
                        <th>Destination-Point</th>
                        <!-- <th>Transporter</th> -->
                        <th>Driver</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
                if($json) {
                foreach($json as $val){ ?> 
                  <tr> 
                   <td>
                    <? foreach($val->pick_detail as $val_1){ ?>  
                    
                     <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$val_1->pickup_id?>"><b>PickUp-Details</b></button>
                        
                        <div class="modal fade" id="<?=$val_1->pickup_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="mediumModalLabel"><b>PickUp-Point Information</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" >
                                    <div class="row">

                                     <div class="col-md-6 bg-light p-2"><b>PickUp-Location:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_1->load_from?></div>    
                                    
                                    <div class="col-md-6 bg-light p-2"><b>Ware-House Receiver Name:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_1->source_name?></div>                            
                                    <div class="col-md-6 bg-light p-2"><b>Ware-House Receiver Contact No:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_1->source_contactno?></div>
                                    
                                    <div class="col-md-6 bg-light p-2"><b>Ware-House Receiver Email:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_1->source_email?></div>                
                                   
                                    <?}?>                            
                                     </div>
                                    </div>
                                  <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       </td>

                 <td>
                    <? foreach($val->dest_detail as $val_2){ ?>  
                    
                     <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$val_2->capacity?>"><b>Destination-Details</b></button>
                        
                        <div class="modal fade" id="<?=$val_2->capacity?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="mediumModalLabel"><b>Drop Off Information</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" >
                                    <div class="row">

                                    <div class="col-md-6 bg-light p-2"><b>Destination Name:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->load_to?></div>

                                   <div class="col-md-6 bg-light p-2"><b>Delivery Receiver Name:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->destination_name?></div>

                                   <div class="col-md-6 bg-light p-2"><b>Delivery Receiver Contact No:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->destination_contactno?></div>

                                  <div class="col-md-6 bg-light p-2"><b>Delivery Receiver Email:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->destination_email?></div> 

                                 <div class="col-md-6 bg-light p-2"><b>Security Code:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->security_code?></div>     

                                    <div class="col-md-6 bg-light p-2"><b>Date:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->load_date?></div>                            
                                    <div class="col-md-6 bg-light p-2"><b>Total Price:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->total_price?></div>
                                    
                                    <div class="col-md-6 bg-light p-2"><b>Total Truck :</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->total_truck?></div>                
                                    <div class="col-md-6 bg-light p-2"><b>Goods:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->goods_type?></div>

                                    <div class="col-md-6 bg-light p-2"><b>No Of Packages:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->no_of_packages?></div>

                                    <div class="col-md-6 bg-light p-2"><b>Weight:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->weight?></div>

                                    <div class="col-md-6 bg-light p-2"><b>Package Type:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->package_type?></div>

                                    <div class="col-md-6 bg-light p-2"><b>Load Type:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->load_type?></div>

                                    <div class="col-md-6 bg-light p-2"><b>Total Luggage:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->total_luggage?></div>

                                    <div class="col-md-6 bg-light p-2"><b>Luggage Unit:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_2->luggage_unit?></div>

                                    <?}?>                            
                                  
                                     </div>
                                    </div>
                                  <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       </td>
                               
                  <td>
                    <? foreach($val->Driver_details as $val_4){ ?>  
                    
                     <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#driver"><b>Driver-Details</b></button>
                        
                        <div class="modal fade" id="driver" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="mediumModalLabel"><b>Driver Information</b></h5>
                                        <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" >
                                    <div class="row">
                           
                                    <div class="col-md-6 bg-light p-2"><b>Driver Name:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->driver_name?></div>
                                    
                                    <div class="col-md-6 bg-light p-2"><b>Driver Contact No:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->driver_contctno?></div>

                                    <div class="col-md-6 bg-light p-2"><b>Driver Nic_No:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->driver_cnicno?></div>

                                    <div class="col-md-6 bg-light p-2"><b>Driver Address:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->driver_addres?></div>

                                    <div class="col-md-6 bg-light p-2"><b>Truck Name:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->truck_type_name?></div>
                                    
                                    <div class="col-md-6 bg-light p-2"><b>Truck No:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->truck_no?></div>

                                    <div class="col-md-6 bg-light p-2"><b>Truck Capacity:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->truck_capacity?></div>
                                    
                                    <div class="col-md-6 bg-light p-2"><b>Truck Curent Weight :</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->truck_current_load?></div>

                                   <div class="col-md-6 bg-light p-2"><b>Truck Return Weight :</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->return_weight?></div>

                                   <div class="col-md-12 bg-light p-2" style="text-align: center;"><b>Transporter Details</b></div>

                                    <div class="col-md-6 bg-light p-2"><b>Transporter Name:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->owner_name?></div>
                                    
                                    <div class="col-md-6 bg-light p-2"><b>Transporter Email:</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->owner_email?></div>

                                   <div class="col-md-6 bg-light p-2"><b>Transporter Contact-No :</b></div>
                                    <div class="col-md-6 p-2"><?=$val_4->owner_contct_no?></div>
        
                                    <?}?>                            
                                     </div>
                                    </div>
                        
                                </div>
                            </div>
                        </div>
                       </td>
                       
                        <td>

                           <?=(strftime("%B %d %Y",$val->created_on))?>

                           </td> 
                         </tr>
                        <?php } }?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>    
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
