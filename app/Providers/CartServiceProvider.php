<?php

namespace App\Providers;

use App\model\products\Cart;
use App\model\products\Order;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer(['fashe.header'], function ($view) {
            $user_id = Auth::id();
            if($user_id == true) {
                $carts = Cart::where('user_id', $user_id)->get();
                $all_num = count($carts);
                // foreach($carts as $cart){
                //     $cart_price[] = $cart->price;
                //     $detail_price[] = $cart->cart_details()->price;
                // }
                // $all_total = array_sum($all);
            }else{
                $carts = [];
                $all_num = count($carts);
                // $all_total = 0;
            }
            $view->with('carts', $carts);
            $view->with('all_num', $all_num);
            // $view->with('all_total', $all_total);
        });
    }
}
