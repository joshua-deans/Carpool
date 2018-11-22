@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/display.css') }}" rel="stylesheet">
@endsection
@include('inc.navbar_signed_in')
@section('php')
    <?php
        function get_distance($coords1,$coords2) {
            $R = 6371;
            $obj1 = json_decode($coords1);
            $obj2 = json_decode($coords2);

            $lon1= $obj1->{'oriLng'};
            $lat1 = $obj1->{'oriLat'};
            $lon11= $obj1->{'destLng'};
            $lat11 = $obj1->{'destLat'};

            $lon2 = $obj2->{'oriLng'};
            $lat2 = $obj2->{'oriLat'};
            $lon22 = $obj2->{'destLng'};
            $lat22 = $obj2->{'destLat'};

            $dLat = deg2rad($lat2-$lat1);
            $dLon = deg2rad($lon2-$lon1);

            $dLat2 = deg2rad($lat22-$lat11);
            $dLon2 = deg2rad($lon22-$lon11);

            $a1 = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($dLon/2) * sin($dLon/2);

            $a2 = sin($dLat2/2) * sin($dLat2/2) + cos(deg2rad($lat11)) * cos(deg2rad($lat22)) *
                sin($dLon2/2) * sin($dLon2/2);

            $c1 = 2 * atan2(sqrt($a1), sqrt(1-$a1));
            $d1 = $R * $c1; // Distance in km
            $c2 = 2 * atan2(sqrt($a2), sqrt(1-$a2));
            $d2 = $R * $c2;

            if ($d1 < 10 && $d1 >= 0 && $d2 < 10 && $d2 >= 0){
                return 1;
            }
            else{
                return 0;
            }

        }
    ?>
@endsection
@section('content')

    <div class="container" style="padding: 20px;max-width: 800px;">
        <h1>Route Matches</h1>
        <br>

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
                            <?php
                                $driver = null;
                                foreach($users as $u) {
                                    if ($route->driverID == $u->id) {
                                        $driver = $u;
                                        break;
                                    }
                                }
                            ?>
                            <tr>
                                <th>{{$driver->name}}</th>
                                <th>SFU</th>
                                <th>Coquitlam</th>
                                <th>{{$route->carpoolDateTime}}</th>
                                <th>{{$driver->phone}}</th>
                                <th>
                                    <form action="{{url('RoutesController@update', [$route->rideID])}}" method="POST" >
                                    <input type="hidden" name="_method" value="PUT">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">Select this Driver</button>
                                    </form>
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

            </div>

@endsection