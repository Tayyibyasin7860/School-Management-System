<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ExamRequest as StoreRequest;
use App\Http\Requests\ExamRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ExamCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ExamCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Exam');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/exam');
        $this->crud->setEntityNameStrings('exam', 'exams');

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
                'label' => 'Title',
                'name' => 'title',
            ],
            [
                'label' => 'Subject',
                'name' => 'subject_id',
                'type' => 'select',
                'entity' => 'Subject',
                'attribute' => 'title'
            ],
            [
                'label' => 'Date',
                'name' => 'date'
            ],
            [
                'label' => 'Class',
                'name' => 'class_id',
                'type' => 'select',
                'entity' => 'ClassRoom',
                'attribute' => 'title'
            ],
        ]);
        $this->crud->addFields([
            [
                'label' => 'Title',
                'name' => 'title'
            ],
            [
                'label' => 'Subject',
                'name' => 'subject_id',
                'type' => 'select',
                'entity' => 'Subject',
                'attribute' => 'title'
            ],
            [
                'label' => 'Student Name (optional)',
                'name' => 'user_id',
                'type' => 'select',
                'entity' => 'User',
                'attribute' => 'name'
            ],
//            [
//                'label' => 'Class',
//                'name' => 'class_id',
//                'type' => 'select',
//                'entity' => 'ClassRoom',
//                'attribute' => 'title'
//            ],
            [
                'label' => 'Date',
                'name' => 'date',
                'type' => 'date'
            ],
        ]);

        // add asterisk for fields that are required in ExamRequest
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
