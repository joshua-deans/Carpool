@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/vehicle.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_signed_in')
    @include('inc.messages')
    <div class="container vehicleHeader">
            <h3>Edit your vehicle</h3>
        <div class="profileNameInfo col-md-12">
            <h2 class="text-center">Driver Information</h2>
            {!! Form::open(['action' => 'VehicleController@edit', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{Form::label('licenseStatus', 'License Status')}}
                {{Form::text('licenseStatus', $vehicle->licenseStatus, ['class' => 'form-control'])}}
            </div>
            <h2 class="text-center">Create your vehicle</h2>
            <div class="form-group">
                {{Form::label('picture', 'Upload Image')}}
                {{Form::file('picture')}}
            </div>
            <div class="form-group">
                {{Form::label('vehicleName', 'Vehicle Name')}}
                {{Form::text('vehicleName', $vehicle->vehicleName, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('make', 'Make')}}
                {{Form::text('make', $vehicle->make, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('model', 'Model')}}
                {{Form::text('model', $vehicle->model, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('year', 'Year')}}
                {{Form::number('year', $vehicle->year, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('color', 'Color')}}
                {{Form::text('color', $vehicle->color, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('seats', 'Seats')}}
                {{Form::number('seats', $vehicle->seats, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $vehicle->description, ['class' => 'form-control'])}}
            </div>
            {{Form::hidden('_method', 'POST')}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection