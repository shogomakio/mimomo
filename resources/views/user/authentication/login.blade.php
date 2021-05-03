@extends('layouts.master')
@section('title', 'Mimomo - ログインページ')
@section('content')
<div class="flex-center position-ref full-height">

    <div class="flex-center position-absolute full-height">

        <div class="content">
            <form method="POST" action="{{ route('user.login') }}">
                @csrf
                <h1>Login</h1>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </ul>
                </div>
                @endif

                <div class="form-input mt-4">
                    <label>Email</label>
                    <input id="login" type="login" class="form-control @error('login') is-invalid @enderror"
                        name="login" value="{{ old('login') }}" required autocomplete="login">

                    @error('login')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-input">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-sm mt-4"> {{ __('Login') }} <i
                        class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</div>
<!-- / Page Content -->
@endsection
