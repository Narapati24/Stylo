<a href="{{ $link ?? '#' }}" class="block bg-white rounded-lg shadow-sm overflow-hidden group" aria-label="{{ $title ?? 'Product' }}">
    <!-- Image area: selalu punya tinggi tetap dan placeholder background -->
    <div class="relative w-full bg-gray-50 min-h-[14rem] flex items-center justify-center overflow-hidden">
        <img
            src="{{ $image ?? 'https://via.placeholder.com/600x600' }}"
            alt="{{ $title ?? 'Product image' }}"
            loading="lazy"
            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
        >
        {{-- Badge --}}
        <span class="absolute top-3 left-3 bg-amber-400 text-amber-900 text-xs font-semibold px-2 py-1 rounded">
            New
        </span>
    </div>

    <!-- Content -->
    <div class="p-4">
        <h3 class="text-base font-medium text-gray-900 mb-1 truncate" title="{{ $title }}">{{ $title }}</h3>
        <p class="text-sm text-gray-600 mb-3 font-semibold">{{ $price }}</p>

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <button
                    type="button"
                    class="text-sm px-3 py-1 rounded-md bg-amber-100 text-amber-800 font-semibold hover:bg-amber-200 transition"
                    aria-label="Add {{ $title }} to cart"
                >
                    Add
                </button>

                <a href="{{ $link ?? '#' }}" class="text-sm text-gray-600 hover:underline" aria-label="View {{ $title }}">
                    View
                </a>
            </div>

            <div class="text-sm text-gray-400 select-none" aria-hidden="true">★ ★ ★ ★☆</div>
        </div>
    </div>
</a>