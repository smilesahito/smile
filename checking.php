<?
  include("classes/common.class.php");
  global $config;
  $dbconn = db::singleton();
  $query = "SELECT * FROM `tbl_catagory_document` WHERE `catagory_id`=1";
  $dbconn->SetQuery($query);
  $role_list= $dbconn->LoadObjectList();?>
<!--   // $row = $dbconn->GetNumRows();
  // print_r($role_list);die; -->
  <?global $config;
  $dbconn = db::singleton();
  $query1 = "SELECT * FROM `tbl_catagory`";
  $dbconn->SetQuery($query1);
  $role_list1= $dbconn->LoadObjectList();
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
 background-image: url("images/sign_up.jpg");
 background-size: cover;
 background-repeat: no-repeat;
  /*background-size: 75% 50%;*/
}

.card { background-color: rgba(0, 0, 0, 0.0); }
.card-header, .card-footer { opacity: 0}
a{
  cursor: pointer
}


</style>
<body>


     


  <!--  <div class="sufee-login d-flex align-content-center flex-wrap float-right" style="margin-right:100px">
        <div class="container" style="margin-top: 5%">
            <div class="login-content"> -->
                <!-- <div class="login-logo"> -->
                    <!-- <a href="signup.php"> -->
                        <!-- <h2 class="text-dark"><em>Registration</em> </h2> -->
                    <!-- </a> -->
               <!-- / </div>   -->
              
               
            <!-- <div>                       
             <div class="content mt-3 ">
                <div class="col-lg-46 "> -->
                    <!-- <div class="card "> -->
                      <!-- <div class="card-body card-block "> -->
                   
                      <!-- <?for($a=1;$a<=10;$a++){?> -->
                      <!--   <?echo $a;?>
                       <div class="form-actions form-group float-right" data-toggle="collapse" data-target="#<?=$a?>" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-dot-circle-o"></i><b> Continue</b></div><br>
                   
                        <br>
                        <div class="form-group collapse" id="<?=$a?>" style="margin-top: 15px">
                        <div class="input-group">
                        <?echo $a;?>

                        <?if($a=="4"){?>
                        <?for($b=0;$b<=10;$b++){?>
                        <div class="input-group-addon"><i class="fa fa-user" style="margin-top: 15px"></i></div>
                        <div class="input-group-addon"><i class="fa fa-user" style="margin-top: 15px"></i></div>
                        <div class="input-group-addon"><i class="fa fa-user" style="margin-top: 15px"></i></div>
                        <div class="input-group-addon"><i class="fa fa-user" style="margin-top: 15px"></i></div>
                        <?}}else{?> -->
                        
                      <!--   <div class="input-group-addon"><i class="fa fa-user" style="margin-top: 15px"></i></div>
                        <div class="input-group-addon"><i class="fa fa-user" style="margin-top: 15px"></i></div>
                        <div class="input-group-addon"><i class="fa fa-user" style="margin-top: 15px"></i></div>
                        <div class="input-group-addon"><i class="fa fa-user" style="margin-top: 15px"></i></div>
                         <?}?> 
                        </div>
                     </div> -->
                   <!--   <?}?>   
                   </div>

                     
                       </div>     -->                   
                     <!-- </div> -->
                   <!-- </div>                    -->
               <!-- </div> -->

<!--  -->      
              <!--   </div>           
        </div>
    </div>  -->




</body>
</html>
<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script src="/js/chosen.jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function(){
  // Call Geo Complete
 document.getElementById("cnic_no").style.display="none";
 document.getElementById("nicop").style.display="none";
 document.getElementById("alien_no").style.display="none";
 document.getElementById("passport_no").style.display="none";
  
  $('#_identity_documnt_').change(function(){
    // alert();
                let _identity_documnt_= $("#_identity_documnt_").val();
                var cnic_no= document.getElementById("cnic_no");
                var nicop= document.getElementById("nicop");
                var alien= document.getElementById("alien_no");
                var pasport= document.getElementById("passport_no");
                console.log(_identity_documnt_);

                if( _identity_documnt_ == "1" ) {
                  nicop.style.display = "none";
                  alien.style.display = "none";
                  pasport.style.display = "none";
                  cnic_no.style.display = "block";
                }else {
                  cnic_no.style.display = "none";                  
                }
                
                if( _identity_documnt_ == "2" ) {
                  cnic_no.style.display = "none";
                  alien.style.display = "none";
                  pasport.style.display = "none";
                  nicop.style.display = "block";
                }else {
                  nicop.style.display = "none";                  
                }

               if( _identity_documnt_ == "3" ) {
                  cnic_no.style.display = "none";
                  nicop.style.display = "none";
                   alien.style.display = "block";
                  pasport.style.display = "block";      
                }else {
                  alien.style.display = "none";
                  pasport.style.display = "none";                  
                }




        });

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

