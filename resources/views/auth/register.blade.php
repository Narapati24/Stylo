@extends('layouts.auth')

@section('content')
    <div class="text-center mb-8">
        <h1 class="text-xl font-bold text-primary mb-1">Create Account</h1>
        <p class="text-sm text-gray-500">Join Stylo for an exclusive experience</p>
    </div>

    <div class="space-y-6">
        <a href="{{ route('auth.google') }}" class="flex items-center justify-center gap-3 w-full h-12 text-sm font-semibold border border-gray-200 rounded-xl text-primary hover:bg-gray-50 transition-colors">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="20">
            <span>Sign up with Google</span>
        </a>

        <div class="relative flex items-center py-2">
            <div class="flex-grow border-t border-gray-100"></div>
            <span class="flex-shrink-0 mx-4 text-xs font-bold text-gray-300 uppercase tracking-widest">OR</span>
            <div class="flex-grow border-t border-gray-100"></div>
        </div>

        <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label for="name" class="text-xs font-bold uppercase tracking-wider text-gray-500">Full Name</label>
                <input type="text" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required autofocus
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-0 bg-gray-50/50 transition-all placeholder:text-gray-400 text-sm">
                @error('name')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-1.5">
                <label for="email" class="text-xs font-bold uppercase tracking-wider text-gray-500">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@email.com" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-0 bg-gray-50/50 transition-all placeholder:text-gray-400 text-sm">
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-1.5">
                <label for="password" class="text-xs font-bold uppercase tracking-wider text-gray-500">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-0 bg-gray-50/50 transition-all placeholder:text-gray-400 text-sm">
                @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-1.5">
                <label for="password_confirmation" class="text-xs font-bold uppercase tracking-wider text-gray-500">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-0 bg-gray-50/50 transition-all placeholder:text-gray-400 text-sm">
            </div>

            <button type="submit" class="w-full bg-primary text-white font-bold py-3.5 rounded-xl hover:bg-gray-800 transition-all active:scale-[0.98] shadow-lg shadow-primary/20 mt-2">
                Create Account
            </button>
        </form>

        <div class="text-center text-sm text-gray-500">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">Sign in</a>
        </div>
    </div>
@endsection
