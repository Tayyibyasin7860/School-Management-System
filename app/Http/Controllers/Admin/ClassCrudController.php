<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ClassRequest as StoreRequest;
use App\Http\Requests\ClassRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ClassCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ClassCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\ClassRoom');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/class');
        $this->crud->setEntityNameStrings('class', 'classes');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
         //$this->crud->setFromDb();


         $this->crud->addColumns([
             [
                 'label' => 'Name',
                 'name'  => 'title',
             ],
             [
                 'label' => 'Capacity',
                 'name'  => 'capacity',
             ],
             [
                 'label' => 'Available Seats',
                 'name'  => 'available_seats',
             ]
         ]);
        $this->crud->addFields([
            [
                'label' => 'Name',
                'name'  => 'title',
            ],
            [
                'label' => 'Capacity',
                'name'  => 'capacity',
            ],
        ]);


        // add asterisk for fields that are required in ClassRequest
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
