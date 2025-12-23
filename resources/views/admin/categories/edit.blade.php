@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<x-admin.layout-form 
    title="Edit Category" 
    subtitle="Update category details."
    action="{{ route('admin.categories.update', $category) }}"
    method="PUT"
    has-files="true"
    back-url="{{ route('admin.categories.index') }}"
    submit-text="Update Category"
>
    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" 
            class="w-full border-secondary focus:border-primary focus:ring-0 rounded-none bg-bone px-4 py-2"
            required>
        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Slug -->
    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" 
            class="w-full border-secondary focus:border-primary focus:ring-0 rounded-none bg-bone px-4 py-2"
            required>
        @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Image -->
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
        @if($category->image)
            <div class="mb-2">
                <img src="{{ $category->image_url }}" alt="Current Image" class="h-20 w-auto border border-secondary">
            </div>
        @endif
        <input type="file" name="image" id="image" 
            class="w-full border border-secondary p-2 rounded-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-0 file:text-sm file:font-semibold file:bg-secondary file:text-primary hover:file:bg-accent transition-colors">
        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image.</p>
        @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="4" 
            class="w-full border-secondary focus:border-primary focus:ring-0 rounded-none bg-bone px-4 py-2">{{ old('description', $category->description) }}</textarea>
        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Is Active -->
    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
            class="rounded-none border-secondary text-primary focus:ring-0 w-5 h-5">
        <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
    </div>
</x-admin.layout-form>
@endsection
