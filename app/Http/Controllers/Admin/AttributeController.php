<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\model\products\Attribute;

class AttributeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('admin.products.attributes.index',[
            'attributes' => Attribute::paginate(10),
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
        $request->validate([
            'title' => 'required|string|max:255',
            'is_multi' => 'boolean|max:255',
            'position' => 'string|max:255',
        ]);
        $attribute =Attribute::create([
            'title' => $request['title'],
            'is_multi' => $request['is_multi'],
            'position' => $request['position'],
        ]);
        return $attribute;
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
        $attribute = Attribute::find($id);
        return $attribute;
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
        $attribute = Attribute::find($id);
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'is_multi' => 'sometimes|string|max:255',
            'position' => 'sometimes|string|max:255',
            'attribute_details' => 'sometimes|string|max:255',
        ]);
        $attribute->title = $request->get('title');
        $attribute->is_multi = $request->get('is_multi');
        $attribute->position = $request->get('position');
        $attribute->save();
        return $attribute;
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
        $attribute = Attribute::find($id);
        $attribute->delete();
        return response()->json(['success']);
    }
}
