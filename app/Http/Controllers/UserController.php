<?php

namespace App\Http\Controllers;

use App\model\Contact;
use App\model\products\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::check() === true)
        {
            $this->middleware('auth');
            $user_id = Auth::id();
            $carts = Cart::where('user_id', $user_id)->get();
            $all_num = count($carts);
        }else{
            $carts = [];
            $all_num = 0;
        }
        return view('fashe.blog', [
            'carts' => $carts,
            'all_num' => $all_num,
        ]);
    }

    //用户中心
    public function index()
    {
        $user = Auth::user();
        $contact = Contact::all();
        return view('fashe.user', compact('user', 'contact'));
    }
}
