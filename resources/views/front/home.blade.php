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
                                <a href="{{ url('/') }}" class="w-full flex items-center justify-center px-8 py-3 border border-primary text-base font-medium rounded-md text-primary bg-transparent hover:bg-bone hover:text-accent md:py-4 md:text-lg transition-colors">
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section heading -->
        <div class="flex items-end justify-between mb-8 border-b border-secondary/30 pb-4">
            <div>
                <h2 class="text-3xl font-serif font-bold text-primary">Featured Products</h2>
                <p class="mt-2 text-charcoal/60">Handpicked for your wardrobe.</p>
            </div>
            <a href="#" class="hidden sm:block text-sm font-medium text-accent hover:text-primary transition-colors">
                See all products <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>

        <!-- Product Grid -->
        <section>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10">
                @foreach($products as $product)
                    @php
                        $productLink = Route::has('front.product') ? route('front.product', $product->id) : url('/product/'.$product->id);
                    @endphp

                    @if($hasProductComponent)
                        @include('components.product-card', [
                            'title' => $product->name,
                            'price' => 'Rp ' . number_format($product->price),
                            'image' => $product->thumbnail,
                            'link'  => $productLink
                        ])
                    @else
                        {{-- Fallback sederhana dengan Tailwind jika komponen belum ada --}}
                        <div class="group relative block bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-secondary/30 h-full flex flex-col">
                            <div class="relative aspect-[4/5] overflow-hidden bg-bone">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            </div>
                            <div class="p-5 flex flex-col flex-grow">
                                <div class="mb-2 flex-grow">
                                    <h3 class="text-lg font-serif font-medium text-primary truncate">{{ $product->name }}</h3>
                                    <p class="text-accent font-medium mt-1">{{ 'Rp ' . number_format($product->price) }}</p>
                                </div>
                                <div class="mt-4 pt-4 border-t border-secondary/20">
                                    <button type="button" class="w-full text-sm px-4 py-2 rounded-md bg-primary text-white font-medium hover:bg-charcoal transition">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            
            <div class="mt-8 text-center sm:hidden">
                <a href="#" class="text-sm font-medium text-accent hover:text-primary transition-colors">
                    See all products <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </section>
    </div>
</div>
@endsection