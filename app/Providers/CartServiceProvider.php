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
            }else{
                $carts = [];
                $all_num = count($carts);
            }
            $view->with('carts', $carts);
            $view->with('all_num', $all_num);
        });
    }
}
