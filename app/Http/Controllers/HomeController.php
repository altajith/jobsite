<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth, Request;
use App\Models\Job\Details;
use App\Models\Property\AcadamicMaster;
use App\Models\Job\Category;
use App\Models\Job\Nature;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
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
    }

    public function index()
    {
        $user = Auth::user();

        $inputs = Request::all();

        $data = ['user' => $user];

        $data['category'] = [];
        $data['acadamic'] = [];
        $data['nature'] = [];
        $data['title'] = '';
        $data['address'] = '';

        $records = Details::where('status',0);
        if(isset($inputs['category']) && is_array($inputs['category']) && count($inputs['category']) > 0){
            $records = $records->whereIn('job_category_id',$inputs['category']);
            $data['category'] = $inputs['category'];
        }
        if(isset($inputs['acadamic']) && is_array($inputs['acadamic']) && count($inputs['acadamic']) > 0){
            $records = $records->whereIn('acadamic_id',$inputs['acadamic']);
            $data['acadamic'] = $inputs['acadamic'];
        }
        if(isset($inputs['nature']) && is_array($inputs['nature']) && count($inputs['nature']) > 0){
            $records = $records->whereIn('job_nature_id',$inputs['nature']);
            $data['nature'] = $inputs['nature'];
        }
        if(isset($inputs['title']) && $inputs['title'] <> ''){
            $records = $records->where('title',$inputs['title']);
            $data['title'] = $inputs['title'];
        }
        if(isset($inputs['address']) && $inputs['address'] <> ''){
            $records = $records->where('location',$inputs['address']);
            $data['address'] = $inputs['address'];
        }
        $records = $records->orderBy('created_at','desc')->paginate(10);
        
        $data['records'] = $records;

        $data['cats'] =  Category::where('status',1)->orderBy('job_title')->get();
        $data['nats'] =  Nature::orderBy('nature')->get();
        $data['acs'] = AcadamicMaster::where('status',1)->orderBy('acadamic_detail')->get();
        $data['fter'] = true;
 
        return view('home', $data);
    }

    public function single($id)
    {
        $user = Auth::user();

        $data = ['user' => $user];
        $data['record'] = Details::where('id',$id)->first();

        return view('job.single', $data);
    }

    public function image($file)
    {
        return response()->download(storage_path("app/images/{$file}"));
    }

    public function attachment($file)
    {
        return response()->download(storage_path("app/attachments/{$file}"));
    }

    public function init()
    {
        $user = Auth::user();

        $data = ['user' => $user];

        return view('job.init', $data);
    }

    public function thanks()
    {
        $user = Auth::user();

        $data = ['user' => $user];

        return view('job.thank', $data);
    }
}
