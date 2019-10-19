<?php

namespace App\Http\Controllers\Admin;
use App\Jobs\WelcomeStudentMailJob;
use App\Mail\WelcomeStudentMail;
use App\Models\Role;
use App\Models\StudentDetail;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserRequest as StoreRequest;
use App\Http\Requests\UserRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Carbon\Carbon;
use http\Client\Curl\User;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;

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
        //$this->crud->setFromDb();
	$this->crud->addColumns([
			[
                'name' => 'row_number',
                'type' => 'row_number',
                'label' => 'Sr. #',
                'orderable' => false,
            ],
		[
			'name'=>'name',
			'label'=>'Name'
		],
		[
			'name'=>'email',
			'label'=>'Email'
		],
		[
			'name'=>'class_id',
			'label'=>'Class',
			'type' => 'select',
			'entity' => 'studentDetail.classRoom',
			'attribute' => 'title'
		]
	]);

	$this->crud->addFields([
		[
			'name'=>'name',
			'label'=>'Name'
		],
		[
			'name'=>'email',
			'label'=>'Email'
		],
		[
			'name'=>'password',
			'label'=>'Password',
			'type' => 'password',


		]
	]);
        $this->crud->removeField('admin_id');
        $this->crud->addFields([
                [
                    'label' => 'Confirm Password',
                    'name' => 'password_confirmation',
                    'type' => 'password'
                ],
            ]);


        if (backpack_user()->hasRole('school_admin')) {
            $classes = backpack_user()->myClasses();
            $this->crud->addFilter([ // dropdown filter
                'name' => 'class_id',
                'type' => 'dropdown',
                'label' => 'Class'
            ], $classes, function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'studentDetail', function ($query) use ($value) {
                    $query->where('class_id', $value);
                });
            });
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
        if(backpack_user()->hasRole('super_admin')) {
            $this->crud->addFields([
                [
                    'label' => 'Admin',
                    'name' => 'admin_id',
                    'type' => 'select_from_array',
                    'options'=>Role::getAllAdmins()
                ],
            ]);
            $this->crud->addColumns([
                [
                    'label' => 'Admin',
                    'name' => 'admin_id',
                    'type' => 'select',
                    'entity' => 'schoolAdmin',
                    'attribute' => 'name',
                ],
            ]);
        }
        // add asterisk for fields that are required in UserRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $user_id = backpack_user()->id;
        if (auth()->user()->hasRole('school_admin')){
            $this->crud->addClause('where','admin_id','=',$user_id);
        }
        if (auth()->user()->hasRole('super_admin')){
            $this->crud->addClause('where','admin_id','!=','');
        }
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

        if(backpack_user()->hasRole('school_admin')){
            $request->request->set('admin_id', backpack_user()->id);
        }

        $studentPassword = $request->request->get('password_confirmation');
        $studentEmail = $request->request->get('email');
        $studentData = [];
        $studentData ['studentEmail'] = $studentEmail;
        $studentData ['studentPassword'] = $studentPassword;

        $mail = (new WelcomeStudentMail($studentData))->delay(Carbon::now()->addSeconds(3));
        $mail->subject = ($request->subject) ? $request->subject : 'Important Notice from ' . config('app.name');

        WelcomeStudentMailJob::dispatch($studentEmail, $mail);

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
