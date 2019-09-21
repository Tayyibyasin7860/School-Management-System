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
         $this->crud->setFromDb();

//        $this->crud->addFields([
//
//            [
//                'label'=> 'Title',
//                'name' => 'title',
//            ],
//            [
//                'label'=> 'Capacity',
//                'name' => 'capacity',
//            ],
//            [
//                'label'=> 'Teacher',
//                'name' => 'teacher_id',
//                'type' =>'select2',
//                'entity'=> 'teacher',
//                'attribute' => 'name',
//            ],
//            [
//                'label'=> 'Admin',
//                'name' => 'admin_id',
//                'type' =>'select2',
//                'entity'=> 'admin',
//                'attribute' => 'name',
//            ],
//        ]);
//        $this->crud->addColumns([
//            [
//                'label'=> 'ID',
//                'name' => 'id',
//            ],
//            [
//                'label'=> 'Title',
//                'name' => 'title',
//            ],
//            [
//                'label'=> 'Capacity',
//                'name' => 'capacity',
//            ],
//            [ //this show teacher name
//                'label'=> 'Teacher',
////                'name' => 'teacher_id',
////                'type' =>'select',
////                'entity'=> 'teacher',
////                'attribute' => 'name',
//            ],
//            [ //this shows user name
//                'label'=> 'Admin',
//                'name' => 'admin_id',
//                'type' =>'select',
//                'entity'=> 'admin', // the name of method in ClassRoomModel
//                'attribute' => 'name', // name is the related model attribute, related model is User and name it user's attribute that we wanted to show
//            ],
//        ]);
        // add asterisk for fields that are required in ClassRequest
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
