<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\model\articles\Comment;

class CommentlistController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($article_id)
    {
        //
        return view('admin.articles.commentlists.index',[
            'commentlists' => Comment::where('article_id', $article_id)->paginate(10),
        ]);
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
    public function show($article_id, Comment $comment)
    {
        //
        $commentlists = Comment::where('article_id', $article_id)->get();
        return $commentlists;
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
    public function destroy($article_id, Comment $commentlist)
    {
        //
        $commentlist->delete();
        return redirect('admin/articles/{{$article_id}}/commentlists');
    }
}
