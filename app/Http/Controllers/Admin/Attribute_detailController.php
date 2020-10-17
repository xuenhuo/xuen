<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\model\products\Attribute_detail;

class Attribute_detailController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($attribute_id)
    {
        //
        return view('admin.products.attributes.details.index', [
            'details' => Attribute_detail::where('attribute_id', $attribute_id)->paginate(10),
            'atid' => $attribute_id,
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
    public function store($attribute_id, Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'string|max:255',
            'position' => 'string',
            'attribute_id' => 'string',
        ]);
        $attribute_detail = Attribute_detail::create([
            'title' => $request['title'],
            'price' => $request['price'],
            'position' => $request['position'],
            'attribute_id' => $attribute_id,
        ]);
        return [$attribute_detail, $attribute_id];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($attribute_id, Attribute_detail $attribute_detail)
    {
        //
        return [$attribute_detail, $attribute_id];
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
    public function update($attribute_id, Request $request, Attribute_detail $attribute_detail)
    {
        //
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|string|max:255',
            'position' => 'sometimes|string',
            'attribute_id' => 'sometimes|string',
        ]);
        $attribute_detail->title = $request->get('title');
        $attribute_detail->price = $request->get('price');
        $attribute_detail->position = $request->get('position');
        $attribute_detail->attribute_id = $request->get('attribute_id');
        $attribute_detail->save();
        return [$attribute_detail, $attribute_id];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($attribute_id, Attribute_detail $attribute_detail)
    {
        //
        $attribute_detail->delete();
        return response()->json(['success']);
    }
}
