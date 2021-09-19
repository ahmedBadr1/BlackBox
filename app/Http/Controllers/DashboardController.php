<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Branch;
use App\Models\Order;
use App\Models\State;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use function GuzzleHttp\Promise\all;

class DashboardController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index()
    {

        return view('dashboard');
    }
    public function dashboard()
    {
        $this->middleware('permission:dashboard');
        $users = User::all()->count();
        $states = State::all()->count();
        $branches = Branch::all()->count();
        $zones = Zone::all()->count();
        $areas = Area::all()->count();
        $orders = Order::all()->count();

        return view('dashboard', compact('users','states','branches','zones','areas','orders'));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }
    public function profileEdit()
    {
        $user = Auth::user();
        $states= State::where('active',true)->get();
        $areas = Area::pluck('name')->all();
        return view('profile.edit', compact('user','states','areas'));
    }
    public function profileUpdate(Request $request)
    {
     //  dd($request->all());
        $user = Auth::user();

        $this->validate($request,[
            'name'=>'required',
            'bio'=> '',
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'address'=> '',
            'area'=> '',
            'state'=> 'required',
            'profile_photo'=> 'image',
            'url'=> '',
        ]);

        $input = $request->all();

        $path = 'uploads/profiles/photos/';
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        if(! isset($input['profile_photo'])){
            $photoPath  = $user->profile->photo;
        }else {
                if(File::exists(storage_path().'/app/public/'.$user->profile->profile_photo)){
                    //dd('found');
                    File::delete(storage_path().'/app/public/'.$user->profile->profile_photo);
                }
            $photoPath =  $input['profile_photo']->store($path,'public');
            $user->profile->profile_photo = $photoPath;

        }
        if($input['bio']){
            $user->profile->bio = $input['bio'];
        }
        if($input['address']){
            $user->profile->address = $input['address'];
        }
        if($input['area']){
            $user->profile->area = $input['area'];
        }
        if($input['url']){
            $user->profile->url = $input['url'];
        }


        $user->push();
        notify()->success('Profile Updated Successfully','Profile Updated');
        return redirect()->route('profile');
    }

    public function sellers()
    {
        $sellers =Role::where('name', 'seller')->first()->users()->get();

        return view('admin.sellers', compact('sellers'));
    }

}
