@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <p class="text-gray-500 text-sm">Welcome back to Stylo Admin.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-white border border-secondary p-6 rounded-lg shadow-sm">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Total Products</h3>
            <p class="font-serif text-4xl text-primary">{{ $totalProducts }}</p>
            <div class="mt-4 text-xs text-gray-500 flex items-center gap-1">
                <span>Active items in catalog</span>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white border border-secondary p-6 rounded-lg shadow-sm">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Total Categories</h3>
            <p class="font-serif text-4xl text-primary">{{ $totalCategories }}</p>
            <div class="mt-4 text-xs text-gray-500 flex items-center gap-1">
                <span>Product categories</span>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white border border-secondary p-6 rounded-lg shadow-sm">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Total Customers</h3>
            <p class="font-serif text-4xl text-primary">{{ $totalUsers }}</p>
            <div class="mt-4 text-xs text-gray-500 flex items-center gap-1">
                <span>Registered users</span>
            </div>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="bg-white border border-secondary rounded-lg shadow-sm overflow-hidden">
        <div class="p-6 border-b border-secondary flex items-center justify-between">
            <h3 class="font-serif text-xl text-primary">Recently Added Products</h3>
            <a href="{{ route('admin.reports.index') }}" class="bg-primary text-white px-6 py-2 text-sm font-medium hover:bg-accent transition-colors rounded-lg">
                🗐  Download Laporan
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-bone text-gray-500 text-xs uppercase tracking-wider border-b border-secondary">
                        <th class="px-6 py-4 font-medium">Product</th>
                        <th class="px-6 py-4 font-medium">Category</th>
                        <th class="px-6 py-4 font-medium">Price</th>
                        <th class="px-6 py-4 font-medium">Stock</th>
                        <th class="px-6 py-4 font-medium text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-secondary">
                    @forelse($recentProducts as $product)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($product->thumbnail)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded-lg border border-secondary">
                                    @else
                                        <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                            No Img
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-primary">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-500">Slug: {{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="px-2 py-1 bg-bone rounded-lg text-xs border border-secondary">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-primary">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 rounded-lg text-xs font-medium {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $product->stock }} in stock
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-sm text-primary hover:text-accent font-medium transition-colors">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-secondary bg-bone text-center">
            <a href="{{ route('admin.products.index') }}" class="text-sm text-primary hover:text-accent font-medium transition-colors">View All Products &rarr;</a>
        </div>
    </div>
@endsection
