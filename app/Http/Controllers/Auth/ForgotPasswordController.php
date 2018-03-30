<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;

use App\User;
use Request, Mail;
use App\Mail\PasswordReset;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index($token)
    {
        $data = [];

        $data['init'] = true;
        if($token <> '0'){
            $data['init'] = false;
            $data['email'] = Request::input('email');
            $data['token'] = $token;
        }
        
        return view('auth.password', $data);
    }

    public function save()
    {
        $data = Request::all();

        $init = true;
        if($data['init'] <> 1){
            $init = false;
        }

        $validator = $this->validator($data,$init);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $token = str_random(32);
        if($init){
            $user = User::where('email',$data['email'])->first();
            if($user){
                $user->reset_token = $token;
                $user->save();
                $url = url('/').'/forgot/password/'.$token.'?email='.$data['email'];
                Mail::to($user)->send(new PasswordReset($user,$url));
                $msg[] = 'Your password reset url is successfully sent to '.$data['email'].'.';

                session(['success' => $msg]);
            }else{
                $validator->errors()->add('error',$data['email'].' is not registered with us, please try again!'); 
            }
            return redirect()->back();
        }else{
            $user = User::where('email',$data['email'])->where('reset_token',$data['token'])->first();
            if($user){
                $user->password = bcrypt($data['password']);
                $user->reset_token = $token;
                $user->save();
                $msg[] = 'Your password is successfully changed.';

                session(['success' => $msg]);
            }else{
                $validator->errors()->add('error','Password reset link is not valid, please try again!'); 
            }
            return redirect()->to('/');
        }
    }

    protected function validator(array $data,$init)
    {
        if($init){
            return Validator::make($data, [
                'email' => 'required|email'
            ]);
        }else{
            return Validator::make($data, [
                'password_confirmation' => 'required|min:6',
                'password' => 'required|confirmed|min:6'
            ]);
        }
    }

}
