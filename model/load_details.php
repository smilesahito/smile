		<div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header bg-primary">
			<h5 class="modal-title text-white" id="mediumModalLabel">Pending Jobs Details</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		
		<div class="modal-body" >
		<div class="row">
		<div class="col-md-2 font-weight-bold">Load ID:</div>
		<div class="col-md-2 bg-light"><?="LP-".$val->load_id?></div>                            
		<div class="col-md-3 font-weight-bold">Expected Price:</div>
		<div class="col-md-2 bg-light"><?=$val->expected_price?></div> 
		<div class="col-md-2 font-weight-bold">Total Truck:</div>
		<div class="col-md-1 bg-light"><?=$val->total_truck?></div> 
		<!-- <div class="col-md-3 font-weight-bold">Insurance:</div> -->
		<!-- <div class="col-md-3 bg-light"><?=$val->insurance?></div>  -->
		<!-- <div class="col-md-3 font-weight-bold">Insurance Number:</div> -->
		<!-- <div class="col-md-3 bg-light"><?=$val->insurance_number?></div>                             -->

		<?php 
		$b=0;
		foreach($val->pickup_detail as $row2)
		{ ?>

		<div class="col-md-12"><hr /></div> 
		<div class="col-md-12 bg-info font-weight-bold text-white p-2">Drop-Off Detail #<?=++$b?>. </div> 
		<div class="col-md-3 font-weight-bold mt-3">Officer Name:</div>
		<div class="col-md-3 bg-light mt-3"><?=$row2->source_name?></div> 
		<div class="col-md-2 font-weight-bold mt-3">Phone No:</div>
		<div class="col-md-3 bg-light mt-3"><?=$row2->source_contactno?></div>
		<div class="col-md-2 font-weight-bold mt-3">Email:</div>
		<div class="col-md-3 bg-light mt-3"><?=$row2->source_email?></div>
		<div class="col-md-2 font-weight-bold mt-3">Load From:</div>
		<div class="col-md-3 bg-light mt-3"><?=$row2->load_from?></div>

		<?php  }
		$a=0;
		foreach($val->load_detail as $row)
		{ ?>

		<div class="col-md-12"><hr /></div> 
		<div class="col-md-12 bg-info font-weight-bold mt-3 p-2 text-white">Prick-Up Detail #<?=++$a?>. </div> 

		<div class="col-md-3 font-weight-bold mt-3">Goods Type:</div>
		<div class="col-md-3 mt-3 bg-light"><?=$row->goods_type?></div> 

		<div class="col-md-3 font-weight-bold mt-3">Security Code:</div>
		<div class="col-md-3 mt-3 bg-light"><?=$row->security_code?></div> 


		<div class="col-md-3 mt-3 font-weight-bold">No of packages:</div>
		<div class="col-md-3 mt-3bg-light "><?=$row->no_of_packages?></div>
		<div class="col-md-3 mt-3 font-weight-bold">Type of Packages:</div>
		<div class="col-md-3 mt-3 bg-light "><?=$row->package_type?></div>                            


		<div class="col-md-3 mt-3 font-weight-bold">Weight:</div>
		<div class="col-md-3 mt-3 bg-light "><?=$row->weight?></div>                            


		<div class="col-md-3 mt-3 font-weight-bold">Target Price:</div>
		<div class="col-md-3 mt-3 bg-light"><?=$row->target_price?></div>

		<div class="col-md-12"><hr /></div> 

		<div class="col-md-3 mt-3 font-weight-bold">Name:</div>
		<div class="col-md-3 mt-3 bg-light"><?=$row->destination_name?></div> 
		<div class="col-md-3 mt-3 font-weight-bold">Telephone:</div>
		<div class="col-md-3 mt-3 bg-light"><?=$row->destination_contactno?></div>


		<div class="col-md-3 mt-3 font-weight-bold">Load To:</div>
		<div class="col-md-3 mt-3 bg-light"><?=$row->load_to?></div>


		<?php }	?>

		</div>

		<div class="modal-footer">
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
		</div>
		</div>
		</div>
		</div>