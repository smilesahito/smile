		


		<div class="modal fade" id="<?=$job->bid_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header bg-default">
				<h5 class="modal-title" id="mediumModalLabel"><strong> Job Detail </strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
		</div>
		
		<div class="modal-body" style="margin: 10px">
		<div class="row">

		<div class="col-md-2.5 font-weight-bold">Owner Name:</div>
		<div class="col-md-3  bg-light"><?=$job->name?></div>                            
		<div class="col-md-1.5 font-weight-bold">Bid Amount:</div>
		<div class="col-md-1  bg-light"><?=$job->bid_amount?></div>                        
		<div class="col-md-2.5 font-weight-bold">No. Of Truck:</div>
		<div class="col-md-1  bg-light"><?=$job->no_of_truck?></div>                            
		<?php  
		$count = 0;
		foreach ($job->pickup_detail as $load_detail) { ?>
		<div class="col-md-12"><hr /></div> 
		<div class="col-md-12 bg-info font-weight-bold">
			<span class="pull-right text-white ">جھاں سامان لے جانا ھے   #<?=++$count?> </span> 
		<span class="pull-left" style="color: white; height: 25px">Destination Location </span>
		</div> 

		<div class="col-md-3 mt-2 font-weight-bold">Drop-Off:</div>
		<div class="col-md-3 mt-2"><?=$load_detail->load_from?></div> 
		<div class="col-md-3 mt-2 font-weight-bold">Receiver Name:</div>
		<div class="col-md-3 mt-2 "><?=$load_detail->source_name?></div>  
		<div class="col-md-3 font-weight-bold">Contact No. :</div>
		<div class="col-md-3 "><?=$load_detail->source_contactno?></div>
                       
					
		<?php } 
		$count = 0;
		foreach ($job->load_detail as $dest_detail) {?>
		<div class="col-md-12"><hr /></div> 
		<div class="col-md-12 bg-info font-weight-bold">
			<span class="pull-right" style="color: white;"><?=++$count?>جھاں سے سامان اٹھانا ھے  # </span>
			<span class="pull-left" style="color: white; height: 25px">Pick-Up Location </span>
		</div> 
		<div class="col-md-3 font-weight-bold mt-2">Commodities Type:</div>
		<div class="col-md-3 mt-2"><?=$dest_detail->goods_type?></div>
		<div class="col-md-3 font-weight-bold mt-2">Pickup:</div>
		<div class="col-md-3 mt-2"><?=$dest_detail->load_to?></div> 
		<div class="col-md-3 font-weight-bold">Officer Name:</div>
		<div class="col-md-3 "><?=$dest_detail->destination_name?></div>  
		<div class="col-md-3 font-weight-bold">Contact No. :</div>
		<div class="col-md-3 "><b><?=$dest_detail->destination_contactno?></b></div>
                           
		<div class="col-md-3 font-weight-bold">Package Type:</div>
		<div class="col-md-3 "><b><?=$dest_detail->package_type?></b></div>
		<div class="col-md-3 font-weight-bold">Weight:</div>
		<div class="col-md-3 "><?=$dest_detail->weight?></div>

		<?php } ?>	


		</div>
		</div>	
	
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
		</div>
	
		</div>
		</div>
		</div>