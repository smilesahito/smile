  
  <?    include("r_sorting.css");   ?> 




    <div class="breadcrumbs">
    <div class="col-sm-4">
    <div class="page-header float-left">
    <div class="page-title">
         <h1>Lorry Owner List</h1>
    </div>
    </div>
    </div>
    <div class="col-sm-8">
    <div class="page-header float-right">
    <div class="page-title">
        <ol class="breadcrumb text-right">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active">Lorry Owner List</li>
        </ol>
    </div>
    </div>
    </div>
    </div>

    <? 
        $owner = User::GetUser('LO');
        if(isset($param))
	    {?>

    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
         <span class="badge badge-pill badge-success">Success</span>
        You are successfully add the Lorry Owner.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
	<?}?>	
    <? if(isset($param1))
	   {?>

    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Success</span>
        You are successfully delete the Lorry Owner.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
	<?}?>

    <div class="content mt-3">
    <div class="">
    <div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="p-3 mb-2 bg-info text-white">
        <button type="button" class="alert alert-primary btn btn-primary btn-sm float-right" onclick="location.href='owner_registration.php';"><i class="fa fa-plus"></i>&nbsp; New</button>
    </div>
    
    <div class="card-body table-responsive">
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
                <tr class="bg-success text-white">
                    <th>Owner Name</th>
                    <th>Login-ID</th>                     
                    <th>Email</th>
                    <th class="a-n b-n">View</th>
                    <th class="a-n b-n">Status</th>
                    <th class="a-n b-n">Action</th>
                </tr>
            </thead>
            <tbody>
    
                <? if($owner)
                   {
                   $a=1;
                   foreach($owner as $row)
                   { ?>
                    <tr>
                        <td><?=$row->name?></td>
                        <td><?=$row->login_id?></td>
                        <td><?=$row->user_email?></td>
                        <td>
                            <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$row->user_id?>">
                        Details
                            </button>

                        <div class="modal fade" id="<?=$row->user_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="mediumModalLabel">Lorry Owner Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body" >
                        <div class="row">
                        <? foreach($row->_detail as $row1) { ?>


                        <div class="col-md-4 bg-light p-2"><b>Address:</b></div>
                        <div class="col-md-8 p-2"><?=$row1->address?></div> 
                        <div class="col-md-4 bg-light p-2"><b>City:</b></div>
                        <div class="col-md-8 p-2"><?=$row1->city?></div>                        
                        <div class="col-md-4 bg-light p-2"><b>Mobile:</b></div>
                        <div class="col-md-8 p-2"><?=$row1->contact_no?></div> 

                        <?if(empty($row1->cnic_no)){}else{?>                           
                        <div class="col-md-4 bg-light p-2"><b>CNIC #:</b></div>
                        <div class="col-md-8 p-2"><?=$row1->cnic_no?></div>
                        <?}?>

                        <?if(empty($row1->nicop)){}else{?> 
                        <div class="col-md-4 bg-light p-2"><b>NICOP #:</b></div>
                        <div class="col-md-8 p-2"><?=$row1->nicop?></div>
                        <?}?>
                        
                        <?if(empty($row1->alien)){}else{?> 
                        <div class="col-md-4 bg-light p-2"><b>ALIEN #:</b></div>
                        <div class="col-md-8 p-2"><?=$row1->alien?></div>
                        <div class="col-md-4 bg-light p-2"><b>PASSPORT #:</b></div>
                        <div class="col-md-8 p-2"><?=$row1->passport_no?></div>
                        <?}?>

                        <div class="col-md-4 bg-light p-2"><b>NTN #:</b></div>
                        <div class="col-md-8 p-2"><?=$row1->ntn_no?></div>             
                        
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
                        <td>
                            <a href="#" class="on-default edit-row text-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-default remove-row text-danger ml-3" title="Delete"><i class="fa fa-trash-o"></i></a>
                            <?php  $num_row =  User::checkDrive_status($row->user_id);
                             if ($num_row > 0) {?>
                            
                                <span class=" text-success ml-3"> <i class="fa  fa-check"></i></span>  
                                <?php }else{ ?>
                                <a href="controller/action-ctl.php?command=makedriver&user_id=<?=$row->user_id?>" class=" text-success ml-3" title="Make Driver"><i class="fa  fa-wheelchair"></i></a>
                                <?php } ?>    
                        </td>

                    </tr>
                    <? }  } }?>
							
            </tbody>
        </table>
                               
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>



