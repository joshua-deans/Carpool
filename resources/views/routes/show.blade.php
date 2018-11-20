@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/myroutes.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_signed_in')
    <div>
        <div class="left">
            <a href = "/Routes" class = "btn btn-default">Go Back</a>
            <h1> start - end </h1>

            <ul class="list-group">

                <li class="list-group-item">date time:{{$routes->carpoolDateTime}}</li>
                <li class="list-group-item">driver name:{{$driver[0]->name}}</li>
                @if (count($passenger) > 0)
                    <li class="list-group-item">passenger name:{{$passenger[0]->name}}</li>
                @else
                    <li class="list-group-item">passenger name:No passenger</li>
                @endif
                <li class="list-group-item">Capacity:{{$routes->peopleCap}}</li>
                <li class="list-group-item">Current passengers:{{$routes->peopleCur}}</li>
                <li class="list-group-item">Location: need to transfer json int to name{{$routes->coords}}</li>
            </ul>



            {{ Form::open(array('url' => 'Routes/'.$routes->rideID, 'class' => 'pull-right')) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection