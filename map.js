function loadMap() {
	var pune = {lat: 18.5204, lng: 73.8567};
	var map = new google.maps.Map(document.getElementById('map'),{
		zoom: 10,
		center: pune
	});

	var marker = new google.maps.Marker({
		position: pune,
		map: map
	});
}