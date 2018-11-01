@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/login_signup.css') }}" rel="stylesheet">
@endsection

@include('inc.navbar_landing')

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
        <div class="form-group">
            <input id="birthday" type="date" placeholder="MM/DD/YYYY"
                   class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                   name="birthday" required>
            @if ($errors->has('birthday'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('birthday') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input id="phone#" type="tel" placeholder="Phone number"
                   class="form-control{{ $errors->has('phone#') ? ' is-invalid' : '' }}"
                   name="phone#" required>
            @if ($errors->has('phone#'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone#') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </form>
</div>

@endsection
