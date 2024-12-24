@extends('layouts.app')

@section('content')
<div class="limiter">
    <div class="container-login100 d-flex">
        <!-- Registration form on the right -->
        <div class="col-md-6 d-flex align-items-center justify-content-center order-md-2">
            <div class="card-body">
                <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <span class="login100-form-title p-b-43">
                        Register
                    </span>
                    <div class="row mb-4">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                        <div class="col-md-9">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="col-md-9">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="col-md-9">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                        <div class="col-md-9">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Register
                        </button>
                    </div>

                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            <p>Already a member? <a href="{{ route('login') }}">Login</a></p>
                        </span>
                    </div>

                    <div class="login100-form-social flex-c-m">
                        <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Image on the left -->
        <div class="col-md-6 d-none d-md-block p-0 order-md-1">
            <img src="{{ asset('images/login_background.jpg') }}" class="img-fluid h-100" alt="Side Image">
        </div>
    </div>
</div>
@endsection
