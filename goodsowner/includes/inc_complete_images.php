<?php
      $laod_id = $_GET['load_id']; 
      $driver_ = Load::GetDriverID($_SESSION["sess_admin_id"],$laod_id); 

    if ($driver_) 
    {    
         $a = 0;
         foreach ($driver_ as $row) 
         {           
           $images = Load::GetImage($_SESSION["sess_admin_id"],$laod_id,$row->driver_id); 
           $img_array[$a] = $row;
           $img_array[$a]->img = $images;
           $a++;
        }  
    }
     include 'custome.css';   
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

body {
  font-family: Arial, Helvetica, sans-serif;
}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  padding-top: 100px; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.9);
}

.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>


    <div class="breadcrumbs bg-info p-3 mb-2">
    <div class="col-sm-4">
    <div class="page-header float-left bg-info">
    <div class="page-title text-white">
        <h1><b>Jobs Image List</b></h1>
    </div>
    </div>
    </div>
           
    <div class="col-sm-8">
    <div class="page-header float-right bg-info">
    <div class="page-title">
        <ol class="breadcrumb text-right bg-info">
            <li><a href="index.php" class="text-dark"><b>Dashboard</b></a></li>
            <li class="active text-white"><b>Image List</b></li>
        </ol>
    </div>
    </div>
    </div>
    </div>


    <div class="content mt-3">
    <div class="row">
    <div class="col-md-12">
    <div class="card" style="border-radius: 10px;">
    <div class="card-body" >
        <form action="./controller/action-ctl.php" method="POST">     
              <input type="hidden" name="command" value="imageDes">
  
    <div class="row">                        
    <div class="col-md-4">
        <label class=" form-control-label"><strong> Images</strong></label>
        <hr>
    </div>
    </div>

    <div class="row">
    
    <?php  
    foreach ($img_array as $val)
    {
    $c=0;
    $count=0;
    foreach ($val->img as $row)
    {
    if($count=="0")
    { 
    ?>
                     
    <div class="panel panel-default panel-faq  col-sm-11" id="container_div" style="margin-left: 30px">
    <div class="panel-heading ">
          <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#hide_show<?=$val->driver_id?>">

          <h4 class="panel-title">
              <strong><?=$row->name?></strong>
              <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
          </h4>
          </a>

    </div>

    <?  $img = $row->file_name.'.jpg';                             
    $file_path =$config["root_path"].'/'.$img;    
    $src =  Load::getImageData($file_path);
    ?>


    <div id="hide_show<?=$val->driver_id?>" class="panel-collapse collapse" >
    <div class="panel-body">
    <div class="row form-group">
    <div class="col-xs-12 col-sm-12">
    <div class="col-md-12 ">
    <div class="col-md-4" >
        <img class="img-fluid" id="myImg" src="<?=$src?>" style=" cursor: zoom-in; height:150px;">
       
          <!--=========== Image Open in Model by click   ================  -->

          
    <div id="myModal" class="modal"><!-- The Modal -->
        <span class="close1">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <script>
    var modal = document.getElementById("myModal");
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close1")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    }
    </script>

    </div>
    </div>

    <?$count++;?>

    <? }
     else
     { 
      $img = $row->file_name.'.jpg';                             
      $file_path = $config["root_path"].'/'.$img;    
      $src =Load::getImageData($file_path);
    ?>


    <div class="col-md-3">                 
    <div class="row">

        <img class="img-fluid img-thumbnail " id="<?=$row->img_id?>" src="<?=$src?>" style=" cursor: zoom-in; height:150px; margin-left: 23px;">
         <div id="myModal1" class="modal">
        <span class="close" style="color: #ffffff">&times;</span>
        <img class="modal-content" id="img1">
        <div id="caption1"></div>
    </div>

    <script>// Script relat to model...
    // Get the modal
    var modal = document.getElementById("myModal1");
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("<?=$row->img_id?>");
    var modalImg = document.getElementById("img1");
    var captionText = document.getElementById("caption1");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    }
    </script>

   </div>
  </div>
  <? 
  $count++;
   }
   }
   ?>  

   <div>
      <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#<?=$row->driver_id?>"><i class="fa fa-info-circle" style="padding-right: 10px;"></i> Driver Details</button>

            <div class="modal fade" id="<?=$row->driver_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                 <h5 class="modal-title" id="mediumModalLabel"><b>Driver Details</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="col-md-12">
            <div class="row">        
            <div class="col-md-12" style="margin-top: 7.5px">
            <div class="row">
                 <h5  class="col-md-6" ><b>Driver Information</b></h5><br/>
                 <div class="col-md-6"></div>
                 <div class="col-md-12"></div>
            <div class="col-md-4 bg-light p-2" align="left">Driver Name:</div>
            <div class="col-md-8 p-2"  align="left"><?=$row->name?></div>     
            <div class="col-md-4 bg-light p-2"  align="left">Driver Contact No:</div>
            <div class="col-md-8 p-2" align="left"><?=$row->contact_no?></div>      
            <div class="col-md-4 bg-light p-2"  align="left">City:</div>
            <div class="col-md-8 p-2"  align="left"><?=$row->city?></div>     
            <div class="col-md-4 bg-light p-2"  align="left">Cnic-No:</div>
            <div class="col-md-8 p-2"  align="left"><?=$row->cnic_no?></div>
            <div class="col-md-4 bg-light p-2"  align="left">Address:</div>
            <div class="col-md-8 p-2"  align="left"><?=$row->address?></div>             
      
            </div>
            </div>
              <hr>

            <div class="col-md-12">
              <hr>
            <div class="row">                       
                <h5 class="w-100" style="margin-top: 20px" ><b>Transporter Details</b></h5>
                <hr> 
            <div class="col-md-6 bg-light p-2"  align="left">Transporter Name:</div>
            <div class="col-md-6 p-2"  align="left"><?=$row->owner_name?></div>  
            <div class="col-md-6 bg-light p-2"  align="left">Transporter Email:</div>
            <div class="col-md-6 p-2"  align="left"><?=$row->owner_email?></div>
            <div class="col-md-6 bg-light p-2"  align="left">Transporter Contact No:</div>
            <div class="col-md-6 p-2"  align="left"><?=$row->owner_contact_no?></div>

            </div>
            </div>
             <hr>
   
            </div>                    
            </div>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>

            </div>
            </div>
            </div>
  </div>                                 
  </div>
  </div>
  </div>
  </div>
  </div>  

  <?php }?>

      </form>
  </div> 
  </div>
  </div>
  </div>
  </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style type="text/css">
   .modal-dialog {
    z-index: 10001;
  }