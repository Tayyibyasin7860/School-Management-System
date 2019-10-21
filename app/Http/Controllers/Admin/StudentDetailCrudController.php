<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\StudentRequest as StoreRequest;
use App\Http\Requests\StudentRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\App;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class StudentDetailCrudController extends CrudController
{
    public function setup()
    {

        $student_id = \Route::current()->parameter('student_id');
        $student_name = User::where('id',$student_id)->pluck('name')->first();

        // set a different route for the admin panel buttons
        $this->crud->setRoute(config('backpack.base.route_prefix')."/student/".$student_id.'/profile');

            $user = User::find($student_id);
            $schoolAdminClasses = $user->getStudentDetailAdminAttribute();
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\StudentDetail');
      //  $this->crud->setRoute(config('backpack.base.route_prefix') . '/student');
        $this->crud->setEntityNameStrings($student_name . '\'s' . ' profile', 'profiles');
        $this->crud->addClause('where', 'student_id', '=', $student_id);
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
                'name' => 'student_id',
                'type' => 'number',
                'entity' => 'User',
                'attribute' => 'id'
            ],
            [
                'label' => 'photo',
                'name' => 'photo',
                'type' => 'image',
                'height' => '70px',
                'width' => '70px',
                'prefix' => 'storage/'
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
                'entity' => 'ClassRoom',
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

        if (backpack_user()->hasRole('school_admin')) {
            $this->crud->addFields([
                [
                    'label' => 'Class',
                    'name' => 'class_id',
                    'type' => 'select2_from_array',
                    'options' => backpack_user()->myClasses(),
                    'attribute' => 'title'
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'label' => 'Class',
                    'name' => 'class_id',
                    'type' => 'select2_from_array',
                    'options' => $schoolAdminClasses,
                    'attribute' => 'title'
                ],
            ]);
        }

        $this->crud->addFields([
            [
                'label' => 'Student ID',
                'name' => "student_id",
                'type' => 'hidden',
                'default' => $student_id,
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
                'label' => "Profile Image",
                'name' => "photo",
                'type' => 'image',
                'upload' => true,
                'crop' => true,
                'aspect_ratio' => 1,
            ],
            [
                'label' => 'Date of Birth',
                'name' => 'date_of_birth',
                'type' => 'date_picker'
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
        try {
            $redirect_location = parent::storeCrud($request);
        } catch (\Illuminate\Database\QueryException $e) {
            abort(404, 'Sorry, you can not add more than one profile for a student.');
        }
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
