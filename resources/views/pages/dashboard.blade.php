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
                <h3>Plan your Commute!</h3>
                {!!Form::open(['action'=>'RoutesController@store','id'=>"commute-form",'method'=>"POST"])!!}
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
                        <label class="radio-inline"><input id="pass" type="radio" name="userType" value="passenger" checked>Passenger</label>
                        @if($driver == true)
                            <label class="radio-inline"><input id="driv" type="radio" name="userType" value="driver">Driver</label>
                        @else
                            <label class="radio-inline"><input id="driv" type="radio" name="userType" value="driver"
                                                               disabled>Driver</label>
                        @endif
                    </div>
                <button type="button" class="btn btn-primary" id="submitChange">Submit</button>
                {!! Form::close() !!}
                <br>
            </div>
            <div class="col-8">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="route" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Matching Routes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($routes)>0)
                        @foreach($routes as $route)
                            <div class="popwindow">
                                <h3><a href="/Routes/{{$route->rideID}}">route id: {{$route->rideID}}</a></h3>
                                <small>date time:{{$route->carpoolDateTime}}</small>
                            </div>
                        @endforeach
                        {{$routes->links()}}
                    @else
                        <div class="popwindow"><p>No routes found</p></div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const fp = flatpickr("#datetimepicker", {
            enableTime: true,
            altInput: true,
            altFormat: "F j, Y h:i K",
            minDate: "today",
            dateFormat: "U"
        });
    </script>
    <script src="{{ asset('js/location.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?v=weekly&key=
AIzaSyC_EIWb_yAvbLmnjYU4qHxvzWlcGKU-jeA&libraries=places&callback=initMap"></script>
@endsection
