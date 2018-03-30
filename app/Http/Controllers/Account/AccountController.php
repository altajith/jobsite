<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Job\Apply;
use Request, Auth, Hash;

class AccountController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Account Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data = ['user' => Auth::user()];
        
        return view('account.profile', $data);
    }

    public function save()
    {
        $data = Request::all();
      
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = Auth::user();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->gender = $data['gender'];
        $user->mobile = $data['mobile'];

        if($user->save()){
            $msg[] = 'Your account is successfully updated.';
            session(['success' => $msg]);
            return redirect()->back();
        }else{
            $validator->errors()->add('error','Failed to save the user details, please try again!'); 
        }

        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'mobile' => 'required|string|unique:users',
        ]);
    }

    public function changePassword(){
        $data = Request::all();
      
        $validator = $this->validatorPassword($data);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = Auth::user();

        if (!Hash::check($data['current_password'], $user->password)){
            $validator->errors()->add('error','Entered current password is not correct, please try again!'); 
        }else{

            $user->password = bcrypt($data['password']);

            if($user->save()){
                $msg[] = 'Your account password is successfully changed.';
                session(['success' => $msg]);
                return redirect()->back();
            }else{
                $validator->errors()->add('error','Failed to change the password, please try again!'); 
            }
        }

        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    protected function validatorPassword(array $data)
    {
        return Validator::make($data, [
            'current_password' => 'required',
            'password_confirmation' => 'required|min:6',
            'password' => 'required|confirmed|min:6',
        ]);
    }


    public function changePicture(){
        $data = Request::all();
      
        $validator = $this->validatorPicture($data);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $photo = Request::file('photo');
        $extension = $photo->extension();
       
        $path = $photo->storeAs('images', str_random(32).'_'.strtotime(date('Y-m-d')).'.'.$extension);
       
        $picture = url('/').'/'.$path;

        $user = Auth::user();
        $user->picture = $picture;

        if($user->save()){
            $msg[] = 'Your profile picture is successfully changed.';
            session(['success' => $msg]);
            return redirect()->back();
        }else{
            $validator->errors()->add('error','Failed to change the profile picture, please try again!'); 
        }

        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    protected function validatorPicture(array $data)
    {
        return Validator::make($data, [
            'photo' => 'required|mimes:jpeg,bmp,png'
        ]);
    }

    public function indexMyList()
    {
        $user = Auth::user();

        $data = ['user' => $user];

        $data['records'] = Apply::with(['job'])->where('user_id',$user->id)->orderBy('created_at','desc')->paginate(10);
        
        return view('job.myList', $data);
    }
    
    
}
