<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FeeRequest as StoreRequest;
use App\Http\Requests\FeeRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class FeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FeeCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Fee');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/fee');
        $this->crud->setEntityNameStrings('fee', 'fees');

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
                'label'=> 'Title',
                'name' => 'title',
            ],
            [
                'label'=> 'Amount',
                'name' => 'amount',
            ],
            [
                'label'=> 'Student Name',
                'name' => 'user_id',
                'type' =>'select',
                'entity'=> 'User',
                'attribute' => 'name',
            ],
            [
                'label'=> 'Due Date',
                'name' => 'due_date'
            ],
            [
                'label'=> 'Status',
                'name' => 'status',
            ],

        ]);

        $this->crud->addFields([
            [
                'label'=> 'Title',
                'name' => 'title',
            ],
            [
                'label'=> 'Amount',
                'name' => 'amount',
                'type' => 'number'
            ],
            [
                'label'=> 'Student Name',
                'name' => 'user_id',
                'type' =>'select',
                'entity'=> 'User',
                'attribute' => 'name',
            ],
            [
                'label' => 'Due Date',
                'name' => 'due_date',
                'type' => 'date'
            ],
            [
                'label'=> 'Status',
                'name' => 'status',
                'type' => 'enum'
            ],

        ]);
        $this->crud->addFilter([ // simple filter
            'type' => 'simple',
            'name' => 'status',
            'label'=> 'Pending Fee Students'
        ],
            false,
            function() { // if the filter is active
                $this->crud->addClause('where', 'status', 'Pending');
            } );
        // add asterisk for fields that are required in FeeRequest
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
