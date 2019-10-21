<?php

use App\Http\Middleware\AdminCheck;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', 'AdminCheck', config('backpack.base.middleware_key', 'admin')],
    'namespace' => 'App\Http\Controllers\Admin',
], function () {

    Route::get('dashboard', 'DashboardController@dashboard');
    // custom admin routes
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('student', 'StudentUserCrudController');
    Route::group(['prefix' => 'student/{student_id}'], function () {
        CRUD::resource('profile', 'StudentDetailCrudController');

    });
    CRUD::resource('class-subject', 'ClassSubjectBaseCrudController');

    CRUD::resource('class', 'ClassCrudController');
    Route::group(['prefix' => 'class/{class_id}'], function () {
        CRUD::resource('subject', 'ClassSubjectCrudController');
    });

    CRUD::resource('school-admin', 'SchoolAdminUserCrudController');
    CRUD::resource('subject', 'SubjectCrudController');

    // Backpack\NewsCRUD
    CRUD::resource('article', 'ArticleCrudController');
    CRUD::resource('category', 'CategoryCrudController');
    CRUD::resource('tag', 'TagCrudController');

    CRUD::resource('exam', 'ExamCrudController');

    CRUD::resource('result', 'ResultCrudController');

    CRUD::resource('role', 'RoleCrudController');
    Route::get('/permission/generate', 'PermissionCrudController@generatePermissions');
    CRUD::resource('permission', 'PermissionCrudController');

    Route::get('mailbox', 'MailboxController@create');
    Route::post('mailbox', 'MailboxController@send');
    Route::get('mailbox/{student}', 'MailboxController@studentEmail');
    Route::get('fee-receipt/generate', 'FeeReceiptCrudController@generateReceiptForm');
    Route::post('fee-receipt/generate', 'FeeReceiptCrudController@generateReceipt');
    CRUD::resource('fee-receipt', 'FeeReceiptCrudController');
    CRUD::resource('class-fee', 'ClassFeeCrudController');
    CRUD::resource('exam-session', 'ExamSessionCrudController');
    CRUD::resource('fee-type', 'FeeTypeCrudController');
    CRUD::resource('feedback', 'FeedbackCrudController');
});
Route::get('api/exam-session', 'App\Http\Controllers\Admin\ExamCrudController@adminExamSessions');
Route::get('api/exam-session/{id}', 'App\Http\Controllers\Admin\ExamCrudController@show');
