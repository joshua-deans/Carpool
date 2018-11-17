@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/vehicle.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_signed_in')

    @if($vehicle)
        <h3>You have a vehicle</h3>
        <h3>Display the vehicle information</h3>
        <a href="vehicle/edit">Edit your vehicle</a>
    @else
        <h3>Create your vehicle</h3>
        <div class="profileNameInfo col-md-6">
            {!! Form::open(['action' => 'VehicleController@add', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{Form::file('picture')}}
            </div>
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', '', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('make', 'Make')}}
                {{Form::text('make', '', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('model', 'model')}}
                {{Form::textarea('model', '', ['class' => 'form-control'])}}
            </div>
            {{Form::hidden('_method', 'POST')}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>

    @endif

@endsection