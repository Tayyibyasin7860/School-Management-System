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

Route::group([    'prefix' => 'student',
                'middleware' => ['auth','StudentCheck']], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/fee', 'HomeController@fee')->name('fee');
    Route::get('/profile', 'StudentProfileController@index')->name('profile');
    Route::get('/profile/{user}/edit', 'StudentProfileController@edit');
    Route::put('/profile/{user}', 'StudentProfileController@update')->name('edit-submit');
    Route::patch('/update-photo/{user}', 'StudentProfileController@updateImage');

    Route::get('/notice-board', 'HomeController@noticeBoard')->name('notice-board');
    Route::get('/exam', 'HomeController@exam')->name('exam');
    Route::get('/result', 'HomeController@result')->name('result');
    $auth = auth()->user();
    Route::get('/compose-mail', 'StudentMailController@create');

});

