<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stylo') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans text-primary antialiased bg-bone min-h-screen flex flex-col">
    
    <!-- Navbar -->
    <nav class="bg-bone border-b border-secondary px-6 py-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('front.home') }}" class="font-serif text-3xl font-bold tracking-wide text-primary">
                Stylo
            </a>

            <!-- Navigation -->
            <div class="hidden md:flex items-center gap-8 font-medium text-sm tracking-wide uppercase">
                <a href="{{ route('front.home') }}" class="hover:text-accent transition-colors">Home</a>
                <a href="#" class="hover:text-accent transition-colors">Shop</a>
                <a href="#" class="hover:text-accent transition-colors">Collections</a>
                <a href="#" class="hover:text-accent transition-colors">About</a>
            </div>

            <!-- Icons -->
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-accent transition-colors">
                    <span class="sr-only">Search</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </a>
                <a href="{{ route('front.cart') }}" class="hover:text-accent transition-colors relative">
                    <span class="sr-only">Cart</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </a>
                @auth
                    <div class="relative group">
                        <button class="flex items-center gap-1 hover:text-accent transition-colors">
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white border border-secondary shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-bone">Admin Dashboard</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-bone text-red-600">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hover:text-accent transition-colors">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-bone py-12 border-t border-secondary">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="font-serif text-2xl mb-4">Stylo</h3>
                <p class="text-sm text-gray-400 leading-relaxed">Earthy luxury fashion for the modern soul. Timeless pieces crafted with care.</p>
            </div>
            <div>
                <h4 class="font-bold uppercase text-xs tracking-widest mb-4 text-accent">Shop</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">New Arrivals</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Best Sellers</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Accessories</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold uppercase text-xs tracking-widest mb-4 text-accent">Company</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Sustainability</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold uppercase text-xs tracking-widest mb-4 text-accent">Newsletter</h4>
                <p class="text-sm text-gray-400 mb-4">Subscribe to receive updates, access to exclusive deals, and more.</p>
                <form class="flex border-b border-gray-600 pb-2">
                    <input type="email" placeholder="Enter your email" class="bg-transparent w-full outline-none text-sm placeholder-gray-500 text-white">
                    <button type="submit" class="text-accent uppercase text-xs font-bold hover:text-white transition-colors">Join</button>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-gray-800 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Stylo. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>
</html>
