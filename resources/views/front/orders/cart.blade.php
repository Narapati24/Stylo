@extends('layouts.app')

@section('content')

<div class="block relative w-full bg-white min-h-screen" x-data="checkoutHandler()">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold mb-10 tracking-tight text-gray-900 border-b pb-6">
            Checkout
        </h1>

        <!-- Error Message -->
        <div x-show="errorMessage" x-transition class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline" x-text="errorMessage"></span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="errorMessage = ''">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8 space-y-10">
                
                <section>
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-black text-white text-sm">1</span>
                        Order Items
                    </h2>
                    
                    <div class="border-t border-b border-gray-100 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                        <table class="w-full">
                            <tbody class="divide-y divide-gray-100">
                                @forelse($cartItems as $item)
                                <tr>
                                    <td class="py-4">
                                        <div class="flex gap-6">
                                            <div class="w-20 h-24 shrink-0 border border-gray-100 rounded overflow-hidden bg-gray-100">
                                                <img src="{{ Storage::url($item->product->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $item->product->name }}">
                                            </div>
                                            <div class="flex flex-col justify-between py-1">
                                                <div>
                                                    <h3 class="font-bold text-gray-900 uppercase tracking-tight">{{ $item->product->name }}</h3>
                                                    <p class="text-sm text-gray-500 mt-1">Price: Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="flex items-center justify-between w-full">
                                                    <p class="text-sm font-medium">Qty: {{ $item->quantity }}</p>
                                                    <form action="{{ route('front.cart.remove', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 underline">Remove</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 text-right align-top">
                                        <span class="font-bold text-lg text-gray-900">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="py-8 text-center text-gray-500">
                                        Your cart is empty. <a href="{{ route('front.collection') }}" class="underline text-black">Shop now</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-black text-white text-sm">2</span>
                        Shipping Address
                    </h2>

                    <form id="checkout-form" @submit.prevent="processCheckout" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-600">Receiver Name <span class="text-red-500">*</span></label>
                                <input type="text" x-model="form.name" placeholder="Enter receiver name" maxlength="50" required class="w-full border-2 border-gray-400 px-4 py-2 focus:border-black outline-none transition-all placeholder:text-gray-400">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-600">Phone Number <span class="text-red-500">*</span></label>
                                <input type="tel" x-model="form.phone" placeholder="08xxxxxxxxxx" maxlength="15" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required class="w-full border-2 border-gray-400 px-4 py-2 focus:border-black outline-none transition-all placeholder:text-gray-400">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-600">Street Address <span class="text-red-500">*</span></label>
                            <textarea x-model="form.address" rows="2" placeholder="Street Name, House Number, etc." maxlength="80" required class="w-full border-2 border-gray-400 px-4 py-2 focus:border-black outline-none transition-all resize-none placeholder:text-gray-400"></textarea>
                        </div>

                        <div class="space-y-2 relative">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-600">City / District <span class="text-red-500">*</span></label>
                            <input type="text" x-model="searchQuery" @input.debounce.500ms="searchLocation()" placeholder="Type city or district name..." class="w-full border-2 border-gray-400 px-4 py-2 focus:border-black outline-none transition-all placeholder:text-gray-400">
                            <input type="hidden" x-model="form.destination_id">
                            
                            <div x-show="locations.length > 0" @click.outside="locations = []" class="absolute z-10 w-full bg-white border border-gray-200 shadow-lg max-h-60 overflow-y-auto mt-1">
                                <template x-for="loc in locations" :key="loc.id">
                                    <div @click="selectLocation(loc)" class="p-3 hover:bg-gray-50 cursor-pointer text-sm border-b border-gray-100 last:border-0">
                                        <p class="font-bold" x-text="loc.subdistrict_name"></p>
                                        <p class="text-xs text-gray-500" x-text="loc.city_name + ', ' + loc.province_name"></p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-600">Postal Code <span class="text-red-500">*</span></label>
                            <input type="text" x-model="form.postal_code" placeholder="Postal Code" maxlength="10" required class="w-full border-2 border-gray-400 px-4 py-2 focus:border-black outline-none transition-all placeholder:text-gray-400">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-600">Courier <span class="text-red-500">*</span></label>
                            <select x-model="form.courier" @change="checkCost()" required class="w-full border-2 border-gray-400 px-4 py-2 focus:border-black outline-none transition-all bg-white">
                                <option value="">Select Courier</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS Indonesia</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>

                        <div class="space-y-2" x-show="costs.length > 0">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-600">Service <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-1 gap-3">
                                <template x-for="cost in costs" :key="cost.service">
                                    <label class="flex items-center justify-between p-3 border-2 rounded cursor-pointer hover:border-black transition-all" :class="form.service === cost.service ? 'border-black bg-gray-50' : 'border-gray-200'">
                                        <div class="flex items-center gap-3">
                                            <input type="radio" name="service" :value="cost.service" x-model="form.service" @change="selectService(cost)" class="w-4 h-4 text-black focus:ring-black">
                                            <div>
                                                <p class="font-bold text-sm" x-text="cost.service"></p>
                                                <p class="text-xs text-gray-500" x-text="cost.description + ' (' + cost.etd + ')'"></p>
                                            </div>
                                        </div>
                                        <span class="font-bold text-sm" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(cost.cost)"></span>
                                    </label>
                                </template>
                            </div>
                        </div>
                    </form>
                </section>
                
                <div class="h-32"></div>
            </div>

            <aside class="lg:col-span-4">
                <div class="sticky top-28"> 
                    <div class="bg-gray-50 p-8 border border-gray-200 shadow-md">
                        <h2 class="text-xl font-bold mb-8 uppercase tracking-tighter text-gray-900">Order Summary</h2>

                        <div class="space-y-4 text-sm pb-8 border-b border-gray-200">
                            <div class="flex justify-between text-gray-600">
                                <span>Item's total ({{ $cartItems->count() }} items)</span>
                                <span>Rp {{ number_format($total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="text-gray-400 italic font-medium" x-text="form.shipping_cost > 0 ? 'Rp ' + new Intl.NumberFormat('id-ID').format(form.shipping_cost) : 'TBD'">TBD</span>
                            </div>
                        </div>

                        <div class="flex justify-between font-bold text-xl py-8 text-gray-900">
                            <span>Order Total</span>
                            <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal)">Rp {{ number_format($total_price, 0, ',', '.') }}</span>
                        </div>

                        <button form="checkout-form" :disabled="loading || !form.service" class="w-full bg-black text-white py-5 font-bold hover:bg-gray-800 transition-all uppercase tracking-widest text-sm active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                            <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="loading ? 'Processing...' : 'Confirm Order'">Confirm Order</span>
                        </button>

                        <p class="text-[10px] text-gray-400 mt-6 text-center leading-relaxed italic">
                            By confirming your order, you agree to our Terms and Conditions.
                        </p>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    function checkoutHandler() {
        return {
            searchQuery: '',
            locations: [],
            costs: [],
            loading: false,
            totalPrice: {{ $total_price }},
            grandTotal: {{ $total_price }},
            form: {
                name: '{{ Auth::user()->name }}',
                address: '',
                destination_id: '',
                province_name: '',
                city_name: '',
                subdistrict_name: '',
                postal_code: '',
                phone: '',
                courier: '',
                service: '',
                shipping_cost: 0
            },

            errorMessage: '',

            searchLocation() {
                if (this.searchQuery.length < 3) return;
                
                this.loading = true;
                this.errorMessage = '';
                fetch(`{{ route('front.api.locations') }}?q=${this.searchQuery}`)
                .then(res => res.json())
                .then(data => {
                    this.locations = data;
                })
                .finally(() => this.loading = false);
            },

            selectLocation(loc) {
                this.form.destination_id = loc.id;
                this.form.province_name = loc.province_name;
                this.form.city_name = loc.city_name;
                this.form.subdistrict_name = loc.subdistrict_name;
                this.form.postal_code = loc.zip_code; // Auto fill zip code
                
                this.searchQuery = `${loc.subdistrict_name}, ${loc.city_name}, ${loc.province_name}`;
                this.locations = [];
                this.checkCost();
            },

            checkCost() {
                if (!this.form.destination_id || !this.form.courier) return;

                this.loading = true;
                this.errorMessage = '';
                fetch('{{ route('front.api.shipping-cost') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        destination_id: this.form.destination_id,
                        courier: this.form.courier
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // API V2 returns flat array of costs
                    if (Array.isArray(data)) {
                        this.costs = data;
                    } else {
                        this.costs = [];
                    }
                })
                .finally(() => this.loading = false);
            },

            selectService(cost) {
                this.form.shipping_cost = cost.cost;
                this.grandTotal = this.totalPrice + this.form.shipping_cost;
            },

            processCheckout() {
                this.loading = true;
                this.errorMessage = '';
                
                fetch('{{ route('front.checkout.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.form)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        this.errorMessage = data.error;
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        return;
                    }

                    if (data.snap_token) {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                window.location.href = '{{ route('front.orders.index') }}'; // Redirect to orders page
                            },
                            onPending: function(result) {
                                window.location.href = '{{ route('front.orders.index') }}';
                            },
                            onError: function(result) {
                                this.errorMessage = "Payment failed!";
                            },
                            onClose: function() {
                                window.location.href = '{{ route('front.orders.index') }}';
                            }
                        });
                    } else {
                        this.errorMessage = 'Something went wrong! Please try again.';
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                })
                .catch(err => {
                    console.error(err);
                    this.errorMessage = 'Error processing checkout. Please check your connection and try again.';
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                })
                .finally(() => this.loading = false);
            }
        }
    }
</script>

@endsection
