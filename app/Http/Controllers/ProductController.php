<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $product = Product::where('habilitado','=',true)->get();
        return $product;
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name=$request->get('name');
        $product->description=$request->get('description');
        $product->precio=$request->get('precio');
        $product->habilitado=$request->get('habilitado');
        $product->save();
        return $product;
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name=$request->get('name');
        $product->description=$request->get('description');
        $product->precio=$request->get('precio');
        $product->habilitado=$request->get('habilitado');
        $product->save();

        return $product;
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
