@forelse($products as $product)
<tr class="border-b border-secondary hover:bg-bone transition-colors">
    <td class="py-4 px-4 text-gray-600">{{ $products->firstItem() + $loop->index }}</td>
    <td class="py-4 px-4">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover border border-secondary">
    </td>
    <td class="py-4 px-4 font-medium text-primary">{{ $product->name }}</td>
    <td class="py-4 px-4 text-gray-600">{{ $product->category->name ?? 'N/A' }}</td>
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
    <td colspan="6" class="py-8 text-center text-gray-500">No products found.</td>
</tr>
@endforelse
