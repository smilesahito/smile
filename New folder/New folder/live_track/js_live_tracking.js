	
	var map = new google.maps.Map(document.getElementById('map'), 
	{
		zoom: 12,
		center: new google.maps.LatLng(24.926294,67.022095),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	
	// var infowindow = new google.maps.InfoWindow();
	
	var marker = new google.maps.Marker(
	{
		map: map,
	});
	
	// marker.setPosition(map.getCenter());
	
	function get_location() 
    {
		$.ajax(
		{
			type:"post",
			url: "../goodsowner/controller/action-ctl.php",
			data:{ owner_id:owner_id,command:'driverCordinate'},
			success:function(location)
			{
				console.log('Snd');
				curr_loc = JSON.parse(location);
				
				for(i=0; i<curr_loc.length; i++)
				{
					
					// Create Driver Icon For First Time Only
					//---------------------------------------
					if(icon[i] === undefined)
					{
						marker[i] = new google.maps.Marker(
						{
							position: new google.maps.LatLng(curr_loc[i].lat, curr_loc[i].lng),
							map: map,
							icon:'../images/green.png',
							title: 'Golden Gate Bridge'
						});
						
						icon[i] = curr_loc[i].driver_id;
					}
					//---------------------------------------
					
					if(curr_lat[i] === undefined)
					{
						curr_lat[i] = curr_loc[i].lat;
					}	
					if(curr_lng[i] === undefined)
					{
						curr_lng[i] = curr_loc[i].lng;
					}	
					
					moveto_lat[i] = curr_loc[i].lat;
					moveto_lng[i] = curr_loc[i].lng;
					
					deltalat = (moveto_lat[i] - curr_lat[i]) / 100;
					deltalng = (moveto_lng[i] - curr_lng[i]) / 100;
					
					if(deltalat > 0 || deltalng > 0)
					{
						for (var j = 0; j < 100; j++)
						{
							 (function (j,i)
							 {
								setTimeout(function (deltalat,deltalng)
								{
									if(deltalat > 0)
									{
										curr_lat[i] = Number(curr_lat[i]) + Number(deltalat);
									}
									if(deltalng > 0)
									{
										curr_lng[i] = Number(curr_lng[i]) + Number(deltalng);
									}
									
									marker[i].setPosition(new google.maps.LatLng(curr_lat[i],curr_lng[i]));
									console.log(curr_lat[i],curr_lng[i]);
									
								}, 200*j,deltalat,deltalng);
							  })(j,i);
							
						}
					}
					
					deltalat = 0;
					deltalng = 0;
				}
			}
		}); 	
    }
	
	var curr_lat = [];
	var curr_lng = [];
	
	var moveto_lat = [];
	var moveto_lng = [];
	
	var icon = [];
	
	//get_location();
	setInterval(get_location, 1000);