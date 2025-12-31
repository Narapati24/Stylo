@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 min-h-screen">
    <h1 class="text-3xl font-bold mb-10 tracking-tight text-gray-900 border-b pb-6">
        My Orders
    </h1>

    @if(session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    @if(session('warning'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('warning') }}</span>
        </div>
    @endif

    <div class="space-y-8">
        @forelse($orders as $order)
        <div class="bg-white border border-gray-200 p-6 rounded-lg shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b border-gray-100 pb-4">
                <div>
                    <p class="text-sm text-gray-500">Order ID: <span class="font-bold text-gray-900">{{ $order->code }}</span></p>
                    <p class="text-sm text-gray-500">Date: {{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="mt-4 md:mt-0 flex items-center gap-4">
                    @if($order->status == 'PENDING')
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold uppercase tracking-wider rounded-full">Pending</span>
                        <div class="flex gap-2">
                            @if($order->snap_token)
                                <button onclick="pay('{{ $order->snap_token }}')" class="bg-black text-white px-4 py-2 text-sm font-bold uppercase tracking-wider hover:bg-gray-800 transition-all">
                                    Pay Now
                                </button>
                            @endif
                            <a href="{{ route('front.orders.check', $order->id) }}" class="bg-gray-200 text-gray-800 px-4 py-2 text-sm font-bold uppercase tracking-wider hover:bg-gray-300 transition-all rounded">
                                Check Status
                            </a>
                        </div>
                    @elseif($order->status == 'PAID' || $order->status == 'SUCCESS')
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-bold uppercase tracking-wider rounded-full">Paid</span>
                    @elseif($order->status == 'CANCELLED')
                        <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-bold uppercase tracking-wider rounded-full">Cancelled</span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-bold uppercase tracking-wider rounded-full">{{ $order->status }}</span>
                    @endif
                </div>
            </div>

            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex gap-4 items-center">
                    <div class="w-16 h-20 bg-gray-100 rounded overflow-hidden shrink-0">
                        <img src="{{ Storage::url($item->product->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $item->product->name }}">
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">{{ $item->product->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center">
                <p class="text-sm text-gray-500">Shipping: Rp {{ number_format($order->shipping_price, 0, ',', '.') }}</p>
                <p class="text-lg font-bold text-gray-900">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>
        </div>
        @empty
        <div class="text-center py-12">
            <p class="text-gray-500 mb-4">You haven't placed any orders yet.</p>
            <a href="{{ route('front.collection') }}" class="inline-block bg-black text-white px-6 py-3 font-bold uppercase tracking-wider hover:bg-gray-800 transition-all">
                Start Shopping
            </a>
        </div>
        @endforelse
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    function pay(snapToken) {
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                window.location.reload();
            },
            onPending: function(result) {
                window.location.reload();
            },
            onError: function(result) {
                alert("Payment failed!");
            },
            onClose: function() {
                // Do nothing
            }
        });
    }
</script>
@endsection
