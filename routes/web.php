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

Route::get('/user/{id}', function ($id) {
    return 'this is user'.$id;
});

Route::get('index','pages@index');
Route::get('about','pages@about');
Route::get('service','pages@service');

Route::resource('post','postcontroller');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
