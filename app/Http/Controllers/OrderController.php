<?php

namespace App\Http\Controllers;

use App\model\products\Attribute_details;
use App\model\Contact;
use App\model\products\Order;
use App\model\products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class OrderController extends UserController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        View::share('orders', $orders);
        return view('fashe.cart', [
            'orders' => Order::where('user_id', $user_id)->get(),
        ]);
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'num' => 'required|string',
            'status' => 'required|string',
            'num-product' => 'required|string',
            'price' => 'required|string',
            'product' => 'string',
            'details' => 'array',
        ]);
        $price = $request->get('price');
        $quantity = $request->get('num-product');
        $total = $price*$quantity;
        $user_id = Auth::id();
        $order = Order::create([
            'num' => $request['num'],
            'quantity' => $request['num-product'],
            'status' => $request['status'],
            'total' => $total,
            'user_id' => $user_id,
        ]);
        $product = $request->get('product');
        if (!empty($product)) {
            $product = Product::where('title', $product)->get()->pluck('id');
            $order->products()->sync($product);
        }
        $detailList = $request->get('details');
        if (!empty($detailList)) {
            foreach ($detailList as $details) {
                $detail = Attribute_details::find(['id' => $details]);
            }
            $details = Attribute_details::whereIn('id', $detailList)->get()->pluck('id');
            $order->attribute_details()->sync($details);
        }
        // $contact = $request->get('contact');
        // if(!empty($contact)) {
        //     $contact = Contact::where('address', $contact)->get()->pluck('id');
        //     $order->contacts()->sync($contact);
        // }
        return redirect()->route('orders.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = Order::find($id);
        return $order;
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
    public function update($id, Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('orders.index');
    }
}
