<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('delivery.dashboard');
    }
    public function profile()
    {
        $user = Auth::user();

            $allTasks = $user->taskson->count();

            $doneTasks = $user->taskson->whereNotNull('done_at',)->count();



        $allOrders = $user->custody->count();
        $doneOrders = $user->custody->where('status_id','6')->count();

        return view('delivery.profile.index', compact('user','allTasks','doneTasks','allOrders','doneOrders'));
    }
    public function profileEdit()
    {
        $user = Auth::user();
        $states= State::where('active',true)->get();
        $areas = Area::pluck('name')->all();
        return view('delivery.profile.edit', compact('user','states','areas'));
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
        toastr()->success('Profile Updated Successfully','Profile Updated');
        return redirect()->route('delivery.profile');
    }
}
