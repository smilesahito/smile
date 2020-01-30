<?
  global $config;
  $dbconn = db::singleton();
  $query = "SELECT * FROM `tbl_catagory`";
  $dbconn->SetQuery($query);
  $role_list= $dbconn->LoadObjectList();
  // $row = $dbconn->GetNumRows();
  // print_r($row);die;
?>     


    <div class="breadcrumbs bg-info">
        <div class="col-sm-4">
          <div class="page-header float-left bg-info">
            <div class="page-title text-white">
              <h1><b>Documents Required</b></h1>
            </div>
         </div>
      </div>
      
      <div class="col-sm-8">
        <div class="page-header float-right bg-info">
          <div class="page-title">
            <ol class="breadcrumb text-right bg-info">
              <li><a href="index.php" class="text-dark"><b>Dashboard</b></a></li>
                <li class="active text-white" ><b>Document Registrartion  </b></li>
              </ol>
           </div>
         </div>
      </div>
   </div>

            
			<form class="form-horizontal" name ="abc" method="post" role="form" action="controller/action-ctl.php" enctype="multipart/form-data">
			<input type="hidden" name="command" value="add_document_and_role">
	
    <?if(isset($param)){?>
			<div class="content mt-3">
				<div class="col-lg-12">
             <div class="card">
               <div class="card-body card-block">
               
                   <div class="form-group">
                     <div class="input-group">
                       <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="hidden" name="user_id" value="<?php if($param){echo $param;}?>">
                         <select name="catgory_user_role" data-placeholder="Selecy Role..." class="form-control" id="user_role"  style="height: 60px">         
                             <option value="" disabled selected>Select Role...</option>             
                                <?foreach($role_list as $row){?>                                
                                   <option value="<?=$row->catagory_id?>" name="catagory_id"><?=$row->catagory_name?></option>

                                <?}?> 
                            </select>
                       </div>
                  </div>
                                          
              <div class="form-group form-control ">
                <div class="input-group" >
              <h6>These Docment Requried :</h6>
                   <span id="document_id" style=" width: 100%"></span>
                </div>
              </div>        
  
        <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-dot-circle-o"></i> Submit</button></div>
         
         
        </div>
      </div>
   </div>
 </div>

<?}?> 
 </form>
<script src="/js/chosen.jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
  // Call Geo Complete
  $('#user_role').change(function(){

                var user_role= $("#user_role").val();
                console.log(user_role);

                var command = 'user_role';
                $.ajax(
                {
                    type: "post",
                    url: "../admin/controller/action-ctl.php",
                    data: { user_role:user_role,command:command},
                    success:function(response)
                    {
                        console.log(response);
                        
                        $('#document_id').html(response); 
                    }
                    
                });


        });
  

  // $("#addressto").geocomplete({details:"div#to_div"});

});

</script>