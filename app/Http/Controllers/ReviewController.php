<?php

namespace App\Http\Controllers;

use App\model\products\Product;
use App\model\products\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends UserController
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
    public function create($product_id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        //
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'product_id' => 'required',
        ]);
        $user_id = Auth::id();
        $review = Product::create([
            'content' => $request['content'],
            'user_id' => $user_id,
            'product_id' => $product_id,
        ]);
        return Redirect::to('products.reviews.create');
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
    public function update(Request $request, $product_id, Review $review)
    {
        //
        $request->validate([
            'content' => 'sometimes|required',
            'user_id' => 'sometimes|required',
            'product_id' => 'sometimes|required',
        ]);
        $user_id = Auth::id();
        $review->content = $request->get('content');
        $review->user_id = $user_id;
        $review->product_id = $product_id;
        return Redirect::to('products.reviews.edit');
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