<!-- ========================================================================================= -->
<!--                       Verify GO and Check document                              -->
<!-- ===================================================================================== -->


        
    <? 
    $owner = User::verifyTransporter(); 
    if(isset($param1))
    {?>
    

    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        <span class="badge badge-pill badge-success">Success</span>
        Verification are Complete.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    
    <?}?>  
    <? if(isset($param1))
    {?>

    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Success</span>
        Verification are Complete.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    
    <?} ?>

    <div class="content mt-3">
    <div class="">
    <div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="col-sm-4">
    <div class="page-header float-left">
    <div class="page-title">
        <h1>Verify TRANSPORTERS </h1>
    
    </div>
    </div>
    </div>
    
    <div class="card-body table-responsive ">
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
             <thead>
                  <tr class="bg-warning text-white">
                    <th>Owner Name</th>
                    <th>OwnerShip</th>
                    <th>Login-ID</th>
                    <th>Email</th>
                    <th>Date #</th>
                    <th>View</th>
                    <th class="a-n b-n">Status</th>
                    <th class="a-n b-n">Action</th>
                  </tr>
            </thead>
            <tbody>
                <? if($owner)
                {
                $a=1;
                foreach($owner as $row){?> 
           
                <tr>
                    <td><?=$row->name?></td>
                    <td><?if($row->user_type=="GO"){
                      echo "<b>GOODS-OWNER</b>";
                    }else if($row->user_type=="LO"){
                      echo "<b>TRANSPORTER</b>";
                    }?></td>
                    <td><?=$row->login_id?></td>
                    <td><?=$row->user_email?></td>
                    <td><?=(strftime("%B %d %Y",$row->user_datetime))?></td>
                    <td>
                        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$row->user_id?>">
                      Details
                        </button>
                       
                    <div class="modal fade" id="<?=$row->user_id?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-primary">
                       <h5 class="modal-title text-white" id="mediumModalLabel"> Owner Detail</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                           
                    <div class="modal-body" >
                    <div class="row">
                    
                    <?if (is_array($row->load_detail) || is_object($row->load_detail)){?>
                    <?foreach($row->load_detail as $load_detail) {?>
                               
                    <div class="col-md-4 bg-light p-2"><b>Address:</b></div>
                    <div class="col-md-8 p-2"><?=$load_detail->address?></div>         
                    <div class="col-md-4 bg-light p-2"><b>City:</b></div>
                    <div class="col-md-8 p-2"><?=$load_detail->city?></div>
                    <div class="col-md-4 bg-light p-2"><b>Mobile:</b></div>
                    <div class="col-md-8 p-2"><?=$load_detail->contact_no?></div>

                    <?if(empty($load_detail->cnic_no)){}else{?>                            

                    <div class="col-md-4 bg-light p-2"><b>CNIC #:</b></div>
                    <div class="col-md-8 p-2"><?=$load_detail->cnic_no?></div>

                    <?}?>   
                    <?if(empty($load_detail->nicop)){}else{?>

                    <div class="col-md-4 bg-light p-2"><b>NICOP #:</b></div>
                    <div class="col-md-8 p-2"><?=$load_detail->nicop?></div>

                    <?}?>                                   
                    <?if(empty($load_detail->alien)){}else{?>

                    <div class="col-md-4 bg-light p-2"><b>ALIEN #:</b></div>
                    <div class="col-md-8 p-2"><?=$load_detail->alien?></div>
                    <div class="col-md-4 bg-light p-2"><b>PASSPORT #:</b></div>
                    <div class="col-md-8 p-2"><?=$load_detail->passport_no?></div>
                    
                    <?}?>                            
                    
                    <div class="col-md-4 bg-light p-2"><b>NTN #:</b></div>
                    <div class="col-md-8 p-2"><?=$load_detail->ntn_no?></div>                            
                    <?}}?>  
                                
                    <div class="col-md-4 bg-light p-2"><b>Download Document #:</b></div> 
                    <?foreach($row->detail as $document) {?>
                                                      
                    <?$owner_catagory = User::fetch_UserCatagory($document->catagory_id);
                    $owner_document = User::fetch_UserDocument($document->document_id);?>
                    <a href="../uploads/registrartion_document/<?=$document->document_name?>" download="<?=$document->document_name?>">   

                    <button class="btn btn-warning"  data-target="uploads/registrartion_document/<?=$document->document_name?>" style="margin-right: 10px"><i class="fa fa-download"></i></button>
                    </a>    
                    <?}?><br>  
                    
                    <div class="col-md-12 p-2" ></div>  
                    <div class="col-md-4 bg-light p-2"><b>Owner Catagory #:</b></div>
                                  
                    <?if (is_array($owner_catagory) || is_object($owner_catagory)){?>     
                    <?foreach($owner_catagory as $catagory) {?>
                    <div class="col-md-8 p-2"><?=$catagory->catagory_name?></div>
                    <?}} ?>   

                    <div class="col-md-4 bg-light p-2"><b>Document Name #:</b></div>

                    <?if (is_array($owner_document) || is_object($owner_document)){?>
                    <?foreach($owner_document as $docmnt_nme) {?>
                    <div class="col-md-8 p-2"><?=$docmnt_nme->document_name?><br></div>
                    <?} }?>
                                           
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

                            <input type="hidden" name="command" value="activeOwner">
                            <input type="hidden" name="user_id" value="<?=$row->user_id?>">
                        <td>
                            <button type="submit" class="btn btn-outline-success btn-sm fa fa-check">Active
                            </button>
                        </td>
                        </form>
                </tr>
                <? } }?>
                            
            </tbody>
        l</table>
                
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
<style type="text/css">
 body, body.modal-open{
    padding-right:0 !important;
  }
</style>




