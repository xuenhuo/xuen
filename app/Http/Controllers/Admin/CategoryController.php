<?php

namespace App\Http\Controllers\Admin;

use App\model\products\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('admin.products.categories.index', [
            'categories' => Category::all(),
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
            'photo' => 'required',
            'position' => 'string',
            'disabled' => 'boolean',
        ]);
        $path = $request->file('photo')->store('public/categories');
        $category = Category::create([
            'title' => $request['title'],
            'photo' => explode("/", $path)[2],
            'position' => $request['position'],
            'disabled' => $request['disabled'],
        ]);
        return $category;
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
        $category = Category::find($id);
        return $category;
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
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'photo' => 'sometimes|required',
            'position' => 'sometimes|string',
            'disabled' => 'sometimes|boolean',
        ]);
        $category = Category::find($id);
        $category->title = $request->get('title');
        if ($request->file('photo') != null) {
            $path = $request->file('photo')->store('public/categories');
            $category->photo = explode("/", $path)[2];
        }
        $category->position = $request->get('position');
        $category->disabled = $request->get('disabled');
        $category->save();
        return $category;
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
        $category = Category::find($id);
        $category->delete();
        return response()->json(['success']);
    }
}
