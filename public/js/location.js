var map;

function submitDriverEventListener(oriMarker, destMarker) {
    $("#commute-form").submit(function (event) {
        if ($('#driv').is(':checked')) {
            var locationJson = {
                oriLng: oriMarker.position.lng(),
                oriLat: oriMarker.position.lng(),
                destLng: destMarker.position.lng(),
                destLat: destMarker.position.lat()
            };
            $(this).append('<input type="hidden" name="locJSON" value="' + JSON.stringify(locationJson) + '" />');
        }
    });
}

function submitPassengerEventListener(oriMarker, destMarker) {
    $("#submitChange").click(function (event) {
        if (($('#pass').is(':checked')) && $('#input-origin').val() !== "" && $('#input-dest').val() !== ""
            && $('#datetimepicker').val() !== "") {
            // Sending an AJAX request to /dashboard
            // This finds the matches in the database and returns them.
            var token = $('meta[name="csrf-token"]').attr('content');
            $.post("/dashboard",
                // this is the data being sent in the POST request
                {
                    "_method": 'POST',
                    "_token": token
                },
                // this function runs when the call is completed.
                function (data, status) {
                    if (status === "success") {
                        console.log(data.routes);
                        if (data.routes.length === 0) {
                            $(".modal-body").html('<div class="popwindow"><p>No routes found</p></div>');
                        }
                        else {
                            $(".modal-body").html('');
                            data.routes.forEach(function (route) {
                                $(".modal-body").append('<h3><a href="/Routes/' + route.rideId + '">Route ID: ' + route.rideId + '</a></h3>' +
                                    '<small>Date Time:' + route.carpoolDateTime + '</small>');
                            })
                        }
                        $('#route').modal();
                    }
                });
        }
    });
}

document.getElementById("pass").addEventListener("click", function(){
    document.getElementById("submitChange").type="button";
    document.getElementById("submitChange").dataset.target = "#route";
});

document.getElementById("driv").addEventListener("click", function(){
    document.getElementById("submitChange").type="submit";
    document.getElementById("submitChange").dataset.target = "";
});

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
            var $newdiv = $("<div class=\"alert alert-danger alert-dismissible\">\n" +
                "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>\n" +
                "<strong>Error!</strong> Location service is disabled by your browser for this website.\n" +
                "</div>");
            $('.alert-container').append($newdiv);
        });
    } else {
        var $newdiv = $("<div class=\"alert alert-danger alert-dismissible\">\n" +
            "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>\n" +
            "<strong>Error!</strong> Browser doesn't support Geolocation, we are unable to get your location.\n" +
            "</div>");
        $('.alert-container').append($newdiv);
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

    submitDriverEventListener(oriMarker, destMarker);
    submitPassengerEventListener(oriMarker, destMarker);
}