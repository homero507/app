<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Models\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Controllers\CommentController;



Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');
Route::get('articles', 'App\Http\Controllers\ArticleController@index');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('user','App\Http\Controllers\UserController@getAuthenticatedUser');

    //Articles
    Route::get('articles/{article}','App\Http\Controllers\ArticleController@show');
    Route::get('articles/{article}/image', 'App\Http\Controllers\ArticleController@image');
    Route::post('articles','App\Http\Controllers\ArticleController@store');
    Route::put('articles/{article}', 'App\Http\Controllers\ArticleController@update');
    Route::delete('articles/{article}', 'App\Http\Controllers\ArticleController@delete');

    
    //comments

    Route::get('articles/{article}/comments', 'App\Http\Controllers\CommentController@index');
    Route::get('articles/{article}/comments/{comment}', 'App\Http\Controllers\CommentController@show');
    Route::post('articles/{article}/comments', 'App\Http\Controllers\CommentController@store');
    Route::put('articles/{article}/comments/{comment}', 'App\Http\Controllers\CommentController@update');
    Route::delete('articles/{article}/comments/{comment}', 'App\Http\Controllers\CommentController@delete');

});




