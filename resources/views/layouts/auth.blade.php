<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stylo') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans text-primary antialiased bg-bone min-h-screen flex items-center justify-center p-4">
    
    <main class="w-full max-w-[420px] bg-white px-8 py-10 rounded-3xl shadow-xl relative">
        {{-- Close Button --}}
        <a href="{{ route('front.home') }}" class="absolute top-5 right-5 text-gray-400 hover:text-primary transition-colors p-2 rounded-full hover:bg-gray-50" title="Back to Home">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </a>

        @yield('content')
    </main>

</body>
</html>