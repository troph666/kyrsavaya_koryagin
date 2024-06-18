<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product_list', compact('products'));
    }

    public function showUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function approveProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'approved';
        $product->save();

        return redirect()->back()->with('success', 'Товар успешно подтвержден.');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->category = $request->input('category');

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $imagePath = $request->file('image')->store('public/products');
        $product->image = str_replace('public/', '', $imagePath);
    }

    $product->save();

    return redirect()->route('admin.product.index')->with('success', 'Товар успешно обновлен.');
}

}
