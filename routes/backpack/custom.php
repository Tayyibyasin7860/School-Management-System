<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    //auth routes
//    Route::auth();
//    Route::post('logout','Auth/LoginController@logout')->name('logout');

    // custom admin routes
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('student', 'StudentUserCrudController');
    Route::group(['prefix' => 'student/{student_id}'], function() {
        CRUD::resource('profile', 'StudentCrudController');

    });
    CRUD::resource('school-admin', 'SchoolAdminUserCrudController');
    CRUD::resource('subject', 'SubjectCrudController');
    CRUD::resource('class', 'ClassCrudController');

    // Backpack\NewsCRUD
    CRUD::resource('article', 'ArticleCrudController');
    CRUD::resource('category', 'CategoryCrudController');
    CRUD::resource('tag', 'TagCrudController');

    Route::get('mailbox', 'MailboxController@index');
    CRUD::resource('exam', 'ExamCrudController');
    CRUD::resource('result', 'ResultCrudController');

    CRUD::resource('fee', 'FeeCrudController');

    CRUD::resource('role', 'RoleCrudController');
    Route::get('/permission/generate', 'PermissionCrudController@generatePermissions');
    CRUD::resource('permission', 'PermissionCrudController');

});
