<?php

namespace App\Http\Controllers;

use App\model\articles\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends UserController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($article_id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($article_id, Request $request)
    {
        //
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'article_id' => 'required',
        ]);
        $user_id = Auth::id();
        $comment = Comment::create([
            'content' => $request['content'],
            'user_id' => $user_id,
            'article_id' => $article_id,
        ]);
        return redirect()->route('articles.show', ['id' => $article_id]);
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
    public function update($article_id, Request $request, Comment $comment)
    {
        //
        $request->validate([
            'content' => 'sometimes|required',
            'user_id' => 'sometimes|required',
            'article_id' => 'sometimes|required',
        ]);
        $user_id = Auth::id();
        $comment->content = $request->get('content');
        $comment->user_id = $user_id;
        $comment->article_id = $article_id;
        return redirect()->route('articles.show', ['id' => $article_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($article_id, Comment $comment)
    {
        //
        $comment->delete();
        return redirect()->route('articles.show', ['id' => $article_id]);
    }
}
