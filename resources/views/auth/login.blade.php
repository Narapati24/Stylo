@extends('layouts.app')

@section('content')
<header class="main-header">
    <div class="header-container">
        <a href="/" class="header-logo">Stylo</a>

        <nav class="header-nav">
            <a href="#" class="nav-link">Home</a>
            <a href="#" class="nav-link">Shop</a>
            <a href="#" class="nav-link">Collections</a>
            <a href="#" class="nav-link">About</a>
        </nav>

        <div class="header-actions">
            <a href="#" class="header-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </a>
            <a href="#" class="header-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </a>
            <a href="/login" class="nav-link" style="color: var(--color-primary);">Login</a>
        </div>
    </div>
</header>

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