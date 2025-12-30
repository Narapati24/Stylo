@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\View;

    // Gunakan $products dari controller kalau ada, kalau tidak buat dummy 8 item
    if (!isset($products) || empty($products)) {
        $products = Collection::times(8, function ($i) {
            return (object)[
                'id'    => $i,
                'name'  => 'Product ' . $i,
                'price' => rand(50000, 500000),
                'image' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'
            ];
        });
    }

    $hasProductComponent = View::exists('components.product-card');
@endphp

<div class="bg-white">
    <!-- Hero -->
    <div class="relative bg-bone overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-bone sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-serif font-bold text-primary sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Discover Earthy</span>
                            <span class="block text-accent xl:inline">Luxury</span>
                        </h1>
                        <p class="mt-3 text-base text-charcoal/70 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Curated pieces inspired by natural textures and calm colors. Comfortable fabrics, timeless silhouettes — crafted for everyday elegance.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start gap-4">
                            <div class="rounded-md shadow">
                                <a href="{{ url('/') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-charcoal md:py-4 md:text-lg transition-colors">
                                    Shop Now
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ url('/collection') }}" class="w-full flex items-center justify-center px-8 py-3 border border-primary text-base font-medium rounded-md text-primary bg-transparent hover:bg-bone hover:text-accent md:py-4 md:text-lg transition-colors">
                                    Explore Collection
                                </a>
                            </div>
                        </div>
                        
                        <div class="mt-8 border-t border-secondary/30 pt-6">
                            <ul class="grid grid-cols-2 gap-4 text-sm text-charcoal/60">
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Free shipping over Rp 200k
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Secure payments
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    30 days returns
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Local artisans
                                </li>
                            </ul>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Woman in earthy fashion">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" id="products-section">
        <!-- Section heading -->
        <div class="flex items-end justify-between mb-8 border-b border-secondary/30 pb-4">
            <div>
                <h2 class="text-3xl font-serif font-bold text-primary">Featured Products</h2>
                <p class="mt-2 text-charcoal/60">Handpicked for your wardrobe.</p>
            </div>
            <a href="#products-section" class="hidden sm:block text-sm font-medium text-accent hover:text-primary transition-colors">
                See all products <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>

        <!-- Filter Section & Grid -->
        <div x-data="{
            activeCategory: '{{ request('category_id') }}',
            isLoading: false,
            filter(categoryId) {
                this.activeCategory = categoryId;
                this.isLoading = true;
                
                axios.get('{{ route('front.home') }}', {
                    params: {
                        category_id: categoryId,
                        partial: true
                    }
                })
                .then(response => {
                    document.getElementById('product-grid-container').innerHTML = response.data;
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    this.isLoading = false;
                });
            }
        }">
            <div class="mb-8 flex flex-wrap gap-3 items-center">
                <span class="text-sm font-medium text-charcoal">Filter:</span>
                <button @click="filter('')" 
                        :class="!activeCategory ? 'bg-primary text-white' : 'bg-bone text-charcoal border border-secondary hover:bg-secondary'"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors cursor-pointer">
                    All Products
                </button>
                @foreach($categories as $category)
                    <button @click="filter('{{ $category->id }}')" 
                            :class="activeCategory == '{{ $category->id }}' ? 'bg-primary text-white' : 'bg-bone text-charcoal border border-secondary hover:bg-secondary'"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-colors cursor-pointer">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Product Grid -->
            <section id="product-grid-container" class="transition-opacity duration-300" :class="{ 'opacity-50': isLoading }">
                @include('front.products.partials.grid')
            </section>
        </div>
    </div>
</div>
@endsection