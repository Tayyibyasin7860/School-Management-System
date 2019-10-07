<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ExamSessionRequest as StoreRequest;
use App\Http\Requests\ExamSessionRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ExamSessionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ExamSessionCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\ExamSession');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/exam-session');
        $this->crud->setEntityNameStrings('exam session', 'exam sessions');

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
                'label' => 'Title',
                'name' => 'title'
            ],
            [
                'label' => 'Year',
                'name' => 'year'
            ],

        ]);
        $this->crud->addFields([
            [
                'label' => 'Title',
                'name' => 'title'
            ],
            [
                'label' => 'Year',
                'name' => 'year'
            ],

        ]);
        // add asterisk for fields that are required in ExamSessionRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->removeColumn('admin_id');
        $this->crud->removeField('admin_id');
        if(auth()->user()->hasRole('school_admin')){
            $this->crud->addClause('where','admin_id','=',backpack_user()->id);
        }
    }

    public function store(StoreRequest $request)
    {

        // your additional operations before save here
        $request->request->set('admin_id', backpack_user()->id);

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
