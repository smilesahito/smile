 <?php
 $user_id = $_SESSION["sess_admin_id"];
 $pending_goods = GoodsOwner::GetGoods('','pending');
 ?>


       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pending Post</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                             <li><a href="#">List Load Post</a></li>
                            
                            <li class="active">Pending Post</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>




        <div class="content mt-3">
                <div class="row">
                <div class="col-md-12">                   
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Post ID</th>
                        <th>Load</th>
                        <th>Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>View</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
						if($pending_goods) {
						foreach($pending_goods as $val){ ?> 
                        <tr> 
                        <td><?php echo $val->load_id;?></td> 
                        <td><?php echo $val->capacity;?></td> 
                        <td><?php echo $val->load_date;?></td> 
                        <td><?php echo $val->from_date;?></td> 
                        <td><?php echo $val->to_date;?></td> 
                         <td>
                         <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#12">Details</button>
		                <div class="modal fade" id="12" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
		                    <div class="modal-dialog modal-lg" role="document">
		                        <div class="modal-content">
		                            <div class="modal-header">
		                                <h5 class="modal-title" id="mediumModalLabel">User Detail</h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                    <span aria-hidden="true">&times;</span>
		                                </button>
		                            </div>
		                            <div class="modal-body" >
		                            <div class="row">
                                	<div class="col-md-4 bg-light p-2">truck Type:</div>
                                	<div class="col-md-8 p-2"><?=$val->truck_type?></div>                            
                                	<div class="col-md-4 bg-light p-2">capacity:</div>
                                	<div class="col-md-8 p-2"><?=$val->capacity?></div>                            
                                	<div class="col-md-4 bg-light p-2">goods Type:</div>
                                	<div class="col-md-8 p-2"><?=$val->goods_type?></div>                            
                                	<div class="col-md-4 bg-light p-2">load Date:</div>
                                	<div class="col-md-8 p-2"><?=$val->load_date?></div>                            
                                	<div class="col-md-4 bg-light p-2">expected Price:</div>
                                	<div class="col-md-8 p-2"><?=$val->expected_price?></div>                            
                                	<div class="col-md-4 bg-light p-2">posting Type:</div>
                                	<div class="col-md-8 p-2"><?=$val->posting_type?$val->posting_type:0?></div>                            
                                	<div class="col-md-4 bg-light p-2">No Of Packages:</div>
                                	<div class="col-md-8 p-2"><?=$val->No_of_packages?></div>   
                                	</div>
                                	 
                                	<div class="row">                       
                                	<div class="col-md-4 bg-light p-2">Dimenson:</div>
                                	<div class="col-md-8 p-2"><?=$val->dimenson?></div>     
                                	<div class="col-md-4 bg-light p-2">Quality:</div>
                                	<div class="col-md-8 p-2"><?=$val->quality?></div> 
                                	<div class="col-md-4 bg-light p-2">Total Price:</div>
                                	<div class="col-md-8 p-2"><?=$val->total_price?></div>  
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
                        <form class="form-horizontal m-t-5" method="post" action="controller/action-ctl.php" enctype="multipart/form-data">
                        	<input type="hidden" class="form-control" name="command" value="acceptload">
                        	<input type="hidden" class="form-control" name="load_id" value="<?php echo $val->load_id;?>">
                        	<button type="submit" class="btn btn-primary btn-sm">Accept</button>
                        </form>
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