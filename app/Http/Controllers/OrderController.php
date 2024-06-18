<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
        ]);
    
        $order = new Order();
        $order->product_id = $request->input('product_id');
        $order->product_name = $request->input('product_name');
        $order->product_price = $request->input('product_price');
        $order->user_id = auth()->user()->id;
    
        $order->save();
    
        return redirect()->route('my.orders')->with('success', 'Заказ успешно оформлен!');
    }
    
    public function submit(Request $request, $order_id)
{
    $request->validate([
        'delivery-address' => 'required|string|max:255', 
    ]);

    $order = Order::findOrFail($order_id);

    $order->delivery_address = $request->input('delivery-address');
    $order->status = 'confirmed'; 

    $order->save();

    return redirect()->back()->with('success', 'Заказ успешно подтвержден!');
}


    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->with('product')->get();
        return view('my_orders', ['orders' => $orders]);
    }
    
}
