<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Request, Mail;
use App\Mail\AccountCreated;
use App\Helpers\Common;

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
    protected $redirectTo = '/signup';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data = [];
        
        return view('auth.signup', $data);
    }

    public function indexIframe($id)
    {
        $data = [];
        $data['id'] = $id;
        
        return view('auth.signupif', $data);
    }

    public function register()
    {
        $data = Request::all();

        $validator = $this->validator($data);
       
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
       
        $data['password'] = str_random(5);
        $user = $this->create($data);

        Mail::to($user)->send(new AccountCreated($user,$data['password']));
        $msg[] = 'Your account is successfully created and we have sent you the password to '.$data['email'].'.';
        session(['success' => $msg]);

        if(isset($data['job_id']) && $data['job_id'] != ''){
            if(Common::applyJob($data['job_id'],$user)){
                return redirect()->to('/thanks');
            }else{
                $validator->errors()->add('error','Job id is not found in the system, please try again!'); 
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }else{
            return redirect()->to($this->redirectTo);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|unique:users',
            'user_type_id' => 'required|integer'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'mobile' => $data['mobile'],
            'user_type_id' => $data['user_type_id'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'reset_token' => str_random(16),
            'created_by' => 0,
            'updated_by' => 0
        ]);
    }
}
