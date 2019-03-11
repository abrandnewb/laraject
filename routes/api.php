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

//get posts
Route::get('posts', 'PostsApiController@index');

//get a single post
Route::get('post/{id}', 'PostsApiController@show');

//create post
Route::post('post', 'PostsApiController@store');

//update post
Route::put('post', 'PostsApiController@update');

//delete post
Route::delete('post/{id}', 'PostsApiController@destroy');