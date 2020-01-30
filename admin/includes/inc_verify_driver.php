        <div class="breadcrumbs ">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Verify Driver</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Verify Driver</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

<? 
  $owner = User::verifyDriver(); 
  // echo "<pre>";
  // print_r($owner);
  // echo "</pre>";die;
  
if(isset($param))
                    {?><div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            <span class="badge badge-pill badge-success">Success</span>
                                                You are successfully add the Lorry Owner.
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                    <?}
                        ?>  
            <? if(isset($param1))
                {?><div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Success</span>
                                    You are successfully delete the Lorry Owner.
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
                      <!--   <div class="p-3 mb-2 bg-info text-white ">
                            <button type="button" class="alert alert-primary btn btn-primary btn-sm float-right" onclick="location.href='goods_owner_registration.php';"><i class="fa fa-plus"></i>&nbsp; New</button>
                        </div> -->
                        <div class="card-body table-responsive ">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr class="bg-success text-white">
                        <th>Owner Name</th>
                        <th>ROLE</th>
                        <th>Login-ID</th>
                        <th>Transporter</th>
                        <th>Date #</th>
                        <th>View</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
            <? if($owner){ $a=1;
               
                foreach($owner as $row){?> 
           
                    <tr>
                        <td><?=$row->name?></td>
                        <td><?if($row->user_type=="D"){
                          echo "<b>DRIVER</b>";
                        }?></td>
                        <td><?=$row->login_id?></td>
                        <td><?=$row->login_id?></td>
                     
                        <td><?=(strftime("%B %d %Y",$row->user_datetime))?></td>
                                           
                        <td><button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$row->user_id?>">
                          Details
                      </button>
                       
                <div class="modal fade" id="<?=$row->user_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="mediumModalLabel"> Driver Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <div class="row">
                                    <?if (is_array($row->load_detail) || is_object($row->load_detail)){?>
                                   <?foreach($row->load_detail as $load_detail) {?>
                                                                                           
                                    <div class="col-md-4 bg-light p-2"><b>License :</b></div>
                                    <div class="col-md-8 p-2"><?=$load_detail->license_file_name?>
                                           
                                <a href="../uploads/registrartion_document/<?=$load_detail->license_file_name?>" download="<?=$load_detail->license_file_name?>">   
                                              
                                    <button class="btn btn-warning"  data-target="uploads/registrartion_document/<?=$load_detail->license_file_name?>" style="margin-right: 10px"><i class="fa fa-download"></i></button>
                                </a>    
                                    </div>                            
                                  <div class="col-md-4 bg-light p-2"><b>Reference Name:</b></div>
                                  <div class="col-md-8 p-2"><?=$load_detail->reference_name1?></div>                            
                                  <div class="col-md-4 bg-light p-2"><b>Reference Contact No:</b></div>
                                  <div class="col-md-8 p-2"><?=$load_detail->reference_no1?></div>

                                  <div class="col-md-4 bg-light p-2"><b>Another Reference Name:</b></div>
                                  <div class="col-md-8 p-2"><?=$load_detail->reference_name2?></div>        

                                  <div class="col-md-4 bg-light p-2"><b>Another Reference Contact No:</b></div>
                                  <div class="col-md-8 p-2"><?=$load_detail->reference_no2?></div>
                                                                      
                                  <div class="col-md-12 bg-light p-2" style="text-align: center;"><u><b>Transporter Details :</b></u></div>
                              
                                  <?  $detail = User::fetch_LO_detail($load_detail->owner_id); 
                                  foreach($detail as $lo_detail) {?> 

                                  <div class="col-md-4 bg-light p-2"><b>Transporter Name :</b></div>
                                  <div class="col-md-8 p-2"><?=$lo_detail->name?></div>        

                                  <div class="col-md-4 bg-light p-2"><b>Login-ID</b></div>
                                  <div class="col-md-8 p-2"><?=$lo_detail->login_id?></div>
                                  <div class="col-md-4 bg-light p-2"><b>Status</b></div>
                                  <div class="col-md-8 p-2"><?=$lo_detail->user_status?></div>
                                  <div class="col-md-4 bg-light p-2"><b>Create Date</b></div>
                                  <div class="col-md-8 p-2"><?= (strftime("%B %d %Y",$lo_detail->user_datetime))?></div>
                                
                                <?} 
                                 }
                               }?><br>  
                               
     
                                   
                                                           
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                       </td>
                        <td><?=$row->user_status?></td>
                            
                            <form class="form-horizontal" method="post" role="form" action="controller/action-ctl.php" enctype="multipart/form-data">
                           
                            <input type="hidden" name="command" value="activeDriver">
                             <input type="hidden" name="user_id" value="<?=$row->user_id?>">
                          <td>
                            <button type="submit" class="btn btn-outline-success btn-sm fa fa-check">Active</button>
                          </td>
                          </form>
                      </tr>
                    <? } }?>
                            
                     </tbody>
                   </table>
                 </div>
               </div>
             </div>
          </div>
       </div>
    </div>
  