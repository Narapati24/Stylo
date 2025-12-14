@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
        @csrf

        <!-- Name -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Product Name</label>
            <input type="text" name="name" id="name" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <!-- slug -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                class="w-full border-secondary focus:border-primary focus:ring-0 rounded-none bg-bone px-4 py-2"
                required>
            @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Category -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Category</label>

            <select name="category_id"
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"
                    required>
                <option value="">-- Select Category --</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Price -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Price</label>
            <input type="number" name="price" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <!-- Stock -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Stock</label>
            <input type="number" name="stock" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <!-- Description -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Description</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
        </div>

        <!-- Thumbnail -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Thumbnail</label>
            <input type="file" name="thumbnail">
        </div>

        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Save Product</button>
    </form>

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


