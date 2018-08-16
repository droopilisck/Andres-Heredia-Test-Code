<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get articles
        $article = Article::orderBy('created_at', 'desc')->paginate(5);

        //Return the collection of articles as a resource
        return ArticleResource::collection($article);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status= array("active","inactive");
        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;
        
        if($article->code==null){
            $article->id = (string)Str::uuid();
            $article->code="" . random_int(10, 99);
        }
        else{
            $article->id = $request->input('article_id');
        }
        $article->name = $request->input('name');
        $article->description = $request->input('description');
        $article->status=$request->input('status');
        
        

        if ($article->save()) {
            return new ArticleResource($article);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get a single article
        $article = Article::findOrFail($id);

        //Return single article as a resource
        return new ArticleResource($article);
    }

    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete article
        $article = Article::findOrFail($id);

        if ($article->delete()) {
            return new ArticleResource($article);
        }
    }
}
