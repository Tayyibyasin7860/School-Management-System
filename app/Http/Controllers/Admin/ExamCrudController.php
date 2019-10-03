<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exam;
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
//        $this->crud->query = $this->crud->query->with(['examSession' => function ($query) {
//            $query->where('admin_id', '=', backpack_user()->id);
//        }]);
        $exam = Exam::find(1);
        $exam->getAdminIdAttribute();
        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();


        $this->crud->addColumns([
            [
                'label' => 'Admin',
                'name' => 'admin_id',
                'type' => 'select2'
            ],
            [
                'label' => 'Exam Session',
                'name' => 'exam_session_id',
                'type' => 'select',
                'entity' => 'examSession',
                'attribute' => 'title'
            ],
            [
                'label' => 'Class',
                'name' => 'class_id',
                'type' => 'select',
                'entity' => 'classRoom',
                'attribute' => 'title'
            ],
            [
                'label' => 'Subject',
                'name' => 'subject_id',
                'type' => 'select',
                'entity' => 'subject',
                'attribute' => 'title'
            ],
            [
                'label' => 'Date',
                'name' => 'date',
            ],
        ]);
        $this->crud->addFields([
            [
                'label' => 'Exam Session',
                'name' => 'exam_session_id',
                'type' => 'select',
                'entity' => 'examSession',
                'attribute' => 'title'
            ],
            [
                'label' => 'Class',
                'name' => 'class_id',
                'type' => 'select',
                'entity' => 'classRoom',
                'attribute' => 'title'
            ],
            [
                'label' => 'Subject',
                'name' => 'subject_id',
                'type' => 'select',
                'entity' => 'subject',
                'attribute' => 'title'
            ],
            [
                'label' => 'Date',
                'name' => 'date',
                'type' => 'date'
            ],
        ]);

        // add asterisk for fields that are required in ExamRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

//        $user_id = backpack_user()->id;
//        $this->crud->query = $this->crud->query->with('examSession');
//        }]);
//        $this->crud->addClause('where', 'admin_id', backpack_user()->id);
    }

    public function store(StoreRequest $request)
    {
        $request->request->set('admin_id', backpack_user()->id);
        // your additional operations before save here
//        $request->request->set('admin_id', backpack_user()->id);
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
