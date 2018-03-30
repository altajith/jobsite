<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Request, Auth, Hash;
use App\Models\Property\Master;
use App\Models\User\UserProperty;

class AdvanceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Advance Controller
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

    private function getElements($user){
        return Master::with(array('user_property' => function($query) use ($user)
                                {
                                    $query->where('user_id', $user->id);
                                }))
                                ->where('user_type_id', $user->user_type_id)
                                ->get();
    }

    public function index()
    {
        $user = Auth::user();
        $data = ['user' => $user];

        $elements = $this->getElements($user);
      
        $records = [];
        foreach($elements as $element){
            $records[$element->category_group][] = $element;
        }

        $data['records'] = $records;

        return view('account.advance', $data);
    }

    public function save()
    {
        $data = Request::all();
        $user = Auth::user();

        $elements = $this->getElements($user);

        foreach($elements as $element){
            $item = UserProperty::where('user_id',$user->id)->where('property_id',$element->id)->first();
            if(!$item){
                $item = new UserProperty;
                $item->user_id = $user->id;
                $item->property_id = $element->id;
            }
            $item->value = (isset($data['advance_fld_'.$element->id]) ? $data['advance_fld_'.$element->id]:'');
            $item->created_by = $user->id;
            $item->updated_by = $user->id;
            $item->save();
        }

        $msg[] = 'Advance setting fields are successfully updated.';
        session(['success' => $msg]);

        return redirect()
            ->back()
            ->withInput();
    }

}
