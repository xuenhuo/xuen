<?php

namespace App\Http\Controllers;

use App\model\products\Cart;
use App\model\products\Category;
use App\model\products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $n = $request['sorting'];
        switch($n){
            case 0 :
                $products = DB::table('products')->latest()->paginate(12);
            break;
            case 1 :
                $products = DB::table('products')->orderBy('price')->paginate(12);
            break;
            case 2 :
                $products = DB::table('products')->orderBy('price', 'desc')->paginate(12);
            break;
        }
        $product_count = count(Product::all());
        $categories = Category::paginate(5);
        return view('fashe.product', compact('products', 'product_count', 'categories'));
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
        $product = Product::find($id);
        $reviews = $product->reviews()->get();
        $reviews_count = $product->reviews()->count();
        $features = Product::where('featured', 1)->paginate(8);
        return view('fashe.product-detail', compact('product', 'reviews', 'reviews_count', 'features'));
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
    }
}
