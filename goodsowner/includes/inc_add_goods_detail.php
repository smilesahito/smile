      

      <div class="breadcrumbs">
      <div class="col-sm-4">
      <div class="page-header float-left">
      <div class="page-title">
          <h1>Add Load Details</h1>
      </div>
      </div>
      </div>

      <div class="col-sm-8">
      <div class="page-header float-right">
      <div class="page-title">
          <ol class="breadcrumb text-right">
              <li><a href="index.php">Dashboard</a></li>
              <li><a href="load_list.php">Load List</a></li>
              <li class="active">New Load</li>
          </ol>
      </div>
      </div>
      </div>
      </div>

      <div class="content mt-3">
      <div class="animated fadeIn">
      <div class="row">
        <form class="form-horizontal m-t-5" method="post" action="controller/action-ctl.php" enctype="multipart/form-data">
          <input type="hidden" class="form-control" name="command" value="addloaddetail">
          <input type="hidden" name="load_id" value="<?=base64_decode($param)?>">        
      <div class="col-xs-12 col-sm-12">
      <div class="card">
			<div class="card-header">
					<strong class="card-title">Load Information</strong>
					<?php $load=Load::GetLoad(base64_decode($param));?>
			</div>
                           
      <div class="card-body card-block">
      <div class="form-group col-md-4">
          <label class=" form-control-label">Truck Type Needed</label>
      <div class="font-weight-bold">
      <?=$load->truck_type_name?>
      </div>
      </div>

      <div class="form-group col-md-3">
          <label class=" form-control-label">Capacity</label>
      <div class="font-weight-bold">
      <?=$load->capacity?>
      </div>
      </div>

      <div class="form-group  col-md-3">
          <label class=" form-control-label">Date</label>
      <div class="font-weight-bold">
      <?=$load->load_date?>
      </div>
      </div>
      
      <div class="form-group col-md-2">
          <label class=" form-control-label">Expected Prices</label>
      <div class="font-weight-bold">
      <?=$load->expected_price?>
      </div>
      </div>

      <div class="form-group col-md-4">
          <label class=" form-control-label">Load From</label>
      <div class="font-weight-bold">
      <?=$load->load_from?>
      </div>
      </div>
      
      <div class="form-group col-md-3">
          <label class=" form-control-label">From Latitude</label>
      <div class="font-weight-bold">
      <?=$load->from_latitude?>
      </div>
      </div>

      <div class="form-group col-md-3">
          <label class=" form-control-label">Load Longitude</label>
      <div class="font-weight-bold">
      <?=$load->from_longitude?>
      </div>
      </div>
      
      <div class="form-group col-md-2">
          <label class=" form-control-label">Name</label>
      <div class="font-weight-bold">
      <?=$load->source_name?>
      </div>
      </div>

      <div class="form-group col-md-4">
          <label class=" form-control-label">Telephone</label>
      <div class="font-weight-bold">
      <?=$load->source_contactno?>
      </div>
      </div>
      
      <div class="form-group col-md-3">
          <label class=" form-control-label">Email</label>
      <div class="font-weight-bold">
      <?=$load->source_email?>
      </div>
      </div>

      <div class="form-group col-md-3">
          <label class=" form-control-label">Bid Start Date</label>
      <div class="font-weight-bold">
      <?=$load->bid_date_start?>
      </div>
      </div>
      
      <div class="form-group col-md-2">
          <label class=" form-control-label">Bid End Date</label>
      <div class="font-weight-bold">
      <?=$load->bid_date_end?>
      </div>
      </div>
      </div>
      </div>
      </div>

      <div class="col-xs-12 col-sm-12">
      <div class="card">
      <div class="card-header">
          <strong class="card-title">About Goods</strong>
      </div>
					
      <div class="card-body">
      <div class="form-group col-md-4">
          <label class=" form-control-label">Goods Type</label>
      <div class="input-group">
          <input class="form-control" name="goods_type" type="text" required="" value="Cement">
      </div>
      </div>
      
      <div class="form-group col-md-3">
          <label for="select" class=" form-control-label">Posting Type</label>
      <div class="input-group">
          <select name="posting_type" id="posting_type" class="form-control">
              <option value="">Please select</option>
              <option value="Reguler">Reguler</option>
              <option value="Binding">Binding</option>
          </select>
      </div>
      </div>

      <div class="form-group col-md-2">
          <label class=" form-control-label">No of packages</label>
      <div class="input-group">
          <input class="form-control" name="no_of_packages" type="text" required="" value="90">
      </div>
      </div>
                        
      <div class="form-group col-md-3">
          <label for="select" class=" form-control-label">Type of Packages</label>
      <div class="input-group">
          <select name="package_type" id="package_type" class="form-control">
              <option value="">Please select</option>
              <option value="Loose Cargo">Loose Cargo</option>
          </select>
      </div>
      </div>

      <div class="form-group col-md-3">
          <label for="text-input" class=" form-control-label">Load Type</label>
      <div class="input-group">
          <select name="load_type" id="package_type" class="form-control" required="required">
              <option value="">Please select</option>
              <option value="Weight">Weight</option>
              <option value="Package">Package</option>
          </select>
      </div>
      </div>

      <div class="form-group col-md-3">
          <label for="text-input" class=" form-control-label">Dimension</label>
      <div class="input-group">
          <input type="text" id="dimenson" name="dimenson" placeholder="Text" class="form-control" value="12"><small class="form-text text-muted"></small>
      </div>
      </div>

      <div class="form-group col-md-3">
          <label for="text-input" class=" form-control-label">Weight Per Package</label>
      <div class="input-group">
          <input type="text" id="weight" name="weight" placeholder="Text" class="form-control" value="12"><small class="form-text text-muted"></small>
      </div>
      </div>
                          
      <div class="form-group col-md-3">
          <label for="text-input" class=" form-control-label">Price  Per Package</label>
      <div class="input-group">
          <input type="text" id="target_price" name="target_price" placeholder="Text" class="form-control" value="12"><small class="form-text text-muted"></small>
      </div>
      </div>
      </div>
      </div>
      </div>
                    
      <div class="col-xs-12 col-sm-12">
      <div class="card">
      <div class="card-header">
          <strong class="card-title">Destination Information</strong>
      </div>

      <div class="card-body">
      <div class="form-group col-md-4">
          <label for="text-input" class=" form-control-label">Name</label>
      <div class="input-group">
          <input type="text" id="destination_name" name="destination_name" placeholder="Text" class="form-control" value="destine"><small class="form-text text-muted"></small>
      </div>
      </div>
      
      <div class="form-group col-md-4">
          <label for="text-input" class=" form-control-label">Telephone</label>
      <div class="input-group">
          <input type="text" id="destination_contactno" name="destination_contactno" placeholder="Text" class="form-control" value="destine123" ><small class="form-text text-muted"></small>
      </div>
      </div>

      <div class="form-group col-md-4">
          <label for="text-input" class=" form-control-label">Email</label>
      <div class="input-group">
          <input type="text" id="destination_email" name="destination_email" placeholder="Text" class="form-control" value="destine@tyesting.com"><small class="form-text text-muted"></small>
      </div>
      </div>

      <div class="form-group col-md-4">
          <label class=" form-control-label">Load To</label>
      <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-building-o"></i></div>
          <textarea name="load_to" id="load_to" rows="2" placeholder="Write Load Destination Address Here..." class="form-control">Merewether Clock Tower Seari Quarters, Karachi, Karachi City, Sindh, Pakistan</textarea>
      </div>
      </div>

      <div class="form-group col-md-2">
          <label class=" form-control-label">To Latitude</label>
      <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
          <input class="form-control text-center" name="to_latitude" type="text" placeholder="To Latitude" value="24.848901">
      </div>
      
      <div class="orm-group col-md-2">
          <label class=" form-control-label">To Longitude</label>
      <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
          <input class="form-control text-center" name="to_longitude" type="text" placeholder="To Longitude" value="66.997483">
      </div>
                          
      <div class="form-group col-md-2">
          <label for="text-input" class=" form-control-label">Distance</label>
      <div class="input-group">
          <input type="text" id="distance" name="distance" class="form-control" value="40 km"></div>
      </div>

      <div class="form-group col-md-2">
          <label for="text-input" class=" form-control-label">Approximately Travelling Time</label>
      <div class="input-group">
          <input type="text" name="appx_traveling_time" class="form-control"></div>
      </div>
      </div>
      </div>
      </div>
      <?php $load_details=Load::GetLoadDetails(base64_decode($param),'Active'); 
			if($load_details) {?>
      <div class="col-xs-12 col-sm-12">
      <div class="card">
      <div class="card-header">
          <strong class="card-title">Post Load Details</strong>
      </div>

      <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Destination User</th>
                  <th scope="col">Goods Type</th>
                  <th scope="col">Destination</th>
                  <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
						<?php $a=1;
						foreach($load_details as $row)
						{ 
						?>
              <tr>
                  <th scope="row"><?=$a?></th>
                  <td><?=$row->destination_name?></td>
                  <td><?=$row->goods_type?></td>
                  <td><?=$row->load_to?></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-sm mt-2" title="View" data-toggle="modal" data-target="#view<?=$row->load_detail_id?>">
                    <i class="fa fa-eye"></i>
                    </button>
										<a href="controller/action-ctl.php?command=delloaddetail&load_id=<?=base64_decode($param)?>&load_detail_id=<?=$row->load_detail_id?>" class="btn btn-danger btn-sm mt-2" role="button"><i class="fa fa-trash-o"></i></a>
      						</td>
              </tr>
              <?php include("../model/post_load_details.php") ?>		                
					    <?php $a++;	}
							?>
            </tbody>
        </table>

        </div>
        </div>
        </div>
        <?php } ?>
                    
        <div class="col-xs-12 col-sm-12">
        <div class="card">
        <div class="card-body">
            <button type="submit" class="btn btn-primary btn-sm">
              <i class="fa fa-plus"></i> Add
            </button>
            <?php if($load_details) { ?>
            <button type="button" class="btn btn-success btn-sm"  onClick="Javascript:window.location.href = 'load_list.php';">
              <i class="fa fa-arrow-circle-left"></i> Close
            </button>
            <?php } ?>
        </div>
        </div>
        </div>
        </form>


        </div>
        </div><!-- .animated -->
        </div><!-- .content -->