<?
  // include("../classes/common.class.php");
  global $config;
  $dbconn = db::singleton();
  $query = "SELECT * FROM `tbl_catagory_document` WHERE `catagory_id`=1";
  $dbconn->SetQuery($query);
  $role_list= $dbconn->LoadObjectList();?>

        <div class="breadcrumbs bg-info">
            <div class="col-sm-4">
                <div class="page-header float-left bg-info">
                    <div class="page-title text-white">
                        <h1><b>Goods Owner Registration</b></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right bg-info">
                    <div class="page-title">
                        <ol class="breadcrumb text-right bg-info">
                            <li><a href="index.php" class="text-dark"><b>Dashboard</b></a></li>
                            <li class="active text-white"><b>Owner Registration</b>  </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

            
			<form class="form-horizontal" method="post" role="form" action="controller/action-ctl.php" enctype="multipart/form-data">
			<input type="hidden" name="command" value="addowner">
			<input type="hidden" name="user_type" value="GO">

			<div class="content mt-3">

				<div class="col-lg-12">
                    <div class="card">
                      <div class="card-body card-block">
                        <form action="" method="post" class="">
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-user"></i></div>
                              <input type="text" id="username" name="username" placeholder="GoodsOwner Name" class="form-control" required="true">
                              
                            </div>
                          </div>
                             <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                              <input type="email" id="email" name="email" placeholder="Email- ID" class="form-control" required="true">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                              <input type="email" id="loginid" name="loginid" placeholder="User- ID" class="form-control" required="true">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                              <input type="password" id="password" name="password" placeholder="Password" class="form-control" required="true">
                            </div>
                          </div>
                       
                      
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                              <input type="text" id="contact_no" name="contact_no" placeholder="Mobile No." class="form-control" required="true">
                            </div>
                          </div>

                             <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                              <select name="identity_documnt" class="form-control" id="_identity_documnt_"  style="height: 40px" required="true">    
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
                              <input type="text"  name="cnic_no" placeholder="CNIC No." class="form-control" >
                            </div>
                          </div>
                            <div class="form-group" id="nicop">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                              <input type="numbers"  name="nicop" placeholder="NICOP (1234567890)." class="form-control" >
                            </div>
                          </div>
                            <div class="form-group" id="alien_no">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                              <input type="numbers"  name="alien_no" placeholder="ALIEN Card No(12345687900)." class="form-control" >
                            </div>
                          </div>
                            <div class="form-group" id="passport_no">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                              <input type="text"  name="passport_no" placeholder="Passport No" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                             <div class="input-group-addon"><i class="fa fa-barcode"></i></div>
                              <input type="text" id="ntn_no" name="ntn_no" placeholder="NTN No." class="form-control" required="true">
                            </div>
                          </div>
                          <!-- <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-shield"></i></div>
                              <textarea name="terms_n_condition" id="terms_n_condition" rows="5" placeholder="Term & Condition" class="form-control"></textarea>
                            </div>
                          </div> -->

                              <div class="form-group">
                            <div class="input-group">
                               <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                  <select name="city"  class="form-control" required="true">
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
                              <div class="input-group-addon"><i class="fa fa-home"></i></div>
                              <textarea name="address" id="address" rows="5" placeholder="Address..." class="form-control" required="true"></textarea>
                            </div>
                          </div>

                          <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-dot-circle-o"></i> Continue</button></div>
                        </form>
                      </div>
                    </div>
                  </div>
    </div>
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


