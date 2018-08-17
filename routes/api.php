<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//List articles
Route::middleware('auth:api')->get('articles', 'ArticleController@index');

//List single article
Route::middleware('auth:api')->get('article/{id}', 'ArticleController@show');

//Create new Article

Route::middleware('auth:api')->post('article', 'ArticleController@store');

//Update Article
Route::middleware('auth:api')->put('article', 'ArticleController@store');

//Delete Article
Route::middleware('auth:api')->delete('article/{id}', 'ArticleController@destroy');