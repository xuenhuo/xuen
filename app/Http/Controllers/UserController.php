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
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        $all_num = count($orders);
        foreach($orders as $order){
            $od[] = $order->total;
        }
        // $all_total = array_sum($od);
        View::share('orders', 'all_num');
    }

    //用户中心
    public function index()
    {
        $user = Auth::user();
        $contact = Contact::all();
        return view('fashe.user', compact('user', 'contact'));
    }

    // public function header()
    // {
    //     $orders = Order::all();
    //     $all_num = count($orders);
    //     foreach($orders as $order){
    //         $od[] = $order->total;
    //     }
    //     $all_total = array_sum($od);
    //     return view('fashe.header', [
    //         'orders' => Order::all(),
    //         'all_num' => $all_num,
    //         'all_total' => $all_total,
    //     ]);
    // }
}
