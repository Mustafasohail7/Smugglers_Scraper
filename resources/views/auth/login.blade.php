@extends('layouts.app')

@section('content')
<style type="text/css">
   
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <h1 class="heading_h1_login">Welcome to Smugglers OMS Scrapper</h1>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="login-form" method="POST" action="{{ route('custom-login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-12 col-form-label">{{ __('Username') }}</label>

                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Added a margin below the password input -->
                        <div class="row mb-3">
                            <div class="col-md-12"></div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn loginbtn">
                                    {{ __('Log in') }}
                                </button>
                                <!-- Removed the sign-up link -->
                                <!-- <p class="text-end mt-2">Don't have an account? <a href="{{ route('register') }}">{{ __('Sign up') }}</a></p> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection