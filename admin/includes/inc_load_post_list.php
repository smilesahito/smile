 <?php
      $goods = Load::GetLoadList(); 
      include("r_sorting.css");?>
 


    <div class="breadcrumbs">
    <div class="col-sm-4">
    <div class="page-header float-left">
    <div class="page-title">
        <h1>Load Post List (New)</h1>
    </div>
    </div>
    </div>
    
    <div class="col-sm-8">
    <div class="page-header float-right">
    <div class="page-title">
        <ol class="breadcrumb text-right">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active">Load Post List</li>
        </ol>
    
    </div>
    </div>
    </div>
    </div>

    
    <div class="content mt-3">
    <div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-body  table-responsive">
      
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr class="bg-success text-white">
                        <th>Load ID</th>
                        <th>Goods Owner</th>
                        <th>Capacity</th>
                        <th>Load Date</th>
                        <th class="a-n b-n">View</th>
                        <th class="a-n b-n">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
						if($goods) {
						foreach($goods as $val){ ?> 
                        <tr> 
                        <td><?php echo "LP-".$val->load_id;?></td>
                        <td><?php echo $val->posted_by;?></td>
                        <td><?php echo $val->capacity;?></td>
                        <td><?php echo $val->load_date;?></td> 
                           <td>
                         <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$val->load_id?>">Details</button>

                       </td>
                        <td>
                           <a href="#" class="on-default edit-row text-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                           <a href="#" class="on-default remove-row text-danger ml-3" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                        
                         </tr>
                     <?php include("../model/load_details.php"); } }?>
                 
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
        </div>