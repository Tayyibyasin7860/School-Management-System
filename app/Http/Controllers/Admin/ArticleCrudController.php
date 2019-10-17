<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Role;
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\NewsCRUD\app\Http\Requests\ArticleRequest as StoreRequest;
use Backpack\NewsCRUD\app\Http\Requests\ArticleRequest as UpdateRequest;

class ArticleCrudController extends CrudController
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

        $this->crud->setModel("App\Models\Article");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/article');
        $this->crud->setEntityNameStrings('Announcement or News', 'Notice Board');
        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        $categories = backpack_user()->categories->pluck('name','id')->toArray();
        // ------ CRUD COLUMNS
        $this->crud->addColumn([
               'name' => 'row_number',
               'type' => 'row_number',
               'label' => 'Sr. #',
               'orderable' => false,
           ]);


        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Title',
            'limit' => 40
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
        $this->crud->addColumn([
            'label' => 'Category',
            'type' => 'select',
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => "Backpack\NewsCRUD\app\Models\Category",
        ]);
        $this->crud->addColumn([
            'name' => 'content',
            'label' => 'Content',
            'limit' => 2000
        ]);

        $this->crud->addColumn([
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
        ]);
        // ------ CRUD FIELDS
        $this->crud->addField([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
            'placeholder' => 'Your title here',
        ]);

        $this->crud->addField([
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
            'value' => date('Y-m-d'),
        ], 'create');
        $this->crud->addField([    // TEXT
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
        ], 'update');

        $this->crud->addField([    // WYSIWYG
            'name' => 'content',
            'label' => 'Content',
            'type' => 'ckeditor',
            'placeholder' => 'Your textarea text here',
        ]);
        if (backpack_user()->hasRole('school_admin')) {
            $this->crud->addField([
                'label' => 'Category',
                'name' => 'category_id',
                'type' => 'select2_from_array',
                'options' => $categories,
            ]);
        } else {
            $this->crud->addField([
                'label' => 'Category',
                'name' => 'category_id',
                'type' => 'select2_from_array',
                'options' => Category::getCategoriesWithAdminAttribute(),
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
                'type' => 'select_from_array',
                'options'=>Role::getAllAdmins()
            ]);
        }
        $this->crud->addField([    // CHECKBOX
            'name' => 'status',
            'label' => 'Status',
            'type' => 'hidden',
            'value' => 'Published'
        ]);
        $this->crud->enableAjaxTable();

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
