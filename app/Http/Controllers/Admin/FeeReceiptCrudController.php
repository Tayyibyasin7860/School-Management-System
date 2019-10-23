<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassRoom;
use App\Models\FeeReceipt;
use App\Models\FeeType;
use App\Models\Role;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FeeReceiptRequest as StoreRequest;
use App\Http\Requests\FeeReceiptRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use App\User;
use http\Env\Request;

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
        foreach ($userAdminStudents as $userAdminStudent) {
            $userAdminStudentsWithAllStudents [] = $userAdminStudent;
        }
//        $userAdminStudentsWithAllStudents [] = User::getAdminStudents();
//        dd($userAdminStudentsWithAllStudents);

        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'row_number',
            'type' => 'row_number',
            'label' => 'Sr. #',
            'orderable' => false,
        ]);
        if (backpack_user()->hasRole('super_admin')) {
            $this->crud->addColumn([
                'label' => 'Admin',
                'name' => 'admin_id',
                'type' => 'select',
                'entity' => 'feeType.schoolAdmin',
                'attribute' => 'name'
            ]);
        }
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
                'label' => 'Due Date',
                'name' => 'due_date',
                'type' => 'date'
            ],
            [
                'label' => 'Status',
                'name' => 'status',
            ],
            [
                'label' => 'Submitted Amount',
                'name' => 'submitted_amount',
            ],
            [
                'label' => 'Submission Date',
                'name' => 'submission_date',
            ],
        ]);

        if (auth()->user()->hasRole('school_admin')) {
            $this->crud->addFields([
                [
                    'name' => 'fee_type_id',
                    'label' => "Fee Type",
                    'type' => 'select2_from_array',
                    'options' => User::adminFeesTypes(),
                    'allows_null' => false,
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'name' => 'fee_type_id',
                    'label' => "Fee Type",
                    'type' => 'select2',
                    'entity' => 'feeType',
                    'attribute' => 'type',
                ]
            ]);
        }
        if (auth()->user()->hasRole('school_admin')) {
            $this->crud->addFields([
                [
                    'name' => 'student_id',
                    'label' => "Student Name",
                    'type' => 'select2_from_array',
                    'options' => $userAdminStudents,
                    'allows_null' => false,
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'name' => 'student_id',
                    'label' => "Student",
                    'type' => 'select2_from_array',
                    'options' => User::onlyStudents(),
                ]
            ]);
        }
        $this->crud->addFields([
            [
                'label' => 'Amount',
                'name' => 'amount',
            ],
            [
                'label' => 'Amount',
                'name' => 'amount',
            ],

            [
                'label' => 'Due Date',
                'name' => 'due_date',
                'type' => 'date_picker'
            ],
            [
                'label' => 'Status',
                'name' => 'status',
                'type' => 'enum'
            ],
            [
                'label' => 'Submitted Amount',
                'name' => 'submitted_amount',
            ],
            [
                'label' => 'Submission Date',
                'name' => 'submission_date',
                'type' => 'date_picker',
            ],
        ]);
        // add asterisk for fields that are required in FeeReceiptRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->addFilter([ // dropdown filter
            'name' => 'status',
            'type' => 'dropdown',
            'label' => 'Status'
        ], [
            'Pending' => 'Pending',
            'Paid' => 'Paid',

        ], function ($value) { // if the filter is active
            $this->crud->addClause('where', 'status', $value);
        });
        if (backpack_user()->hasRole('super_admin')) {
            $this->crud->addFilter([ // dropdown filter
                'name' => 'admin_id',
                'type' => 'dropdown',
                'label' => 'Admins'
            ], Role::getAllAdmins(), function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'feeType', function ($query) use ($value) {
                    $query->where('admin_id', $value);
                });
            });
        }
        if (backpack_user()->hasRole('school_admin')) {
            $this->crud->addClause('whereHas', 'student', function ($query) {
                $query->where('admin_id', '=', backpack_user()->id);
            });
        }
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

    public function generateReceiptForm()
    {
        $classRooms = ClassRoom::where('admin_id', backpack_user()->id)->get();
        $feeTypes = FeeType::where('admin_id', backpack_user()->id)->get();
        return view('vendor/backpack/base/generateReceipts', compact('classRooms', 'feeTypes'));
    }

    public function generateReceipt()
    {
        request()->validate([
            'fee_type' => 'required',
            'class' => 'required',
            'due_date' => 'required|date',
        ]);
        $class = ClassRoom::find(request()->class);
        $class_fee = $class->classFee->where('fee_type_id', request()->fee_type)->first();
        if ($class_fee !== null && count($class->students) !== 0) {
            $student_count = 0;
            foreach ($class->students->pluck('student_id') as $student_id)
                FeeReceipt::create([
                    'student_id' => $student_id,
                    'fee_type_id' => request()->fee_type,
                    'amount' => $class_fee->amount,
                    'submitted_amount' => 0,
                    'due_date' => request()->due_date,
                    'status' => 'Pending',
                ]);
            $message = 'All receipts are generated successfully.';
            $classRooms = ClassRoom::where('admin_id', backpack_user()->id)->get();
            $feeTypes = FeeType::where('admin_id', backpack_user()->id)->get();
            return redirect('admin/fee-receipt/generate')->with([
                'message' => $message,
                'classRooms' => $classRooms,
                'feeTypes' => $feeTypes,
            ]);
        } else {
            $classRooms = ClassRoom::where('admin_id', backpack_user()->id)->get();
            $feeTypes = FeeType::where('admin_id', backpack_user()->id)->get();
            if ($class_fee == null) {
                $message = 'Please create fee for this class first';
            } else {
                $message = 'No receipts were generated because this class has no students';
            }
//            dd($message);
            return redirect('admin/fee-receipt/generate')->with([
                'errorMessage' => $message,
                'classRooms' => $classRooms,
                'feeTypes' => $feeTypes,
            ]);
        }
    }
}
