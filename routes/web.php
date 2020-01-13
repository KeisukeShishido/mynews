<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('news/create', 'Admin\NewsController@add');
    Route::post('news/create', 'Admin\NewsController@create');
    Route::get('news', 'Admin\NewsController@index');
    Route::get('news/edit', 'Admin\NewsController@edit');
    Route::post('news/edit', 'Admin\NewsController@update');
    Route::delete('news/delete', 'Admin\NewsController@delete');

    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::post('profile/create', 'Admin\ProfileController@create');
    Route::get('profile/edit', 'Admin\ProfileController@edit' );
    Route::post('profile/edit', 'Admin\ProfileController@update' );
    Route::get('profiles', 'Admin\ProfileController@index');
    Route::get('profiles/edit', 'Admin\ProfileController@edit');
    Route::post('profiles/edit', 'Admin\ProfileController@update');
    Route::delete('profiles/delete', 'Admin\ProfileController@delete');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
