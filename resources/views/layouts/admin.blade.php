<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stylo') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans text-primary antialiased bg-bone min-h-screen flex flex-col">
    
    <!-- Admin Navbar -->
    <nav class="bg-white border-b border-secondary px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-4">
            <a href="{{ url('/admin/dashboard') }}" class="font-serif text-2xl font-bold tracking-wide text-primary">
                Stylo <span class="text-sm font-sans font-normal text-gray-500">Admin</span>
            </a>
        </div>
        <div class="flex items-center gap-6">
            <a href="{{ url('/') }}" target="_blank" class="text-sm hover:text-accent transition-colors">View Store</a>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium">{{ Auth::user()->name ?? 'Admin' }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs font-bold uppercase tracking-wider text-red-600 hover:text-red-800">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-secondary hidden md:block min-h-full">
            <div class="py-6 px-4 space-y-2">
                <p class="px-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Master Data</p>
                
                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-secondary text-primary' : 'text-gray-600 hover:bg-bone hover:text-primary' }} transition-colors">
                    Categories
                </a>

                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-secondary text-primary' : 'text-gray-600 hover:bg-bone hover:text-primary' }} transition-colors">
                    Products
                </a>
                <!-- Add more links here -->
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-none relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-none relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @livewireScripts
</body>
</html>
