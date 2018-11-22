@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/display.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection
@include('inc.navbar_signed_in')

@section('php')
    <?php
        function match_distance($coords1,$coords2) {
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

            if ($d1 < 1 && $d1 >= 0 && $d2 < 1 && $d2 >= 0){
                return 1;
            }
            else{
                return 0;
            }
        }

        function match_time($time1,$time2){
            if ($time1 < $time2){
                $d = ( $time2 - $time1 )/ 3600;
            }
            else{
                $d = ( $time1 - $time2 )/ 3600;
            }

            if ($d <0.5 ){
                return 1;
            }
            else{
                return 0;
            }

        }
    ?>
@endsection
@section('content')
    <script>
        function geocode(start, divID){
            axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
                params:{
                    latlng:start,
                    key: 'AIzaSyCgBuOiCTu4lSCitAlk-YxtZ_Aw6KRIqxU'
                }
            })
                .then(function(response){
                    document.getElementById(divID).innerHTML=
                        response.data.results[0].formatted_address;
                })
                .catch(function(error){
                    console.log(error);
                })
        }
        function get_name(a) {
            var b1 =  "oriName";
            var b2 =  "oriName";
            var c = a.toString();
            var d1 = b1.concat(c);
            var d2 = b2.concat(c);
            var coordJSON = document.getElementById(c).textContent;
            var oricoords = JSON.parse(coordJSON);
            var oriLat = oricoords.oriLat;
            var oriLng = oricoords.oriLng;
            var destLat = oricoords.destLat;
            var destLng = oricoords.destLng;
            var oriString = oriLat + ',' + oriLng;
            var destString = destLat + ',' + destLng;
            geocode(oriString,d1);
            geocode(destString,d2);
        }

    </script>
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
                <?php
                    $count=0;
                ?>
                @if (count($routes) > 0)
                    @foreach($routes as $route)
                        @if(match_distance($p_coords,$route->coords)==1
                        && match_time($p_time,$route->carpoolDateTime)==1)
                            <?php
                                echo "<script>c++;</script>";
                                $count ++;
                                $driver = null;
                                foreach($users as $u) {
                                    if ($route->driverID == $u->id) {
                                        $driver = $u;
                                        break;
                                    }
                                }
                            ?>

                            <div id="<?php echo $count?>" style="display: none;">{{$route->coords}}</div>
                            <tr>
                                <th>{{$driver->name}}</th>
                                <th id="oriName<?php echo $count?>"></th>
                                <th id="destName<?php echo $count?>"></th>
                                <script>get_name(<?php echo $count?>);</script>
                                <th><?php echo date('Y-m-d g:i A',$route->carpoolDateTime  );?></th>
                                <th>{{$driver->phone}}</th>
                                <th>
                                    <form action="/displayroute/{{$route->rideId}}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">Select this Driver</button>
                                    </form>
                                </th>
                            </tr>
                        @endif
                    @endforeach
                    @if($count == 0)
                            <tr>
                                <th>No routes found</th>
                                <th><br></th>
                                <th><br></th>
                                <th><br></th>
                                <th><br></th>
                                <th><br></th>
                            </tr>
                    @endif
                @endif
                    </table>

            </div>

@endsection
