<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Business;
use App\Models\Order;
use App\Models\State;
use App\Models\User;
use App\Notifications\ChangePasswordNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:seller');
    }
    public function index()
    {
        $business = \auth()->user()->business ;
        $user = \auth()->user();
//dd($business);
      //  $orders = Order::where('user_id',auth()->id());

        $total =  Order::myOrders()->whereNotIn('status_id', [1,2,10] )->sum('total'); //scope in Order
        $count = Order::myOrders()->count();

        $success = Order::myOrders()->where('status_id',  6)->count();
        $pending =  Order::myOrders()->whereIn('status_id', [1,2,3,4,5] )->count();
        $failed  =     Order::myOrders()->whereIn('status_id', [7,8,9,10]  )->count();
//dd($failed);
        $cancelled =  Order::myOrders()->whereIn('status_id', [7,8])->count(); // refused or cancel

        $monthOrdersCount =$business->ordersMonthly(now()->month)->count(); //relation based on month in User
        $monthOrdersValue = $business->ordersMonthly(now()->month)->sum('total');

        $lastMonthOrdersCount = $business->ordersMonthly(now()->subMonth(1))->whereNotIn('status_id', [1,2,10] )->count();
        $lastMonthOrdersValue = $business->ordersMonthly(now()->subMonth(1))->whereNotIn('status_id', [1,2,10] )->sum('total');


       // dd($monthOrdersCount);

        return view('seller.dashboard',compact(
            'monthOrdersCount', 'monthOrdersValue'
            ,'lastMonthOrdersCount','lastMonthOrdersValue'
            ,'success','pending','failed','cancelled',
            'total','count'
        ));
    }
    public function mybalance (){
        //   $total = auth()->user()->orders->sum('value');
        //   Order::with('area')->whereIn('status_id',[3,4,5,6,7,8,9])->sortBy('status_id');
        $avilableOrders = auth()->user()->orders()->with('area','status')->whereIn('status_id',[3,4,5,6,7,8,9])->orderBy('created_at','desc')->get();
        $recentOrders = auth()->user()->orders()->with('status')->orderBy('created_at','desc')->take(10)->get();
      //   dd($recentOrders);
        $subTotal = $avilableOrders->sum('sub_total');
        $discount = $avilableOrders->sum('discount');
        $tax = $avilableOrders->sum('tax');
        $total = $avilableOrders->sum('total');
        // dd($avilableOrders);
        $ordersCount = auth()->user()->orders->count();


        return view('seller.accounting.mybalance',compact('total','subTotal','discount','tax','ordersCount','avilableOrders','recentOrders'));
    }

    public function profile()
    {
        $user = Auth::user();

        $total =  $user->orders()->whereNotIn('status_id', [1,2,10] )->sum('total');
        $count = $user->orders()->count();

        $orders =  $user->orders()->select('product')->get();
        $products = 0;

       foreach ($orders as $order){
           $products += $order->product['quantity'];
       }
      // dd($products);
            $allTasks = $user->tasks->count();
            $doneTasks = $user->tasks->whereNotNull('done_at')->count();

        //      dd($donetasks);

        $allOrders = $user->orders->count();
        $doneOrders = $user->orders->where('status_id','6')->count();

        $states= State::where('active',true)->get();
        $areas = Area::pluck('name')->all();

        return view('seller.profile', compact('user','allTasks','doneTasks','allOrders','doneOrders' , 'total','count','products','states','areas'));
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
        return redirect()->route('profile');
    }
    public function help(){
        return view('seller.help');
    }
    public function notifications(){
        return view('seller.notifications');
    }
    public function messages(){
        return view('seller.messages.index');
    }

    public function setting ()
    {
        $industries = Business::$industries ;
        $channels = Business::$channels;
        $business = \auth()->user()->business ?? null;
      //  dd(auth()->user()->orders()->count());
      //  dd($business->orders()->count());
        return view('seller.setting',compact('business','industries','channels'));
    }
    public function saveSetting(Request $request)
    {
      //  dd($request->all());
      $input =  $this->validate($request,[
            'name' => 'required',
            "contact" => "required",
            "industry" => "required",
            "channel" => "required",
            "url" => "required|url",
        ]);
   //dd($input);

        $user = \auth()->user();
     //   dd($user->business);
  //     $business = Business::firstOrNew($input);;
        if(isset($user->business)){
            $user->business->update($input) ;
        }else{
            $business = Business::create($input);
            $user->business()->associate($business)->save();
        }
   //     dd($user->business);


        return back();
    }

    public function changePassword (Request $request)
    {
      $input =  $this->validate($request,[
            'password' => 'required',
            'new_password' => 'required|min:8|same:con_password',
            'con_password' => 'required',
        ]);
  //    dd($input);
        $user = auth()->user();
      //  dd($user->password);
        if (!Hash::check($input['password'], $user->password)) {
            toastr('password not true');
            return back();
        }
        $user->password = Hash::make($input['new_password']);
        $user->save();
        $user->notify(new ChangePasswordNotification());
        toastr('all good');
        return back();
    }



}
