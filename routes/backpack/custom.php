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
], function () { // custom admin routes
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('subject', 'SubjectCrudController');
    CRUD::resource('class', 'ClassCrudController');

    // Backpack\NewsCRUD
    CRUD::resource('article', 'ArticleCrudController');
    CRUD::resource('category', 'CategoryCrudController');
    CRUD::resource('tag', 'TagCrudController');


    CRUD::resource('exam', 'ExamCrudController');
    CRUD::resource('result', 'ResultCrudController');
    CRUD::resource('student', 'StudentCrudController');
    CRUD::resource('fee', 'FeeCrudController');
});
