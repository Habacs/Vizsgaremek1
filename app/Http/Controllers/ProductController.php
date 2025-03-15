<?php

namespace App\Http\Controllers;

use Illuminate\Models\Controllers;
use Illuminate\Http\Request;

class ProductCointroller extends Controller{
    public function index(){
        return Product::all();
    }

    public function show($id){
        return Product::findOrFail($id);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);
        return Product::create($request->all());
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
        ]);
        $product->update($request->all());  
        return $product;
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->noContent();
    }

}