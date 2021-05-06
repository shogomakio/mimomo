@extends('layouts.master')
@section('title', 'Mimomo - Register')
@section('style')
<style>

    .form-control {
        height: 40px;
        box-shadow: none;
        color: #969fa4;
    }

    .form-control:focus {
        border-color: #5cb85c;
    }

    .form-control,
    .btn {
        border-radius: 3px;
    }

    .signup-form {
        width: 450px;
        margin: 0 auto;
        padding: 30px 0;
        font-size: 15px;
    }

    .signup-form h2 {
        color: #636363;
        margin: 0 0 15px;
        position: relative;
        text-align: center;
    }

    .signup-form h2:before,
    .signup-form h2:after {
        content: "";
        height: 2px;
        width: 30%;
        background: #d4d4d4;
        position: absolute;
        top: 50%;
        z-index: 2;
    }

    .signup-form h2:before {
        left: 0;
    }

    .signup-form h2:after {
        right: 0;
    }

    .signup-form .hint-text {
        color: #999;
        margin-bottom: 30px;
        text-align: center;
    }

    .signup-form form {
        color: #999;
        border-radius: 3px;
        margin-bottom: 15px;
        background: #f2f3f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }

    .signup-form .form-group {
        margin-bottom: 20px;
    }

    .signup-form input[type="checkbox"] {
        margin-top: 3px;
    }

    .signup-form .btn {
        font-size: 16px;
        font-weight: bold;
        min-width: 140px;
        outline: none !important;
    }

    .signup-form .row div:first-child {
        padding-right: 10px;
    }

    .signup-form .row div:last-child {
        padding-left: 10px;
    }

    .signup-form a {
        color: #fff;
        text-decoration: underline;
    }

    .signup-form a:hover {
        text-decoration: none;
    }

    .signup-form form a {
        color: #5cb85c;
        text-decoration: none;
    }

    .signup-form form a:hover {
        text-decoration: underline;
    }

</style>
@endsection
@section('content')
<div class="signup-form">
    <form action="{{ route('user.signup') }}" method="post">
        @csrf
        <h2>Register</h2>
        <p class="hint-text">Create your account. It's free and only takes a minute.</p>
        <div class="form-group">
            <div class="row">
                <div class="col"><input id="firstName" type="text"
                        class="form-control @error('firstName') is-invalid @enderror" name="firstName"
                        value="{{ old('firstName') }}" placeholder="First Name" required autocomplete="firstName"
                        autofocus>
                </div>
                @error('firstName')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="col">
                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror"
                        name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" required
                        autocomplete="lastName" autofocus>
                </div>
                @error('lastName')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                name="username" value="{{ old('username') }}" placeholder="Username" required autocomplete="username" autofocus>
            @error('username')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
            @error('email')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input id="password_confirmation" type="password"
                class="form-control @error('passwordConfirm') is-invalid @enderror" name="password_confirmation"
                placeholder="Confirm Password" required autocomplete="new-password">
        </div>
        <!-- <div class="form-group">
            <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms
                    of Use</a> &amp; <a href="#">Privacy Policy</a></label>
        </div> -->
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
    <div class="text-center">Already have an account? <a href="#">Sign in</a></div>
</div>

    @endsection
