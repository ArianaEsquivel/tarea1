<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('posts/{id}', 'PostsController@show')-> where("id", "[0-9]+");
Route::get('posts', 'PostsController@index');
Route::post('posts', 'PostsController@store');
Route::delete("posts/{id}", "PostsController@destroy")-> where("id", "[0-9]+");
Route::put("posts/{id}", "PostsController@update")-> where("id", "[0-9]+");

Route::get('comentarios/{id}', 'ComentariosController@show')-> where("id", "[0-9]+");
Route::get('comentarios', 'ComentariosController@index');
Route::post('comentarios', 'ComentariosController@store');
Route::delete("comentarios/{id}", "ComentariosController@destroy")-> where("id", "[0-9]+");
Route::put("comentarios/{id}", "ComentariosController@update")-> where("id", "[0-9]+");

Route::get('users/{id}', 'UserController@show')-> where("id", "[0-9]+");
Route::get('users', 'UserController@index');
Route::post('users', 'UserController@store');
Route::delete("users/{id}", "UserController@destroy")-> where("id", "[0-9]+");
Route::put("users/{id}", "UserController@update")-> where("id", "[0-9]+");



Route::get('edad', 'UserController@index')-> middleware('validar.edad');


Route::post("login", "UserController@logIn");
Route::post("registro", "UserController@registro");

//Route::middleware('auth:sanctum')->get('/cuenta', [UserController::class, 'cuenta']);
Route::middleware('auth:sanctum')->delete('/logout', 'UserController@logOut');
Route::middleware('auth:sanctum')->get('/cuenta', 'UserController@index');
