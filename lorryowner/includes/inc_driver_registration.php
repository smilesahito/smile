    
    <div class="breadcrumbs">
    <div class="col-sm-4">
    <div class="page-header float-left">
    <div class="page-title">
        <h1>Driver Registration</h1>
    </div>
    </div>
    </div>
    
    <div class="col-sm-8">
    <div class="page-header float-right">
    <div class="page-title">
        <ol class="breadcrumb text-right">
          <li><a href="index.php">Dashboard</a></li>
          <li class="active">Driver Registration</li>
        </ol>
    </div>
    </div>
    </div>
    </div>


    <?if(empty($_GET['param'])){

    }else if($_GET['param']== "1"){?>
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        <span class="badge badge-pill badge-success">Success</span>
          Your Driver Inforamtion has been record. Your Driver will be active within 3days when all the submitted document are verified...  
          Thank You 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?}?>
            
    <form class="form-horizontal" method="post" role="form" action="controller/action-ctl.php" enctype="multipart/form-data">
        <input type="hidden" name="command" value="adddriver">
    <div class="content mt-3">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body card-block">
        <form action="" method="post" class="">
    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="username" name="username" placeholder="Driver Name" class="form-control">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
        <input type="text" id="loginid" name="loginid" placeholder="Login ID" class="form-control">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
      <input type="password" id="password" name="password" placeholder="Password" class="form-control">
    </div>
    </div>
   
    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-home"></i></div>
       <textarea name="address" id="address" rows="5" placeholder="Address..." class="form-control"></textarea>
    </div>
    </div>
    
    <div class="form-group">
    <div class="input-group">
         <select name="city" class="form-control">
      
            <option value="" selected disabled hidden>Choose a City...</option>
            <option value="Karachi">Karachi</option>
            <option value="Lahore">Lahore</option>
            <option value="Islamabad">Islamabad</option>
            <option value="Hydrabad">Hydrabad</option>
        </select>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
        <input type="text" id="contact_no" name="contact_no" placeholder="Mobile No." class="form-control">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
        <input type="text" id="cnic_no" name="cnic_no" placeholder="CNIC No." class="form-control">
    </div>
    </div>

    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-upload"> </i> Driver License</span>
    </div>
    <div class="custom-file">
    <input type="file" class="custom-file-input" id="license" name="license">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
    </div>
    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="reference_name1" name="reference_name1" placeholder="First Reference Name" class="form-control">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
        <input type="text" id="reference_no1" name="reference_no1" placeholder="Mobile No." class="form-control">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="reference_name2" name="reference_name2" placeholder="Second Reference Name" class="form-control">
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
        <input type="text" id="reference_no2" name="reference_no2" placeholder="Mobile No." class="form-control">
    </div>
    </div>

    <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-dot-circle-o"></i> Submit</button></div>
    </form>
    </div>
    </div>
    </div>
    </div>