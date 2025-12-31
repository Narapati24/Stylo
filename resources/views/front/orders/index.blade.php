@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 min-h-screen bg-bone">
    <h1 class="text-3xl md:text-4xl font-serif font-bold mb-10 tracking-tight text-primary border-b border-secondary pb-6">
        My Orders
    </h1>

    <div class="space-y-8">
        @forelse($orders as $order)
        <div class="bg-white border border-secondary/20 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b border-gray-100 pb-4 gap-4">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Order ID</p>
                    <p class="text-lg font-bold text-primary tracking-wide">#{{ $order->code }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full md:w-auto">
                    @if($order->status == 'PENDING')
                        <span class="px-4 py-1.5 bg-yellow-50 text-yellow-700 text-xs font-bold uppercase tracking-wider rounded-full border border-yellow-200">Pending Payment</span>
                        <div class="flex gap-3 w-full sm:w-auto">
                            @if($order->snap_token)
                                <button onclick="pay('{{ $order->snap_token }}')" class="flex-1 sm:flex-none bg-primary text-white px-6 py-2 text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors shadow-sm">
                                    Pay Now
                                </button>
                            @endif
                            <a href="{{ route('front.orders.check', $order->id) }}" class="flex-1 sm:flex-none text-center border border-gray-300 text-gray-600 px-6 py-2 text-sm font-medium rounded-lg hover:bg-gray-50 hover:text-primary transition-colors">
                                Check Status
                            </a>
                        </div>
                    @elseif($order->status == 'PAID' || $order->status == 'SUCCESS')
                        <span class="px-4 py-1.5 bg-green-50 text-green-700 text-xs font-bold uppercase tracking-wider rounded-full border border-green-200">Paid</span>
                        <a href="{{ route('front.orders.invoice', $order->id) }}" class="flex-1 sm:flex-none text-center border border-gray-300 text-gray-600 px-6 py-2 text-sm font-medium rounded-lg hover:bg-gray-50 hover:text-primary transition-colors">
                            Download Invoice
                        </a>
                    @elseif($order->status == 'CANCELLED')
                        <span class="px-4 py-1.5 bg-red-50 text-red-700 text-xs font-bold uppercase tracking-wider rounded-full border border-red-200">Cancelled</span>
                    @else
                        <span class="px-4 py-1.5 bg-gray-100 text-gray-600 text-xs font-bold uppercase tracking-wider rounded-full border border-gray-200">{{ $order->status }}</span>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                @foreach($order->items as $item)
                <div class="flex gap-6 items-center group">
                    <div class="w-20 h-24 bg-gray-100 rounded-lg overflow-hidden shrink-0 shadow-sm">
                        <img src="{{ Storage::url($item->product->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $item->product->name }}">
                    </div>
                    <div class="flex-1">
                        <h4 class="font-serif font-bold text-lg text-primary mb-1">{{ $item->product->name }}</h4>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">{{ $item->quantity }} x <span class="font-medium text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</span></p>
                            <p class="font-medium text-primary sm:hidden">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="hidden sm:block text-right">
                        <p class="font-bold text-primary">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 bg-gray-50/50 -mx-6 -mb-6 px-6 py-4 rounded-b-xl">
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span>Shipping Cost</span>
                        <span>Rp {{ number_format($order->shipping_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                        <span class="font-serif font-bold text-lg text-primary">Total Order</span>
                        <span class="font-bold text-xl text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-20 bg-white rounded-xl border border-dashed border-gray-300">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-primary mb-2">No orders found</h3>
            <p class="text-gray-500 mb-8 max-w-sm mx-auto">Looks like you haven't placed any orders yet. Start exploring our collection to find something you love.</p>
            <a href="{{ route('front.collection') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-primary hover:bg-gray-800 transition-all shadow-sm hover:shadow">
                Start Shopping
            </a>
        </div>
        @endforelse

        <!-- Pagination -->
        <div class="mt-10">
            {{ $orders->links() }}
        </div>
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
                // Error handled by toast notification in layout
                window.location.reload();
            },
            onClose: function() {
                // Do nothing
            }
        });
    }
</script>
@endsection
