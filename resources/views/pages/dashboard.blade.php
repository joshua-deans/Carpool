@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_EIWb_yAvbLmnjYU4qHxvzWlcGKU-jeA&libraries=places"></script>
    <style>
        #map {
            height: 100%;
        }
    </style>
@endsection

@section('content')
    @include('inc.navbar_signed_in')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>Plan your Commute!</h3>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="input-origin" placeholder="Origin">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="input-dest" placeholder="Destination">
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="userType" value="passenger" checked>Passenger</label>
                        <label class="radio-inline"><input type="radio" name="userType" value="driver">Driver</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br>
            </div>
            <div class="col-8">
                <div id="map" style="height:450px;"></div>
            </div>
        </div>
    </div>
    <script>
        // Note: This example requires that you consent to location sharing when
        // prompted by your browser. If you see the error "The Geolocation service
        // failed.", it means you probably did not give permission for the browser to
        // locate you.
        var map, infoWindow;

        function setUpGeolocation() {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // infoWindow.setPosition(pos);
                    // infoWindow.setContent('Location found.');
                    // infoWindow.open(map);
                    map.setCenter(pos);
                }, function () {
                    // handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                // handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function AutocompleteDirectionsHandler(map) {
            this.map = map;
            this.originPlaceId = null;
            this.destinationPlaceId = null;
            this.travelMode = 'DRIVING';
            var originInput = document.getElementById('input-origin');
            var destinationInput = document.getElementById('input-dest');
            this.directionsService = new google.maps.DirectionsService;
            this.directionsDisplay = new google.maps.DirectionsRenderer;
            this.directionsDisplay.setMap(map);

            var originAutocomplete = new google.maps.places.Autocomplete(
                originInput);
            var destinationAutocomplete = new google.maps.places.Autocomplete(
                destinationInput);


            this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
            this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
        }


        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 49.2827, lng: -123.0197},
                zoom: 11,
                disableDefaultUI: true
            });
            // infoWindow = new google.maps.InfoWindow;

            setUpGeolocation();
            new AutocompleteDirectionsHandler(map);
        }

        AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
            var me = this;
            autocomplete.bindTo('bounds', this.map);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.place_id) {
                    window.alert("Please select an option from the dropdown list.");
                    return;
                }
                if (mode === 'ORIG') {
                    me.originPlaceId = place.place_id;
                } else {
                    me.destinationPlaceId = place.place_id;
                }
                me.route();
            });

        };

        AutocompleteDirectionsHandler.prototype.route = function() {
            if (!this.originPlaceId || !this.destinationPlaceId) {
                return;
            }
            var me = this;

            this.directionsService.route({
                origin: {'placeId': this.originPlaceId},
                destination: {'placeId': this.destinationPlaceId},
                travelMode: this.travelMode
            }, function(response, status) {
                if (status === 'OK') {
                    me.directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        };


        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
    </script>


    <script async defer src="https://maps.googleapis.com/maps/api/js?v=weekly&key=
AIzaSyC_EIWb_yAvbLmnjYU4qHxvzWlcGKU-jeA
&callback=initMap"></script>
@endsection