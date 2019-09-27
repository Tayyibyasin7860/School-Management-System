<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\StudentRequest as StoreRequest;
use App\Http\Requests\StudentRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    public function setup()
    {

        $studentid = \Route::current()->parameter('student_id');
        // set a different route for the admin panel buttons
        $this->crud->setRoute(config('backpack.base.route_prefix')."/student/".$studentid.'/profile');


        // show only that admin users



        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\StudentDetail');
      //  $this->crud->setRoute(config('backpack.base.route_prefix') . '/student');
        $this->crud->setEntityNameStrings('profile', 'profiles');

        $this->crud->addClause('where', 'user_id', '=', $studentid);
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        $this->crud->addColumns([
            [
                'label' => 'Student ID',
                'name' => 'user_id',
                'type' => 'number',
                'entity' => 'User',
                'attribute' => 'id'
            ],
            [
                'label' => 'photo',
                'name' => 'photo',
                'type' => 'image',
                'prefix' => 'storage/',
                'height' => '40px',
                'width' => '40px'
            ],
            [
                'label' => 'Name',
                'name' => 'name',
                'type' => 'select',
                'entity' => 'User',
                'attribute' => 'name',
            ],
            [
                'label' => 'Class',
                'name' => 'class_id'
            ],
            [
                'label' => 'Father Name',
                'name' => 'father_name'
            ],
            [
                'label' => 'gender',
                'name' => 'gender'
            ],
            [
                'label' => 'Date of Birth',
                'name' => 'date_of_birth',
            ],
            [
                'label' => 'Email',
                'name' => 'user_email',
                'type' => 'select',
                'entity' => 'User',
                'attribute' => 'email'

            ],
            [
                'label' => 'Phone Number',
                'name' => 'phone_number'
            ],
            [
                'label' => 'Address',
                'name' => 'address'
            ]

        ]);

        $this->crud->addFields([
            [
                'label' => 'Name',
                'name' => 'user_id',
                'type' => 'select',
                'entity' => 'User',
                'attribute' => 'name',
            ],
            [
                'label' => 'photo',
                'name' => 'photo'
            ],
            [
                'label' => 'Class',
                'name' => 'class_id',
                'type' => 'select',
                'entity' => 'ClassRoom',
                'attribute' => 'title'
            ],
            [
                'label' => 'Father Name',
                'name' => 'father_name'
            ],
            [
                'label' => 'gender',
                'name' => 'gender',
                'type' => 'enum'
            ],
            [
                'label' => 'Date of Birth',
                'name' => 'date_of_birth',
                'type' => 'date'
            ],
//            [
//                'label' => 'Email',
//                'name' => 'user_id',
//                'type' => 'select',
//                'entity' => 'User',
//                'attribute' => 'email'
//
//            ],
            [
                'label' => 'Phone Number',
                'name' => 'phone_number'
            ],
            [
                'label' => 'Address',
                'name' => 'address'
            ]
        ]);

        // add asterisk for fields that are required in StudentRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

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
