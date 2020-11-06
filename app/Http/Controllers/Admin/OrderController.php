<?php

namespace App\Http\Controllers\Admin;

use App\model\products\Order;
use Illuminate\Http\Request;

class OrderController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('admin.products.orders.index', [
            'orders' => Order::paginate(10),
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
        $order = Order::find($id);
        $request->validate([
            'num' => 'sometimes|required|string',
            'status' => 'sometimes|required|string',
            'total' => 'sometimes|required|string',
            'user_id' => 'sometimes|required|string',
            'contact_id' => 'sometimes|string',
            'remark' => 'sometimes',
            'name' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'address' => 'sometimes|string',
            // 'product_id' => 'sometimes',
            // 'title' => 'sometimes',
            // 'price' => 'sometimes',
            // 'quantity' => 'sometimes',
            // 'attribute_id' => 'sometimes',
            // 'at_title' => 'sometimes',
            // 'attribute_detail_id' => 'sometimes',
            // 'at_detail_title' => 'sometimes',
            // 'at_detail_price' => 'sometimes',
        ]);
        $order->num = $request->get('num');
        $order->status = $request->get('status');
        $order->total = $request->get('total');
        $order->user_id = $request->get('user_id');
        $order->remark = $request->get('remark');
        $order->contact_id = $request->get('contact_id');
        $order->name = $request->get('name');
        $order->phone = $request->get('phone');
        $order->address = $request->get('address');

        return $order;
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
        return response()->json(['success']);
    }
}
