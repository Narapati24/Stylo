@if($products->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10">
        @foreach($products as $product)
            @include('components.product-card', [
                'id' => $product->id,
                'title' => $product->name,
                'price' => 'Rp ' . number_format($product->price, 0, ',', '.'),
                'image' => $product->thumbnail,
                'link' => route('front.product', $product->slug),
                'created_at' => $product->created_at
            ])
        @endforeach
    </div>

    <div class="mt-12">
        {{ $products->links() }}
    </div>
@else
    <div class="text-center py-24 bg-white rounded-3xl border border-secondary/20 shadow-sm">
        <div class="w-20 h-20 bg-bone rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-serif font-bold text-primary mb-3">No matches found</h3>
        <p class="text-charcoal/60 mb-8 max-w-md mx-auto">We couldn't find any products matching your current filters. Try checking for typos or using different keywords.</p>
        <button @click="resetFilters()" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full hover:bg-charcoal transition-colors duration-300 shadow-lg shadow-primary/20">
            <span>Clear all filters</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
@endif