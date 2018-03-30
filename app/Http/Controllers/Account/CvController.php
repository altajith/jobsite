<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Request, Auth, Hash;
use App\Models\User\CV;

class CvController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Cv Controller
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
        $user = Auth::user();

        $data = ['user' => $user];

        $data['records'] = CV::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(10);
        
        return view('account.cvs', $data);
    }

    public function indexCv($id)
    {
        $user = Auth::user();
        $data = ['user' => $user];

        $data['cv_title'] = old('cv_title');
        $data['cover_letter'] = old('cover_letter');
        $data['status'] = old('status');
        $data['path'] = false;
        $data['id'] = $id;

        if($id > 0){
            $cv = CV::where('id',$id)->first();
            if($cv){
                $data['cv_title'] = $cv->title;
                $data['cover_letter'] = $cv->cover_letter;
                $data['status'] = $cv->status;
                $data['path'] = $cv->path;
            }
        }

        return view('account.cv', $data);
    }
    
    public function save()
    {
        $data = Request::all();
  
        $new = true;
        if($data['cv_id'] > 0){
            $new = false;
        }

        $validator = $this->validator($data,$new);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = Auth::user();

        $cv_file_path = false;
        if(Request::hasFile('cv_file')){
            $cv_file = Request::file('cv_file');
            $extension = $cv_file->extension();
            $path = $cv_file->storeAs('attachments', str_random(32).'_'.strtotime(date('Y-m-d')).'.'.$extension);
            $cv_file_path = url('/').'/'.$path;
        }

        if(!$new){
            $cv = CV::find($data['cv_id']);
            if(!$cv){
                $validator->errors()->add('error','Failed to save the cv, please try again!'); 
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }else{
            $cv = new CV;
        }

        $cv->user_id = $user->id;
        if($cv_file_path){
            $cv->path = $cv_file_path;
        }
        $cv->title = $data['cv_title'];
        $cv->cover_letter = $data['cover_letter'];
        $cv->status = $data['status'];
        $cv->created_by = $user->id;
        $cv->updated_by = $user->id;

        if($cv->save()){
            $msg[] = 'Your cv is successfully updated.';
            session(['success' => $msg]);
            return redirect()->back();
        }else{
            $validator->errors()->add('error','Failed to save the cv, please try again!'); 
        }

        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    protected function validator(array $data,$new)
    {
        if($new){
            return Validator::make($data, [
                'cv_title' => 'required|string|max:255',
                'status' => 'required|integer',
                'cv_file' => 'required|mimes:pdf,doc,docx',
                'cover_letter' => 'required|string',
            ]);
        }else{
            return Validator::make($data, [
                'cv_title' => 'required|string|max:255',
                'status' => 'required|integer',
                'cover_letter' => 'required|string',
            ]);
        }
    }
    
}
