<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\RoleRequest as StoreRequest;
use App\Http\Requests\RoleRequest as UpdateRequest;

/**
 * Class RoleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class RoleCrudController extends CrudController
{
    public function setup()
    {
//        dd(\App\User::find(637)->getAllPermissions());
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Role');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/role');
        $this->crud->setEntityNameStrings('role', 'roles');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addFields([
            [
                'label'=>'Name',
                'name'=>'name',
            ],
            [
                'label'=>'Guard',
                'name'=>'guard_name',
                'default'=>'web',
                'type'=>'hidden'
            ],
//            [   // CustomHTML
//                'name' => 'separator',
//                'type' => 'custom_html',
//                'value' => '</div></div></div><div><div><div>'
//            ],
//            [   // Select2Multiple = n-n relationship (with pivot table)
//                'label' => "Permissions",
//                'type' => 'select2_multiple',
//                'name' => 'permissions', // the method that defines the relationship in your Model
//                'entity' => 'permissions', // the method that defines the relationship in your Model
//                'attribute' => 'name', // foreign key attribute that is shown to user
//                'model' => "App\Models\Permission", // foreign key model
//                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
//            ],
            [
                'name' => 'perms',
                'label' => "Permissions",
                'type' => 'permission_checklist',
                'options' => Permission::pluck('name', 'name')->toArray(),
                'fake' => true, // show the field, but don’t store it in the database column above
                'allows_multiple' => true,

            ],
        ], 'update/create/both');

        $this->crud->addColumns([
            [
                'label'=>'Name',
                'name'=>'name'
            ],
            [
                'label'=>'Guard',
                'name'=>'guard_name',
            ],
            [
                'name' => 'perms',
                'label' => "Permissions",
                'type' => 'array',
                'options' => Permission::pluck('name', 'name')->toArray(),
            ],

        ]);

//        $this->crud->enableDetailsRow();
//        $this->crud->allowAccess('details_row');
        // add asterisk for fields that are required in RoleRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');




        $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);
        if(request()->user()->can('list role'))
            $this->crud->allowAccess('list');
        if(request()->user()->can('create role'))
            $this->crud->allowAccess('create');
        if(request()->user()->can('update role'))
            $this->crud->allowAccess('update');
        if(request()->user()->can('delete role'))
            $this->crud->allowAccess('delete');
    }

    public function store(StoreRequest $request)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function destroy($id)
    {

        $this->denyIfDefault($id);

        return parent::destroy($id);
    }

    private function denyIfDefault($id){
        if(in_array($this->crud->getEntry($id)->name, ['super admin','builder admin', 'customer' ]))
        abort(403);
    }

}
