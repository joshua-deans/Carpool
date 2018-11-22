@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/myroutes.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

@endsection

@section('content')
    @include('inc.navbar_signed_in')
    <div>
        <div class ="left">
            <h1>Routes as Driver</h1>
            @if (count($driver_routes) > 0)
                @foreach($driver_routes as $route)
                        <div class="well">
                            <h3><a href="/Routes/{{$route->rideId}}">route id: {{$route->rideId}}</a></h3>
                            <small><?php echo date('Y-m-d  g:i A',$route->carpoolDateTime  );?></small>
                        </div>
                @endforeach
                {{$driver_routes->links()}}
            @else
                <div class="well"><h3> No routes found</h3></div>
            @endif
        </div>

        <div class ="right">
            <h1>Routes as Passenger</h1>
            @if (count($passenger_routes) > 0)
                @foreach($passenger_routes as $route)
                    <div class="well">
                        <h3><a href="/Routes/{{$route->rideId}}">route id: {{$route->rideId}}</a></h3>
                        <small><?php echo date('Y-m-d g:i A',$route->carpoolDateTime  );?></small>
                    </div>
                @endforeach
                {{$passenger_routes->links()}}
            @else
                <div class="well"><h3> No routes found</h3></div>
            @endif
        </div>
    </div>
@endsection