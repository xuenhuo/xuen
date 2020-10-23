<?php

namespace App\Http\Controllers;

use App\model\Ad;
use App\model\articles\Article;
use App\model\products\Category;
use App\model\products\Order;
use App\model\products\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Providers\CartServiceProvider;

class HomeController extends Controller
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
            $this->middleware('auth');$user_id = Auth::id();
            // $orders = Order::where('user_id', $user_id)->get();
            // $all_num = count($orders);
            // foreach($orders as $order){
            //     $od[] = $order->total;
            // }
            // $all_total = array_sum($od);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ads = Ad::paginate(3);
        $dresses = Category::where('title', 'Dresses')->get();
        $sunglasses = Category::where('title', 'Sunglasses')->get();
        $watches = Category::where('title', 'Watches')->get();
        $footerwear = Category::where('title', 'Footerwear')->get();
        $bags = Category::where('title', 'Bags')->get();
        $products = Product::where('featured', 1)->paginate(8);
        // $sale = Product::where('sale', '<', 'price')->get();
        $articles = Article::paginate(3);
        return view('fashe.index', compact('ads', 'dresses', 'sunglasses', 'watches', 'footerwear',
                    'bags', 'products', 'articles'));
        // return view('fashe.index', compact('ads', 'products', 'articles'));
    }

    //联系我们
    public function contact()
    {
        return view('fashe.contact');
    }

    //关于我们
    public function about()
    {
        return view('fashe.about');
    }
}
