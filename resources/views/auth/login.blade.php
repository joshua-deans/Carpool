@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/login_signup.css') }}" rel="stylesheet">
@endsection

@include('inc.navbar_landing')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Login</h2>
        <div class="form-group">
            <input id="email" type="email" placeholder="Email" class="form-control
            {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                   required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <input id="password" type="password" placeholder="Password" class="form-control
            {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>
        <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>
        <div class="form-group">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </div>
    </form>
</div>


@endsection
