<?php

namespace App\Http\Controllers\Admin;

use App\User;
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

        $student_id = \Route::current()->parameter('student_id');
        $student_name = User::where('id',$student_id)->pluck('name')->first();

        // set a different route for the admin panel buttons
        $this->crud->setRoute(config('backpack.base.route_prefix')."/student/".$student_id.'/profile');


        // show only that admin users



        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\StudentDetail');
      //  $this->crud->setRoute(config('backpack.base.route_prefix') . '/student');
        $this->crud->setEntityNameStrings('profile', 'profiles');

        $this->crud->addClause('where', 'user_id', '=', $student_id);
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
                'name' => 'class_id',
                'type' => 'select',
                'entity' => 'class',
                'attribute' => 'title'
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
                'label' => 'Student ID',
                'name' => "user_id",
                'type' => 'hidden',
                'default' => $student_id,
            ],
            [ // image
                'label' => "Profile Image",
                'name' => "photo",
                'type' => 'image',
                'upload' => true,
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
                // 'disk' => 's3_bucket', // in case you need to show images from a different disk
                // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
            ],
            [
                'label' => 'Class',
                'name' => 'class_id',
                'type' => 'select',
                'entity' => 'class',
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
