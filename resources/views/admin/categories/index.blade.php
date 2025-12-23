@extends('layouts.admin')

@section('content')
<x-admin.layout-crud title="Categories" :create-url="route('admin.categories.create')" create-text="Add New">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-secondary text-xs uppercase tracking-wider text-gray-500">
                <th class="py-4 px-4 font-medium">Image</th>
                <th class="py-4 px-4 font-medium">Name</th>
                <th class="py-4 px-4 font-medium">Slug</th>
                <th class="py-4 px-4 font-medium">Status</th>
                <th class="py-4 px-4 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse($categories as $category)
            <tr class="border-b border-secondary hover:bg-bone transition-colors">
                <td class="py-4 px-4">
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-12 h-12 object-cover border border-secondary">
                </td>
                <td class="py-4 px-4 font-medium text-primary">{{ $category->name }}</td>
                <td class="py-4 px-4 text-gray-600">{{ $category->slug }}</td>
                <td class="py-4 px-4">
                    <span class="px-2 py-1 text-xs {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="py-4 px-4 text-right space-x-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-gray-600 hover:text-accent font-medium">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-8 text-center text-gray-500">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</x-admin.layout-crud>
@endsection
