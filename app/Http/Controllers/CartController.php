<?php

namespace App\Http\Controllers;

use App\model\products\Attribute_detail;
use App\model\products\Cart;
use App\model\products\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
        return view('fashe.cart', [
            'carts' => Cart::where('user_id', $user_id)->get(),
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
    public function store(Request $request)
    {
        //
        $price = $request->get('price');
        // $quantity = $request->get('num-product');
        // $sub_price[] = $request['at_detail_price'];
        // $sub_total = array_sum($sub_price);
        // $total = $price+$sub_total;
        $user_id = Auth::id();
        $cart = Cart::create([
            'user_id' => $user_id,
            'product_id' => $request['product_id'],
            'title' => $request['title'],
            'price' => $price,
            'quantity' => $request['num_product'],
            'photo' => $request['photo'],
        ]);
        //cart_detail
        $c[] = $request['at_id'];
        $n = count($c);
        for ($i=1;$i<=$n;$i++) {
            $attribute_id[] = $request['at_id'];
            $at_title[] = $request['at_title'];
            $at_detail_id[] = $request['at_detail_id'];
            $at_detail = Attribute_detail::find($at_detail_id[$i-1]);
            $at_detail_title[] = $at_detail->get('title');
            $at_detail_price[] = $at_detail->get('price');
            $detail = $cart->cart_details()->create([
                'attribute_id' => $attribute_id[$i-1],
                'attribute_detail_id' => $at_detail_id[$i-1],
                'title' => $at_title[$i-1],
                'subtitle' => $at_detail_title[$i-1],
                'price' => $at_detail_price[$i-1],
            ]);
        }

        // return redirect()->route('');
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
    public function update(Request $request, $id)
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
        return redirect()->route('carts.index');
    }
}
