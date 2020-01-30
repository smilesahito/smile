 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc0w-AvPE6AWsOdtsvNcRqaRe9R4XfLyE">
  </script>

  <div id="map" style="width: 100%; height: 650px;">
    
    <script type="text/javascript">
      
      
    </script>
  </div>

  <script type="text/javascript">

    var a=0;
    function myTimer() {
    // console.log(' each 1 second...');
  
    <?
    $owner_id = $_SESSION["sess_admin_id"];
    $drivers_data = Load::fetch_Drivers_Cordinate_GO($owner_id); 
    ?> 

     get_destination();

  }

    var myVar = setInterval(myTimer, 5000);

    function get_destination(){

    var locations= [];
    
    <? foreach ($drivers_data as $value ) {
        if(isset($value->destination_details))
        
        {
        foreach ($value->destination_details as $data) {   ?>
        
        locations.push(['Job Type : <?=$data->job_type?> -- Goods-Types ( <?=$data->load_to?> ) ',<?=$data->pickup_latitude?>,<?=$data->pickup_longitude?>]);


       <? }
       }

    } ?>

  
    if(a==0 ){

    var map = new google.maps.Map(document.getElementById('map'), {
     
      zoom: 12,
      center: new google.maps.LatLng(24.926294,67.022095),
      mapTypeId: google.maps.MapTypeId.ROADMAP

    });
    a++;
  }
    var infowindow = new google.maps.InfoWindow();
    var marker, i;

    for (i = 0; i < locations.length; i++) {  
        
     
              console.log(locations[i][0],locations[i][1],locations[i][2]);
               
               marker = new google.maps.Marker({
               position: new google.maps.LatLng(locations[i][1], locations[i][2]),
               map: map,
               icon:'../images/ic_car.png'
        
                }); 
        
     
     
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
      
        
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
      
        }
      })(marker, i));

        // var result = [locations[i][1], locations[i][2]];
        // transition(result);
    }



   

    var numDeltas = 100;
    var delay = 10; //milliseconds
    var i = 0;
    var deltaLat;
    var deltaLng;

    function transition(result){
        i = 0;
        deltaLat = (result[0] - position[0])/numDeltas;
        deltaLng = (result[1] - position[1])/numDeltas;
        moveMarker();
    }

    function moveMarker(){
        position[0] += deltaLat;
        position[1] += deltaLng;
        var latlng = new google.maps.LatLng(position[0], position[1]);
        marker.setPosition(latlng);
        if(i!=numDeltas){
            i++;
            setTimeout(moveMarker, delay);

        }
      }
    }

  
  </script>
