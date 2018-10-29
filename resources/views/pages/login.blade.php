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
@endsection
