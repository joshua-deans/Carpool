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
@endsection
