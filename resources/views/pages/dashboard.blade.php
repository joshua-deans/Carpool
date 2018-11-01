@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="{{ asset('js/location.js') }}"></script>
@endsection

@include('inc.navbar_signed_in')

@section('content')

    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>Plan your Commute!</h3>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="input-origin" placeholder="Origin">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="input-dest" placeholder="Destination">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="departure-time" placeholder="Departure Time">
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="userType" value="passenger" checked>Passenger</label>
                        <label class="radio-inline"><input type="radio" name="userType" value="driver">Driver</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br>
            </div>
            <div class="col-8">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script async defer src="https://maps.googleapis.com/maps/api/js?v=weekly&key=
AIzaSyC_EIWb_yAvbLmnjYU4qHxvzWlcGKU-jeA&libraries=places&callback=initMap"></script>