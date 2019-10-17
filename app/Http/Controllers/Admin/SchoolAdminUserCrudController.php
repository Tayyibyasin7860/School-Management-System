<?php

namespace App\Http\Controllers\Admin;
use App\Models\StudentDetail;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserRequest as StoreRequest;
use App\Http\Requests\UserRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SchoolAdminUserCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/school-admin');
        $this->crud->setEntityNameStrings('School Admin', 'School Admins');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();
        $this->crud->removeField('admin_id');
        $this->crud->removeColumn('admin_id');

        $this->crud->addField([
            'label' => 'Password Confirmation',
            'name' => 'password_confirmation',
            'type' => 'password'
        ]);

        // add asterisk for fields that are required in UserRequest
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
        $this->crud->addClause('role','school_admin');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        if ($password = $request->input('password')) {
            $request->merge(['password' => bcrypt($password)]);
        } else {
            $request->request->remove('password');
        }
        $redirect_location = parent::storeCrud($request);

        $this->crud->entry->assignRole('school_admin');
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
