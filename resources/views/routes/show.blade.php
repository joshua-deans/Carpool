@extends('layouts.app')

@section('stylesheet')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js">
        var dateString = moment.unix(value).format("MM/DD/YYYY");

    </script>
    <link href="{{ asset('css/myroutes.css') }}" rel="stylesheet">


@endsection

@section('content')
    @include('inc.navbar_signed_in')
    <div class="container" style="max-width:750px;">
        <div class="center">
            <div id="coords" style="display: none;">{{$routes->coords}}</div>

            <ul class="list-group">
                <li class="list-group-item"><h4>From:</h4><p id="oriName"></p></li>
                <li class="list-group-item"><h4>To:</h4><p id="destName"></p></li>
                <li class="list-group-item"><h4>Date:</h4>
                    <p><?php echo date('Y-m-d g:i A', $routes->carpoolDateTime);?></p></li>
                <li class="list-group-item"><h4>Driver Name:</h4>
                    <p>{{$driver[0]->name}}</p>
                    <a href="{{ url('profile/'.$driver[0]->id) }}" class="whiteLink">Driver Profile</a>
                </li>
                @if (count($passenger) > 0)
                    <li class="list-group-item"><h4>Passenger Name:</h4>
                        <p>{{$passenger[0]->name}}</p></li>
                @else
                    <li class="list-group-item"><h4>Passenger Name:</h4>
                        <p>No passenger</p></li>
                @endif
            </ul>
            <a href = "/Routes" class = "btn btn-default" id="gobackbutton">Go Back</a>
            {!! Form::open(['action' => ['RoutesController@destroy', $routes->rideId], 'method' => 'post']) !!}
            {{Form::hidden('_method', 'delete')}}
            {{Form::button('<i class="fas fa-trash">Delete</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-md'])}}
            {!! Form::close() !!}
            <br>
        </div>
    </div>
    <script>
        var coordJSON = document.getElementById("coords").textContent;
        var oricoords = JSON.parse(coordJSON);
        var oriLat = oricoords.oriLat;
        var oriLng = oricoords.oriLng;
        var destLat = oricoords.destLat;
        var destLng = oricoords.destLng;
        var oriString = oriLat + ',' + oriLng;
        var destString = destLat + ',' + destLng;
        geocode(oriString,"oriName");
        geocode(destString,"destName");

        function geocode(start, divID){
            axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
                params:{
                    latlng:start,
                    key: 'AIzaSyCgBuOiCTu4lSCitAlk-YxtZ_Aw6KRIqxU'
                }
            })
                .then(function(response){
                    document.getElementById(divID).innerHTML=
                        response.data.results[0].formatted_address;
                })
                .catch(function(error){
                    console.log(error);
            })
        }

    </script>

@endsection
