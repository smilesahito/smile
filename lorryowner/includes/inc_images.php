<?php
      
     $load_id = $_GET['load_id']; 
     $driver_ = LorryOwner::getdriverdata($load_id); 
    


     if ($driver_) 
     {    
         $a = 0;
         foreach ($driver_ as $row) 
         {      
           $images = LorryOwner::GetImage_LO($load_id,$row->driver_id); 
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

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
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

/* Add Animation */
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

/* The Close Button */
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

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

<!--     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
       
   <div class="card" style="background-image: linear-gradient(to left, #209bd6, #2b87b7, #307398, #31607b, #304d5f);" class="btn btn-primary col-md-12;">
        <span class="pull-right"><i onclick="window.history.back();" style="color: white;padding: 15px" class="fa  fa-arrow-left" style="color: white; ">  </i></span>

    </div>



    <div class="content mt-4">
    <div class="row">
    <div class="col-md-12">
    <div class="card" style="border-radius: 10px;">
    <!-- <div class="card-body" > -->
        <form action="./controller/action-ctl.php" method="POST">     
              <input type="hidden" name="command" value="imageDes">
       
        <div class="card" style="background-image: linear-gradient(to left, #209bd6, #2b87b7, #307398, #31607b, #304d5f);" class="btn btn-primary col-md-12;" style="color: white">
         <span class="pull-left" style="margin-left: 30px; color: white; padding: 5px" ><h4><b>Images</b> 
         </h4>
         </span>
        </div>
        <hr>
 

    <!-- </div> -->

    <div class="row">
    
    <?php  
    $count=0;
    foreach ($img_array as $val)
    {

    $c=0;
  
    foreach ($val->img as $row)
    {

      $img = $row->file_name.'.jpg';                             
      $file_path =$config["root_path"].$img;    
      $src =  Load::getImageData($file_path);
    ?>
                     
    <div class="col-md-4">
    <div class="col-md-3">

      <img class="img-fluid img-thumbnail " id="<?=$row->img_id?>" src="<?=$src?>"  style=" cursor: zoom-in">
       
       <div id="myModal1" class="modal"><!-- The Modal -->
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
 
   }
  }
   ?>  