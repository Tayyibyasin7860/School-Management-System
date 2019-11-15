<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);

        //if super admin role doesn't exist then create it
        $roles = Role::all();
        $superAdminRoleExists = false;
        $schoolAdminRoleExists = false;
        foreach ($roles as $role) {
            if($role->name == 'super_admin'){
                $superAdminRoleExists = true;
            }
            if($role->name == 'school_admin'){
                $schoolAdminRoleExists = true;
            }
        }
        if (!$superAdminRoleExists) {
            Role::create([
                'name' => 'super_admin',
                'guard_name' => 'web'
            ]);
        }

        //if super admin does not exist than assign role of super admin to new registered user
        $users = User::all();
        $superAdminExists = false;

        foreach($users as $user){
                if ($user->roles->first() && $user->roles->first()->name == 'super_admin') {
                    $superAdminExists = true;
            }
        }
        if(!$superAdminExists){
            auth()->user()->assignRole('super_admin');
        }
        //if super admin exists than assign school admin role to new registered user
        else{
            if(!$schoolAdminRoleExists){
                Role::create([
                    'name' => 'school_admin',
                    'guard_name' => 'web'
                ]);
            }
            auth()->user()->assignRole('school_admin');
        }
        //setup data for school admin i.e. classes, subjects etc
        if (auth()->user()->hasRole('school_admin')) {
            $user->setupData();
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
