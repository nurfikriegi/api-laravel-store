<?php

namespace App\Http\Controllers;

use App\product;
use App\order;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create product
        $product = new product();

        $product->nama_produk = $request->nama_produk;
        $product->warna = $request->warna;
        $product->jumlah = $request->jumlah;
        $product->harga = $request->harga;

        $product->save();
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //list product
        $product = product::select('_id', 'nama_produk', 'harga')->get();
        return response()->json($product);
    }

    public function findById($id)
    {
        //show all product
        $product = product::select('_id', 'nama_barang', 'harga', 'warna', 'jumlah')->find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        //adding product to chart

        $product = product::find($request->id);
        $cart = session()->get("cart");
        if(!isset($cart[$request->id])){
            $cart[$request->id] = [
                "nama_produk" => $product->nama_produk,
                "qty" => $request->qty,
                "harga" => $product->harga
            ];
        }else{
            error_log($cart[$request->id]);
            $cart[$request->id]["qty"] = $cart[$request->id]["qty"] + $request->qty;
        }

        // unset($cart);
        session(["cart" => $cart]);
        // session(['cart' => $product->nama_produk]);

        return response()->json(session($cart));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function checkOut(product $product)
    {
        //checkout from cart
        $cart = session()->get("cart");
        foreach ($cart as $key => $value) {
            $order = new order();
            //add new product
            $order->id_produk = $key;
            $order->jumlah = $value->jumlah;
            $order->harga = $value->harga;
            $order->total = $value->total;

            $order->save();
            unset($cart[$key]);
        }
        session(["cart" => $cart]);

        return response()->json($order); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function showListOrder(){

    }
}
