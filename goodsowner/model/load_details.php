

<div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary" class="text-white">
				<h5 class="modal-title text-white" id="mediumModalLabel">Post Load Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" >
				<div class="row">
					<div class="col-md-3 font-weight-bold">Load ID:</div>
					<div class="col-md-3 bg-light"><?="LP-".$val->load_id?></div>   
                          
					
					<div class="col-md-3 font-weight-bold">truck Type:</div>
					<div class="col-md-3 "><?=$val->truck_type?></div>

					<div class="col-md-3 font-weight-bold">truck Type:</div>
					<div class="col-md-3 "><?=$val->truck_type?></div> 
					                           
					<div class="col-md-3 font-weight-bold">capacity:</div>
					<div class="col-md-3 "><?=$val->capacity?></div>                            
					<div class="col-md-3 font-weight-bold">Date:</div>
					<div class="col-md-3 "><?=$val->load_date?></div>                            
					
					<div class="col-md-3 font-weight-bold">Expected Prices:</div>
					<div class="col-md-3 "><?=$val->expected_price?></div>                            
					<div class="col-md-3 font-weight-bold">Bid Date Start:</div>
					<div class="col-md-3 "><?=$val->bid_date_start?></div> 
					
					<div class="col-md-3 font-weight-bold">Bid Date End:</div>
					<div class="col-md-3 "><?=$val->bid_date_end?></div>

					
					<?php $pickup_details=Load::Getpickup($val->load_id); 
						if($pickup_details) { $a=1;
							foreach($pickup_details as $row)
					{ ?>
					
					<div class="col-md-12"><hr /></div> 
					<div class="col-md-12 bg-info font-weight-bold">Pick Up Detail #<?=$a?>. </div> 
					
					<div class="col-md-3 font-weight-bold">Source Name:</div>
					<div class="col-md-3 "><?=$row->source_name?></div> 
					<div class="col-md-3 font-weight-bold">Contact No. :</div>
					<div class="col-md-3 "><?=$row->source_contactno?></div>  

					<div class="col-md-3 font-weight-bold">Source email:</div>
					<div class="col-md-3 "><?=$row->source_email?></div>
					<div class="col-md-3 font-weight-bold">Load From:</div>
					<div class="col-md-3 "><?=$row->load_from?></div>                            

					<div class="col-md-3 font-weight-bold">From Latitude:</div>
					<div class="col-md-3 "><?=$row->from_latitude?></div>
					<div class="col-md-3 font-weight-bold">From Longitude:</div>
					<div class="col-md-3 "><?=$row->from_longitude?></div>                            

					
					<?php $a++;
					 }
						} 
					?>


					 <?php $load_details=Load::GetLoadDetails($val->load_id); 
						if($load_details) { $a=1;
							foreach($load_details as $row)
					{ ?>
					
					<div class="col-md-12"><hr /></div> 
					<div class="col-md-12 bg-info font-weight-bold">Destination Detail #<?=$a?>. </div> 
					
					<div class="col-md-3 font-weight-bold">Goods Type:</div>
					<div class="col-md-3 "><?=$row->goods_type?></div> 
					<div class="col-md-3 font-weight-bold">Posting Type:</div>
					<div class="col-md-3 "><?=$row->posting_type?></div>  

					<div class="col-md-3 font-weight-bold">No of packages:</div>
					<div class="col-md-3 "><?=$row->no_of_packages?></div>
					<div class="col-md-3 font-weight-bold">Type of Packages:</div>
					<div class="col-md-3 "><?=$row->package_type?></div>                            

					<div class="col-md-3 font-weight-bold">Dimension:</div>
					<div class="col-md-3 "><?=$row->dimenson?></div>
					<div class="col-md-3 font-weight-bold">Weight:</div>
					<div class="col-md-3 "><?=$row->weight?></div>                            

					<div class="col-md-3 font-weight-bold">Load Type:</div>
					<div class="col-md-3 "><?=$row->load_type?></div>
					<div class="col-md-3 font-weight-bold">Target Price:</div>
					<div class="col-md-3 "><?=$row->target_price?></div>

					<div class="col-md-12"><hr /></div> 

					<div class="col-md-3 font-weight-bold">Name:</div>
					<div class="col-md-3 "><?=$row->destination_name?></div> 
					<div class="col-md-3 font-weight-bold">Telephone:</div>
					<div class="col-md-3 "><?=$row->destination_contactno?></div>

					<div class="col-md-3 font-weight-bold">Email:</div>
					<div class="col-md-3 "><?=$row->destination_email?></div>
					<div class="col-md-3 font-weight-bold">Load To:</div>
					<div class="col-md-3 "><?=$row->load_to?></div>

					<div class="col-md-3 font-weight-bold">To Latitude:</div>
					<div class="col-md-3 "><?=$row->to_latitude?></div> 
					<div class="col-md-3 font-weight-bold">To Longitude:</div>
					<div class="col-md-3 "><?=$row->to_longitude?></div>

					<div class="col-md-3 font-weight-bold">Distance:</div>
					<div class="col-md-3 "><?=$row->distance?></div>
					<div class="col-md-3 font-weight-bold">App. Trav. Time:</div>
					<div class="col-md-3 "><?=$row->appx_traveling_time?></div>
					<?php $a++; }
						} ?>
				</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
		                </div>