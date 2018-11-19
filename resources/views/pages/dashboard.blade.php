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
                <form>
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
                    <div class="form-group">
                        <label class="radio-inline"><input id="pass" type="radio" name="userType" value="passenger" checked>Passenger</label>
                        <label class="radio-inline"><input id="driv" type="radio" name="userType" value="driver">Driver</label>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle = "modal" data-target="#route" id="submitChange">Submit</button>
                </form>
                <br>
            </div>
            <div class="col-8">
                <div id="map"></div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="route" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Matching Routes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="myroutes" class="modal-body">
                    My routes
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