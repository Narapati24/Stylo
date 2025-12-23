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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>
<body class="font-sans text-primary antialiased bg-bone min-h-screen flex flex-col" x-data="{ searchOpen: false }">
    
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
                <button @click="searchOpen = !searchOpen" class="hover:text-accent transition-colors focus:outline-none">
                    <span class="sr-only">Search</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
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

        <!-- Search Overlay -->
        <div x-show="searchOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="absolute top-full left-0 w-full bg-white border-b border-secondary shadow-lg z-40 p-4"
             style="display: none;">
            <div class="max-w-3xl mx-auto" x-data="{
                query: '',
                results: [],
                search() {
                    if (this.query.length < 2) {
                        this.results = [];
                        return;
                    }
                    axios.get('{{ route('front.home') }}', { params: { search: this.query } })
                        .then(response => {
                            this.results = response.data.products;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            }">
                <div class="relative">
                    <input x-model="query" 
                           @input.debounce.300ms="search()"
                           type="text" 
                           placeholder="Search for products..." 
                           class="w-full px-4 py-3 rounded-lg border border-secondary focus:border-primary focus:ring-0 bg-bone"
                           autofocus
                    >
                    <button @click="searchOpen = false" class="absolute right-3 top-3 text-gray-400 hover:text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Search Results -->
                <div x-show="results.length > 0" class="mt-4">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Products</h3>
                    <div class="grid grid-cols-1 gap-2">
                        <template x-for="product in results" :key="product.id">
                            <a :href="product.url" class="flex items-center gap-4 p-2 hover:bg-bone rounded-lg transition-colors">
                                <img :src="product.image_url" :alt="product.name" class="w-12 h-12 object-cover rounded-md">
                                <div>
                                    <h4 class="text-sm font-medium text-primary" x-text="product.name"></h4>
                                    <p class="text-xs text-accent font-bold" x-text="'Rp ' + product.price"></p>
                                </div>
                            </a>
                        </template>
                    </div>
                    <div class="mt-4 text-center">
                        <a :href="'{{ route('front.home') }}?search=' + query" class="text-xs text-primary hover:underline">View all results</a>
                    </div>
                </div>
                
                <div x-show="query.length >= 2 && results.length === 0" class="mt-4 text-center text-gray-500 text-sm">
                    No products found.
                </div>
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
