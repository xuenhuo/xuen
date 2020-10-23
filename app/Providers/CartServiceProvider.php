<?php

namespace App\Providers;

use App\model\products\Order;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
            $orders = Order::where('user_id', $user_id)->get();
                $view->with('orders', $orders);
            });
        if(Auth::check() === true)
        {
            view()->composer(['fashe.header'], function ($view) {
                $user_id = Auth::id();
                $orders = Order::where('user_id', $user_id)->get();
                $all_num = count($orders);
                foreach($orders as $order){
                    $od[] = $order->total;
                }
                $view->with('orders', $orders);
                $view->with('all_num', $all_num);
                // $view->with('orders', $orders);
            });
           
            // $all_total = array_sum($od);
            // View::share('orders', $orders);
            // View::share('all_num', $all_num);
        }
    }
}
