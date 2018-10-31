@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_landing')
    <div class="container">
        <div class="profileHeader">
            <div class="col-md-4">
                @if ($user->profilePicture)
                    <img src="{{URL::asset('images/'.$user->profilePicture)}}">
                @else
                    <img src="{{URL::asset('imgs/emptyProfile.jpg')}}" style="height: 200px; width: 200px;">
                @endif
            </div>
            <div class="profileNameInfo col-md-6">
                <h3>
                    Name:
                    <?php
                    echo $user->name
                    ?>
                </h3>
                <h3>
                    email:
                    <?php
                    echo $user->email;
                    ?>
                </h3>
                <h3>
                    phone:
                    <?php
                    echo $user->phone;
                    ?>
                </h3>
                <h3>
                    About:
                    <?php
                    echo $user->description;
                    ?>
                </h3>
                <h3>
                    Birthday:
                    <?php
                    echo $user->birthday;
                    ?>
                </h3>
                <h3>
                    Rating:
                    <?php
                    echo $user->avgRating;
                    ?>
                </h3>
            </div>
            <a href="profile/edit" class="btn btn-light">Edit</a>
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
