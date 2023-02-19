@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST"
                action="{{ route('auth.login') }}"
                class="needs-validation"
                novalidate>
                @csrf
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input id="username"
                        type="text"
                        class="form-control"
                        name="username"
                        tabindex="1"
                        placeholder="Email address or username"
                        required
                        autofocus>
                    <div class="invalid-feedback">
                        Please fill in your username
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password"
                            class="control-label">Password</label>
                    </div>
                    <input id="password"
                        type="password"
                        class="form-control"
                        name="password"
                        tabindex="2"
                        placeholder="Password"
                        required>
                    <div class="invalid-feedback">
                        Please fill in your password
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            name="remember"
                            class="custom-control-input"
                            tabindex="3"
                            id="remember-me">
                        <label class="custom-control-label"
                            for="remember-me">Remember Me</label>
                    </div>
                </div>

                <div class="form-group text-right">
                    <a href="auth-forgot-password.html"
                        class="float-left mt-3">
                        Forgot Password?
                    </a>
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-icon icon-right"
                        tabindex="4">
                        Login
                    </button>
                </div>

                <div class="text-center">
                    Don't have an account? <a href="{{ route('register') }}">Create new one</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
