@extends('layouts.app')

@section('stylesheet')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

@include('inc.navbar_signed_in')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>Plan your Commute!</h3>
                {!! Form::open(['action' => 'RoutesController@store', 'id'=> 'commute-form',  'method' => 'POST']) !!}
                <div class="form-group">
                    {{ Form::text('origin', '', ['class'=>'form-control', 'id'=>'input-origin', 'placeholder'=>'Origin', 'required'=>''])  }}
                </div>
                <div class="form-group">
                    {{ Form::text('destination', '', ['class'=>'form-control', 'id'=>'input-dest', 'placeholder'=>'Destination', 'required'=>''])  }}
                </div>
                <div class="form-group">
                    {{ Form::text('time', '', ['class'=>'form-control', 'id'=>'datetimepicker', 'placeholder'=>'Departure Time', 'required'=>''])  }}
                </div>
                <div class="form-group">
                    <label class="radio-inline">{{ Form::radio('userType', 'passenger', true) }} Passenger </label>
                    <label class="radio-inline">{{ Form::radio('userType', 'driver') }} Driver </label>
                </div>
                {{ Form::hidden('_method', 'PUT')}}
                {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
                {!! Form::close() !!}
                <br>
            </div>
        </div>
    </div>
@endsection