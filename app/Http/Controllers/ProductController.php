<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Http\Requests\DeleteProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id','name','descripcion','precio','habilitado')->where('habilitado','<>',0)->get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $product = new Product;
        $product->name = $request->input('name');
        $product->descripcion = $request->input('descripcion');
        $product->precio = $request->input('precio');
        $product->save();
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $request)
    {
        $product = Product::find($request->input('id'));
        $product->name = $request->input('name');
        $product->descripcion = $request->input('descripcion');
        $product->precio = $request->input('precio');
        $product->habilitado = $request->input('habilitado');
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function deshabilitar(DeleteProduct $request)
    {
        $product = Product::findOrFail($id);
        $product->habilitado = 0;
        $product->save();
    }
}
