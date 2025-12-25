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
                'image' => 'https://via.placeholder.com/600x600'
            ];
        });
    }

    $hasProductComponent = View::exists('components.product-card');
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Hero -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center mb-12">
        <div>
            <h1 class="text-4xl sm:text-5xl font-serif text-gray-900 mb-4">
                Discover Earthy Luxury
            </h1>
            <p class="text-gray-600 mb-6 max-w-xl">
                Curated pieces inspired by natural textures and calm colors. Comfortable fabrics, timeless silhouettes — crafted for everyday elegance.
            </p>

            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="inline-flex items-center px-5 py-3 bg-amber-400 text-amber-900 font-semibold rounded-md shadow hover:bg-amber-300 transition">
                    Shop Now
                </a>

                <a href="{{ Route::has('front.product') ? route('front.product', $products->first()->id) : url('/product/1') }}" class="text-sm text-gray-600 hover:underline">
                    Explore collection →
                </a>
            </div>

            <ul class="mt-8 grid grid-cols-2 gap-2 text-sm text-gray-500">
                <li>Free shipping over Rp 200.000</li>
                <li>Secure payments</li>
                <li>30 days returns</li>
                <li>Local artisans</li>
            </ul>
        </div>

        <div class="order-first lg:order-last">
            <div class="rounded-lg overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/..." alt="Model wearing Stylo" loading="lazy" class="w-full h-80 object-cover rounded-lg">
            </div>
        </div>
    </section>

    <!-- Section heading -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">Featured Products</h2>
        <a href="#" class="text-sm text-gray-600 hover:underline">See all</a>
    </div>

    <!-- Product Grid -->
    <section>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                @php
                    $productLink = Route::has('front.product') ? route('front.product', $product->id) : url('/product/'.$product->id);
                @endphp

                @if($hasProductComponent)
                    @include('components.product-card', [
                        'title' => $product->name,
                        'price' => 'Rp ' . number_format($product->price),
                        'image' => $product->image,
                        'link'  => $productLink
                    ])
                @else
                    {{-- Fallback sederhana dengan Tailwind jika komponen belum ada --}}
                    <a href="{{ $productLink }}" class="block bg-white rounded-lg shadow-sm overflow-hidden group">
                        <div class="relative">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                        </div>
                        <div class="p-4">
                            <h3 class="text-base font-medium text-gray-900 mb-1 truncate">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-3 font-semibold">{{ 'Rp ' . number_format($product->price) }}</p>
                            <div class="flex items-center justify-between">
                                <button type="button" class="text-sm px-3 py-1 rounded-md bg-amber-100 text-amber-800 font-semibold hover:bg-amber-200 transition">
                                    Add
                                </button>
                                <span class="text-sm text-gray-400">★ ★ ★ ★☆</span>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </section>
</div>
@endsection