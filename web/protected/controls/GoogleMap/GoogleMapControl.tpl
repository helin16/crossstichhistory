<com:TPanel ID="langChangerPanel">
<script type="text/javascript" src="http://www.google.com/jsapi?key=<%= $this->key %>"></script>
<script type="text/javascript">
	google.load("maps", "2",{"other_params":"sensor=true"});

	var map = null;
    var geocoder = null;

	function initialize() 
	{
		map = new google.maps.Map2(document.getElementById("map_canvas"));
		map.addControl(new GSmallMapControl());
		map.addControl(new GMapTypeControl());
		geocoder = new GClientGeocoder();
		
		if (geocoder) 
		{
			var address = '<%= $this->address %>';
			geocoder.getLatLng(address,
								function(point) 
								{
									if (point) 
									{
										map.setCenter(point, 13);
							            var marker = new GMarker(point);
							            map.addOverlay(marker);
							            //marker.openInfoWindowHtml(address);
							      	}
							    });
		}				    
	}
  
	google.setOnLoadCallback(initialize);
</script>
<div id="map_canvas" style="width: <%=$this->width%>px; height: <%=$this->height%>px"></div>
</com:TPanel>