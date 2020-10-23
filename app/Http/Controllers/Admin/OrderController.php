<?php

namespace App\Http\Controllers\Admin;

use App\model\products\Attribute_details;
use App\model\Contact;
use App\model\products\Order;
use App\model\products\Product;
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
        $product = $order->products()->get()->pluck('title');
        $details = $order->attribute_details()->get()->pluck('title');
        $contact = $order->contacts()->get()->pluck('address');
        return [$order, $product, $details, $contact];
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
            'quantity' => 'sometimes|required|string',
            'total' => 'sometimes|required|string',
            'user_id' => 'sometimes|string',
            'product' => 'sometimes|string',
            'details' => 'sometimes|string',
            'contact' => 'sometimes|string',
        ]);
        $order->num = $request->get('num');
        $order->status = $request->get('status');
        $order->quantity = $request->get('quantity');
        $order->total = $request->get('total');
        $order->user_id = $request->get('user_id');

        $product = $request->get('products');
        if (!empty($product)) {
            $product = Product::where('title', $product)->first();
            $order->products()->sync($product->id);
        }
        $comma = ',';
        $details = $request->get('details');
        if (!empty($details)) {
            if (strpos($details, $comma) !== false) {
                $detailList = explode(",", $details);
                // Loop through the detail array that we just created
                foreach ($detailList as $details) {
                    // Get any existing details
                    $detail = Attribute_details::where('title', '=', $details)->first();
                    // If the detail exists, sync it, otherwise create it
                    if ($detail != null) {
                        $d[] = $detail->id;
                    } else {
                        $detail = new Attribute_details();
                        $detail->title = $details;
                        $detail->save();
                        $d[] = $detail->id;
                    }
                }
            } else {
                // Only one detail
                $detail = Attribute_details::where('title', '=', $details)->first();
                if ($detail != null) {
                    $d[] = $detail->id;
                } else {
                    $detail = new Attribute_details();
                    $detail->title = $details;
                    $detail->save();
                    $d[] = $detail->id;
                }
            }
        }
        $contact = $request->get('contact');
        if (!empty($contact)) {
            $contact = Contact::where('address', $contact)->first();
            $order->contacts()->sync($contact->id);
        }
        $order->attribute_details()->sync($d);

        return [$order, $product, $details, $contact];
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
