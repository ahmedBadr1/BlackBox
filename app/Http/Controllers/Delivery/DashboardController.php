<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:delivery');
    }
    public function index()
    {
        return view('delivery.dashboard');
    }

    public function notifications()
    {
        $notifications =  \auth()->user()->unReadNotifications;
//        dd($notifications);
        //   auth()->user()->notify(new NewUserNotification());
        return view('delivery.notifications',compact('notifications')) ;
    }

    public function profile()
    {
        $user = Auth::user();

            $allTasks = $user->taskson->count();

            $doneTasks = $user->taskson->whereNotNull('done_at',)->count();
     //   $count = Order::where('delivery_id',$user->id)->where('status_id',6)->count();


        $allOrders = $user->custody->count();
        $doneOrders = $user->custody->where('status_id','6')->count();

        return view('delivery.profile', compact('user','allTasks','doneTasks','allOrders','doneOrders'));
    }
    public function profileUpdate(Request $request)
    {
        //  dd($request->all());
        $user = Auth::user();

        $this->validate($request,[
            'name'=>'required',
            'bio'=> 'nullable',
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'address'=> 'nullable|string',
            'photo'=> 'nullable|image',
            'url'=> 'nullable|url',
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
        if(isset($input['bio'])){
            $user->profile->bio = $input['bio'];
        }
        if(isset($input['address'])){
            $user->profile->address = $input['address'];
        }
        if(isset($input['url'])){
            $user->profile->url = $input['url'];
        }

        $user->push();

        toastr()->success('Profile Updated Successfully','Profile Updated');
        return redirect()->route('delivery.profile');
    }


}
