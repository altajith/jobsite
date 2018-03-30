<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Request, Auth, Hash;
use App\Models\Property\AcadamicMaster;
use App\Models\Job\Category;
use App\Models\Job\Nature;
use App\Models\Job\Details;
use App\Models\Job\Apply;
use App\Helpers\Common;

class JobController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Job Controller
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

        $data['job_title'] = old('job_title');
        $data['category'] = old('category');
        $data['acadamic'] = old('acadamic');
        $data['nature'] = old('nature');
        $data['publish_date'] = old('publish_date');
        $data['closing_date'] = old('closing_date');
        $data['address'] = old('address');
        $data['description'] = old('description');
        $data['experiance'] = old('experiance');
        
        $data['cats'] =  Category::where('status',1)->orderBy('job_title')->get();
        $data['nats'] =  Nature::orderBy('nature')->get();
        $data['acs'] = AcadamicMaster::where('status',1)->orderBy('acadamic_detail')->get();

        return view('job.create', $data);
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

        $job_file_path = '';
        if(Request::hasFile('job_file')){
            $job_file = Request::file('job_file');
            $extension = $job_file->extension();
            $path = $job_file->storeAs('images', str_random(32).'_'.strtotime(date('Y-m-d')).'.'.$extension);
            $job_file_path = url('/').'/'.$path;
        }else{
            $validator->errors()->add('error','Job image file is empty, please try again!'); 
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $job = new Details;

        $job->title = $data['job_title'];  
        $job->path = $job_file_path;
        $job->user_id = $user->id;
        $job->job_category_id = $data['category'];
        $job->job_nature_id = $data['nature'];
        $job->publish_date = $data['publish_date'];
        $job->closing_date = $data['closing_date'];
        $job->acadamic_id = $data['acadamic'];
        $job->location = $data['address'];
        $job->description = $data['description'];
        $job->experiance = $data['experiance'];
        $job->created_by = $user->id;
        $job->updated_by = $user->id;

        if($job->save()){
            $msg[] = "Your job is successfully created, and it's under review. we will get back to you soon.";
            session(['success' => $msg]);
            return redirect()->back();
        }else{
            $validator->errors()->add('error','Failed to save the job details, please try again!'); 
        }

        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'job_title' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'closing_date' => 'required|date',
            'category' => 'required',
            'acadamic' => 'required',
            'nature' => 'required',
            'job_file' => 'required|mimes:jpeg,bmp,png',
            'address' => 'required|string',
            'description' => 'required|string',
            'experiance' => 'required|string'
        ]);
    }    

    public function indexList()
    {
        $user = Auth::user();

        $data = ['user' => $user];

        $data['records'] = Details::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(10);
        
        return view('job.companyList', $data);
    }

    public function apply($id)
    {
        $validator = Validator::make(Request::all(), []);

        $user = Auth::user();
        if(!$user){
            $validator->errors()->add('error','To apply please login to the system, please try again!'); 
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if(Common::applyJob($id,$user)){
            return redirect()
                ->to('/thanks');
        }else{
            $validator->errors()->add('error','Job id is not found in the system, please try again!'); 
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function indexView($id)
    {
        $user = Auth::user();

        $data = ['user' => $user];
        $data['record'] = Details::where('id',$id)->first();

        return view('job.view', $data);
    }
}
