<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('seller.dashboard');
    }
    public function mybalance (){
        //   $total = auth()->user()->orders->sum('value');
        //   Order::with('area')->whereIn('status_id',[3,4,5,6,7,8,9])->sortBy('status_id');
        $avilableOrders = auth()->user()->orders()->with('area','status')->whereIn('status_id',[3,4,5,6,7,8,9])->orderBy('status_id')->get();
        //  dd($avilableOrders);
        $total = $avilableOrders->sum('value');
        // dd($avilableOrders);
        $ordersCount = auth()->user()->orders->count();

        //    dd($total);
        return view('seller.accounting.mybalance',compact('total','ordersCount','avilableOrders'));
    }
    public function mytrash()
    {
        if(Gate::allows('feature','trash')){
            $orders = auth()->user()->orders()->onlyTrashed()->paginate(25);
        }else{
            abort('403');
        }


        //   dd($orders);
        return view('seller.orders.trash',compact('orders'));
    }
    public function profile()
    {
        $user = Auth::user();


            $allTasks = $user->tasks->count();
            $doneTasks = $user->tasks->whereNotNull('done_at')->count();

        //      dd($donetasks);

        $allOrders = $user->orders->count();
        $doneOrders = $user->orders->where('status_id','6')->count();


        return view('admin.profile.index', compact('user','allTasks','doneTasks','allOrders','doneOrders'));
    }
    public function profileEdit()
    {
        $user = Auth::user();
        $states= State::where('active',true)->get();
        $areas = Area::pluck('name')->all();
        return view('admin.profile.edit', compact('user','states','areas'));
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
}
