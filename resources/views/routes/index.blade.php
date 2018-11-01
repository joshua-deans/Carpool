@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_landing')
    <h1> My Routes</h1>
    @if (count($routes) > 0)
        @foreach($routes as $route)
            <div class="well">
                <h3><a href="/Routes/{{$route->rideId}}">route id: {{$route->rideId}}</a></h3>
                <small>date time:{{$route->carpoolDateTime}}</small>
            </div>
        @endforeach
        {{$routes->links()}}
    @else
        <p> No routes found</p>
    @endif

@endsection