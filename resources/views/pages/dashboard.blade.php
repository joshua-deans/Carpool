@extends('layouts.app')

@section('stylesheet')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

@if($driver == true)
@include('inc.navbar_signed_in')
@else
    @include('inc.navbar_signed_in_2')
@endif

@section('content')
    <div class="container-fluid alert-container" style="margin-bottom: -40px">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('success') }}
            </div>
        @elseif (Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> {{ Session::get('error') }}
            </div>
        @endif
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>Step 1: Choose your Role</h3>
                <div class="form-group">
                    <button type="button" id="pass" style="margin-right: 5px;width:90px;" class="btn btn-default">
                        Passenger
                    </button>
                    @if ($driver == true)
                        <button type="button" style="margin-left: 5px;width:90px;" id="driv" class="btn btn-default">
                            Driver
                        </button>
                    @else
                        <button type="button" style="margin-left: 5px;width:90px;" id="driv" class="btn btn-default"
                                disabled="disabled">Driver
                        </button>
                    @endif
                    {{--<label class="radio-inline"><input id="pass" type="radio" name="userType" value="passenger">Passenger</label>--}}
                    {{--@if ($driver == true)--}}
                    {{--<label class="radio-inline"><input id="driv" type="radio" name="userType" value="driver">Driver</label>--}}
                    {{--@else--}}
                    {{--<label class="radio-inline"><input id="driv" type="radio" name="userType" value="driver"--}}
                    {{--disabled>Driver</label>--}}
                    {{--@endif--}}
                </div>
                {!!Form::open(['action'=>'RoutesController@matching','id'=>"commute-form-passenger",'method'=>"POST"])!!}
                <h3>Step 2: Plan Your Commute as a Passenger</h3>
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
                <h3>Step 2: Plan Your Commute as a Driver</h3>
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
