var map;

function submitEventListener(originPlaced, destPlaced, oriMarker, destMarker) {
    $("#commute-form").submit(function (event) {
        var locationJson = {
            oriLng: oriMarker.position.lng(),
            oriLat: oriMarker.position.lng(),
            destLng: destMarker.position.lng(),
            destLat: destMarker.position.lat()
        };
        $(this).append('<input type="hidden" name="locJSON" value="' + JSON.stringify(locationJson) + '" />');
    });
}

function initMap(){
//user location section
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49.28, lng: -123}, //default center around Vancouver
        zoom: 11,
        disableDefaultUI: true
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
            marker.setMap(map);
            map.setCenter(pos);
        },function(){
            alert("Location service is disabled by your browser for this website");
        });
    } else {
        // Browser doesn't support Geolocation
        alert("Browser doesn't support Geolocation, we are unable to get your location");
    }


    //autocomplete section
    var origin = document.getElementById("input-origin"); //input box for origin
    var origin_compele = new google.maps.places.Autocomplete(origin);
    var destination = document.getElementById("input-dest"); //input box for destiation
    var destination_compele = new google.maps.places.Autocomplete(destination);

    var initialMarkerLocation = {lat: 49.28, lng: -123};
    //initialize two markers
    var oriMarker = new google.maps.Marker({
        position: initialMarkerLocation,
        label:'S'
    });
    var originPlaced = false;
    var destMarker = new google.maps.Marker({
        position: initialMarkerLocation,
        label:'D'
    });
    var destPlaced = false;

    //event handlers
    google.maps.event.addListener(origin_compele, 'place_changed', function(){
        var origin_places = origin_compele.getPlace();
        var oriPos = {
            lat: origin_places.geometry.location.lat(),
            lng: origin_places.geometry.location.lng()
        };
        markerBounds = new google.maps.LatLngBounds();
        if (destPlaced) {
            markerBounds.extend(destMarker.getPosition());
        }
        oriMarker.setPosition(oriPos);
        oriMarker.setVisible(true);
        oriMarker.setMap(map);
        map.fitBounds(markerBounds.extend(oriMarker.getPosition()));
        if (!destPlaced) {
            map.setZoom(14);
        }
        originPlaced = true;
    });

    google.maps.event.addListener(destination_compele, 'place_changed', function(){
        var destination_places = destination_compele.getPlace();
        var destiPos = {
            lat: destination_places.geometry.location.lat(),
            lng: destination_places.geometry.location.lng()
        };
        markerBounds = new google.maps.LatLngBounds();
        if (originPlaced) {
            markerBounds.extend(oriMarker.getPosition());
        }
        destMarker.setPosition(destiPos);
        destMarker.setVisible(true);
        destMarker.setMap(map);
        map.fitBounds(markerBounds.extend(destMarker.getPosition()));
        if (!originPlaced) {
            map.setZoom(14);
        }
        destPlaced = true;
    });

    submitEventListener(originPlaced, destPlaced, oriMarker, destMarker);
}


