<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index ()
    {
        return new ArticleCollection(Article::paginate());
    }

    public function show(Article $article)
    {
         return response()->json(new ArticleResource($article), 200);
    }

    public function image(Article $article)
    {
     return response()->download(Storage::Url($article->image));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
             'title' => 'required|string|unique:articles|max:255',
             'body' => 'required|string',
             'category_id' => 'required|exists:categories,id',
             'image' => 'required|image|dimensions:min_width=500,min_height=500',
         ]);             

         if ($validator->fails()) {
             return response()->json(['error' => 'data_validation_failed',
            "error_list"=>$validator->errors()], 400);
         }
             $article = new Article($request->all());
             $path = $request->image->store('public/articles');
             $article->image = $path;
             $article->save();

             return response()->json(new ArticleResource($article), 201);
    }

    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
             'title' => 'required|string|unique:articles,title.'.$article->id.'|max:255',
             'body' => 'required|string',
             'category_id' => 'required|exists:categories,id',   
         ]);

        if ($validator->fails()) {
             return response()->json(['error' => 'data_validation_failed',
            "error_list"=>$validator->errors()], 400);
         }

        $article->update($request->all());
        return response()->json($article, 200);    
    }

    public function delete(Article $article)
    {
        $article->delete();
                
        return response()->json(null, 204);
    }
}
