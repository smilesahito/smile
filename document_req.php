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
 background-image: url("images/signup2.jpg");
 background-size: cover;
 background-repeat: no-repeat;
  /*background-size: 75% 50%;*/
}


</style>
<body>

    <div class="sufee-login  flex-wrap float-right" >
        <div class="container" style="margin-top: 6%">
            <div class="login-content">
                <div class="login-logo">
                    <a href="document_req.php">
                        <h2 > <em>Upload Document</em> </h2>
                    </a>
                </div>
            <div  > 
             <div class="content mt-3 ">
                <div class="col-lg-12 ">
                    <div class="card ">
                      <div class="card-body card-block ">
                                    
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
                      </div>
                    </div>
                  </div>
           </div>
<!--  -->
      
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


</body>
</html>
