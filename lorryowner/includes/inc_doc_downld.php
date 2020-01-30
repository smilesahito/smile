  
	<?php
      
     $load_id = $_GET['load_id']; 
  
     $accept_driverjob_list = Load::fetchContainerCRO($load_id);

    ?>
 <div class="card" style="background-image: linear-gradient(to left, #209bd6, #2b87b7, #307398, #31607b, #304d5f);" class="btn btn-primary col-md-12;">
        <span class="pull-right"><i onclick="window.history.back();" style="color: white;padding: 15px" class="fa  fa-arrow-left"></i></span>
    </div>

  <div class="card">
  <div class="card-body">
  <div class="table-responsive">
       <table class="table table-striped table-bordered table-hover">
           <thead>
              <tr>
                  <th>Document Name</th>
                  <th>Download File</th>
                
              </tr>
           </thead>
           <tbody>
           		 <?if(!empty($accept_driverjob_list)){?>
            	 <?php foreach ($accept_driverjob_list as $job) {?>
            
            	<tr>
                	<td>Container Cro</td>
                	<td> 
                		<?if($job->con_cro !=null){ 
                         
                         ?>
                		 <button class="btn btn-primary" title="Download File" onclick="window.location ='download_file.php?filepath=<?=$config["root_path"]?>&file=<?=$job->con_cro?>'"><i class="fa fa-download"></i> </button>  
                		<?}?>		
                	</td>
                </tr>
                <tr>	
                	<td>Gurantee Document</td>
                	<td> 
                		<?if($job->guarantee_doc !=null){  ?>

            <button class="btn btn-primary" title="Download File" onclick="window.location ='download_file.php?filepath=<?=$config["root_path"]?>&file=<?=$job->guarantee_doc?>'"><i class="fa fa-download"></i> </button>  
                		<?}?>		
                	</td>
                </tr>
                <tr>	
                	<td>Bl Document</td>
                	<td> 
                		<?if($job->bl_doc !=null){  ?>
                		 <button class="btn btn-primary" title="Download File" onclick="window.location ='download_file.php?filepath=<?=$config["root_path"]?>&file=<?=$job->bl_doc?>'"><i class="fa fa-download"></i> </button>  
                		<?}?>		
                	</td>
                </tr>
                <tr>	
                	<td>Delivery Document</td>
                	<td> 
                		<?if($job->delivery_doc !=null){  ?>
                		 <button class="btn btn-primary" title="Download File" onclick="window.location = 'download_file.php?filepath=<?=$config["root_path"]?>&file=<?=$job->delivery_doc?>'"><i class="fa fa-download"></i> </button>  
                		<?}?>		
                	</td>
                </tr>
                <tr>	
                	<td>Invoice Document</td>
                	<td> 
                		<?if($job->invoice_doc !=null){  ?>
                		 <button class="btn btn-primary" title="Download File" onclick="window.location ='download_file.php?filepath=<?=$config["root_path"]?>&file=<?=$job->invoice_doc?>'"><i class="fa fa-download"></i> </button>  
                		<?}?>		
                	</td>
                </tr>
                <tr>	
                	<td>GD Document</td>
            		<td> 
                		<?if($job->gd_doc !=null){  ?>
                		 <button class="btn btn-primary" title="Download File" onclick="window.location = 'download_file.php?filepath=<?=$config["root_path"]?>&file=<?=$job->gd_doc?>'"><i class="fa fa-download"></i> </button> 
                		<?}?>		
                	</td>
            	</tr>	


            <? } }  ?> 
            </tbody>
        </table>
    </div>
    </div>
	</div>
