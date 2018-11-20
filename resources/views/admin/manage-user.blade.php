@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
@endsection

@include('inc.navbar_admin')

@section('content')
    <div class="container">
        <div class="list-group">
            @if(count($members) > 0)
                @foreach($members as $members)
                    <a href="#" class="list-group-item list-group-item-action list-group-item-primary">{{$members->email}}</a>
                @endforeach
            @else

            @endif

        </div>
    </div>

@endsection

