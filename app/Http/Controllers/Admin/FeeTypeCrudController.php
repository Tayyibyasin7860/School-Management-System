<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FeeTypeRequest as StoreRequest;
use App\Http\Requests\FeeTypeRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class FeeTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FeeTypeCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\FeeType');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/fee-type');
        $this->crud->setEntityNameStrings('Fee type', 'fee types');

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
				'name'=>'type',
				'label'=>'Fee Type'
			],
			[
				'name'=>'due_date',
				'label'=>'Due Date'
			]
		]);
		$this->crud->addFields([
			
			[
				'name'=>'type',
				'label'=>'Fee Type'
			],
			[
				'name'=>'due_date',
				'label'=>'Due Date',
				'type'=>'number',
				'hint'=>'Select day of month.'
			]
		]);
        // add asterisk for fields that are required in FeeTypeRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
		
		$user_id = backpack_user()->id;
        $this->crud->addClause('where','admin_id','=',$user_id);
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
