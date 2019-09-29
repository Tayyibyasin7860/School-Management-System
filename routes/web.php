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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth','StudentCheck']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/fee', 'HomeController@fee')->name('fee');
    Route::get('/profile', 'StudentDetailsController@index')->name('profile');
    Route::get('/profile/{user}/edit', 'StudentDetailsController@edit');
    Route::put('/profile/{user}', 'StudentDetailsController@update');
    Route::patch('/update-photo/{user}', 'StudentDetailsController@updateImage');

    Route::get('/notice-board', 'HomeController@noticeBoard')->name('notice-board');
    Route::get('/exam', 'HomeController@exam')->name('exam');
    Route::get('/result', 'HomeController@result')->name('result');
    $auth = auth()->user();
    Route::get('/compose-mail', 'StudentMailController@create');

});

