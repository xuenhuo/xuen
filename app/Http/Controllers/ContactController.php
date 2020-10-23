<?php

namespace App\Http\Controllers;

use App\model\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends UserController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('fashe.user', [
            'contacts' => Contact::all(),
            'user_id' => Auth::id(),
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
            'name' => 'required|string',
            'phone_num' => 'required|string',
            'address' => 'required',
            'user_id' => 'required|string',
        ]);
        $user_id = Auth::id();
        $contact = Contact::create([
            'name' => $request['name'],
            'phone_num' => $request['phone_num'],
            'address' => $request['address'],
            'user_id' => $user_id,
        ]);
        return $contact;
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
        $contact = Contact::find($id);
        return $contact;
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
        $contact = Contact::find($id);
        $request->validate([
            'name' => 'sometimes|required|string',
            'phone_num' => 'sometimes|required|string',
            'address' => 'sometimes|required',
            'user_id' => 'sometimes|required|string',
        ]);
        $contact->name = $request->get('name');
        $contact->phone_num = $request->get('phone_num');
        $contact->address = $request->get('address');
        $contact->user_id = $request->get('user_id');
        $contact->save();

        return $contact;
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
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json(['success']);
    }
}
