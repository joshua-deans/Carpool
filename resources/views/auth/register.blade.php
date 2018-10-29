@extends('layouts.webfront')

@section('stylesheet')
    <link href="{{ asset('css/login_signup.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2>Register</h2>
        <div class="form-group">
            <input id="name" type="text" placeholder="Name"
                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                   value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input id="password" type="password" placeholder="Password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input id="password-confirm" type="password" placeholder="Confirm Password"
                   class="form-control" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </form>
</div>

@endsection
