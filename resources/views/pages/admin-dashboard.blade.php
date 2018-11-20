@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection

@include('inc.navbar_admin')

@section('content')



    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Members</h3>
                <h4>Number of registered users: </h4>
                <h4>{{$systemData['members']}}</h4>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Drivers</h3>
                <h4>Number of designated drivers: </h4>
                <h4>{{$systemData['drivers']}}</h4>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Carpools</h3>
                <h4>Number of active carpools: </h4>
                <h4>{{$systemData['carpools']}}</h4>
            </div>
        </div>
    </div>



@endsection
