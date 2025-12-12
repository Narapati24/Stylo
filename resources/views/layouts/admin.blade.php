<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Stylo</title>

    {{-- Vite / compiled CSS (Tailwind) --}}
    @if (app()->environment('local') || file_exists(public_path('build')))
        @vite('resources/css/app.css')
    @endif

    @livewireStyles
</head>
<body class="min-h-screen bg-bone font-sans" style="background: #FAF9F6;">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 p-6" style="background: #2C2A29; color: #FAF9F6;">
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" class="text-xl font-serif no-underline" style="color: #C5A880;">
            Stylo — Admin
        </a>
    </div>

    <nav aria-label="Main navigation">
        <ul class="space-y-2">
            @if(Route::has('admin.dashboard'))
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="block px-3 py-2 rounded-none text-sm font-medium
                              {{ request()->routeIs('admin.dashboard') ? 'text-accent' : 'text-white' }}"
                       style="color: {{ request()->routeIs('admin.dashboard') ? '#C5A880' : '#FAF9F6' }};">
                        Dashboard
                    </a>
                </li>
            @endif

            @if(Route::has('admin.products.index'))
                <li>
                    <a href="{{ route('admin.products.index') }}"
                       class="block px-3 py-2 rounded-none text-sm font-medium
                              {{ request()->routeIs('admin.products.*') ? 'text-accent' : 'text-white' }}"
                       style="color: {{ request()->routeIs('admin.products.*') ? '#C5A880' : '#FAF9F6' }};">
                        Products
                    </a>
                </li>
            @endif

            @if(Route::has('admin.products.create'))
                <li>
                    <a href="{{ route('admin.products.create') }}"
                       class="block px-3 py-2 rounded-none text-sm font-medium text-white hover:text-accent"
                       style="color: #FAF9F6;">
                        + Add Product
                    </a>
                </li>
            @endif

            {{-- Optional links: hanya tampil jika route ada --}}
            @if(Route::has('admin.categories.index'))
                <li>
                    <a href="{{ route('admin.categories.index') }}"
                       class="block px-3 py-2 rounded-none text-sm font-medium text-white hover:text-accent">
                        Categories
                    </a>
                </li>
            @endif

            @if(Route::has('admin.reports.index'))
                <li>
                    <a href="{{ route('admin.reports.index') }}"
                       class="block px-3 py-2 rounded-none text-sm font-medium text-white hover:text-accent">
                        Reports
                    </a>
                </li>
            @endif
        </ul>
    </nav>

    <div class="mt-6 border-t pt-4" style="border-color: #E8E6E1;">
        <p class="text-xs text-white/70">Signed in as</p>
        <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
    </div>
</aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <header class="mb-6 pb-4 border-b" style="border-color: #E8E6E1;">
                <h2 class="text-2xl font-serif text-primary">@yield('title', 'Dashboard')</h2>
            </header>

            @if(session('success'))
                <div class="mb-4 px-4 py-2 rounded-none" style="background: #C5A880; color: #2C2A29;">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @livewireScripts
</body>
</html>