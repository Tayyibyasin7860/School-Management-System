<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FeedbackRequest as StoreRequest;
use App\Http\Requests\FeedbackRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class FeedbackCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FeedbackCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Feedback');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/feedback');
        $this->crud->setEntityNameStrings('feedback', 'all student feedbacks');
        $this->crud->denyAccess('update');
        $this->crud->removeButton('create');



        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();
        $this->crud->addColumns([
            [
                'name' => 'row_number',
                'type' => 'row_number',
                'label' => 'Sr. #',
                'orderable' => false,
            ],
            [
                'label' => 'Student Name',
                'name' => 'student_id',
                'type' => 'select',
                'entity' => 'student',
                'attribute' =>'name'
            ],
            [
                'label' => 'Subject',
                'name' => 'subject'
            ],
            [
                'label' => 'Feedback',
                'name' => 'message',
                'limit' => '2000'
            ],
            [
            'label' => 'Submission Date',
            'name' => 'submission_date'
            ]
        ]);

        if (backpack_user()->hasRole('school_admin')) {
            $students = User::where('admin_id', backpack_user()->id)->pluck('name', 'id')->toArray();
            $this->crud->addFilter([ // dropdown filter
                'name' => 'student_id',
                'type' => 'select2',
                'label' => 'Student'
            ], $students, function ($value) { // if the filter is active
                $this->crud->addClause('where', 'student_id', $value);
            });
        }
        if(backpack_user()->hasRole('super_admin')){
            $this->crud->addColumn([
                'label' => 'Admin',
                'name' => 'admin_id',
                'type' => 'select',
                'entity' => 'schoolAdmin',
                'attribute' => 'name',
            ]);
        }
        if (backpack_user()->hasRole('super_admin')) {
            $this->crud->addFilter([ // dropdown filter
                'name' => 'admin_id',
                'type' => 'dropdown',
                'label' => 'Admins'
            ], Role::getAllAdmins(), function ($value) { // if the filter is active
                $this->crud->addClause('where', 'admin_id','=',$value);
            });
        }
        // add asterisk for fields that are required in FeedbackRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $user_id = backpack_user()->id;
        if (auth()->user()->hasRole('school_admin')){
            $this->crud->addClause('where','admin_id','=',$user_id);
        }    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
