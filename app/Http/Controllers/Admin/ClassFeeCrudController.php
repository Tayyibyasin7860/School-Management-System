<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassRoom;
use App\Models\Role;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ClassFeeRequest as StoreRequest;
use App\Http\Requests\ClassFeeRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ClassFeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ClassFeeCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\ClassFee');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/class-fee');
        $this->crud->setEntityNameStrings('fee of a class', 'fees of classes');

        $admin = User::find(backpack_user()->id);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

		$feeTypes=  backpack_user()->adminFeeTypes->pluck('type','id')->toArray();
        if (auth()->user()->hasRole('school_admin')) {
            $this->crud->addFields([
                [
                    'label' => 'Class',
                    'name' => 'class_id',
                    'type' => 'select_from_array',
                    'options' => $admin->myClasses(),
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
            $this->crud->addFields([
                [
                    'name' => 'fee_type_id',
                    'label' => "Fee Type",
                    'type' => 'select2_from_array',
                    'options' => User::adminFeesTypes(),
                    'allows_null' => false,
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'name' => 'fee_type_id',
                    'label' => "Fee Type",
                    'type' => 'select2',
                    'entity' => 'feeType',
                    'attribute' => 'type',
                ]
            ]);
        }
        $this->crud->addFields([
			[
                'label' => 'Amount',
                'name' => 'amount',
                'type' => 'number'
            ],
		]);
		$this->crud->addColumns([
            [
               'name' => 'row_number',
               'type' => 'row_number',
               'label' => 'Sr. #',
               'orderable' => false,
				],

            [
                'label' => 'Class',
                'name' => 'class_id',
                'type' => 'select',
                'entity' => 'classRoom',
                'attribute' => 'title'
            ],
            [
                'label' => 'Fee Type',
                'name' => 'fee_type_id',
                'type' => 'select',
                'entity' => 'feeType',
                'attribute' => 'type'
            ],
			[
                'label' => 'Amount',
                'name' => 'amount',
                'type' => 'number'
            ],
		]);

        $classes=  backpack_user()->myClasses();
        $this->crud->addFilter([ // dropdown filter
          'name' => 'class_id',
          'type' => 'dropdown',
          'label'=> 'Class'
        ], $classes, function($value) { // if the filter is active
            $this->crud->addClause('where', 'class_id', $value);
        });
        if (auth()->user()->hasRole('school_admin')) {
            $this->crud->addClause('whereHas', 'classRoom', function ($query) {
                $query->where('admin_id', '=', backpack_user()->id);
            });
        }
        // add asterisk for fields that are required in ClassFeeRequest
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
