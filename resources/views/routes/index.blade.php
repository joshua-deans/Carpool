@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/myroutes.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

@endsection

@section('content')
    @include('inc.navbar_signed_in')
    <div>
        <div id="left">
            <div class="well"><h1> Driver Routes</h1></div>
            @if (count($routes) > 0)
                @foreach($routes as $route)
                    @if( $route->driverID == $user_id )
                        <div class="well">
                            <h3><a href="/Routes/{{$route->rideId}}">route id: {{$route->rideId}}</a></h3>
                            <small>date time:{{$route->carpoolDateTime}}</small>
                        </div>
                    @endif
                @endforeach
                {{$routes->links()}}
            @else
                <div class="well"><p> No routes found</p></div>
            @endif
        </div>

        <div id="right">
            <div class="well"><h1> Passenger Routes</h1></div>
            @if (count($routes) > 0)
                @foreach($routes as $route)
                    @if( $route->passID == $user_id )
                        <div class="well">
                            <h3><a href="/Routes/{{$route->rideId}}">route id: {{$route->rideId}}</a></h3>
                            <small>date time:{{$route->carpoolDateTime}}</small>
                        </div>
                    @endif
                @endforeach
                {{$routes->links()}}
            @else
                <div class="well"><p> No routes found</p></div>
            @endif
        </div>
    </div>
@endsection