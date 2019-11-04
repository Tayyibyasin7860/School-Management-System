<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassRoom;
use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\Subject;
use App\User;
use App\Models\Role;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
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
//        $this->crud->setFromDb();

        if (auth()->user()->hasRole('school_admin')) {
            $this->crud->addColumns([
                [
                    'label' => 'Exam Session',
                    'name' => 'exam_session_id',
                    'type' => 'select_from_array',
                    'options' => \App\User::myExamSessions(),
                    'attribute' => 'title'
                ],
            ]);
        } else {
            $this->crud->addColumns([
                [
                    'label' => 'Exam Session',
                    'name' => 'exam_session_id',
                    'type' => 'select',
                    'entity' => 'examSession',
                    'attribute' => 'title'
                ],
            ]);
        }
        $this->crud->addColumns([
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
        if (auth()->user()->hasRole('school_admin')) {
            $this->crud->addFields([
                [
                    'label' => 'Exam Session',
                    'name' => 'exam_session_id',
                    'type' => 'select2_from_array',
                    'options' => User::myExamSessions(),
                    'attribute' => 'title'
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'label' => 'Exam Session',
                    'name' => 'exam_session_id',
                    'type' => 'select_from_array',
                    'options' => ExamSession::getExamSessionWithAdminAttribute()
                ]
            ]);
        }
        if (auth()->user()->hasRole('school_admin')) {
            $user = User::find(auth()->user()->id);
            $myClasses = $user->myClasses();
            $this->crud->addFields([
                [
                    'label' => 'Class',
                    'name' => 'class_id',
                    'type' => 'select2_from_array',
                    'options' => $myClasses,
                    'attribute' => 'title'
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'label' => 'Class',
                    'name' => 'class_id',
                    'type' => 'select2_from_array',
                    'options' => ClassRoom::getClassWithAdminAttribute()
                ]
            ]);
        }
        if (auth()->user()->hasRole('school_admin')) {
            $user = User::find(auth()->user()->id);
            $mySubjects = $user->mySubjects();
            $this->crud->addFields([
                [
                    'label' => 'Subject',
                    'name' => 'subject_id',
                    'type' => 'select2_from_array',
                    'options' => $mySubjects,
                    'attribute' => 'title'
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'label' => 'Subject',
                    'name' => 'subject_id',
                    'type' => 'select2_from_array',
                    'options' => Subject::getSubjectWithAdminAttribute()
                ],
            ]);
        }
        $this->crud->addFields([
            [
                'label' => 'Date',
                'name' => 'date',
                'type' => 'date_picker'
            ],
        ]);


        if (backpack_user()->hasRole('super_admin')) {
            $this->crud->addFilter([ // dropdown filter
                'name' => 'admin_id',
                'type' => 'dropdown',
                'label' => 'Admins'
            ], Role::getAllAdmins(), function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'classRoom', function ($query) use ($value) {
                    $query->where('admin_id', $value);
                });

            });
        }

        // add asterisk for fields that are required in ExamRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        if (auth()->user()->hasRole('school_admin')) {
            $this->crud->addClause('whereHas', 'examSession', function ($query) {
                $query->where('admin_id', '=', backpack_user()->id);
            });
        }

    }

    public function store(StoreRequest $request)
    {

        // your additional operations before save here
        if (auth()->user()->hasRole('school_admin')) {
//            $request->request->set('admin_id', backpack_user()->id);
        }
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
    public function adminExamSessions(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');

        $options = ExamSession::query();

        // if no category has been selected, show no options
        if (! $form['admin_id']) {
            return [];
        }

        // if a category has been selected, only show articles in that category
        if ($form['admin_id']) {
            $options = $options->where('admin_id', $form['admin_id']);
        }

        if ($search_term) {
            $results = $options->where('title', 'LIKE', '%'.$search_term.'%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $options->paginate(10);
    }

    public function show($id)
    {
        return ExamSession::find($id);
    }
}
