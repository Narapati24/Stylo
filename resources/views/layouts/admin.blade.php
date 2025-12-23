<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Stylo</title>

    {{-- Vite / compiled CSS (Tailwind) --}}
    @if (app()->environment('local') || file_exists(public_path('build')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
</head>
<body class="min-h-screen bg-bone font-sans" style="background: #FAF9F6;" x-data="{ sidebarOpen: false }">
    
    {{-- Admin Top Navbar --}}
    <nav class="sticky top-0 z-50 shadow-md bg-white border-b border-secondary">
        <div class="flex justify-between items-center px-4 md:px-8 py-3">
            <div class="flex items-center gap-4">
                <!-- Mobile Menu Button -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-primary focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin/dashboard') }}" class="font-serif text-2xl font-bold tracking-wide text-primary no-underline">
                    Stylo <span class="text-sm font-sans font-normal text-gray-500">Admin</span>
                </a>
            </div>
            <div class="flex items-center gap-6">
                
                {{-- transition-colors dan hover style secara eksplisit --}}
                <a href="{{ url('/') }}" target="_blank" 
                   class="text-sm **transition-colors**" 
                   style="color: #2C2A29; text-decoration:none;"
                   onmouseover="this.style.color='#C5A880'"
                   onmouseout="this.style.color='#2C2A29'">
                   View Store
                </a>
                
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium" style="color: #2C2A29;">{{ Auth::user()->name ?? 'Admin' }}</span>
                    
                    <form method="POST" action="{{ Route::has('logout') ? route('logout') : url('/logout') }}">
                        @csrf
                        <button type="submit" class="text-xs font-bold uppercase tracking-wider **transition-colors**" 
                                style="background:none; border:none; color: #DC2626; cursor:pointer;"
                                onmouseover="this.style.color='#991B1B'"
                                onmouseout="this.style.color='#DC2626'">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>


    {{--Struktur Utama Konten--}}
    <div class="flex flex-1 relative">
        
        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
             style="display: none;">
        </div>

        {{-- Sidebar Gelap --}}
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
            class="fixed md:sticky top-0 md:top-[61px] left-0 z-50 w-64 h-screen md:h-[calc(100vh-61px)] p-6 transition-transform duration-300 ease-in-out flex flex-col shadow-lg md:shadow-none overflow-y-auto"
            style="background: #2C2A29; color: #FAF9F6;">
            
            <div class="flex-grow">
                <nav aria-label="Main navigation">
                    {{--Navigasi Sidebar--}}
                    <ul class="space-y-1">
                        
                        {{-- Dashboard --}}
                        <li>
                            <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin/dashboard') }}"
                               class="block px-3 py-2 text-sm font-medium transition-colors rounded-md"
                               style="background: {{ request()->routeIs('admin.dashboard') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}; color: {{ request()->routeIs('admin.dashboard') ? '#C5A880' : '#FAF9F6' }}; text-decoration:none;"
                               onmouseover="this.style.background='rgba(255, 255, 255, 0.05)'"
                               onmouseout="this.style.background='{{ request()->routeIs('admin.dashboard') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}'">
                                Dashboard
                            </a>
                        </li>
                        {{-- Products --}}
                        <li>
                            <a href="{{ Route::has('admin.products.index') ? route('admin.products.index') : url('/admin/products') }}"
                               class="block px-3 py-2 text-sm font-medium transition-colors rounded-md"
                               style="background: {{ request()->routeIs('admin.products.*') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}; color: {{ request()->routeIs('admin.products.*') ? '#C5A880' : '#FAF9F6' }}; text-decoration:none;"
                               onmouseover="this.style.background='rgba(255, 255, 255, 0.05)'"
                               onmouseout="this.style.background='{{ request()->routeIs('admin.products.*') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}'">
                                Products
                            </a>
                        </li>
                        {{-- Categories --}}
                        @if(Route::has('admin.categories.index'))
                            <li>
                                <a href="{{ route('admin.categories.index') }}"
                                   class="block px-3 py-2 text-sm font-medium transition-colors rounded-md"
                                   style="background: {{ request()->routeIs('admin.categories.*') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}; color: {{ request()->routeIs('admin.categories.*') ? '#C5A880' : '#FAF9F6' }}; text-decoration:none;"
                                   onmouseover="this.style.background='rgba(255, 255, 255, 0.05)'"
                                   onmouseout="this.style.background='{{ request()->routeIs('admin.categories.*') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}'">
                                    Categories
                                </a>
                            </li>
                        @endif
                        {{-- Reports --}}
                        @if(Route::has('admin.reports.index'))
                            <li>
                                <a href="{{ route('admin.reports.index') }}"
                                   class="block px-3 py-2 text-sm font-medium transition-colors rounded-md"
                                   style="background: {{ request()->routeIs('admin.reports.*') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}; color: {{ request()->routeIs('admin.reports.*') ? '#C5A880' : '#FAF9F6' }}; text-decoration:none;"
                                   onmouseover="this.style.background='rgba(255, 255, 255, 0.05)'"
                                   onmouseout="this.style.background='{{ request()->routeIs('admin.reports.*') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}'">
                                    Reports
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>


            {{-- Signed in as (Bottom Section) --}}
            <div class="mt-6 border-t border-gray-700 pt-4 mt-auto">
                <p class="text-xs text-gray-400 mb-1">Signed in as</p>
                <p class="text-sm font-medium mb-2">{{ auth()->user()->name ?? 'Admin' }}</p>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-4 md:p-8 w-full max-w-full overflow-x-hidden">
            
            <div class="bg-white shadow-sm rounded-lg p-4 md:p-6">
                <header class="mb-6 pb-4 border-b border-secondary">
                    <h2 class="text-2xl font-serif text-primary">@yield('title', 'Dashboard')</h2>
                </header>

                {{-- SUCCESS Flash Message --}}
                @if(session('success'))
                    <div class="mb-4 px-4 py-2" style="background: #C5A880; color: #2C2A29; border-radius:4px;">
                        {{ session('success') }}
                    </div>
                @endif
                
                {{-- ERROR Flash Message --}}
                @if (session('error'))
                    <div class="mb-4 px-4 py-2" style="background: #FEE2E2; color: #991B1B; border: 1px solid #FCA5A5; border-radius:4px;">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>