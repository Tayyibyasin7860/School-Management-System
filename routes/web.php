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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/fee', 'HomeController@fee')->name('fee');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::put('/profile', 'HomeController@updateProfile');
Route::get('/notice-board', 'HomeController@noticeBoard')->name('notice-board');
