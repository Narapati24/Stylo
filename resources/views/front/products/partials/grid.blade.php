@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\View;
    $hasProductComponent = View::exists('components.product-card');
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10" id="product-grid">
    @forelse($products as $product)
        @php
            $productLink = Route::has('front.product') ? route('front.product', $product->slug) : url('/product/'.$product->slug);
        @endphp

        @if($hasProductComponent)
            @include('components.product-card', [
                'id' => $product->id,
                'title' => $product->name,
                'price' => 'Rp ' . number_format($product->price),
                'image' => $product->thumbnail,
                'link'  => $productLink,
                'created_at' => $product->created_at
            ])
        @else
            {{-- Fallback sederhana dengan Tailwind jika komponen belum ada --}}
            <div class="group relative block bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-secondary/30 h-full flex-col">
                <div class="relative aspect-4/5 overflow-hidden bg-bone">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>
                <div class="p-5 flex flex-col grow">
                    <div class="mb-2 grow">
                        <h3 class="text-lg font-serif font-medium text-primary truncate">{{ $product->name }}</h3>
                        <p class="text-charcoal/60 text-sm mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        <p class="text-accent font-medium mt-1">{{ 'Rp ' . number_format($product->price) }}</p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-secondary/20">
                        <a href="{{ $productLink }}" class="w-full text-sm px-4 py-2 rounded-md bg-primary text-white font-medium hover:bg-charcoal transition inline-block text-center">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="col-span-full py-12 text-center">
            <p class="text-gray-500 text-lg">No products found in this category.</p>
            <a href="{{ route('front.home') }}" class="mt-4 inline-block text-accent hover:text-primary transition-colors font-medium">
                View all products &rarr;
            </a>
        </div>
    @endforelse
</div>