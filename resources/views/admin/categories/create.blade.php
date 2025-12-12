@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white border border-secondary p-8">
    <div class="mb-8">
        <h1 class="font-serif text-3xl text-primary mb-2">Create Category</h1>
        <p class="text-gray-500 text-sm">Add a new category to your store.</p>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                class="w-full border-secondary focus:border-primary focus:ring-0 rounded-none bg-bone px-4 py-2"
                required>
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Slug -->
        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                class="w-full border-secondary focus:border-primary focus:ring-0 rounded-none bg-bone px-4 py-2"
                required>
            @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Image -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
            <input type="file" name="image" id="image" 
                class="w-full border border-secondary p-2 rounded-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-0 file:text-sm file:font-semibold file:bg-secondary file:text-primary hover:file:bg-accent transition-colors">
            @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="4" 
                class="w-full border-secondary focus:border-primary focus:ring-0 rounded-none bg-bone px-4 py-2">{{ old('description') }}</textarea>
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Is Active -->
        <div class="flex items-center gap-2">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                class="rounded-none border-secondary text-primary focus:ring-0 w-5 h-5">
            <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-secondary">
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 text-sm font-medium text-gray-600 hover:text-primary transition-colors">Cancel</a>
            <button type="submit" class="bg-primary text-white px-8 py-2 text-sm font-medium hover:bg-accent transition-colors rounded-none">
                Save Category
            </button>
        </div>
    </form>
</div>

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
