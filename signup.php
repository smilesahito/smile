<?
  include("classes/common.class.php");
  global $config;
  $dbconn = db::singleton();
  $query = "SELECT * FROM `tbl_catagory_document` WHERE `catagory_id`=1";
  $dbconn->SetQuery($query);
  $role_list= $dbconn->LoadObjectList();
  global $config;
  $dbconn = db::singleton();
  $query1 = "SELECT * FROM `tbl_catagory`";
  $dbconn->SetQuery($query1);
  $role_list1= $dbconn->LoadObjectList();
?>     
<style type="text/css">

#login_id:invalid {
  color: red;
}
#email:invalid {
  color: red;
}

#login_id:valid {
  color: black;
}
#email:valid {
  color: black;
}

.mrgTop10
{
	margin-top: 10px;
}
.mrgBottom5
{
	margin-bottom: 5px;
}
</style>
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
    <link rel="stylesheet" href="assets/scss/style.css">
    <link rel="stylesheet" href="assets/css/css.css">

</head>
<style>
 body {
 background-image: url("images/sign_up.jpg");
 background-size: cover;
 background-repeat: no-repeat;
  /*background-size: 75% 50%;*/
}

.card { background-color: rgba(245, 245, 245, 0.5); }
.card-header, .card-footer { opacity: 1}
a{
  cursor: pointer
}

.info{
  font-size: 16px;
  padding: 10px 15px;
}
.font-weight-bold{
  font-weight: 600 !important;
}
.bg-success {
    background-color: #004fa2!important;
    border: 3px solid #fff;
}
</style>

    <body>
    <div class="container-fluid px-md-5">
    <div class="sufee-login">
    <div class="row mt-5">    
    <div class="col-md-4">
    <div class="card mt-5">
    <div class="card-body">
        <h3 class="text-white">Contact Us</h3>
    <hr>
        <p class="text-dark lead font-weight-bold pb-3">For any query please visit our office</p> 
        <p class="text-dark lead font-weight-bold  pb-3"> <span class="bg-success info text-white rounded-circle mr-3"><i class="fa fa-building"></i></span> Johar Block 1-A, University Road.</p>
        <p class="text-dark lead font-weight-bold  pb-3"> <span class="bg-success info text-white rounded-circle mr-3" ><i class="fa fa-envelope"></i></span>lorrynlorry123@gmail.com </p> 
        <p class="text-dark lead font-weight-bold pb-3 "> <span class="bg-success info text-white rounded-circle mr-3"><i class="fa fa-phone"></i></span>Phone no :123456789</p>
    </div>
    </div>
    </div>

    <div class="col-md-6 offset-md-2">
    <div class="login-logo">
        <h2 class="text-dark"><em>Registration</em> </h2>
    </div>  
    <?if(empty($_GET['param'])){
    }else if($_GET['param']== "2"){?>
    
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
         <span class="badge badge-pill badge-danger">Login-ID Already Exists</span>
                    Login-ID is already exists please try another email
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
      </button>
   </div>
   <?}?>

    <div class="card ">
    <div class="card-body card-block ">
        <form class="form-horizontal" method="post" role="form" action="controller/signup_ctl.php" enctype="multipart/form-data" onsubmit="if(document.getElementById('agree').checked) { return true; } else { alert('Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy'); return false; }">
        <input type="hidden" name="command" value="addowner">
    <div class="form-group">
    <div class="input-group">
        <select name="role"  class="form-control " required="required" id="owner_type">
            <option value="" disabled selected>Select Role...</option>
            <option value="GO">Goods-Owner</option>
            <option value="LO">Transporter</option>
                    
        </select>
    </div>
    </div>   

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="username" name="username" placeholder="Enter  Name" class="form-control" required style="margin-right: 10px">
    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
        <input type="email" id="email" name="email" placeholder="Enter Email Address" class="form-control" required>
    </div>
    </div>
                 
    <div class="form-group" id="invlid_email">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
        <input type="email" id="login_id" name="login_id" placeholder="Enter Login-Id" class="form-control" required style="margin-right: 10px" onfocusout="myFunction()">
    <!-- </div> -->
    <!-- </div> -->
    <!-- <div class="form-group"> -->
    <!-- <div class="input-group"> -->
    <div class="input-group-addon"><i class="fa fa-key"></i></div>
        <input type="password" id="password" name="password" placeholder="Enter User-Password" class="form-control" required>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
        <input type="number" id="contact_no" name="contact_no" placeholder="Enter Mobile No." class="form-control" required style="margin-right: 10px"  >
    <!-- </div> -->
    <!-- </div> -->


    <!-- <div class="form-group"> -->
    <!-- <div class="input-group"> -->
    <div class="input-group-addon"><i class="fa fa-barcode"></i></div>
        <input type="text" id="ntn_no" name="ntn_no" placeholder="Enter NTN No." class="form-control" required>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
        <select name="identity_documnt" class="form-control" id="_identity_documnt_"  style="height: 40px" required="required">    
          <option value="" disabled selected>Select Identity Card...</option>             
          <?foreach($role_list as $row){?>                                
          <option value="<?=$row->document_id?>"><?=$row->document_name?></option>
          <?}?> 
        </select>
    </div>
    </div>
                        
    <div class="form-group" id="cnic_no">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
        <input type="text"  name="cnic_no" placeholder="CNIC-No (12345678900)" class="form-control" >
    </div>
    </div>

    <div class="form-group"  id="nicop">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
        <input type="text" name="nicop" placeholder="NICOP (12345678900)" class="form-control">
    </div>
    </div>

    <div class="form-group" id="alien_no">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
        <input type="text"  name="alien_no" placeholder="ARC-No (12345678900)" class="form-control">
    </div>
    </div> 

    <div class="form-group" id="passport_no">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
        <input type="text"  name="passport_no" placeholder="Passport-No (123456789800)" class="form-control" >
    </div>
    </div>

    <div class="form-group">                           
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-globe"></i></div>
      <select name="city"  class="form-control" required="required">
          <option value="" disabled selected>Choose a City...</option>
          <option value="Karachi">Karachi</option>
          <option value="Lahore">Lahore</option>
          <option value="Islamabad">Islamabad</option>
          <option value="Hydrabad">Hydrabad</option>
      </select>
    </div>
    </div> 

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-home" style="margin-top: 15px"></i></div>
        <textarea name="address" id="address" rows="2" placeholder="Enter Address..." class="form-control" ></textarea>
    </div>
    </div>                                                        
                      

    <!-- <button type="submit" class="btn btn-success btn-sm float-right"  style="margin-right: 0%" ></button> -->
    <!--<div class="form-actions form-group float-right" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-dot-circle-o"></i><b> Continue</b></div>-->

    <div class="form-group collapse_" id="collapseExample__" style="margin-top: 15px">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-user" style="margin-top: 15px"></i></div>

        <select name="catgory_user_role" data-placeholder="Selecy Role..." class="form-control" id="user_role"  style="height: 60px"  required="required"> 
            <option value="" disabled selected>Select   your Catagory...</option>             
            <?foreach($role_list1 as $row1){?>                            
            <option value="<?=$row1->catagory_id?>"><?=$row1->catagory_name?>
            </option>
            <?}?> 
        </select>
    </div>

    <div class="form-group form-control mrgTop10" style="width: 100%;display:none;" id="fileDiv">
    <div class="input-group" >
        <h6 class="mrgBottom5">These Docment Requried To Upload :</h6>
        <span id="document_id" style="width: 100%" require=require></span>
    </div>
    </div> 

    <!-- <a href="">Show Terms and Conditions!</a> -->
        <input type="checkbox" name="checkbox" value="check" id="agree" require="require"  /> I have read and agree to the Terms and Conditions and Privacy Policy
  
    <div class="form-actions form-group mrgTop10"><button type="submit" class="btn btn-success btn-sm float-right"><i class="fa fa-dot-circle-o"></i> Submit</button></div>
    </div> 

    <div  align="center" style="margin-top: 10px;"  class="text-dark">
    <b>Already have an account?<u><a href="index.php" style="color:#1A5276; font-size: 18px"> Sign in</a></u></b> 
    </div>
    </form>    
    </div>
    </div>
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
<!-- for input max and min number -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  // Call Geo Complete
 document.getElementById("cnic_no").style.display="none";
 document.getElementById("nicop").style.display="none";
 document.getElementById("alien_no").style.display="none";
 document.getElementById("passport_no").style.display="none";


 
  
  $('#_identity_documnt_').change(function(){
    // alert();
                var _identity_documnt_= $("#_identity_documnt_").val();
                var cnic_no= document.getElementById("cnic_no");
                var nicop= document.getElementById("nicop");
                var alien= document.getElementById("alien_no");
                var pasport= document.getElementById("passport_no");
               // console.log(_identity_documnt_);

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

 $('#owner_type').change(function()
 {

     var owner_type_= $("#owner_type").val();
     if(owner_type_=="LO")
     {
       alert();
     }
 });



  $('#user_role').change(function()
  {

        var user_role= $("#user_role").val();
        //console.log(user_role);
		
		$('#fileDiv').show();

        var command = 'user_role';
        $.ajax(
        {
            type: "post",
            url: "../admin/controller/action-ctl.php",
            data: { user_role:user_role,command:command},
            success:function(response)
            {
               // console.log(response);
                
                $('#document_id').html(response); 
            }
            
        });


        });
  


  // $("#addressto").geocomplete({details:"div#to_div"});

});

</script>
