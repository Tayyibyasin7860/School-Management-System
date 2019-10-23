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
})->name('welcome');

Auth::routes();
Route::get('/home', 'HomeController@home')->name('home');
Route::group([    'prefix' => 'student',
                'middleware' => ['auth','StudentCheck']], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/fee', 'HomeController@fee')->name('fee');
    Route::get('/profile', 'StudentProfileController@index')->name('profile');
    Route::get('/profile/{user}/edit', 'StudentProfileController@edit');
    Route::put('/profile/{user}', 'StudentProfileController@update')->name('edit-submit');
    Route::patch('/update-photo/{user}', 'StudentProfileController@updateImage');


    Route::get('/exam', 'HomeController@exam')->name('exam');
    Route::get('/result', 'HomeController@result')->name('result');
    $auth = auth()->user();
    Route::get('/feedback', 'StudentFeedbackController@create')->name('feedback');
    Route::put('/feedback/{user}', 'StudentFeedbackController@store');

    Route::prefix('/notice-board')->group(function () {
        Route::get('/', function (){
            return redirect('/student/notice-board/general', 301);
        })->name('notice-board');
        Route::get('/{categories}', 'ArticleController@index')->where('categories','^[a-zA-Z0-9-_\/]+$')->name('category');
//        Route::post('/{categories}', 'ArticleController@paginate')->where('categories','^[a-zA-Z0-9-_\/]+$')->name('category.paginate');
    });
    Route::get('{categories}/{slug}', 'ArticleController@show')->where('categories','^[a-zA-Z0-9-_\/]+$')->name('post'); //single category route

});
