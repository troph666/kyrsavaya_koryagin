<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Необходимо войти в систему, чтобы добавить продукт.');
        }
    
        $validatedData = $request->validate([
            'product-name' => 'required|string|max:255',
            'product-description' => 'required|string',
            'product-price' => 'required|numeric',
            'product-category' => 'required|string',
        ]);

        $product = new Product();
        $product->name = $validatedData['product-name'];
        $product->description = $validatedData['product-description'];
        $product->price = $validatedData['product-price'];
        $product->category = $validatedData['product-category'];
        $product->status = 'pending';
    
        if (Auth::check()) {
            $product->seller_id = Auth::id();
            $product->user_id = Auth::id();
            $product->seller_name = Auth::user()->name;
        }
    
        if ($request->hasFile('product-image')) {
            $image = $request->file('product-image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image = 'images/' . $imageName;
        }
    
        $product->save();
    
        return redirect()->route('seller.products')->with('success', 'Товар успешно добавлен и ожидает подтверждения администратором.');
    }

    public function changeStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'approved';
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Товар подтвержден.');
    }

    public function rejectProduct(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $product = Product::findOrFail($id);
        $product->status = 'rejected';
        $product->rejection_reason = $request->rejection_reason;
        $product->save();

        return redirect()->back()->with('success', 'Товар отклонен и причина отклонения сохранена.');
    }

    public function index()
{
    $products = Product::where('status', 'approved')->get();
    return view('index', ['products' => $products]);
}
public function adminProductList()
{
    $products = Product::all();
    return view('admin.products.index', ['products' => $products]);
}

    public function sellerDashboard()
    {
        $products = Product::where('seller_id', Auth::id())->get();

        $deletedProductIds = session()->get('deleted_products', []);

        $products = $products->reject(function ($product) use ($deletedProductIds) {
            return in_array($product->id, $deletedProductIds);
        });

        return view('seller.seller_products', ['products' => $products]);
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function getProductCatalog()
    {
        $products = Product::where('status', 'approved')->get();
        $products->load('seller');
        return view('product_catalog', ['products' => $products]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category = $validatedData['category'];
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Продукт успешно обновлен.');
    }

    public function catalog()
    {
        $products = Product::where('status', 'approved')->get();
        return view('index', ['products' => $products]);
    }
}