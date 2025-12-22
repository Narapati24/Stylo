<div class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer border border-gray-200">
    <img 
        src="{{ $image ?? 'https://via.placeholder.com/300x400' }}" 
        alt="{{ $title }}" 
        class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-300"
    />

    <div class="p-5 space-y-2">
        <h3 class="font-semibold text-lg text-gray-900 tracking-wide">
            {{ $title }}
        </h3>

        <p class="text-gray-900 font-bold text-xl">
            Rp {{ number_format((float) ($price ?? 0), 0, ',', '.') }}
        </p>

        <a 
            href="{{ $link ?? '#' }}" 
            class="block w-full text-center bg-black text-white font-medium py-2 rounded-lg group-hover:bg-gray-800 transition-all"
        >
            View Details
        </a>
    </div>
</div>
