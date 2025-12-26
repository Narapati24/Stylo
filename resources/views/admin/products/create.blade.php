@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
<x-admin.layout-form 
    title="Create Product" 
    subtitle="Add a new product to your catalog."
    action="{{ route('admin.products.store') }}"
    has-files="true"
    back-url="{{ route('admin.products.index') }}"
    submit-text="Save Product"
>
    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" 
            class="w-full border-secondary focus:border-primary focus:ring-0 rounded-lg bg-bone px-4 py-2"
            required>
        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Slug -->
    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
            class="w-full border-secondary focus:border-primary focus:ring-0 rounded-lg bg-bone px-4 py-2"
            required>
        @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Category -->
    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
        <select name="category_id" id="category_id" 
            class="w-full border-secondary focus:border-primary focus:ring-0 rounded-lg bg-bone px-4 py-2"
            required>
            <option value="">-- Select Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Price -->
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
        <input type="number" name="price" id="price" value="{{ old('price') }}" 
            class="w-full border-secondary focus:border-primary focus:ring-0 rounded-lg bg-bone px-4 py-2"
            required>
        @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Stock -->
    <div>
        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock') }}" 
            class="w-full border-secondary focus:border-primary focus:ring-0 rounded-lg bg-bone px-4 py-2"
            required>
        @error('stock') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="4" 
            class="w-full border-secondary focus:border-primary focus:ring-0 rounded-lg bg-bone px-4 py-2">{{ old('description') }}</textarea>
        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Thumbnail -->
    <div>
        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Thumbnail</label>
        <input type="file" name="thumbnail" id="thumbnail" 
            class="w-full border border-secondary p-2 rounded-lg text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-secondary file:text-primary hover:file:bg-accent transition-colors">
        @error('thumbnail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
</x-admin.layout-form>

<script>
    // Simple slug generator
    document.getElementById('name').addEventListener('input', function(e) {
        let slug = e.target.value.toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection


