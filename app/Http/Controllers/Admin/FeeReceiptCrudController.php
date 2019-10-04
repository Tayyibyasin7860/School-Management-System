<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FeeReceiptRequest as StoreRequest;
use App\Http\Requests\FeeReceiptRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use App\User;

/**
 * Class FeeReceiptCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FeeReceiptCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\FeeReceipt');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/fee-receipt');
        $this->crud->setEntityNameStrings('Fee Receipt', 'fee receipts');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $userAdminStudents = User::getAdminStudents();
        $userAdminStudentsWithAllStudents [] = 'All Students';
        foreach ($userAdminStudents as $userAdminStudent){
            $userAdminStudentsWithAllStudents [] = $userAdminStudent;
        }
//        $userAdminStudentsWithAllStudents [] = User::getAdminStudents();
//        dd($userAdminStudentsWithAllStudents);

        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();
            $this->crud->addColumns([
                [
                    'label' => 'Student Name',
                    'name' => 'student_id',
                    'type' => 'select',
                     'entity' => 'student',
                    'attribute' => 'name'
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
                ],
                [
                    'label' => 'Amount',
                    'name' => 'amount',
                ],
                [
                    'label' => 'Submitted Amount',
                    'name' => 'submitted_amount',
                ],
                [
                    'label' => 'Due Date',
                    'name' => 'due_date',
                    'type' => 'date'
                ],
                [
                    'label' => 'Status',
                    'name' => 'status',
                ],
                [
                    'label' => 'Submission Date',
                    'name' => 'submission_date',
                ],
            ]);
            $this->crud->addFields([
                [
                    'label' => 'Fee Type',
                    'name' => 'fee_type_id',
                    'type' => 'select',
                    'entity' => 'feeType',
                    'attribute' => 'type'
                ],
                [
                    'name' => 'student_id',
                    'label' => "Student Name",
                    'type' => 'select_from_array',
                    'options' => $userAdminStudents,
                    'allows_null' => false,
                ],
                [
                    'label' => 'Amount',
                    'name' => 'amount',
                ],
                [
                    'label' => 'Amount',
                    'name' => 'amount',
                ],
                [
                    'label' => 'Submitted Amount',
                    'name' => 'submitted_amount',
                ],
                [
                    'label' => 'Due Date',
                    'name' => 'due_date',
                    'type' => 'date'
                ],
                [
                    'label' => 'Status',
                    'name' => 'status',
                    'type' => 'enum'
                ],
                [
                    'label' => 'Submission Date',
                    'name' => 'submission_date',
                    'type' => 'date_picker',
                    'allows_null' => true,
                    'default'=>true
                ],
            ]);
        // add asterisk for fields that are required in FeeReceiptRequest
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

    public function generateReceiptForm(){
        return view('vendor/backpack/base/generateReceipts');
    }

    public function generateReceipt(){
        return 'create form view';
    }
}
