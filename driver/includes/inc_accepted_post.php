 <?php

  $goods = GoodsOwner::GetAcceptedLoad($_SESSION["sess_admin_id"]);
?>


       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Load Accepted List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Load Accepted List</li>
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
                      <tr>
                        <th>Load ID</th>
                        <th>Goods Owner</th>
                        <th>Capacity</th>
                        <th>Load Date</th>
                        <th>View</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
						if($goods) {
						foreach($goods as $val){ ?> 
                        <tr> 
                        <td><?php echo "LP-".$val->load_id;?></td>
                        <td><?php echo $val->posted_by;?></td>
                        <td><?php echo $val->capacity;?></td>
                        <td><?php echo $val->load_date;?></td> 
                           <td>
                         <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$val->load_id?>">Details</button>
		                <div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
		                    <div class="modal-dialog modal-lg" role="document">
		                        <div class="modal-content">
		                            <div class="modal-header bg-primary">
		                                <h5 class="modal-title" id="mediumModalLabel">Post Load Detail</h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                    <span aria-hidden="true">&times;</span>
		                                </button>
		                            </div>
		                            <div class="modal-body" >
		                            <div class="row">
                                	<div class="col-md-4 bg-light p-2">Load ID:</div>
                                	<div class="col-md-8 p-2"><?="LP-".$val->load_id?></div>                            
                                	<div class="col-md-4 bg-light p-2">Goods Owner:</div>
                                	<div class="col-md-8 p-2"><?=$val->posted_by?></div>                            
                                	<div class="col-md-4 bg-light p-2">truck Type:</div>
                                	<div class="col-md-8 p-2"><?=$val->truck_type?></div>                            
                                	<div class="col-md-4 bg-light p-2">capacity:</div>
                                	<div class="col-md-8 p-2"><?=$val->capacity?></div>                            
                                	<div class="col-md-4 bg-light p-2">goods Type:</div>
                                	<div class="col-md-8 p-2"><?=$val->goods_type?></div>                            
                                	<div class="col-md-4 bg-light p-2">load From:</div>
                                	<div class="col-md-8 p-2"><?=$val->load_from?></div>                            
                                	<div class="col-md-4 bg-light p-2">From Latitude:</div>
                                	<div class="col-md-8 p-2"><?=$val->from_latitude?></div>                            
                                	<div class="col-md-4 bg-light p-2">From Longitude:</div>
                                	<div class="col-md-8 p-2"><?=$val->from_longitude?></div>              
                                	<div class="col-md-4 bg-light p-2">Load To:</div>
                                	<div class="col-md-8 p-2"><?=$val->load_to?></div>                            
                                	<div class="col-md-4 bg-light p-2">To Longitude:</div>
                                	<div class="col-md-8 p-2"><?=$val->to_latitude?></div>                            
                                	<div class="col-md-4 bg-light p-2">To Longitude:</div>
                                	<div class="col-md-8 p-2"><?=$val->to_longitude?></div>                            
                                	<div class="col-md-4 bg-light p-2">expected Price:</div>
                                	<div class="col-md-8 p-2"><?=$val->expected_price?></div>                            
                                	<div class="col-md-4 bg-light p-2">posting Type:</div>
                                	<div class="col-md-8 p-2"><?=$val->posting_type?></div>                            
                                	<div class="col-md-4 bg-light p-2">No Of Packages:</div>
                                	<div class="col-md-8 p-2"><?=$val->No_of_packages?></div>   
                                	</div>
                                	<hr>
                                	<div class="row">                       
                                	<div class="col-md-4 bg-light p-2">Dimenson:</div>
                                	<div class="col-md-8 p-2"><?=$val->dimenson?></div>     
                                	
                                	<div class="col-md-4 bg-light p-2">Weight:</div>
                                	<div class="col-md-8 p-2"><?=$val->weight?></div> 
                                	
                                	<div class="col-md-4 bg-light p-2">Quality:</div>
                                	<div class="col-md-8 p-2"><?=$val->quality?></div> 
                                	
                                	<div class="col-md-4 bg-light p-2">Total Price:</div>
                                	<div class="col-md-8 p-2"><?=$val->total_price?></div>  
                                	
                                	<div class="col-md-4 bg-light p-2">Bid Start Date:</div>
                                	<div class="col-md-8 p-2"><?=$val->bid_date_start?></div>  
                                	   
                                	<div class="col-md-4 bg-light p-2">Bid End Date:</div>
                                	<div class="col-md-8 p-2"><?=$val->bid_date_end?></div> 
                                	</div>
                                	 <hr>
                                	<div class="row">                       
                                	<div class="col-md-4 bg-light p-2">Source Name:</div>
                                	<div class="col-md-8 p-2"><?=$val->source_name?></div>  
                                	
                                	<div class="col-md-4 bg-light p-2">Source Email:</div>
                                	<div class="col-md-8 p-2"><?=$val->source_email?></div>
                                	
                                	<div class="col-md-4 bg-light p-2">Source Contact No.:</div>
                                	<div class="col-md-8 p-2"><?=$val->source_contactno?></div>
                                	</div>
                                	 <hr>
                                	<div class="row">                       
                                	<div class="col-md-4 bg-light p-2">Destination Name:</div>
                                	<div class="col-md-8 p-2"><?=$val->destination_name?></div>  
                                	
                                	<div class="col-md-4 bg-light p-2">Destination Contact No.:</div>
                                	<div class="col-md-8 p-2"><?=$val->destination_contactno?></div>
                                	
                                	<div class="col-md-4 bg-light p-2">Destination Email:</div>
                                	<div class="col-md-8 p-2"><?=$val->destination_email?></div>
                                	
                                	<div class="col-md-4 bg-light p-2">Distance:</div>
                                	<div class="col-md-8 p-2"><?=$val->distance?></div>
                                	
                                	<div class="col-md-4 bg-light p-2">Approximately Travelling Time:</div>
                                	<div class="col-md-8 p-2"><?=$val->appx_traveling_time?></div>
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
                        	<button type="submit" class="btn btn-success btn-sm">Accepted</button>
                        </td>
                        
                         </tr>
                 	 <?php } }?>
                 
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
        </div><!-- .content -->