<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'default.index', 'uses' => 'DefaultController@index']);
Route::get('products/{product}', ['as' => 'default.product', 'uses' => 'DefaultController@product']);