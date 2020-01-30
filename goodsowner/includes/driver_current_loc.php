
<?php  
   include("../../classes/common.class.php"); 
   extract($_REQUEST);
   
    // if(!Admin::IsUserLoggedIn()) {
    //     header("Location: ../index.php");
    //     exit;
    // }
   extract($_REQUEST);
   ?>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc0w-AvPE6AWsOdtsvNcRqaRe9R4XfLyE">
</script><!--For Map -->


<div id="map" style="width: 100%; height: 350px;">  </div>

<script type="text/javascript">

   var map = new google.maps.Map(document.getElementById('map'), {
     
      zoom: 12,
      center: new google.maps.LatLng(24.926294,67.022095),
      mapTypeId: google.maps.MapTypeId.ROADMAP

    });

   var marker = new google.maps.Marker({
    map: map,
  });

  marker.setPosition(map.getCenter());
 

     var locations_array = [];
     var driver_array = [];
     var driver_update_loc;
     var infowindow = new google.maps.InfoWindow();
    function myTimer() 
    {

      let command = 'driver_Current_Loc';
      let owner_id = <? echo $_SESSION["sess_admin_id"]; ?>;

      $.ajax(
      {
        type:"post",
        url: "../goodsowner/controller/action-ctl.php",
        data:{ owner_id:owner_id,command:command},
        success:function(response)
        {
 
        
          json = JSON.parse(response);
   
          for (var i =  0; i < json.length; i++) {
              if(json[i]['destination_details'] !=null){
         
                pickup_id = json[i]['destination_details'][0]['pickup_id'];
                pickup_latitude = json[i]['destination_details'][0]['pickup_latitude'];
                pickup_longitude = json[i]['destination_details'][0]['pickup_longitude'];
                driver_id = json[i]['destination_details'][0]['driver_id'];
                job_type = json[i]['destination_details'][0]['job_type'];
                driver_name = json[i]['destination_details'][0]['driver_name'];
                locations_array.push([pickup_id,pickup_latitude,pickup_longitude,driver_id,job_type,driver_name]);
              }  
            }
           get_destination(locations_array);
         }  
      });
    }

    setInterval(myTimer, 8000);
    function get_destination(locations){
   

    for (var i = 0; i < locations.length; i++) 
    {  
        
      if(driver_array.includes(locations[i][3]) ){

         google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {

            infowindow.setContent(locations[i][5]);
            infowindow.open(map, marker);

            }
            })(marker, i));
           
            var driver_update_loc = new google.maps.LatLng(locations[i][1],locations[i][2]);
            console.log("contian : "+ "driver_id"+driver_array);
            animatedMove(marker, .35,  driver_update_loc);

        }else{
        
            console.log("Not-Contain "+"--"+locations[i][3]);
           
            if (marker != null) {
            marker.setMap(null);
            }
            driver_array.push(locations[i][3]);  
            marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon:'../images/ic_car.png'

            }); 
          }
    }

    function animatedMove(marker, t, moveto) {
    // var lat = current.lat();
    // var lng = current.lng();

    // var deltalat = (moveto.lat() - current.lat()) / 100;
    // var deltalng = (moveto.lng() - current.lng()) / 100;

    var delay = 35 * t;
    for (var i = 0; i < 100; i++) {
    (function(ind) {
    setTimeout(function() {
    var lat = marker.position.lat();
    var lng = marker.position.lng();
    // lat += deltalat;
    // lng += deltalng;
    latlng = new google.maps.LatLng(moveto.lat(), moveto.lng());
    marker.setPosition(latlng);
    }, delay * ind
    );
    })(i)
    }
  }

}
 
  </script>
