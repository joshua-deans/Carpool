@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/display.css') }}" rel="stylesheet">
@endsection
@include('inc.navbar_signed_in')
@section('php')
    <?php
        function get_distance($coords1,$coords2) {

            $obj1 = json_decode($coords1);
            $lon1= $obj1->{'oriLng'};
            $lat1 = $obj1->{'oriLat'};


            $obj2 = json_decode($coords2);
            $lon2 = $obj2->{'oriLng'};
            $lat2 = $obj2->{'oriLat'};
            $R = 6371;

            $dLat = deg2rad($lat2-$lat1);
            $dLon = deg2rad($lon2-$lon1);

            $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($dLon/2) * sin($dLon/2);

            $c = 2 * atan2(sqrt($a), sqrt(1-$a));
            $d = $R * $c; // Distance in km

            if ($d < 100 && $d >= 0){
                return 1;
            }
            else{
                return 0;
            }

        }
    ?>
@endsection
@section('content')

    <tr id="container">
        <h1>Route Matches</h1>
        <br>
        <form method="post" action="">
            <table id="matchTable">
                <tr>
                    <th>Driver Name</th>

                    <th>Start</th>
                    <th>Destination</th>
                    <th>Time</th>
                    <th>Contact</th>
                    <th>Select</th>
                </tr>
                @if (count($routes) > 0)
                    @foreach($routes as $route)
                        @if(get_distance($p_coords,$route->coords)==1)
                            <tr>
                                <th>example</th>

                                <th>SFU</th>
                                <th>Coquitlam</th>
                                <th>{{$route->carpoolDateTime}}</th>
                                <th>604-000-0000</th>
                                <th><label class="selectDriver"><input type="radio" name="slectedDriver"> Select this Driver</label>
                                </th>
                            </tr>
                        @endif
                    @endforeach

                @else
                        <tr><h3> No routes found</h3></tr>
                @endif
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