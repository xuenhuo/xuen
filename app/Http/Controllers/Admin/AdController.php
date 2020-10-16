<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\model\Ad;

class AdController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('admin.ads.index', [
            'ads' => Ad::paginate(7)
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
            'subtitle' => 'required|string|max:255',
            'photo' =>'required'
        ]);
        //
        $path = $request->file('photo')->store('public/ads');
        $ads = Ad::create([
            'title' => $request['title'],
            'subtitle' => $request['subtitle'],
            'photo' => explode("/", $path)[2],
        ]);
        return $ads;
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
        $ads = Ad::find($id);
        return $ads;
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
        $ads = Ad::find($id);
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'subtitle' => 'sometimes|required|string|max:255',
            'photo' =>'sometimes|required'
        ]);
        $ads->title =  $request->get('title');
        $ads->subtitle = $request->get('subtitle');
        if ($request->file('photo') != null) {
            $path = $request->file('photo')->store('public/ads');
            $ads->ad_photo = explode("/", $path)[2];
        }
        $ads->save();
        return $ads;
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
        $ads = Ad::find($id);
        $ads->delete();
        return response()->json(['success']);
    }
}
