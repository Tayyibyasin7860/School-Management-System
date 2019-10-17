<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\NewsCRUD\app\Http\Requests\CategoryRequest as StoreRequest;
use Backpack\NewsCRUD\app\Http\Requests\CategoryRequest as UpdateRequest;

class CategoryCrudController extends CrudController
{
    public function __construct()
    {
        parent::__construct();


    }
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Category");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/category');
        $this->crud->setEntityNameStrings('category', 'categories');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */

        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('name', 2);

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
               'name' => 'row_number',
               'type' => 'row_number',
               'label' => 'Sr. #',
               'orderable' => false,
           ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Name',
        ]);
        if (backpack_user()->hasRole('super_admin')) {
            $this->crud->addColumn([
                'name' => 'admin_id',
                'label' => 'Admin',
                'type' => 'select',
                'entity' => 'schoolAdmin',
                'attribute' => 'name'
            ]);
        }
        if (backpack_user()->hasRole('super_admin')) {
            $this->crud->addFilter([ // dropdown filter
                'name' => 'admin_id',
                'type' => 'dropdown',
                'label' => 'Admins'
            ], Role::getAllAdmins(), function ($value) { // if the filter is active
                $this->crud->addClause('where', 'admin_id','=',$value);
            });
        }
        // ------ CRUD FIELDS
        $this->crud->addField([
            'name' => 'name',
            'label' => 'Name',
        ]);
        if (backpack_user()->hasRole('school_admin')) {
            $this->crud->addField([    // CHECKBOX
                'name' => 'admin_id',
                'label' => 'Admin ID',
                'type' => 'hidden',
                'value' => backpack_user()->id
            ]);
        }else{
            $this->crud->addField([    // CHECKBOX
                'name' => 'admin_id',
                'label' => 'Admin ID',
                'type' => 'select2_from_array',
                'options' => Role::getAllAdmins()
            ]);
        }

        $user_id = backpack_user()->id;
        if (auth()->user()->hasRole('school_admin')){
            $this->crud->addClause('where','admin_id','=',$user_id);
        }

    }
    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}
