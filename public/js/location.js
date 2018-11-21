var map;
var flag = "";
document.getElementById("commute-form-driver").style.display = "none";
document.getElementById("commute-form-passenger").style.display = "none";


document.getElementById("pass").addEventListener("click", function(){
    document.getElementById("commute-form-passenger").style.display = "block";
    document.getElementById("commute-form-driver").style.display = "none";
    flag = "passenger";
    initMap();
});

document.getElementById("driv").addEventListener("click", function(){
    document.getElementById("commute-form-passenger").style.display = "none";
    document.getElementById("commute-form-driver").style.display = "block";
    flag = "driver";
    initMap();
});

function submitDriverEventListener(oriMarker, destMarker) {
    $("#commute-form-driver").submit(function (event) {
        if ($('#driv').is(':checked') && $('#input-origin').val() !== "" && $('#input-dest').val() !== ""
            && $('#datetimepicker').val() !== "") {
            var locationJson = {
                oriLng: oriMarker.position.lng(),
                oriLat: oriMarker.position.lat(),
                destLng: destMarker.position.lng(),
                destLat: destMarker.position.lat()
            };
            //alert("'"+JSON.stringify(locationJson)+"'");
            var driverCoords = JSON.stringify(locationJson);
            $(this).append('<input id="actualLocation-driver" type="hidden" name="locJSON"/>');
            document.getElementById("actualLocation-driver").value = driverCoords;
        }
        else {
            event.preventDefault();
        }
    });
}

function submitPassengerEventListener(oriMarker, destMarker) {
    $("#commute-form-passenger").submit(function (event) {
        if ($('#pass').is(':checked') && $('#input-origin').val() !== "" && $('#input-dest').val() !== ""
            && $('#datetimepicker').val() !== "") {
            var locationJson = {
                oriLng: oriMarker.position.lng(),
                oriLat: oriMarker.position.lat(),
                destLng: destMarker.position.lng(),
                destLat: destMarker.position.lat()
            };
            var passengerCoords = JSON.stringify(locationJson);
            $(this).append('<input id="actualLocation-passenger" type="hidden" name="locJSON"/>');
            document.getElementById("actualLocation-passenger").value = passengerCoords;            // Sending an AJAX request to /dashboard
            // This finds the matches in the database and returns them.
            var token = $('meta[name="csrf-token"]').attr('content');
            $.post("/dashboard",
                // this is the data being sent in the POST request
                {
                    "_method": 'POST',
                    "_token": token
                })
        }
    });
}

function initMap() {
//user location section
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49.28, lng: -123}, //default center around Vancouver
        zoom: 11,
        disableDefaultUI: true
    });

    var imageCurrent = {
        url: "../svg/dot_316742.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(20, 20) // anchor
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
    var origin_passenger = document.getElementById("input-origin-passenger"); //input box for origin
    var origin_compele = new google.maps.places.Autocomplete(origin);
    var origin_compele_passenger = new google.maps.places.Autocomplete(origin_passenger);

    var destination = document.getElementById("input-dest"); //input box for destiation
    var destination_passenger = document.getElementById("input-dest-passenger"); //input box for destiation
    var destination_compele = new google.maps.places.Autocomplete(destination);
    var destination_compele_passenger = new google.maps.places.Autocomplete(destination_passenger);


    var initialMarkerLocation = {lat: 49.28, lng: -123};
    //initialize two markers
    var oriMarker = new google.maps.Marker({
        position: initialMarkerLocation,
        label: 'S'
    });

    var originPlaced = false;
    var destMarker = new google.maps.Marker({
        position: initialMarkerLocation,
        label: 'D'
    });
    var destPlaced = false;

    //event handlers
    var useOri = origin_compele_passenger;
    var useDest = destination_compele_passenger;
    if (flag === "driver") {
        useOri = origin_compele;
        useDest = destination_compele;
    }
    google.maps.event.addListener(useOri, 'place_changed', function () {
        var origin_places = useOri.getPlace();
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

    google.maps.event.addListener(useDest, 'place_changed', function () {
        var destination_places = useDest.getPlace();
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

    if (flag === "driver"){
        submitDriverEventListener(oriMarker, destMarker);
    }else if(flag === "passenger"){
        submitPassengerEventListener(oriMarker, destMarker);
    }
}


const fpPassenger = flatpickr("#datetimepicker-passenger", {
    enableTime: true,
    altInput: true,
    altFormat: "F j, Y h:i K",
    minDate: "today",
    dateFormat: "U"
});

const fpDriver = flatpickr("#datetimepicker", {
    enableTime: true,
    altInput: true,
    altFormat: "F j, Y h:i K",
    minDate: "today",
    dateFormat: "U"
});

