@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection

@include('inc.navbar_admin')

@section('content')

    <div class="container">
        <form class="navbar-form navbar-right" method="get" action="{{URL::to('/members/')}}" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search name" name="search">
            </div>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
        </form>


        @if(count($members) > 0)
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Birthdate</th>
                    <th>Action</th>
                </tr>
                @foreach($members as $member)
                    <tr>
                        <td>{{$member->name}}</td>
                        <td>{{$member->email}}</td>
                        <td>{{$member->phone}}</td>
                        <td>{{$member->birthday}}</td>
                        <td>
                            {!! Form::open(['action' => ['AdminMembersController@destroy', $member->id], 'method' => 'post']) !!}
                                {{Form::hidden('_method', 'delete')}}
                                {{Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-md'])}}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $members->links() }}
        @else
            <h3>No members exist</h3>
        @endif
    </div>

@endsection

