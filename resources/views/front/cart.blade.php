@extends('layouts.app')

@section('content')

<div class="block relative w-full bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold mb-10 tracking-tight text-gray-900 border-b pb-6">
            Checkout
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-8 space-y-16">
                
                <section>
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-black text-white text-sm">1</span>
                        Order Items
                    </h2>
                    
                    <div class="border-t border-b border-gray-100">
                        <table class="w-full">
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="py-8">
                                        <div class="flex gap-6">
                                            <div class="w-24 h-32 flex-shrink-0 border border-gray-100 rounded overflow-hidden bg-gray-100">
                                                <img src="{{ asset('images/placeholder-product-1.png') }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex flex-col justify-between py-1">
                                                <div>
                                                    <h3 class="font-bold text-gray-900 uppercase tracking-tight">White Long Tee</h3>
                                                    <p class="text-sm text-gray-500 mt-1">Color: White | Size: M</p>
                                                </div>
                                                <p class="text-sm font-medium">Qty: 1</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-8 text-right align-top">
                                        <span class="font-bold text-lg text-gray-900">Rp 100.000</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-8">
                                        <div class="flex gap-6">
                                            <div class="w-24 h-32 flex-shrink-0 border border-gray-100 rounded overflow-hidden bg-gray-100">
                                                <img src="{{ asset('images/placeholder-product-2.png') }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex flex-col justify-between py-1">
                                                <div>
                                                    <h3 class="font-bold text-gray-900 uppercase tracking-tight">Essential Hoodie</h3>
                                                    <p class="text-sm text-gray-500 mt-1">Color: Black | Size: M</p>
                                                </div>
                                                <p class="text-sm font-medium">Qty: 1</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-8 text-right align-top">
                                        <span class="font-bold text-lg text-gray-900">Rp 100.000</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-black text-white text-sm">2</span>
                        Shipping Address
                    </h2>

                    <form id="checkout-form" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-600">First Name <span class="text-red-500">*</span></label>
                                <input type="text" placeholder="Enter first name" maxlength="15" required class="w-full border-2 border-gray-400 px-4 py-3 focus:border-black outline-none transition-all placeholder:text-gray-400">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-600">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" placeholder="Enter last name" maxlength="30" required class="w-full border-2 border-gray-400 px-4 py-3 focus:border-black outline-none transition-all placeholder:text-gray-400">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-600">Street Address <span class="text-red-500">*</span></label>
                            <textarea rows="3" placeholder="Street Name, House Number, etc." maxlength="80" required class="w-full border-2 border-gray-400 px-4 py-3 focus:border-black outline-none transition-all resize-none placeholder:text-gray-400"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-600">City <span class="text-red-500">*</span></label>
                                <input type="text" placeholder="e.g. Jakarta" maxlength="50" required class="w-full border-2 border-gray-400 px-4 py-3 focus:border-black outline-none transition-all placeholder:text-gray-400">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-600">Phone Number <span class="text-red-500">*</span></label>
                                <input type="tel" placeholder="08xxxxxxxxxx" maxlength="13" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required class="w-full border-2 border-gray-400 px-4 py-3 focus:border-black outline-none transition-all placeholder:text-gray-400">
                            </div>
                        </div>
                    </form>
                </section>
                
                <div class="h-32"></div>
            </div>

            <aside class="lg:col-span-4">
                <div class="sticky top-10"> 
                    <div class="bg-gray-50 p-8 border border-gray-200 shadow-md">
                        <h2 class="text-xl font-bold mb-8 uppercase tracking-tighter text-gray-900">Order Summary</h2>

                        <div class="space-y-4 text-sm pb-8 border-b border-gray-200">
                            <div class="flex justify-between text-gray-600">
                                <span>Item's total (2 items)</span>
                                <span>Rp 200.000</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="text-gray-400 italic font-medium">TBD</span>
                            </div>
                        </div>

                        <div class="flex justify-between font-bold text-xl py-8 text-gray-900">
                            <span>Order Total</span>
                            <span>Rp 200.000</span>
                        </div>

                        <button form="checkout-form" class="w-full bg-black text-white py-5 font-bold hover:bg-gray-800 transition-all uppercase tracking-widest text-sm active:scale-[0.98]">
                            Confirm Order
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

@endsection
