@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center">
    <div class="w-full max-w-md bg-white border border-secondary p-8 shadow-sm">
        <h1 class="font-serif text-3xl text-primary text-center mb-2">Welcome Back</h1>
        <p class="text-center text-gray-500 text-sm mb-8">Sign in to your account</p>

        @if(session('error'))
            <div class="bg-red-50 text-red-800 p-3 text-sm mb-4 border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="space-y-4">
            <a href="{{ route('auth.google') }}" class="flex items-center justify-center gap-3 w-full bg-white border border-secondary text-primary py-3 px-4 hover:bg-bone transition-colors">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                <span class="font-medium text-sm">Continue with Google</span>
            </a>
            
            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-secondary"></div>
                <span class="flex-shrink mx-4 text-gray-400 text-xs uppercase tracking-widest">Or</span>
                <div class="flex-grow border-t border-secondary"></div>
            </div>

            <!-- Standard Login Form -->
            <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full border-secondary bg-bone focus:border-primary focus:ring-0 rounded-none px-4 py-2">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full border-secondary bg-bone focus:border-primary focus:ring-0 rounded-none px-4 py-2">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="w-full bg-primary text-white py-3 font-medium text-sm hover:bg-accent transition-colors rounded-none">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
