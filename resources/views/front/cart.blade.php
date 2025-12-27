@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-center">Price</th>
                        <th class="py-3 px-6 text-center">Quantity</th>
                        <th class="py-3 px-6 text-center">Total</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($cart as $id => $details)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img class="w-12 h-12 rounded-full object-cover" src="{{ Storage::url($details['thumbnail']) }}" alt="{{ $details['name'] }}">
                                    </div>
                                    <span class="font-medium">{{ $details['name'] }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                Rp {{ number_format($details['price'], 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                {{ $details['quantity'] }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <form action="{{ route('front.cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="flex justify-between items-center mt-6">
            <div class="text-xl font-bold">
                Total: Rp {{ number_format($total_price, 0, ',', '.') }}
            </div>
            <div>
                <a href="{{ route('front.home') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Continue Shopping
                </a>
                <a href="{{ route('front.checkout') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Checkout
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500 text-lg mb-4">Your cart is empty.</p>
            <a href="{{ route('front.home') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
