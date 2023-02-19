@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>
        <div class="card-body">
            <form
                method="POST"
                class="needs-validation"
                action="{{ route('auth.register') }}"
                novalidate>
                @csrf
                <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input id="nickname"
                        type="text"
                        class="form-control"
                        name="nickname"
                        placeholder="Nickname"
                        autofocus
                        required>
                    <div class="invalid-feedback">
                        Please fill in your nickname
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-7">
                        <label for="email">Email</label>
                        <input id="email"
                            type="email"
                            class="form-control"
                            name="email"
                            placeholder="Email"
                            required>
                        <div class="invalid-feedback">
                            Please fill in your email
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="username">Username</label>
                        <input id="username"
                            type="username"
                            class="form-control"
                            name="username"
                            placeholder="Username"
                            required>
                        <div class="invalid-feedback">
                            Please fill in your username
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="password"
                            class="d-block">Password</label>
                        <input id="password"
                            type="password"
                            class="form-control pwstrength"
                            data-indicator="pwindicator"
                            name="password"
                            placeholder="Password"
                            required>
                        <div class="invalid-feedback">
                            Please fill in your password
                        </div>
                        <div id="pwindicator"
                            class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="password2"
                            class="d-block">Password Confirmation</label>
                        <input id="password2"
                            type="password"
                            class="form-control"
                            name="password-confirmation"
                            placeholder="Password confirmation">
                        <div class="invalid-feedback">
                            Please confirm your password
                        </div>
                        <div id="pwindicator" class="pwindicator">
                            <div id="pwindicate" class="label text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            name="agree"
                            class="custom-control-input"
                            id="agree"
                            required>
                        <label class="custom-control-label"
                            for="agree">I agree with the</label> <a href="#">terms and conditions</a>
                    </div>
                </div>

                <div class="form-group">
                    <button
                        id="register"
                        type="submit"
                        class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
    <script>
        $(document).ready(function () {
            function confirmation() {
                if ($('#password2').val() != $('#password').val()) {
                    $('#register').attr("disabled", true)
                    $('#pwindicate').html("Password not match");
                } else {
                    $('#register').attr("disabled", false)
                    $('#pwindicate').html(' ')
                }
            }

            $('#password2').change(function() {
                confirmation()
            });
        });
    </script>
@endpush
