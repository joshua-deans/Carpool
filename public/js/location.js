var map;

function submitEventListener(originPlaced, destPlaced, oriMarker, destMarker) {
    $("#commute-form").submit(function (event) {
        var locationJson = '{ oriLng : ' + oriMarker.position.lng() + ',oriLat: ' + oriMarker.position.lng() +
            ',destLng: ' + destMarker.position.lng() + ', destLat: ' + destMarker.position.lat() + ' }';
        $(this).append('<input type="hidden" name="locJSON" value="' + locationJson + '" />');
    });
}

function initMap(){
//user location section
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49.28, lng: -123}, //default center around Vancouver
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
            marker.setMap(map);
            map.setCenter(pos);
            /*marker.addListener('mouseover', function () { //hover the pin animation
                marker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function () {
                    marker.setAnimation(null);
                }, 1000)
            });*/
        },function(){
            alert("location service is disabled by your browser for this website");
        });
    } else {
        // Browser doesn't support Geolocation
        alert(" Browser doesn't support Geolocation, we are unable to get your location");
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
        oriMarker.setPosition(oriPos);
        oriMarker.setVisible(true);
        oriMarker.setMap(map);
        map.setCenter(new google.maps.LatLng(oriPos.lat, oriPos.lng));
        map.setZoom(9);
        originPlaced = true;
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
        destPlaced = true;
    });

    submitEventListener(originPlaced, destPlaced, oriMarker, destMarker);
}


