        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add New Truck</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">New Truck</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

            
			<form class="form-horizontal" method="post" role="form" action="controller/action-ctl.php" enctype="multipart/form-data">
			<input type="hidden" name="command" value="addtruck">

			<div class="content mt-3">

				<div class="col-lg-12">
                    <div class="card">
                      <div class="card-body card-block">
                        <form action="" method="post" class="">
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-truck"></i></div>
                              <input type="text" id="truck_type" name="truck_type" placeholder="Truck Type" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-building-o"></i></div>
                              <input type="text" id="truck_company" name="truck_company" placeholder="Made By" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-gears"></i></div>
                              <input type="text" id="truck_model" name="truck_model" placeholder="Model" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                              <input type="text" id="truck_capacity" name="truck_capacity" placeholder="Capacity" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></div>
                              <input type="text" id="truck_no" name="truck_no" placeholder="Truck No." class="form-control">
                            </div>
                          </div>
                          <div class="input-group mb-3">
							  <div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-upload"> </i> Truck RC</span>
							  </div>
							  <div class="custom-file">
								<input type="file" class="custom-file-input" id="truck_rc" name="truck_rc">
								<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
							  </div>
						  </div>
                          <div class="input-group mb-3">
							  <div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-upload"> </i> Vehicle Document</span>
							  </div>
							  <div class="custom-file">
								<input type="file" class="custom-file-input" id="truck_documents" name="truck_documents">
								<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
							  </div>
						  </div>
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-shield"></i></div>
                              <input type="text" id="truck_tracker_id" name="truck_tracker_id" placeholder="Tracker ID" class="form-control">
                            </div>
                          </div>
                          
                          <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-dot-circle-o"></i> Submit</button></div>
                        </form>
                      </div>
                    </div>
                  </div>

		</div>