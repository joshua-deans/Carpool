@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection

@include('inc.navbar_admin')

@section('content')
    <div class="container">
        @if(count($carpools) > 0)
            <table>
                <tr>
                    <th>Ride ID</th>
                    <th>Driver</th>
                    <th>Passengers</th>
                    <th>Capacity</th>
                    <th>Scheduled Time</th>
                    <th>Action</th>
                </tr>
                @foreach($carpools as $carpools)
                    <tr>
                        <td>{{$carpools->rideId}}</td>
                        <td>{{$carpools->driverID}}</td>
                        <td>{{$carpools->peopleCur}}</td>
                        <td>{{$carpools->peopleCap}}</td>
                        <td>{{$carpools->carpoolDateTime}}</td>
                        <td>

                            {!! Form::open(['action' => ['AdminCarpoolController@destroy', $carpools->id], 'method' => 'post']) !!}
                                {{Form::hidden('_method', 'delete')}}
                                {{Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-md'])}}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h3>No carpools exist</h3>
        @endif
    </div>

@endsection

