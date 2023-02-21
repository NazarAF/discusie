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
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-mail-bulk"></i>
                            </div>
                        </div>
                        <input id="username"
                        type="text"
                        class="form-control"
                        name="username"
                        tabindex="1"
                        placeholder="Email address or username"
                        required
                        autofocus>
                    </div>
                    <div class="invalid-feedback">
                        Please fill in your username
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password"
                            class="control-label">Password</label>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div id="shpsw" class="input-group-text">
                                <i class="fas fa-eye-slash"></i>
                            </div>
                        </div>
                        <input id="password"
                        type="password"
                        class="form-control"
                        name="password"
                        tabindex="2"
                        placeholder="Password"
                        required>
                    </div>
                    <div class="invalid-feedback">
                        Please fill in your password
                    </div>
                </div>

                <div class="form-group">
                    <label class="custom-switch pl-0">
                        <input type="checkbox" name="remember" class="custom-switch-input" hidden>
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Remember me</span>
                    </label>
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
   <script>
        $(document).ready(function () {
            $('#shpsw').click(function (e) {
                e.preventDefault();
                $(this).find('.fas').toggleClass('fa-eye-slash fa-eye');
                if ($('#password').attr('type') == 'password') {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });
        });
   </script>
@endpush
