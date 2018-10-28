@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('inc.navbar_landing')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div id="content">
                    <h1>Carpool</h1>
                    <h3>Commuting made easy</h3>
                    <hr>
                    <button class="btn btn-default btn-lg" action="#">Get Started!</button>
                </div>
            </div> <!-- /.col-lg-12 -->
        </div> <!-- /.row-->
    </div> <!-- /.container-fluid -->

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
@endsection
