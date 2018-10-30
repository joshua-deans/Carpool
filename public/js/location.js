alert("please enable browser location");
var map
function initMap() {
    var origin = document.getElementById("input-origin")
    var origin_compele = new google.maps.places.Autocomplete(origin);
    var destination = document.getElementById("input-dest")
    var destination_compele = new google.maps.places.Autocomplete(destination);

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49, lng: -123}, //default center around vancouver
        zoom: 12
    });
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var marker = new google.maps.Marker({
                position: pos
            });
            marker.setMap(map)
            map.setCenter(pos)
            marker.addListener('mouseover', function(){ //hover the pin animation
                marker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function(){ marker.setAnimation(null); }, 1000)
            });
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}
