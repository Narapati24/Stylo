@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-3xl font-bold mb-4 text-gray-900">{{ $product->name }}</h1>
                <p class="text-2xl text-primary font-medium mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ $product->description ?? 'No description available.' }}
                </p>
                
                <div x-data="{ 
                    loading: false,
                    addToCart() {
                        this.loading = true;
                        fetch('{{ route('front.cart.add', $product->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => {
                            if (response.status === 401) {
                                window.location.href = '{{ route('login') }}';
                                return;
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data && data.success) {
                                window.dispatchEvent(new CustomEvent('notify', { 
                                    detail: { message: data.success, type: 'success' } 
                                }));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            window.dispatchEvent(new CustomEvent('notify', { 
                                detail: { message: 'Something went wrong', type: 'error' } 
                            }));
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                    }
                }">
                    <button 
                        @click="addToCart()"
                        :disabled="loading"
                        class="bg-black text-white px-8 py-4 rounded-md font-bold hover:bg-gray-800 transition-colors w-full md:w-auto flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed"
                    >
                        <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="loading ? 'Adding...' : 'Add to Cart'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
