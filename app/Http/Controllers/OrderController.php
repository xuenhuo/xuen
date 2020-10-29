<?php

namespace App\Http\Controllers;

use App\model\Contact;
use App\model\products\Cart;
use App\model\products\Order;
use App\model\products\Order_detail;
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
        // $user_id = Auth::id();
        // $orders = Order::where('user_id', $user_id)->get();
        // foreach($orders as $order){
        //     $od[] = $order->total;
        // }
        // $all_total = array_sum($od);
        // return view('fashe.order', [
        //     'carts' => Cart::where('user_id', $user_id)->get(),
        //     'contact' => Contact::where('user_id', $user_id)->get(),
        // ]);
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
        $d[] = $request['cart_id'];
        $m = count($d);
        for($i=1;$i<=$m;$i++){
            $contact_id = $request['contact'];
            $contact = Contact::find($contact_id);
            $cart = Cart::find($d[$i-1]);
            $total = $request['total'];
            $user_id = $cart->get()->pluck('user_id');
            $product_id = $cart->get()->pluck('product_id');
            $title = $cart->get()->pluck('title');
            $price = $cart->get()->pluck('price');
            $quantity = $cart->get()->pluck('quantity');
            $at_id[] = $cart->cart_details()->get()->pluck('attribute_id');
            $at_title[] = $cart->cart_details()->get()->pluck('title');
            $at_detail_id[] = $cart->cart_details()->get()->pluck('attribute_detail_id');
            $at_detail_title[] = $cart->cart_details()->get()->pluck('subtitle');
            $at_detail_price[] = $cart->cart_details()->get()->pluck('price');
            $c[] = count($at_id);
            $order = Order::create([
                'num' => $request['num'],
                'status' => $request['status'],
                'total' => $total,
                'user_id' => $user_id,
                'contact_id' => $contact_id,
                'remark' => $request['remark'],
                'name' => $contact->get()->pluck('name'),
                'phone' => $contact->get()->pluck('phone'),
                'address' => $contact->get()->pluck('address'),
            ]);
            $detail = $order->create([
                'product_id' => $product_id,
                'title' => $title,
                'price' => $price,
                'quantity' => $quantity,
            ]);
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

        return redirect()->route('orders.store');
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
