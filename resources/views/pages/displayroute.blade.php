@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/display.css') }}" rel="stylesheet">
@endsection
@include('inc.navbar_signed_in')
@section('content')
    <div id="container">
        <h1>Route Matches</h1>
        <br>
        <form method="post" action="">
            <table id="matchTable">
                <tr>
                    <th>Driver Name</th>
                    <th>Drive ID</th>
                    <th>Start</th>
                    <th>Destination</th>
                    <th>Time</th>
                    <th>Contact</th>
                    <th>Select</th>
                </tr>
                <tr>
                    <th>Example1</th>
                    <th>123</th>
                    <th>SFU</th>
                    <th>Coquitlam</th>
                    <th>12:30</th>
                    <th>604-000-0000</th>
                    <th><label class="selectDriver"><input type="radio" name="slectedDriver"> Select this Driver</label>
                    </th>
                </tr>
                <tr>
                    <th>Example2</th>
                    <th>098</th>
                    <th>UBC</th>
                    <th>SFU</th>
                    <th>1:30</th>
                    <th>778-000-0000</th>
                    <th><label class="selectDriver"><input type="radio" name="slectedDriver"> Select this Driver</label>
                    </th>
                </tr>
            </table>
            <br>
            <br>
            <div id="confirm">
                <button class="btn confirm" type="submit" action="RoutesController@index">Confirm</button>
            </div>
            <div id="button">
                <button class="btn goback" type="submit" action="RoutesController@index">Search Again</button>
            </div>
        </form>
    </div>
@endsection