@extends('layouts.master')
@section('title', 'Mimomo - Login')
@section('style')
<style>
    body {
        font-family: 'Varela Round', sans-serif;
    }

    .modal-login {
        color: #636363;
        width: 350px;
    }

    .modal-login .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }

    .modal-login .modal-header {
        border-bottom: none;
        position: relative;
        justify-content: center;
    }

    .modal-login h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -15px;
    }
    .modal-login  .form-group {
        position: relative;
    }
    .modal-login i {
        position: absolute;
        left: 14px;
        top: 11px;
        font-size: 18px;
    }

    .modal-login .form-control:focus {
        border-color: #70c5c0;
    }

    .modal-login .form-control,
    .modal-login .btn {
        min-height: 40px;
        border-radius: 3px;
        padding-left: 40px;
    }

    .modal-login .close {
        position: absolute;
        top: -5px;
        right: -5px;
    }

    .modal-login .modal-footer {
        background: #ecf0f1;
        border-color: #dee4e7;
        text-align: center;
        justify-content: center;
        margin: 0 -20px -20px;
        border-radius: 5px;
        font-size: 13px;
    }

    .modal-login .modal-footer a {
        color: #999;
    }

    .modal-login .avatar {
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #60c7c1;
        padding: 15px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }

    .modal-login .avatar img {
        width: 100%;
    }

    .modal-login.modal-dialog {
        margin-top: 80px;
    }

    .modal-login .btn,
    .modal-login .btn:active {
        color: #fff;
        border-radius: 4px;
        background: #60c7c1 !important;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }

    .modal-login .btn:hover,
    .modal-login .btn:focus {
        background: #45aba6 !important;
        outline: none;
    }

</style>
@endsection

@section('content')
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <div class="avatar">
                    <img src="{{ url('images/avatar.png') }}" alt="Avatar">
                </div>
                <h4 class="modal-title">Member Login</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <i class="fa fa-user"></i>
						<input id="login" type="text" name="login" class="form-control"
                            placeholder="Username or Email" value="{{ old('login') }}" required autocomplete="login">
                    </div>
                    <div class="form-group">
						<i class="fa fa-lock"></i>
						<input id="loginPassword" type="password" name="loginPassword" class="form-control"
                            placeholder="Password" required>
					</div>
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    @if(Session::has('loginErrorMessage'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('loginErrorMessage') }}</p>
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
    @endsection
