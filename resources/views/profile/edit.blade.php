@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_signed_in')


    <div class="container">

        <div class="profileHeader">
            <div class="col-md-4">
                @if ($user->profilePicture)
                    {{$user->profilePicture}}
                @else
                    <img src="{{URL::asset('imgs/emptyProfile.jpg')}}" style="height: 200px; width: 200px;">
                @endif

            </div>
            <div class="profileNameInfo col-md-6">
                {!! Form::open(['action' => ['ProfileController@update', $user->id], 'method' => 'POST', 'files' => true]) !!}
                <div class="form-group">
                    {{Form::file('picture')}}
                </div>
                <div class="form-group">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('phone', 'Phone')}}
                    {{Form::text('phone', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('about', 'About')}}
                    {{Form::textarea('about', '', ['class' => 'form-control'])}}
                </div>
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
@endsection
