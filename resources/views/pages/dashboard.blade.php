@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
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
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputFirstName" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputLastName" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="date" name="date" placeholder="MM/DD/YYYY">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" id="inputPhone" placeholder="Phone #">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
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
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 49.2827, lng: -123.1207},
                zoom: 11
            });
            // infoWindow = new google.maps.InfoWindow;

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // infoWindow.setPosition(pos);
                    // infoWindow.setContent('Location found.');
                    // infoWindow.open(map);
                    map.setCenter(pos);
                }, function() {
                    // handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                // handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
    </script>


    <script async defer src="https://maps.googleapis.com/maps/api/js?key=
AIzaSyC_EIWb_yAvbLmnjYU4qHxvzWlcGKU-jeA
&callback=initMap"
            ></script>
@endsection