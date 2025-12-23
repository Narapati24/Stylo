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
<body class="min-h-screen bg-bone font-sans" style="background: #FAF9F6;">
    
    {{-- Admin Top Navbar --}}
    <nav class="sticky top-0 z-50 shadow-md" style="background: #FFF; border-bottom: 1px solid #E8E6E1;">
        <div class="flex justify-between items-center px-8 py-3">
            <div class="flex items-center gap-4">
                <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin/dashboard') }}" class="font-serif text-2xl font-bold tracking-wide" style="color: #2C2A29; text-decoration:none;">
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
    <div class="flex flex-1" style="align-items:flex-start; overflow:visible; gap:0;">
        
        {{-- Sidebar Gelap --}}
        <aside
            class="w-64 p-6"
            style="background: #2C2A29; color: #FAF9F6; position:sticky; top:60px; z-index:50; min-height:calc(100vh - 60px); box-shadow: 0 2px 8px rgba(0,0,0,0.06); pointer-events:auto; display: flex; flex-direction: column;">
            
            <div style="flex-grow: 1;">
                <nav aria-label="Main navigation">
                    {{--Navigasi Sidebar--}}
                    <ul style="list-style:none; padding:0; margin:0; display:block;">
                        
                        {{-- Dashboard --}}
                        <li>
                            <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin/dashboard') }}"
                               class="block px-3 py-2 text-sm font-medium transition-colors"
                               style="background: {{ request()->routeIs('admin.dashboard') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}; color: {{ request()->routeIs('admin.dashboard') ? '#C5A880' : '#FAF9F6' }}; text-decoration:none;"
                               onmouseover="this.style.background='rgba(255, 255, 255, 0.05)'"
                               onmouseout="this.style.background='{{ request()->routeIs('admin.dashboard') ? 'rgba(197, 168, 128, 0.1)' : 'transparent' }}'">
                                Dashboard
                            </a>
                        </li>
                        {{-- Products --}}
                        <li>
                            <a href="{{ Route::has('admin.products.index') ? route('admin.products.index') : url('/admin/products') }}"
                               class="block px-3 py-2 text-sm font-medium transition-colors"
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
                                   class="block px-3 py-2 text-sm font-medium transition-colors"
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
                                   class="block px-3 py-2 text-sm font-medium transition-colors"
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
            <div class="mt-6 border-t pt-4" style="border-color: #E8E6E1; margin-top: auto;">
                <p class="text-xs" style="color: rgba(255,255,255,0.75); margin:0 0 6px 0;">Signed in as</p>
                <p class="text-sm font-medium" style="margin:0 0 8px 0;">{{ auth()->user()->name ?? 'Admin' }}</p>

                <div class="w-full text-left px-3 py-2 text-sm" style="opacity:0; pointer-events:none; height:40px;">
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-8">
            
            <div class="bg-white shadow-sm" style="background:#fff; border-radius:8px; padding:24px; overflow:visible;">
                <header class="mb-6 pb-4" style="border-bottom: 1px solid #E8E6E1; margin-bottom:24px; padding-bottom:16px;">
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