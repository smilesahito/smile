<?php 
use PHPPOT\Examples;

require("dbcontroller.php");

define("API_KEY","AIzaSyDn1JrKoNqygrc0Wjei_wpPCSFIJXvvclk");
$dbController = new DBController();

$query = "SELECT * FROM tbl_country";
$countryResult = $dbController->runQuery($query);
?>
<html>
<head>
<title>Add Markers to Show Locations in Google Maps</title>
</head>
<style>
body {
	font-family :Arial;
}
#map-layer {
	margin: 20px 0px;
	max-width: 600px;
	min-height: 400;
}
</style>
<body>
<h1>Add Markers to Show Locations in Google Maps</h1>
	<div id="map-layer"></div>

	<script
		src="https://maps.googleapis.com/maps/api/js?key=<?php echo API_KEY; ?>&callback=initMap"
		async defer></script>
	
	<script type="text/javascript">
	var map;
	var geocoder;		

	function initMap() {
		var mapLayer = document.getElementById("map-layer");
		var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
		var defaultOptions = { center: centerCoordinates, zoom: 4 }

		map = new google.maps.Map(mapLayer, defaultOptions);
		geocoder = new google.maps.Geocoder();
		
		<?php 
            if(!empty($countryResult)) 
            {
                foreach($countryResult as $k=>$v)
                {   
         ?>  
         	geocoder.geocode( { 'address': '<?php echo $countryResult[$k]["country"]; ?>' }, function(LocationResult, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var latitude = LocationResult[0].geometry.location.lat();
					var longitude = LocationResult[0].geometry.location.lng();
				} 
        	    		new google.maps.Marker({
            	        position: new google.maps.LatLng(latitude, longitude),
            	        map: map,
            	        title: '<?php echo $countryResult[$k]["country"]; ?>'
            	    });
			});
	    <?php
                }
            }
	    ?>		
	}
	</script>
</body>
</html>