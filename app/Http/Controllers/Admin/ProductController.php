<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Products::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->has('category') && $request->get('category') !== '') {
            $category = $request->get('category');
            $query->where('category_id', $category);
        }

        $products = $query->latest()->paginate(10);

        if ($request->has('search')) {
            $products->appends(['search' => $request->get('search')]);
        }

        if ($request->has('category')) {
            $products->appends(['category' => $request->get('category')]);
        }

        $categories = Category::orderBy('name')->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.products.partials.table-rows', compact('products'))->render(),
                'pagination' => $products->links()->toHtml()
            ]);
        }

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']) . '-' . time();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('products', 'public');
        }

        Products::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Products $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Products $product)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']) . '-' . time();

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')
                ->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Products $product)
    {
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function dashboard()
    {
        $totalProducts = Products::count();
        return view('admin.dashboard', compact('totalProducts'));
    }
}
