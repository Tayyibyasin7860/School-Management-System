<?php

namespace App\Http\Controllers\Admin;
use App\Models\StudentDetails;
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
class StudentUserCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/student');
        $this->crud->setEntityNameStrings('student account', 'student accounts');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->addButtonFromModelFunction('line', 'profile', 'profileButton', 'end');
        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();
        $this->crud->removeField('admin_id');
        if(backpack_user()->hasRole('super_admin')) {
            $this->crud->addFields([
                [
                    'label' => 'Admin',
                    'name' => 'admin_id',
                    'type' => 'select2',
                    'entity' => 'schoolAdmin',
                    'attribute' => 'name',
                ],
            ]);
        }
        // add asterisk for fields that are required in UserRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $user_id = backpack_user()->id;
        $this->crud->addClause('where','admin_id','=',$user_id);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        // your additional operations before save here
        if ($password = $request->input('password')) {
            $request->merge(['password' => bcrypt($password)]);
        } else {
            $request->request->remove('password');
        }

        $request->request->set('admin_id', backpack_user()->id);

        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        $this->crud->entry->assignRole('student');
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
