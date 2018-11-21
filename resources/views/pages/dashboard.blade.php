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
                <h3>Step 1: Choose your Role</h3>
                <div class="form-group">
                    <label class="radio-inline"><input id="pass" type="radio" name="userType" value="passenger">Passenger</label>
                    <label class="radio-inline"><input id="driv" type="radio" name="userType" value="driver">Driver</label>
                </div>
                {!!Form::open(['action'=>'RoutesController@matching','id'=>"commute-form-passenger",'method'=>"POST"])!!}
                    <h3>Step 2: Plan youre commute as a Passenger</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="input-origin-passenger" name="origin" placeholder="Origin" required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="input-dest-passenger" name="destination"
                               placeholder="Destination" required="required">
                    </div>
                    <div class="form-group">
                        <input type='text' class="form-control" id='datetimepicker-passenger' name="time"
                               placeholder="Departure Time" required="required">
                    </div>
                <button type="submit" class="btn btn-primary" id="submitChange-passenger">Submit</button>
                {!! Form::close() !!}

                {!!Form::open(['action'=>'RoutesController@store','id'=>"commute-form-driver",'method'=>"POST"])!!}
                <h3>Step 2: Plan youre commute as Driver</h3>
                <div class="form-group">
                    <input type="text" class="form-control" id="input-origin" name="origin" placeholder="Origin" required="required">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="input-dest" name="destination"
                           placeholder="Destination" required="required">
                </div>
                <div class="form-group">
                    <input type='text' class="form-control" id='datetimepicker' name="time"
                           placeholder="Departure Time" required="required">
                </div>
                <button type="submit" class="btn btn-primary" id="submitChange">Submit</button>
                {!! Form::close() !!}
                <br>
            </div>
            <div class="col-8">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/location.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?v=weekly&key=
AIzaSyC_EIWb_yAvbLmnjYU4qHxvzWlcGKU-jeA&libraries=places&callback=initMap"></script>
@endsection
