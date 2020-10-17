<?php

namespace App\Http\Controllers;

use App\model\products\Order;
use App\model\products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class OrderController extends Controller
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
        return view('fashe.cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($user_id, Request $request)
    {
        //
        $request->validate([
            'num' => 'required|string',
            'quantity' => 'required|string',
            'total' => 'required|string',
            'user_id' => 'string',
            'products' => 'string',
        ]);
        $order = Order::create([
            'num' => Str::random(16),
            'quantity' => $request['quantity'],
            'total' => $request['total'],
            'user_id' => $user_id,
        ]);
        $products = $request->get('products');
        if (!empty($products)) {
            $productList = array_filter(explode(",", $products));
    
            // Loop through the product array that we just created
            foreach ($productList as $products) {
                $product = Product::firstOrCreate(['title' => $products]);
            }
    
            $products = Product::whereIn('title', $productList)->get()->pluck('id');
    
            $order->products()->sync($products);
        }
        return Redirect::to('user.order.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, Order $order)
    {
        //
        return [$order, $user_id];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($user_id, Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, Order $order)
    {
        //
        $order->delete();
        return response()->json(['success']);
    }
}
