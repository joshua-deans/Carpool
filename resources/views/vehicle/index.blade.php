@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/vehicle.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_signed_in')
    @include('inc.messages')
    <div class="container vehicleHeader">
        <div class="row">
            @if($vehicle)
                <div class="col-md-5">
                @if ($vehicle->picture)
                    <img src="{{asset('images/'.$vehicle->picture)}}" class="vehiclePicture">
                @else
                    <img src="{{URL::asset('imgs/emptyProfile.jpg')}}" class="vehiclePicture">
                @endif
            </div>
                <div class="profileNameInfo col-md-7">
            <h3>
                License Status:
                <?php
                echo $vehicle->licenseStatus;
                ?>
            </h3>
            <h3>
                Name:
                <?php
                echo $vehicle->vehicleName;
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
        <br>
        <br>
        <div class="row text-center">
            <a href="vehicle/edit" class="btn btn-primary btn-lg">Edit</a>
        </div>

    @else
            <div class="profileNameInfo col-md-12">
                <h2 class="text-center">Driver Information</h2>
                {!! Form::open(['action' => 'VehicleController@add', 'method' => 'POST', 'files' => true]) !!}
                    <div class="form-group">
                        {{Form::label('licenseStatus', 'License Status')}}
                        {{Form::text('licenseStatus', '', ['class' => 'form-control'])}}
                    </div>
                    <h2 class="text-center">Create your vehicle</h2>
                    <div class="form-group">
                        {{Form::label('picture', 'Upload Image')}}
                        {{Form::file('picture')}}
                    </div>
                    <div class="form-group">
                        {{Form::label('vehicleName', 'Vehicle Name')}}
                        {{Form::text('vehicleName', '', ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('make', 'Make')}}
                        {{Form::text('make', '', ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('model', 'Model')}}
                        {{Form::text('model', '', ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('year', 'Year')}}
                        {{Form::number('year', '', ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('color', 'Color')}}
                        {{Form::text('color', '', ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('seats', 'Seats')}}
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
    </div>
    @endif
@endsection