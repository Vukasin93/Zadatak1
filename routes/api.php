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

//ListArticles
Route::get('articles','ArticleController@index');

//SingleArticles
Route::get('article/{id}','ArticleController@show');

//Create
Route::post('article','ArticleController@store');

//Delete
Route::delete('article','ArticleController@destroy');