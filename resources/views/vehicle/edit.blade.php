@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/vehicle.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_signed_in')
    <div class="container vehicleHeader">
        <div class="row">
            <h3>Edit your vehicle</h3>
            <div class="profileNameInfo col-md-6">
                {!! Form::open(['action' => 'VehicleController@edit', 'method' => 'POST', 'files' => true]) !!}
                <div class="form-group">
                    {{Form::file('picture')}}
                </div>
                <div class="form-group">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', $vehicle->name, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('make', 'Make')}}
                    {{Form::text('make', $vehicle->make, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('model', 'model')}}
                    {{Form::text('model', $vehicle->model, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('year', 'year')}}
                    {{Form::number('year', $vehicle->year, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('color', 'color')}}
                    {{Form::text('color', $vehicle->color, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('seats', 'seats')}}
                    {{Form::number('seats', $vehicle->seats, ['class' => 'form-control'])}}
                </div>
                {{Form::hidden('_method', 'POST')}}
                {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>

@endsection