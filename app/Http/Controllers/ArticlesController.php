<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }   




    public function index()
    {
        $articles=Article::paginate(10);
        return view('articles.index')->with('articles',$articles);
        //return ArticleResource::collection($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover-image' => 'image|nullable|max:1999'
            ]);

            if($request->hasFile('cover-image'))
            {
                $fileNameWithExt= $request->file('cover-image')->getClientOriginalName();
                $filename=pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $ext= $request->file('cover-image')->getClientOriginalExtension();
                $fileNameToStore= $filename."_".time().".".$ext;
                $path=$request->file('cover-image')->storeAs('public/cover-images', $fileNameToStore);
            }
            else
            {
                $fileNameToStore='noimage.jpg';
            }

        $article=$request->isMethod('put')?Article::findOrFail($request->article_id):new Article;

        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->user_id=auth()->user()->id;
        $article->cover_image = $fileNameToStore;
        $article->save();

        return redirect ('/home')->with('success', 'Article Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article=Article::findOrFail($id);
        return view('articles.show')->with('article',$article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::find($id);
       if(auth()->user()->id !== $article->user_id)
       {
        return redirect('/articles')->with('error','Error');
       }
       return view('articles.edit')->with('article',$article);
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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover-image' => 'image|nullable|max:1999']);

            
        if($request->hasFile('cover-image'))
        {
            $fileNameWithExt= $request->file('cover-image')->getClientOriginalName();
            $filename=pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext= $request->file('cover-image')->getClientOriginalExtension();
            $fileNameToStore= $filename."_".time().".".$ext;
            $path=$request->file('cover-image')->storeAs('public/cover-images', $fileNameToStore);
        }
      

    
            $article= Article::find($id);
            $article->title = $request->input('title');
            $article->body = $request->input('body');
            if($request->hasFile('cover-image'))
            {
                $article->cover_image= $fileNameToStore; 
            }
            $article->save();
    
            return redirect ('/articles')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article=Article::findOrFail($id);
        if ($article->delete()) {
            return new ArticleResource($article);
        }
        
    }
}
