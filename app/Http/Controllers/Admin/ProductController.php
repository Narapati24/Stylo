<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        // Validation logic here
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        return view('admin.products.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
