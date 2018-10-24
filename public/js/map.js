<<<<<<< HEAD
function initialize() {
	var myOptions = {
		zoom: 16,
		center: new google.maps.LatLng(51.489500, -0.096777), //change the coordinates
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false,
		mapTypeControl: false,
		zoomControl: false,
		streetViewControl: false,
		}
	var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
	var marker = new google.maps.Marker({
		map: map,
		position: new google.maps.LatLng(51.489500, -0.096777) //change the coordinates
	});
	google.maps.event.addListener(marker, "click", function() {
		infowindow.open(map, marker);
	});
}
=======
function initialize() {
	var myOptions = {
		zoom: 16,
		center: new google.maps.LatLng(51.489500, -0.096777), //change the coordinates
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false,
		mapTypeControl: false,
		zoomControl: false,
		streetViewControl: false,
		}
	var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
	var marker = new google.maps.Marker({
		map: map,
		position: new google.maps.LatLng(51.489500, -0.096777) //change the coordinates
	});
	google.maps.event.addListener(marker, "click", function() {
		infowindow.open(map, marker);
	});
}
>>>>>>> dbc8b86c2ec0f53da821baa08230bbe1f645a77e
google.maps.event.addDomListener(window, 'load', initialize);