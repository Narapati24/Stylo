<div class="group relative block bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-secondary/30 h-full flex-col">
    <!-- Image area -->
    <div class="relative aspect-4/5 overflow-hidden bg-bone">
        <a href="{{ $link ?? '#' }}">
            <img
                src="{{ $image ? asset('storage/'.$image) : 'https://via.placeholder.com/600x800' }}"
                alt="{{ $title ?? 'Product image' }}"
                loading="lazy"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
            >
        </a>
        
        {{-- Badge --}}
        @if(isset($created_at) && \Carbon\Carbon::parse($created_at)->gt(now()->subMonth()))
            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-primary text-xs uppercase tracking-wider font-medium px-3 py-1 rounded-full shadow-sm">
                New
            </span>
        @endif

        {{-- Quick Action Overlay (Desktop) --}}
        <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 hidden lg:block">
             <button
                type="button"
                class="w-full bg-white/95 backdrop-blur text-primary font-medium py-3 rounded-lg shadow-lg hover:bg-primary hover:text-white transition-colors flex items-center justify-center gap-2 cursor-pointer"
                aria-label="Add {{ $title }} to cart"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                </svg>
                Add to Cart
            </button>
        </div>
    </div>

    <!-- Content -->
    <div class="p-5 flex flex-col grow">
        <div class="mb-2 grow">
            <h3 class="text-lg font-serif font-medium text-primary truncate" title="{{ $title }}">
                <a href="{{ $link ?? '#' }}" class="hover:text-accent transition-colors">
                    {{ $title }}
                </a>
            </h3>
            <p class="text-accent font-medium mt-1">{{ $price }}</p>
        </div>

        <div class="flex items-center justify-between mt-4 pt-4 border-t border-secondary/20">
             {{-- Mobile Add Button (Always visible on mobile) --}}
            <button
                type="button"
                class="lg:hidden text-sm px-4 py-2 rounded-md bg-primary text-white font-medium hover:bg-charcoal transition w-full cursor-pointer"
            >
                Add to Cart
            </button>
            
            {{-- Rating --}}
            <div class="hidden lg:flex text-xs text-accent/60 gap-0.5" aria-label="4 out of 5 stars">
                @for($i=0; $i<4; $i++) <span>★</span> @endfor
                <span class="text-secondary">★</span>
            </div>
            
            <div class="hidden lg:block text-xs text-gray-400">
                In Stock
            </div>
        </div>
    </div>
</div>