var map
function initMap(){
//user location section
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49.28, lng: -123}, //default center around vancouver
        zoom: 11
    });
    var imageCurrent = {
        url: "../svg/dot_316742.png", // url
        scaledSize: new google.maps.Size(30,30), // scaled size
        origin: new google.maps.Point(0,0), // origin
        anchor: new google.maps.Point(20,20) // anchor
    };
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var marker = new google.maps.Marker({
                position: pos,
                icon: imageCurrent
            });
            marker.setMap(map)
            map.setCenter(pos)
            /*marker.addListener('mouseover', function () { //hover the pin animation
                marker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function () {
                    marker.setAnimation(null);
                }, 1000)
            });*/
        }, function () {
            handleLocationError(true, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, map.getCenter());
    }


    //autocomplete section
    var origin = document.getElementById("input-origin") //input box for origin
    var origin_compele = new google.maps.places.Autocomplete(origin);
    var destination = document.getElementById("input-dest") //input box for destiation
    var destination_compele = new google.maps.places.Autocomplete(destination);

    var initialMarkerLocation = {lat: 49.28, lng: -123};
    //initialize two markers
    var oriMarker = new google.maps.Marker({
        position: initialMarkerLocation,
        label:'S'
    });
    var destMarker = new google.maps.Marker({
        position: initialMarkerLocation,
        label:'D'
    });

    //event handlers
    google.maps.event.addListener(origin_compele, 'place_changed', function(){
        var origin_places = origin_compele.getPlace();
        var oriPos = {
            lat: origin_places.geometry.location.lat(),
            lng: origin_places.geometry.location.lng()
        };
        oriMarker.setPosition(oriPos);
        oriMarker.setVisible(true);
        oriMarker.setMap(map);
        map.setCenter(new google.maps.LatLng(oriPos.lat, oriPos.lng));
        map.setZoom(9);
    });

    google.maps.event.addListener(destination_compele, 'place_changed', function(){
        var destination_places = destination_compele.getPlace();
        var destiPos = {
            lat: destination_places.geometry.location.lat(),
            lng: destination_places.geometry.location.lng()
        };
        destMarker.setPosition(destiPos);
        destMarker.setVisible(true);
        destMarker.setMap(map);
        map.setCenter(new google.maps.LatLng(destiPos.lat, destiPos.lng));
        map.setZoom(9);
    });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos){
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}

