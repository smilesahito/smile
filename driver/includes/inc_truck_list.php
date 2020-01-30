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
  $truck = LorryOwner::GetTruck($_SESSION['sess_admin_id']); 
  
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
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm float-right" onclick="location.href='truck_add.php';"><i class="fa fa-plus"></i>&nbsp; New</button>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Type</th>
                        <th>Made</th>
                        <th>Model</th>
                        <th>Capacity</th>
                        <th>Truck #</th>
                        <th>Truck RC</th>
                        <th>Document</th>
                        <th>Tracker ID</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
			<? if($truck) { $a=1;
               
                foreach($truck as $row) { ?>
                      <tr>
                        <td><?=$row->truck_type?></td>
                        <td><?=$row->truck_company?></td>
                        <td><?=$row->truck_model?></td>
                        <td><?=$row->truck_capacity?></td>
                        <td><?=$row->truck_no?></td>
                        <td class="text-center"><button type="button" class="btn btn-outline-success btn-sm" onclick="location.href='controller/action-ctl.php?command=downloadfile&filename=<?=$row->truck_rc?>&foldername=<?=$config["rc_path"]?>';"><i class="fa fa-download"></i></button></td>
                        <td class="text-center"><button type="button" class="btn btn-outline-success btn-sm" onclick="location.href='controller/action-ctl.php?command=downloadfile&filename=<?=$row->truck_documents?>&foldername=<?=$config["documents_path"]?>';"><i class="fa fa-download"></i></button></td>
                        <td><?=$row->truck_tracker_id?></td>
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






