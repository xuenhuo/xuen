<?php

namespace App\Http\Controllers;

use App\model\Contact;
use App\model\products\Cart;
use App\model\products\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('fashe.order', [
            'orders' => Order::where('user_id', $user_id)->get(),
            'carts' => Cart::where('user_id', $user_id)->get(),
            'contact' => Contact::where('user_id', $user_id)->get(),
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
        return view('fashe.order');
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
        $cart_id = $request['cart_id'];
        $contact_id = $request['contact'];
        $total = $request['total'];
        $m = count($cart_id);
        for($i=1;$i<=$m;$i++){
            //order
            $user_id = Contact::whereId($contact_id)->pluck('user_id');
            $name = Contact::whereId($contact_id)->pluck('name');
            $phone = Contact::whereId($contact_id)->pluck('phone');
            $address = Contact::whereId($contact_id)->pluck('address');
            $order = Order::create([
                'num' => $request['num'],
                'status' => $request['status'],
                'total' => $total[$i-1],
                'user_id' => $user_id[0],
                'contact_id' => $contact_id,
                'remark' => $request['remark'],
                'name' => $name[0],
                'phone' => $phone[0],
                'address' => $address[0],
            ]);
            //order_detail
            $product_id = Cart::whereId($cart_id[$i-1])->pluck('product_id');
            $title = Cart::whereId($cart_id[$i-1])->pluck('title');
            $price = Cart::whereId($cart_id[$i-1])->pluck('price');
            $quantity = Cart::whereId($cart_id[$i-1])->pluck('quantity');
            $detail = $order->create([
                'product_id' => $product_id[0],
                'title' => $title[0],
                'price' => $price[0],
                'quantity' => $quantity[0],
            ]);
            //order_attribute_detail
            $cart = Cart::whereId($cart_id[$i-1])->get();
            $at_id = $cart->cart_details()->pluck('attribute_id');
            $at_title = $cart->cart_details()->pluck('title');
            $at_detail_id = $cart->cart_details()->pluck('attribute_detail_id');
            $at_detail_title = $cart->cart_details()->pluck('subtitle');
            $at_detail_price = $cart->cart_details()->pluck('price');
            $c[] = count($at_id);
            for ($n=1;$n<=$c;$n++) {
                $sub_detail = $detail->order_attribute_details()->create([
                    'attribute_id' => $at_id[$n-1],
                    'attribute_detail_id' => $at_detail_id[$n-1],
                    'title' => $at_title[$n-1],
                    'subtitle' => $at_detail_title[$n-1],
                    'price' => $at_detail_price[$n-1],
                ]);
            }
        }

        return redirect()->route('orders.index');
        // $request->validate([
        //     'num' => 'required|string',
        //     'status' => 'required|string',
        //     'num-product' => 'required|string',
        //     'price' => 'required|string',
        //     'remark' => 'required|string',
        //     'contact_id' => 'string',
        //     'name' => 'string',
        //     'phone' => 'string',
        //     'address' => 'string',
        // ]);
        // $price = $request->get('price');
        // $quantity = $request->get('num-product');
        // $sub_price[] = $request['at_detail_price'];
        // $sub_total = array_sum($sub_price);
        // $total = ($price+$sub_total)*$quantity;
        // $user_id = Auth::id();
        // $order = Order::create([
        //     'num' => $request['num'],
        //     'status' => $request['status'],
        //     'total' => $total,
        //     'user_id' => $user_id,
        //     'contact_id' => $request['contact_id'],
        //     'remark' => $request['remark'],
        //     'name' => $request['name'],
        //     'phone' => $request['phone'],
        //     'address' => $request['address'],
        // ]);
        // $detail = $order->order_details()->create([
        //     'product_id' => $request['product_id'],
        //     'title' => $request['title'],
        //     'price' => $price,
        //     'quantity' => $quantity,
        // ]);
        // //循环写入数组attribute_details
        // $c[] =  $request['attribute_id'];
        // $n = count($c);
        // for ($i=1;$i<=$n;$i++) {
        //     $attribute_id[] = $request['attribute_id'];
        //     $attribute_detail_id[] = $request['attribute_detail_id'];
        //     $at_title[] = $request['at_title'];
        //     $at_detail_title[] = $request['at_detail_title'];
        //     $at_detail_price[] = $request['at_detail_price'];
        //     $sub_detail = $detail->order_attribute_details()->create([
        //         'attribute_id' => $attribute_id[$i-1],
        //         'attribute_detail_id' => $attribute_detail_id[$i-1],
        //         'title' => $at_title[$i-1],
        //         'subtitle' => $at_detail_title[$i-1],
        //         'price' => $at_detail_price[$i-1],
        //     ]);
        // }
        // $sub_detail = $detail->order_attribute_details()->create([
        //     'attribute_id' => $request['attribute_id'],
        //     'attribute_detail_id' => $request['attribute_detail_id'],
        //     'title' => $request['at_title'],
        //     'subtitle' => $request['at_detail_title'],
        //     'price' => $request['at_detail_price'],
        // ]);

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
    }
}
