@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection

@include('inc.navbar_admin')

@section('content')
    <div class="container">
        @if(count($members) > 0)
            <table>
                <tr>
                    <th>Account ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                @foreach($members as $members)
                    <tr>
                        <td>{{$members->id}}</td>
                        <td>{{$members->name}}</td>
                        <td>{{$members->email}}</td>
                        <td>

                            {!! Form::open(['action' => ['AdminRemoveController@destroy', $members->id], 'method' => 'post']) !!}
                                {{Form::hidden('_method', 'delete')}}
                                {{Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-md'])}}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h3>No members exist</h3>
        @endif
    </div>

@endsection

