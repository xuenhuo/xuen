<?php

namespace App\Http\Controllers;

use App\model\Contact;
use App\model\products\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //用户中心
    public function index()
    {
        $user = Auth::user();
        $contact = Contact::all();
        return view('fashe.user', compact('user', 'contact'));
    }
}
