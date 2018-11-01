@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_landing')
    <a href = "/Routes" class = "btn btn-default">Go Back</a>
    <h1> {{$routes->rideId}}</h1>

    <ul class="list-group">
        <li class="list-group-item">route id: {{$routes->rideId}}</li>
        <li class="list-group-item">date time:{{$routes->carpoolDateTime}}</li>
        <li class="list-group-item">driverID:{{$routes->driverID}}</li>
        <li class="list-group-item">passID:{{$routes->passID}}</li>
        <li class="list-group-item">Capacity:{{$routes->peopleCap}}</li>
        <li class="list-group-item">Current passengers:{{$routes->peopleCur}}</li>
        <li class="list-group-item">Location:{{$routes->coords}}</li>
    </ul>
@endsection