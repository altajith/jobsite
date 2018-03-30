<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

use Request, Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        $data = Request::all();
      
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $remember = false;
        if(isset($data['remember_me']) && $data['remember_me'] == 1) $remember = true;

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
            Auth::loginUsingId(Auth::id());
            return redirect()->intended($this->redirectTo);
        }else{
            $validator->errors()->add('error','Failed to login, please try again!'); 
        }

        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required'
        ]);
    }

    public function logout(){
        \Auth::logout();
        return redirect()->to('/signup');
    }
}
