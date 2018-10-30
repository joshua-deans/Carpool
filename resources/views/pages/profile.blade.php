@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_landing')
    <?php
        $user = DB::table('users')->where('id', $id)->first();
    ?>

    <div class="container">

        <div class="profileHeader">
            <div class="col-md-4">
                <img src="{{asset('imgs/emptyProfile.jpg')}}" class="profilePicture">
            </div>
            <div class="profileNameInfo col-md-6">
                <h3>
                    Name:
                    <?php
                        echo $user->name;
                    ?>
                </h3>
                <h3>
                    Username:
                    <?php
                        echo $user->email;
                    ?>
                </h3>
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
