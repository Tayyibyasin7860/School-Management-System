<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ClassSubjectBaseCrudController;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation

use App\Http\Requests\ClassSubjectRequest as StoreRequest;
use App\Http\Requests\ClassSubjectRequest as UpdateRequest;
/**
 * Class WebsitePageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ClassSubjectCrudController extends ClassSubjectBaseCrudController
{
    public function setup()
    {
        parent::setup();

        /**/
        $class_id = \Route::current()->parameter('class_id');

        // set a different route for the admin panel buttons
        $this->crud->setRoute(config('backpack.base.route_prefix')."/class/".$class_id.'/subject');

        $class = \App\Models\ClassRoom::find($class_id);

        $this->crud->setEntityNameStrings('Subject of class '.$class->title, 'Subjects of class '.$class->title);

        // show only that admin users
        $this->crud->addClause('where', 'class_id', '=', $class_id);

//        $this->crud->addButtonFromModelFunction('line', 'blocks', 'blocksButton', 'end');
        $this->crud->removeColumn('website_id');


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
