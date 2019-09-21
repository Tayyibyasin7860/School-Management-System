<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

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
        //$this->crud->setFromDb();

        $this->crud->addColumns([
            [
                'name' => 'row_number',
                'type' => 'row_number',
                'label' => 'Sr. #',
                'orderable' => false,
            ],
            [
                'label' => 'Student Name',
                'name' => 'user_id',
                'type' => 'select',
                'entity' => 'User',
                'attribute' => 'name'
            ],
            [
                'label' => 'Exam Name',
                'name' => 'exam_id',
                'type' => 'select',
                'entity' => 'Exam',
                'attribute' => 'title'
            ],
            [
                'label' => 'Class',
                'name' => 'class_id',
                'type' => 'select',
                'entity' => 'ClassRoom',
                'attribute' => 'id'
            ],
            [
                'label' => 'Subject',
                'name' => 'subject_id',
                'type' => 'select',
                'entity' => 'Subject',
                'attribute' => 'title'
            ],
            [
                'label' => 'Total Marks',
                'name' => 'total_marks',
                'type' => 'number',
            ],
            [
                'label' => 'Obtained Marks',
                'name' => 'obtained_marks',
                'type' => 'number',
            ],
        ]);

        $this->crud->addFields([
            [
                'label' => 'Student Name',
                'name' => 'user_id',
                'type' => 'select2',
                'entity' => 'User',
                'attribute' => 'name'
            ],
            [
                'label' => 'Exam Name',
                'name' => 'exam_id',
                'type' => 'select2',
                'entity' => 'Exam',
                'attribute' => 'title'
            ],
//            [
//                'label' => 'Class',
//                'name' => 'class_id',
//                'type' => 'select',
//                'entity' => 'ClassRoom',
//                'attribute' => 'title'
//            ],
            [
                'label' => 'Subject',
                'name' => 'subject_id',
                'type' => 'select',
                'entity' => 'Subject',
                'attribute' => 'title'
            ],
            [
                'label' => 'Total Marks',
                'name' => 'total_marks',
                'type' => 'number',
            ],
            [
                'label' => 'Obtained Marks',
                'name' => 'obtained_marks',
                'type' => 'number',
            ],
        ]);

        // add asterisk for fields that are required in ResultRequest
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
