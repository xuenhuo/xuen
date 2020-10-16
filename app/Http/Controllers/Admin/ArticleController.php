<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\model\articles\Article;
use App\model\articles\Tag;

class ArticleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('admin.articles.index', [
            'articles' => Article::paginate(10),
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
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'photo' => 'required',
            'content' => 'required',
            'tags' => 'string|max:255',
        ]);
        //
        $path = $request->file('photo')->store('public/articles');
        $article = Article::create([
            'title' => $request['title'],
            'author' => $request['author'],
            'photo' => explode("/", $path)[2],
            'content' => $request['content'],
        ]);
        
        $tags = $request->get('tags');
        if (!empty($tags)) {
            $tagList = array_filter(explode(",", $tags));
    
            // Loop through the tag array that we just created
            foreach ($tagList as $tags) {
                $tag = Tag::firstOrCreate(['title' => $tags]);
            }
    
            $tags = Tag::whereIn('title', $tagList)->get()->pluck('id');
    
            $article->tags()->sync($tags);
        }

        return [$article, $tags];
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
        $tags = $article->tags()->get()->pluck('title');
        return [$article, $tags];
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
        $article = Article::find($id);
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'photo' => 'sometimes|required',
            'content' => 'sometimes|required',
            'tags' => 'sometimes|string|max:255',
        ]);
        //
        $article->title = $request->get('title');
        $article->author =  $request->get('author');
        if ($request->file('photo') != null) {
            $path = $request->file('photo')->store('public/articles');
            $article->photo = explode("/", $path)[2];
        }
        $article->content = $request->get('content');
        $article->save();

        $tags = $request->get('tags');
        $comma = ',';
        if (!empty($tags)) {
            if (strpos($tags, $comma) !== false) {
                $tagList = explode(",", $tags);
                // Loop through the tag array that we just created
                foreach ($tagList as $tags) {
                    // Get any existing tags
                    $tag = Tag::where('title', '=', $tags)->first();
                    // If the tag exists, sync it, otherwise create it
                    if ($tag != null) {
                        $t[] = $tag->id;
                    } else {
                        $tag = new Tag();
                        $tag->title = $tags;
                        $tag->save();
                        $t[] = $tag->id;
                    }
                }
            } else {
                // Only one tag
                $tag = Tag::where('title', '=', $tags)->first();
                if ($tag != null) {
                    $t[] = $tag->id;
                } else {
                    $tag = new Tag();
                    $tag->title = $tags;
                    $tag->save();
                    $t[] = $tag->id;
                }
            }
        }
        $article->tags()->sync($t);
        return [$article, $tags];
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
        $article = Article::find($id);
        $article->delete();
        return response()->json(['success']);
    }
}
