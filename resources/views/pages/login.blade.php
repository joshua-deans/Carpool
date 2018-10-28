@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('inc.navbar_landing')

    <div class="container">
        <form>
            <h2>Login</h2>
            <div class="form-group">
                <input type="email" class="form-control" id="inputEmail" placeholder="Enter email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
    </div>

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
@endsection
