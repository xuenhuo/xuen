<?php

namespace App\Http\Controllers;

use App\model\Contact;
use App\model\products\Attribute;
use App\model\products\Attribute_detail;
use App\model\products\Cart;
use App\model\products\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            'contact' => Contact::where('user_id', $user_id)->first(),
            'num' => Str::random(16),
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
        $user_id = Auth::id();
        $cart = Cart::create([
            'user_id' => $user_id,
            'product_id' => $request['product_id'],
            'title' => $request['title'],
            'price' => $price,
            'quantity' => $request['quantity'],
            'photo' => $request['photo'],
        ]);
        //cart_detail
        $at_id = $request['at_id'];
        $at_detail_id = $request['at_detail_id'];
        $n = count($at_id);
        for ($i=1;$i<=$n;$i++) {
            $at_title = Attribute::whereId($at_id[$i-1])->pluck('title');
            $at_detail_title = Attribute_detail::whereId($at_detail_id[$i-1])->pluck('title');
            $at_detail_price = Attribute_detail::whereId($at_detail_id[$i-1])->pluck('price');
            $detail = $cart->cart_details()->create([
                'attribute_id' => $at_id[$i-1],
                'attribute_detail_id' => $at_detail_id[$i-1],
                'title' => $at_title[0],
                'subtitle' => $at_detail_title[0],
                'price' => $at_detail_price[0],
            ]);
        }

        return redirect()->route('products.index');
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
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->route('carts.index');
    }
}
