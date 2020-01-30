<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
 <html class="no-js" lang="">
  <!--<![endif]-->
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
 background-image: url("images/413689-FAKIR.jpg");

 background-repeat: no-repeat;
background-size: 100vw 100vh;
}

.card { background-color: rgba(245, 245, 245, 0.5); }
.card-header, .card-footer { opacity: 11}
a{
  cursor: pointer
}

</style>
<body >

    <div class="sufee-login d-flex align-content-center flex-wrap">
       <div class="container" style="margin-top: 6%">
          <div class="login-content">
             <div class="login-logo">
                <a href="index.php" >
                     <h2 class="text-white">LORRY <em>N</em> LORRY</h2>
                </a>
            </div>


        <?if(empty($_GET['param'])){
          
          }else if($_GET['param']== "1"){?>
              <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
             <span class="badge badge-pill badge-success">Success</span>
                    Your Inforamtion has been record. Your Account will be create within 3days when all the submitted document are verified...If any problem please contact us email: abc@lorrynlorry.com 123456789 and  
                    Thank You 
             <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> -->
             <!-- <span aria-hidden="true">×</span> -->
             </button>
             </div>
             <?}?>
         <div  class="card"> 
            <form class="form-horizontal m-t-20 card-body card-block " action="controller/login_ctl.php?action=1" method="post">
            
              <div class="form-group">
                <input type="email" name="uname" class="form-control" placeholder="Email" required="true">
            </div>
            
            <div class="form-group">
                <input type="password" name="pwd" class="form-control" placeholder="Password" required="true">
            </div>

            <div >
            <div  align="center" >
               <button  name="signin" type="submit" class="btn btn-success col-sm-12 ">Sign in <i class="fa fa-sign-in" aria-hidden="true"></i></button>
             </div>           
            
            <div  align="center" style="margin-top: 10px;" class="text-black" >
            <b> Do you want to Create  Account?<u> <a href="signup.php" style="color:#1A5276; font-size: 18px">Sign Up</a></u></b> 
            </div>
            </div>
            </form>
                     
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
