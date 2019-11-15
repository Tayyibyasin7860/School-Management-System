<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PermissionRequest as StoreRequest;
use App\Http\Requests\PermissionRequest as UpdateRequest;

/**
 * Class PermissionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PermissionCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Permission');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/permission');
        $this->crud->setEntityNameStrings('permission', 'permissions');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
//        $this->crud->enableBulkActions();
//        $this->crud->addBulkDeleteButton();

        $this->crud->addButtonFromModelFunction('top', 'generatePermissions', 'generatePermissionsButton', 'beginning');

        $this->crud->addFields([
            [
                'label'=>'Name',
                'name'=>'name'
            ],
            [
                'label'=>'Guard',
                'name'=>'guard_name',
                'default'=>'web',
                'type'=>'hidden'
            ],
//            [
//                'label' => "Roles",
//                'type' => 'checklist',
//                'name' => 'roles', // the method that defines the relationship in your Model
//                'entity' => 'roles', // the method that defines the relationship in your Model
//                'attribute' => 'name', // foreign key attribute that is shown to user
//
//            ],
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
            [   // Select2Multiple = n-n relationship (with pivot table)
                'label' => "Roles",
                'type' => 'select_multiple',
                'name' => 'roles', // the method that defines the relationship in your Model
                'entity' => 'roles', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\Models\Role", // foreign key model
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            ],
        ]);


//        $this->crud->addButtonFromModelFunction('top', 'generatePermissionsButton', 'generatePermissionsButton', 'end');

        // add asterisk for fields that are required in PermissionRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');



        $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete', 'generatePermissions']);
        if(request()->user()->can('list permission'))
            $this->crud->allowAccess('list');
        if(request()->user()->can('create permission'))
            $this->crud->allowAccess('create');
        if(request()->user()->can('update permission'))
            $this->crud->allowAccess('update');
        if(request()->user()->can('delete permission'))
            $this->crud->allowAccess('delete');
        if(request()->user()->can('generate permission'))
            $this->crud->allowAccess(['generatePermissions']);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        return $redirect_location;
    }

    public function generatePermissions(){


        $entities = array_merge( Permission::getModels(app_path("Models")));



        foreach($entities as $entity){



            foreach(['list', 'create', 'update', 'delete'] as $action){

//                if($action == 'list')
//                {
//                    echo \Illuminate\Support\Str::lower($action.' '.$entity).', ';
//                    continue;
//                }

                Permission::firstOrCreate([
                    'name' =>\Illuminate\Support\Str::lower($action.' '.$entity),
                    'guard_name'=>'web'
                ]);
            }


        }

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        \Alert::success("Permissions created successfully.")->flash();
        return redirect('admin/permission');
    }
}
