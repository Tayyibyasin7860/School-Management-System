<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use App\Models\Role;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\User;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ResultRequest as StoreRequest;
use App\Http\Requests\ResultRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ResultCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ResultCrudController extends CrudController
{
    public function setup()
    {
        $allStudents = User::onlyStudents();
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Result');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/result');
        $this->crud->setEntityNameStrings('result', 'results');

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
                'name' => 'exam_session',
                'label' => "Exam Session"
            ],
            [
                'label' => 'Student Name',
                'name' => 'student_id',
                'type' => 'select',
                'entity' => 'student',
                'attribute' => 'name'
            ],
            [
                'label' => 'Subject',
                'name' => 'exam_id',
                'type' => 'select',
                'entity' => 'exam.subject',
                'attribute' => 'title'
            ],
            [
                'label' => 'Class',
                'name' => 'class_id',
                'type' => 'select',
                'entity' => 'exam.classRoom',
                'attribute' => 'title'
            ],
            [
                'label' => 'Total Marks',
                'name' => 'total_marks',
            ],
            [
                'label' => 'Obtained Marks',
                'name' => 'obtained_marks',
            ]
        ]);
        if (auth()->user()->hasRole('school_admin')) {
            $this->crud->addFields([
                [
                    'name' => 'student_id',
                    'label' => "Student Name",
                    'type' => 'select2_from_array',
                    'options' => User::getAdminStudents(),
                    'allows_null' => false,
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'name' => 'student_id',
                    'label' => "Student Name",
                    'type' => 'select2_from_array',
                    'options' => $allStudents,
                    'allows_null' => false,
                ],
            ]);
        }
        if (auth()->user()->hasRole('super_admin')) {
            $this->crud->addFields([
                [
                    'name' => 'exam_id',
                    'label' => "Exam",
                    'type' => 'select',
                    'entity' => 'exam',
                    'attribute' => 'examAdmin',
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'name' => 'exam_id',
                    'label' => "Exam",
                    'type' => 'select',
                    'entity' => 'exam',
                    'attribute' => 'descriptiveName',
                ],
            ]);
        }
        $this->crud->addFields([
//            [
//                'name' => 'exam_id',
//                'label' => "Exam",
//                'type' => 'select',
//                'entity' => 'exam',
//                'attribute' => 'descriptiveName',
//            ],
            [
                'label' => 'Total Marks',
                'name' => 'total_marks',
                'type' => 'text'
            ],
            [
                'label' => 'Obtained Marks',
                'name' => 'obtained_marks',
                'type' => 'text'
            ],
            [
                'label' => 'Teacher Remarks',
                'name' => 'remarks',
                'text' => 'text'
            ]
        ]);

        // add asterisk for fields that are required in ResultRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        if (backpack_user()->hasRole('super_admin')) {
            $this->crud->addFilter([ // dropdown filter
                'name' => 'admin_id',
                'type' => 'dropdown',
                'label' => 'Admins'
            ], Role::getAllAdmins(), function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'student', function ($query) use ($value) {
                    $query->where('admin_id', $value);
                });

            });
        }
        if (auth()->user()->hasRole('school_admin')) {
            $this->crud->addClause('whereHas', 'student', function ($query) {
                $query->where('admin_id', '=', backpack_user()->id);
            });
        }
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
