@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/vehicle.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_signed_in')
    <div class="container vehicleHeader">
        <div class="row">
    @if($vehicle)
            <div class="col-md-3">
                @if ($vehicle->picture)
                    <img src="{{asset('images/'.$vehicle->picture)}}" class="vehiclePicture">
                @else
                    <img src="{{URL::asset('imgs/emptyProfile.jpg')}}" class="vehiclePicture">
                @endif
            </div>
        <div class="profileNameInfo col-md-6">
            <h3>
                Name:
                <?php
                echo $vehicle->name;
                ?>
            </h3>
            <h3>
                Make:
                <?php
                echo $vehicle->make;
                ?>
            </h3>
            <h3>
                model:
                <?php
                echo $vehicle->model;
                ?>
            </h3>
            <h3>
                Color:
                <?php
                echo $vehicle->color;
                ?>
            </h3>
            <h3>
                Year:
                <?php
                echo $vehicle->year;
                ?>
            </h3>
            <h3>
                Seats:
                <?php
                echo $vehicle->seats;
                ?>
            </h3>
            <h3>
                Description:
                <?php
                echo $vehicle->description;
                ?>
            </h3>

        </div>
        </div>
        <div class="row">
            <a href="vehicle/edit" class="btn btn-light">Edit</a>
        </div>
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
                {{Form::text('model', '', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('year', 'year')}}
                {{Form::number('year', '', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('color', 'color')}}
                {{Form::text('color', '', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('seats', 'seats')}}
                {{Form::number('seats', '', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', '', ['class' => 'form-control'])}}
            </div>
            {{Form::hidden('_method', 'POST')}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    @endif

@endsection