@extends('layouts.app')

@section('content')
<div class="bg-bone min-h-screen" x-data="{
    search: {{ Js::from(request('search')) }},
    category: {{ Js::from(request('category')) }},
    sort: {{ Js::from(request('sort')) }},
    isLoading: false,
    mobileFiltersOpen: false,
    
    init() {
        this.$watch('search', value => this.fetchProducts());
        this.$watch('category', value => this.fetchProducts());
        this.$watch('sort', value => this.fetchProducts());
    },

    fetchProducts() {
        this.isLoading = true;
        const params = new URLSearchParams();
        if (this.search) params.append('search', this.search);
        if (this.category) params.append('category', this.category);
        if (this.sort) params.append('sort', this.sort);

        // Update URL without reload
        const url = `${window.location.pathname}?${params.toString()}`;
        window.history.pushState({}, '', url);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('product-grid-container').innerHTML = html;
        })
        .finally(() => {
            this.isLoading = false;
        });
    },
    
    setCategory(id) {
        this.category = id;
        this.mobileFiltersOpen = false;
    },

    resetFilters() {
        this.search = '';
        this.category = '';
        this.sort = '';
    }
}">
    <!-- Header -->
    <div class="relative bg-white border-b border-secondary/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 text-center">
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-primary tracking-tight mb-4">Shop Collection</h1>
            <p class="text-charcoal/60 max-w-xl mx-auto text-lg font-light leading-relaxed">
                Discover our curated selection of premium essentials, designed for the modern lifestyle.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Mobile Filter Toggle -->
        <div class="lg:hidden mb-8 flex justify-between items-center">
            <button @click="mobileFiltersOpen = !mobileFiltersOpen" class="flex items-center gap-2 px-4 py-2 bg-white border border-secondary/30 rounded-full text-sm font-medium text-primary shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                Filters
            </button>
            
            <!-- Mobile Sort -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-sm font-medium text-primary">
                    <span x-text="sort === 'newest' ? 'Newest' : (sort === 'price_asc' ? 'Price: Low to High' : (sort === 'price_desc' ? 'Price: High to Low' : 'Sort by'))">Sort by</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-secondary/10 py-1 z-50" style="display: none;">
                    <button @click="sort = 'newest'; open = false" class="block w-full text-left px-4 py-2 text-sm hover:bg-bone transition-colors" :class="{'font-bold text-primary': sort === 'newest'}">Newest</button>
                    <button @click="sort = 'price_asc'; open = false" class="block w-full text-left px-4 py-2 text-sm hover:bg-bone transition-colors" :class="{'font-bold text-primary': sort === 'price_asc'}">Price: Low to High</button>
                    <button @click="sort = 'price_desc'; open = false" class="block w-full text-left px-4 py-2 text-sm hover:bg-bone transition-colors" :class="{'font-bold text-primary': sort === 'price_desc'}">Price: High to Low</button>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 items-start">
            <!-- Sidebar Filters (Desktop) -->
            <div class="hidden lg:block w-64 shrink-0 space-y-10 sticky top-24">
                <!-- Search -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-primary mb-4">Search</h3>
                    <div class="relative group">
                        <input type="text" x-model.debounce.500ms="search" placeholder="Search products..." 
                            class="w-full bg-white border border-secondary/50 rounded-full px-4 py-3 pl-11 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all shadow-sm">
                        <div class="absolute left-4 top-3.5 text-charcoal/40 group-focus-within:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-primary mb-4">Categories</h3>
                    <div class="space-y-1">
                        <button @click="setCategory('')" 
                           class="w-full text-left flex items-center justify-between py-2 px-3 rounded-lg text-sm transition-all duration-200"
                           :class="!category ? 'bg-primary text-white shadow-md' : 'text-charcoal/70 hover:bg-white hover:text-primary hover:shadow-sm'">
                            <span>All Categories</span>
                            <span x-show="!category">&rarr;</span>
                        </button>
                        @foreach($categories as $cat)
                            <button @click="setCategory('{{ $cat->slug }}')" 
                               class="w-full text-left flex items-center justify-between py-2 px-3 rounded-lg text-sm transition-all duration-200"
                               :class="category == '{{ $cat->slug }}' ? 'bg-primary text-white shadow-md' : 'text-charcoal/70 hover:bg-white hover:text-primary hover:shadow-sm'">
                                <span>{{ $cat->name }}</span>
                                <span x-show="category == '{{ $cat->slug }}'">&rarr;</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Mobile Filters Drawer -->
            <div x-show="mobileFiltersOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="lg:hidden mb-8 bg-white p-6 rounded-2xl shadow-lg border border-secondary/20">
                 
                 <!-- Mobile Search -->
                 <div class="mb-6">
                    <label class="block text-sm font-bold uppercase tracking-widest text-primary mb-3">Search</label>
                    <div class="relative">
                        <input type="text" x-model.debounce.500ms="search" placeholder="Search products..." 
                            class="w-full bg-bone border border-secondary/50 rounded-lg px-4 py-3 pl-10 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        <div class="absolute left-3 top-3.5 text-charcoal/40">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                 </div>

                 <!-- Mobile Categories -->
                 <div>
                    <label class="block text-sm font-bold uppercase tracking-widest text-primary mb-3">Category</label>
                    <div class="flex flex-wrap gap-2">
                        <button @click="setCategory('')" 
                           class="px-4 py-2 rounded-full text-sm font-medium border transition-all"
                           :class="!category ? 'bg-primary text-white border-primary shadow-md' : 'bg-bone text-charcoal border-transparent hover:bg-white hover:border-secondary'">
                            All
                        </button>
                        @foreach($categories as $cat)
                            <button @click="setCategory('{{ $cat->slug }}')" 
                               class="px-4 py-2 rounded-full text-sm font-medium border transition-all"
                               :class="category == '{{ $cat->slug }}' ? 'bg-primary text-white border-primary shadow-md' : 'bg-bone text-charcoal border-transparent hover:bg-white hover:border-secondary'">
                                {{ $cat->name }}
                            </button>
                        @endforeach
                    </div>
                 </div>
            </div>

            <!-- Product Grid Area -->
            <div class="flex-1 min-h-screen">
                <!-- Desktop Toolbar -->
                <div class="hidden lg:flex justify-between items-center mb-8 pb-4 border-b border-secondary/30">
                    <p class="text-sm text-charcoal/60 font-light">
                        Showing results
                    </p>
                    
                    <!-- Custom Sort Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-sm font-medium text-primary hover:text-charcoal transition-colors">
                            <span x-text="sort === 'newest' ? 'Newest' : (sort === 'price_asc' ? 'Price: Low to High' : (sort === 'price_desc' ? 'Price: High to Low' : 'Sort by'))">Sort by</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-secondary/10 py-1 z-50" style="display: none;"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95">
                            <button @click="sort = 'newest'; open = false" class="block w-full text-left px-4 py-2 text-sm hover:bg-bone transition-colors" :class="{'font-bold text-primary': sort === 'newest'}">Newest</button>
                            <button @click="sort = 'price_asc'; open = false" class="block w-full text-left px-4 py-2 text-sm hover:bg-bone transition-colors" :class="{'font-bold text-primary': sort === 'price_asc'}">Price: Low to High</button>
                            <button @click="sort = 'price_desc'; open = false" class="block w-full text-left px-4 py-2 text-sm hover:bg-bone transition-colors" :class="{'font-bold text-primary': sort === 'price_desc'}">Price: High to Low</button>
                        </div>
                    </div>
                </div>

                <!-- Grid Container -->
                <div id="product-grid-container" class="transition-opacity duration-300" :class="{ 'opacity-50': isLoading }">
                    @include('front.shop.partials.product-grid')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection