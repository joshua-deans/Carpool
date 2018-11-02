@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/myroutes.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_signed_in')
    <div class="well"><h1> My Routes</h1></div>
    @if (count($routes) > 0)
        @foreach($routes as $route)
            <div class="well">
                <h3><a href="/Routes/{{$route->rideId}}">route id: {{$route->rideId}}</a></h3>
                <small>date time:{{$route->carpoolDateTime}}</small>
            </div>
        @endforeach
        {{$routes->links()}}
    @else
        <div class="well"><p> No routes found</p></div>
    @endif

@endsection