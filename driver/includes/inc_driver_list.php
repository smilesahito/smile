        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Driver List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Driver List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

<? 
  $driver = LorryOwner::GetDriver($_SESSION['sess_admin_id']); 
  
if(isset($param))
					{?><div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            <span class="badge badge-pill badge-success">Success</span>
                                                You are successfully add the Driver.
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
					<?}
						?>	
 <? if(isset($param1))
					{?><div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Success</span>
                                                You are successfully delete the Driver.
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
					<?}
						?>

<div class="content mt-3">

<div class="">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm float-right" onclick="location.href='driver_registration.php';"><i class="fa fa-plus"></i>&nbsp; New</button>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Driver Name</th>
                        <th>CNIC #</th>
                        <th>Contact #</th>
                        <th>License</th>
                        <th>View</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
			<? if($driver) { $a=1;
               
                foreach($driver as $row) { ?>
                      <tr>
                        <td><?=$row->driver_name?></td>
                        <td><?=$row->driver_cnic_no?></td>
                        <td><?=$row->driver_mob_no?></td>
                        <td class="text-center"><button type="button" class="btn btn-outline-success btn-sm" onclick="location.href='controller/action-ctl.php?command=downloadfile&filename=<?=$row->license_file_name?>&foldername=<?=$config["license_path"]?>';"><i class="fa fa-download"></i></button></td>
                        <td><button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$row->driver_id?>">
                          Details
                      </button>
                       
                <div class="modal fade" id="<?=$row->driver_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Driver Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <div class="row">
                                	<div class="col-md-4 bg-light p-2">User Name:</div>
                                	<div class="col-md-8 p-2"><?=$row->driver_name?></div>                            
                                	<div class="col-md-4 bg-light p-2">Login ID:</div>
                                	<div class="col-md-8 p-2"><?=$row->login_id?></div>                            
                                	<div class="col-md-4 bg-light p-2">Address:</div>
                                	<div class="col-md-8 p-2"><?=$row->address?></div>                            
                                	<div class="col-md-4 bg-light p-2">City:</div>
                                	<div class="col-md-8 p-2"><?=$row->city?></div>                            
                                	<div class="col-md-4 bg-light p-2">Mobile:</div>
                                	<div class="col-md-8 p-2"><?=$row->driver_mob_no?></div>                            
                                	<div class="col-md-4 bg-light p-2">CNIC #:</div>
                                	<div class="col-md-8 p-2"><?=$row->driver_cnic_no?></div>                            
                                	<div class="col-md-4 bg-light p-2">License :</div>
                                	<div class="col-md-8 p-2"><?=$row->license_file_name?></div>                            
                                	<div class="col-md-4 bg-light p-2">First Reference:</div>
                                	<div class="col-md-8 p-2"><?=$row->reference_name1?></div>                            
                                	<div class="col-md-4 bg-light p-2">First Reference #:</div>
                                	<div class="col-md-8 p-2"><?=$row->reference_no1?></div>                            
                                	<div class="col-md-4 bg-light p-2">Second Reference:</div>
                                	<div class="col-md-8 p-2"><?=$row->reference_name2?></div>                            
                                	<div class="col-md-4 bg-light p-2">Second Reference #:</div>
                                	<div class="col-md-8 p-2"><?=$row->reference_no2?></div>                            
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                       </td>
                        <td><?=$row->status?></td>
                        <td><a href="#" class="on-default edit-row text-primary" title="Edit"><i class="fa fa-pencil"></i></a><a href="#" class="on-default remove-row text-danger ml-3" title="Delete"><i class="fa fa-trash-o"></i></a></td>
                      </tr>
                      
                

							<? } 
								   }?>
							
                    </tbody>
                  </table>
                               
                        </div>
                    </div>
                </div>


                </div>
            </div>
</div>






