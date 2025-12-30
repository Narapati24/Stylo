@extends('layouts.app')

@section('content')


<div class="auth-page">
    <div class="auth-container">
        <main class="auth-card">
            <header class="auth-header">
                <h1 class="auth-title">Welcome Back</h1>
                <p class="auth-subtitle">Sign in to your account to continue</p>
            </header>

            <div class="auth-body">
                <a href="{{ route('auth.google') }}" class="auth-google">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="20">
                    <span>Continue with Google</span>
                </a>

                <div class="auth-divider">
                    <span>OR</span>
                </div>

                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="you@email.com" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn-primary">Sign In</button>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection