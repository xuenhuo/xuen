<?php

namespace App\Http\Controllers;

use App\model\articles\Article;
use App\model\articles\Tag;
use App\model\products\Category;
use App\model\products\Product;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::paginate(5);
        $articles = $articles->with('tags')->get();
        $articles = $articles->withCount('comments')->get();
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
        $article = $article->with('tags')->get();
        $article = $article->withCount('comments')->get();
        $article_tags = $article->tags()->get()->pluck('title');
        $comments = $article->comments()->get();
        $products = Product::where('featured', 1)->paginate(5);
        $categories = Category::paginate(5);
        $tags = Tag::all();
        return view('fashe.blog-detail', compact('article', 'article_tags', 'comments', 'comments_count',
        'products', 'categories', 'tags'));
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
