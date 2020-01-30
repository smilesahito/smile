        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Truck List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Truck List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

<? 
  $truck = LorryOwner::GetTruck(); 
    // echo '<pre>';
    // print_r($truck);
    // echo "</pre>";
    // die();
if(isset($param))
                    {?><div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            <span class="badge badge-pill badge-success">Success</span>
                                                You are successfully add the Truck.
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                    <?}
                        ?>  
 <? if(isset($param1))
                    {?><div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Success</span>
                                                You are successfully delete the Truck.
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
                        <div class="p-3 mb-2 bg-info text-white">
                            <button type="button" class="alert alert-primary btn btn-primary btn-sm float-right" onclick="location.href='truck_add.php';"><i class="fa fa-plus"></i>&nbsp; New</button>
                        </div>
                        <div class="card-body table-responsive">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr class="bg-success text-white">
                        <th>Owner</th>
                        <th>Truck Type</th>
                        <th>Truck Capacity</th>
                        <th>View</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
            <? if($truck) { $a=1;
               
                foreach($truck as $row) { ?>
                      <tr>
                        <td><?=$row->driver?></td>
                        <td><?=$row->truck_type_name?></td>
                        <td><?=$row->truck_capacity?></td>
                        <td><button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$row->user_id?>">
                          Details
                      </button>
                       
                <div class="modal fade" id="<?=$row->user_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title" id="mediumModalLabel">Truck Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <div class="row">
                                    <div class="col-md-4 bg-light p-2">Owner Name:</div>
                                    <div class="col-md-8 p-2"><?=$row->driver?></div>                            
                                    <div class="col-md-4 bg-light p-2">Made By:</div>
                                    <div class="col-md-8 p-2"><?=$row->truck_company?></div>                            
                                    <div class="col-md-4 bg-light p-2">Truck Model:</div>
                                    <div class="col-md-8 p-2"><?=$row->truck_model?></div>                            
                                    <div class="col-md-4 bg-light p-2">Capacity:</div>
                                    <div class="col-md-8 p-2"><?=$row->truck_capacity?></div>                            
                                    <div class="col-md-4 bg-light p-2">Truck No:</div>
                                    <div class="col-md-8 p-2"><?=$row->truck_no?></div>                            
                                    <div class="col-md-4 bg-light p-2">Truck RC:</div>
                                    <div class="col-md-8 p-2"><button type="button" class="btn btn-outline-success btn-sm" title="Download" onclick="location.href='controller/action-ctl.php?command=downloadfile&filename=<?=$row->truck_rc?>&foldername=<?=$config["rc_path"]?>';"><i class="fa fa-download"></i></button></div>                            
                                    <div class="col-md-4 bg-light p-2">Truck Documents:</div>
                                    <div class="col-md-8 p-2"><button type="button" class="btn btn-outline-success btn-sm" title="Download" onclick="location.href='controller/action-ctl.php?command=downloadfile&filename=<?=$row->truck_documents?>&foldername=<?=$config["documents_path"]?>';"><i class="fa fa-download"></i></button></div>                            
                                    <div class="col-md-4 bg-light p-2">Tracker ID:</div>
                                    <div class="col-md-8 p-2"><?=$row->truck_tracker_id?></div>                            
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                       </td>
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






