@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<x-admin.layout-crud title="Products" :create-url="route('admin.products.create')" create-text="Add New Product">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-secondary text-xs uppercase tracking-wider text-gray-500">
                <th class="py-4 px-4 font-medium">No</th>
                <th class="py-4 px-4 font-medium">Image</th>
                <th class="py-4 px-4 font-medium">Name</th>
                <th class="py-4 px-4 font-medium">Price</th>
                <th class="py-4 px-4 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse($products as $product)
            <tr class="border-b border-secondary hover:bg-bone transition-colors">
                <td class="py-4 px-4 text-gray-600">{{ $products->firstItem() + $loop->index }}</td>
                <td class="py-4 px-4">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover border border-secondary">
                </td>
                <td class="py-4 px-4 font-medium text-primary">{{ $product->name }}</td>
                <td class="py-4 px-4 text-gray-600">Rp {{ number_format($product->price) }}</td>
                <td class="py-4 px-4 text-right space-x-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-gray-600 hover:text-accent font-medium">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-8 text-center text-gray-500">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</x-admin.layout-crud>
@endsection
