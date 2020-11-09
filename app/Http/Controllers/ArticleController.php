<?php

namespace App\Http\Controllers;

use App\model\products\Cart;
use App\model\articles\Article;
use App\model\articles\Tag;
use App\model\products\Category;
use App\model\products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = DB::table('articles')->latest()->paginate(5);
        $articles = Article::withCount('comments')->latest()->paginate(5);
        // dd($articles);
        $products = Product::where('featured', 1)->paginate(5);
        $categories = Category::paginate(5);
        $tags = Tag::all();
        return view('fashe.blog', compact('articles', 'products', 'categories', 'tags'));
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
        $article = Article::find($id);
        $comments_count = $article->comments()->count();
        $comments = $article->comments()->get();
        $products = Product::where('featured', 1)->paginate(5);
        $categories = Category::paginate(5);
        $tags = Tag::all();
        return view('fashe.blog-detail', compact('article', 'comments_count', 'comments', 'products', 'categories', 'tags'));
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
