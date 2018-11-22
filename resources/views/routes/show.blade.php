@extends('layouts.app')

@section('stylesheet')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js">
        var dateString = moment.unix(value).format("MM/DD/YYYY");

    </script>
    <link href="{{ asset('css/myroutes.css') }}" rel="stylesheet">


@endsection

@section('content')
    @include('inc.navbar_signed_in')
    <div>
        <div class="left">
            <a href = "/Routes" class = "btn btn-default">Go Back</a>
            <div id="coords" style="display: none;">{{$routes->coords}}</div>
            <h1> start: </h1>
            <p id="oriName"></p>
            <h1> end: </h1>
            <p id="destName"></p>


            <ul class="list-group">

                <li class="list-group-item" id="datetime">datetime: <?php echo gmdate("l jS F Y h:i:s A", $routes->datetime);?></li>
                <li class="list-group-item">driver name:{{$driver[0]->name}}</li>
                @if (count($passenger) > 0)
                    <li class="list-group-item">passenger name:{{$passenger[0]->name}}</li>
                @else
                    <li class="list-group-item">passenger name:No passenger</li>
                @endif

                <li class="list-group-item">Location: need to transfer json int to name {{$routes->coords}}</li>
            </ul>

            {!! Form::open(['action' => ['RoutesController@destroy', $routes->rideId], 'method' => 'post']) !!}
            {{Form::hidden('_method', 'delete')}}
            {{Form::button('<i class="fas fa-trash">Delete</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-md'])}}
            {!! Form::close() !!}
        </div>
    </div>
    <script>
        var coordJSON = document.getElementById("coords").textContent;
        var Oricoords = JSON.parse(coordJSON);
        var oriLat = coordJSON.oriLat;
        var oriLng = coordJSON.oriLng;
        var destLat = coordJSON.destLat;
        var destLng = coordJSON.destLng;
        var oriString = oriLat + ',' + oriLng;
        var destString = destLat + ',' + destLng;

        function geocodeLatLng(geocoder) {
            var input = document.getElementById('latlng').value;
            var latlngStr = input.split(',', 2);
            var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setZoom(11);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }
        //var origin = document.getElementById("oriName");
        //use reverse geolocation to find the names of the coords once coords are extracted from the data base;
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?v=weekly&key=
AIzaSyC_EIWb_yAvbLmnjYU4qHxvzWlcGKU-jeA&libraries=places&callback=geocodeLatLng"></script>
@endsection
