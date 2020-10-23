<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\model\products\Order;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function cart() {
        if(Auth::check() === true)
        {
            // $this->middleware('auth');
            $user_id = Auth::id();
            $orders = Order::where('user_id', $user_id)->get();
            // dd($user_id);
            // $all_num = count($orders);
            // foreach($orders as $order){
            //     $od[] = $order->total;
            // }
            // $all_total = array_sum($od);
            View::share('orders', $orders);
        }
    }
}

// class CartController extends BaseController
// {
//     if(Auth::check() == true)
//     {

//     }
// }