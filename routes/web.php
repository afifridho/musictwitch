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

// Route::get('/', function () {
//     return view('admin');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/live', function () {
    return view('live');
});
Route::get('users/{id}', ['as' => 'users.index', 'uses' => 'UserController@index']);
Route::resource('users', 'UserController', ['except' => ['index']]);
Route::get('/search','UserController@searchuser')->name('users.searchuser');
