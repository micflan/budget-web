<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'Budget@index'
]);

Route::get('load', [
    'as' => 'load',
    'uses' => 'Budget@load'
]);

Route::post('create', [
    'as' => 'create',
    'uses' => 'Budget@create'
]);

Route::post('{key}/spend', [
    'as' => 'spend',
    'uses' => 'Budget@spend'
]);

Route::get('{key}', [
    'as' => 'show',
    'uses' => 'Budget@show'
]);
