@extends('layouts.app')

@section('content')
<div class="auth-page">

    <div class="auth-container">
        <div class="auth-card">

            <header class="auth-header">
                <h1 class="auth-title">Welcome Back</h1>
                <p class="auth-subtitle">Sign in to your account</p>
            </header>

            @if(session('error'))
                <div class="auth-alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="auth-body">

                <a href="{{ route('auth.google') }}" class="auth-google">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google">
                    <span>Continue with Google</span>
                </a>

                <div class="auth-divider">
                    <span>OR</span>
                </div>

                <form action="{{ route('login.store') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email') <small>{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                        @error('password') <small>{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn-primary">
                        Sign In
                    </button>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
