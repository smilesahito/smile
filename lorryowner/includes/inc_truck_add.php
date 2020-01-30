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
     
        <?if(empty($_GET['param'])){
          
          }else if($_GET['param']== "1"){?>
              <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
             <span class="badge badge-pill badge-success">Success</span>
                    Your Truck Inforamtion has been record. Your Truck will be active within 3days when all the submitted document are verified...  
                    Thank You 
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">×</span>
             </button>
             </div>
             <?}?>
            
			<form class="form-horizontal" method="post" role="form" action="controller/action-ctl.php" enctype="multipart/form-data">
			<input type="hidden" name="command" value="addtruck">

			<div class="content mt-3">

				<div class="col-lg-12">
                    <div class="card">
                      <div class="card-body card-block">
                   <?php $truck=Truck::GetTruckTypeList(); ?>
                          <div class="form-group">
                              <label class=" form-control-label">Select Truck</label>
                            <div class="input-group">
                              <select name="truck_type" id="truck_type" class="form-control">
                                <option value="">Please select</option>
                                <?php foreach($truck as $row) { ?>
                                <option value="<?=$row->truck_type_id?>"><?=$row->truck_type_name?></option>
                            <?php } ?>
                              </select>
                            </div>                      
                          </div>

                       <div class="form-group">
                        <label class=" form-control-label">Select Capacity</label>
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-rebel"></i>   </div>
                             <select  class="form-control" name="capacity" id="capacity" style="height: 35px"> 
                             <option value="<?=$row->truck_type_id?>" hidden="true">----Select Capacity---</option>
                             </select> 
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
                      </div>
                    </div>
                  </div>

		</div>
  </form>

  <script src="/js/chosen.jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
  // Call Geo Complete

  $('#truck_type').change(function(){

                
                let truck_type= $("#truck_type").val();
                console.log(truck_type);
                let command = 'fetchCapacity';
                $.ajax(
                {
                    type:"post",
                    url: "../goodsowner/controller/action-ctl.php",
                    data:{ truck_type:truck_type,command:command},
                    success:function(response)
                    {
                        console.log(response);
                        $('#capacity').html(response);
                        
                      
                }
                    
                }
               );


            });


  // $("#addressto").geocomplete({details:"div#to_div"});

});

</script>