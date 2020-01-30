<div class="modal fade" id="view<?=$row->load_detail_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>   
