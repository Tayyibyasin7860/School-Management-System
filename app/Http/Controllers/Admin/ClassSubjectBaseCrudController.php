<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassRoom;
use App\Models\ClassSubject;
use App\Models\Subject;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ClassSubjectRequest as StoreRequest;
use App\Http\Requests\ClassSubjectRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ClassSubjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ClassSubjectBaseCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\ClassSubject');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/class-subject');
        $this->crud->setEntityNameStrings('subject corrsponding to class', 'subjects in a class');

//        $classSubject = ClassSubject::find(1)->classRoom;
//        dd($classSubject);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();
        $this->crud->addColumns([
            [
                'label' => 'Subject',
                'name' => 'subject_id',
                'type' => 'select',
                'entity' => 'subject',
                'attribute' => 'title'
            ],

        ]);
        $this->crud->addFields([
            [
                'name' => 'class_id',
                'type' => 'select_from_array',
                'options' => ClassRoom::getAdminClasses(),
                'allows_null' => false,
            ],
            [
                'name' => 'subject_id',
                'label' => "Subject",
                'type' => 'select2_from_array',
                'options' => Subject::getAdminSubjects(),
                'allows_null' => false,
                'allows_multiple'=>true
            ],
////            [
////                'label' => 'Subject',
////                'name' => 'subject_id',
////                'type' => 'select',
////                'entity' => 'Subject',
////                'attribute' => 'title'
////            ]
        ]);
        // add asterisk for fields that are required in ClassSubjectRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

//        $this->crud->addClause('where','class_room',backpack_user()->id);
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
