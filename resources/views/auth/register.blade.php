@extends('layouts.app')

@section('content')

<div class="auth-page">
    <div class="auth-container">
        <main class="auth-card">
            <header class="auth-header">
                <h1 class="auth-title">Create Account</h1>
                <p class="auth-subtitle">Join Stylo for an exclusive experience</p>
            </header>

            <div class="auth-body">
                <a href="{{ route('auth.google') }}" class="auth-google">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="20">
                    <span>Sign up with Google</span>
                </a>

                <div class="auth-divider">
                    <span>OR</span>
                </div>

                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="you@email.com" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn-primary">Create Account</button>
                </form>

                <div class="mt-6 text-center text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">Sign in</a>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
