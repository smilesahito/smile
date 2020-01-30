<?
  include("classes/common.class.php");
  global $config;
  $dbconn = db::singleton();
  $query = "SELECT * FROM `tbl_catagory`";
  $dbconn->SetQuery($query);
  $role_list= $dbconn->LoadObjectList();
  // $row = $dbconn->GetNumRows();
  // print_r($role_list);die;
?>     
  

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lorry N Lorry</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link rel="stylesheet" href="assets/css/css.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<style>
 body {
 background-image: url("images/login.jpg");
 background-size: auto;
 background-repeat: no-repeat;
  /*background-size: 75% 50%;*/
}

.card { background-color: rgba(245, 245, 245, 0.4); }
.card-header, .card-footer { opacity: 1}
</style>
<body>

 <div class="sufee-login d-flex align-content-center flex-wrap float-right" style="margin-right: 100px">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="signup.php">
                        <h2 class="text-dark"><b> <em>Document Upload</em></b> </h2>
                    </a>
                </div>
            
            <div> 
         
             <div>
              <div>
                <div class="card ">
                  <div class="card-body card-block col-md-12 ">
                    <form class="form-horizontal" method="post" role="form" action="controller/signup_ctl.php" enctype="multipart/form-data">
                      <input type="hidden" name="command" value="document_upload">                       
                        <div class="form-group">
                         <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                           <input type="hidden" name="user_id" value="<?php if($param){echo $param;}?>">
                            
                            <select name="catgory_user_role" data-placeholder="Selecy Role..." class="form-control" id="user_role"  style="height: 60px"> 
                              <option value="" disabled selected>Select Ownership...</option>             
                            <?foreach($role_list as $row){?>                            
                              <option value="<?=$row->catagory_id?>"><?=$row->catagory_name?>
                                 </option>
                                <?}?> 
                            </select>
                            </div>
                          </div>
                           
                           <div class="form-group form-control ">
                            <div class="input-group" >
                              <h6>These Docment Requried To Upload :</h6>
                               <span id="document_id" style=" width: 100%"></span>
                            </div>
                          </div>   
                          
                    
                          
                       <div class="form-actions form-group "><button type="submit" class="btn btn-success btn-sm float-right"><i class="fa fa-dot-circle-o"></i> Submit</button></div>
                   
                        </form>
                      </div>
                    </div>
                  </div>
           </div>
<!--  -->
   
                </div>
            </div>
        </div>
    </div>





</body>
</html>
<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script src="/js/chosen.jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="/js/chosen.jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
  // Call Geo Complete
  $('#user_role').change(function(){

                let user_role= $("#user_role").val();
                console.log(user_role);

                let command = 'user_role';
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