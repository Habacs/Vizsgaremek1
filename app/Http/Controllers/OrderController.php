<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\HTTP\Request;

class OrderController extends Controller{
    public function index(){
        return Order::with('product')->get();
    }

    public function show($id){
        return Order::with('products')-> findOrFail($id);
    }

    public function store(Request $request){
        $request->validate([
            'user_id' => 'required|exists: users,id',
            'total_amount' => 'required|numeric',
            'products' => 'required|array',
        ]);

        $order = Order::create($request->only('user_id', 'total_amount'));
        $order->products()->attach($request->products);

        return response()->json([$order, 201]);
    }

    public function update(Request $request, $id){
        $order = Order::findOrFail($id);
        $request->validate([
            'total_amount' => 'sometimes|required|numeric',

        ]);

        $order->update($request->only('total_amount'));
        return $order;
    }

    public function destroy($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->noContent();
    }
}