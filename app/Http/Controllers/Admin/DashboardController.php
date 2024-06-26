<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Business;
use App\Models\Feature;
use App\Models\Order;
use App\Models\Packing;
use App\Models\Plan;
use App\Models\Receipt;
use App\Models\System\Location;
use App\Models\System\Setting;
use App\Models\System\State;
use App\Models\System\Status;
use App\Models\Task;
use App\Models\User;
use App\Models\Zone;
use App\Notifications\Admin\NewUserNotification;
use App\Notifications\ChangePasswordNotification;
use App\Notifications\WelcomeMailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


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
     * @return
     */

    public function index()
    {
       // $this->middleware('permission:dashboard');
//        $users = User::all()->count();
//        $states = State::all()->count();
//        $branches = Branch::all()->count();
//        $zones = Zone::all()->count();
//        $areas = Area::all()->count();
//        $orders = Order::all()->count();

//        $users =  DB::table('users')->count();
//        $states =  DB::table('states')->count();
//        $branches =  DB::table('branches')->count();
//        $zones =  DB::table('zones')->count();
//        $areas = DB::table('areas')->count();
//        $orders = DB::table('orders')->count();

        $users = User::count();
        $deliveries = User::whereHas("roles", function($q){ $q->whereIn("name" ,["delivery"]); })->count();
        $sellers = User::whereHas("roles", function($q){ $q->whereIn("name" ,["seller"]); })->count();
        $states = State::count();
        $branches = Branch::count();
        $zones = Zone::count();
        $areas = Area::count();
        $orders = Order::count();
        $statuses = Status::count();
        $tasks = Task::count();
        $plans = Plan::count();
        $features = Feature::count();
        $receipts = Receipt::count();
        $packing = Packing::count();
        $locations = Location::count();

        return view('admin.dashboard', compact(
            'users',
            'deliveries',
            'sellers',
            'states',
            'branches',
            'zones',
            'areas',
            'orders',
            'statuses',
            'tasks',
            'plans',
            'features',
            'receipts',
            'packing',
            'locations',
        ));
    }
    public function notifications()
    {
       $notifications =  \auth()->user()->unReadNotifications;
     //  dd($notifications);
//        auth()->user()->notify(new NewUserNotification());
        return \view('admin.notifications',compact('notifications')) ;
    }
    public function messages()
    {
        $messages = null     ;
        //  dd($notifications);
        //   auth()->user()->notify(new NewUserNotification());
        return \view('admin.messages',compact('messages')) ;
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

        $states= State::all();
        $areas = Area::pluck('name')->all();

        return view('admin.profile', compact('user','allTasks','doneTasks','allOrders','doneOrders' , 'total','count','products','states','areas'));
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

        toastr()->success('Profile Updated Successfully');
        return redirect()->route('admin.profile');
    }


    public function sellers()
    {
        $sellers = User::with('plan')->whereHas("roles", function($q){ $q->where("name" ,'seller'); })->get();
        $seller = User::find(5);
        $seller->notify(new WelcomeMailNotification());
     //   dd($sellers);
      //  $sellers = User::whereIn('role', 'seller')->get();
//dd($sellers);
        return view('admin.sellers', compact('sellers'));
    }

    public function assign(){
        $orders = Order::with('area')->whereHas("status", function($q){ $q->where("id" ,2); })->get();
        // dd($orders);
        $deliveries = User::whereHas("roles", function($q){ $q->whereIn("name" ,["delivery"]); })->get();

     //   $uniqueId = Str::random(8);
//            while(Order::where('id', $uniqueStr)->exists()) {
//
//            }

//       $id = Hashids::connection(Order::class)->encode('65050');
//      dd($id);

        return view('admin.orders.assign',compact('deliveries','orders'));
    }

    public function assignGo(Request $request){

        $this->validate($request,[
            'delivery' => 'required',
            'orders' => 'required|array'
        ]);
        $input = $request->all();
        $delivery = User::findOrFail($input['delivery']);
        //     dd($delivery->name);
        foreach ($input['orders'] as $id){
            $order = Order::findOrFail($id);
            //  dd($order);
            $order->delivery_id = $delivery->id;
            $order->received_at = now() ;
            $order->expire_at = now()->addHours($order->area->delivery_time);
            $order->status_id = 5 ;
            $order->update();
            // $branch->users()->save($user); $order->area->time_delivery
        }

        toastr()->success( ' Orders Assigned Successfully To '.$delivery->name . ' Delivery','Orders Assigned');
        return redirect()->route('admin.orders.index');
    }
    public function help()
    {
        return view('system.help');
    }
    public function system()
    {
        $system = Setting::first() ;

        return view('system.setting',compact('system'));
    }
    public function saveSystem(Request $request)
    {
        $this->validate($request,[
            'company_name'=>'nullable',
            'company_logo'=>'nullable', // required
            'location_id'=>'nullable|numeric',
           'slogan'=>'nullable',
            'owner'=>'nullable',
            'email'=>'nullable|email',
            'contact'=>'nullable',
            'theme'=>'nullable',
            'footer'=>'nullable',
            'auto_send'=>'nullable|boolean',
            'reschedule_limit' => 'nullable',
            'package_weight_limit' => 'nullable',
        ]);

       $input = $request->except(['_token']);

      //    dd($input);
        $path = 'uploads/system/logo';

        $system = Setting::first();

        if($system){
            if(! isset($input['company_logo'])){
                $photoPath  = $system->company_logo;
            }else {
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                if($system){
                    if(File::exists(storage_path().'/app/public/'.$system->company_logo)){
                        //dd('found');
                        File::delete(storage_path().'/app/public/'.$system->company_logo);
                    }
                }
                $photoPath =  $input['company_logo']->store($path,'public');
                $input['company_logo'] = $photoPath;
            }
            $system->update($input);
        }else{
            Setting::create($input) ;
        }


        Config::set(['app.name' => $input['company_name']]);

        Cache::forget('system');

        toastr()->success('system saved successfully');
        return redirect()->route('admin.dashboard');
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
        //     $business = HasBusiness::firstOrNew($input);;
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

    public function trash()
    {
            //   dd('else');
            //    $orders = auth()->user()->orders()->orderBy('updated_at','DESC')->paginate(10);
            $deletedOrders = Order::onlyTrashed()->count();
            $deletedTasks = Task::onlyTrashed()->count();
        return view('system.trash',compact('deletedOrders','deletedTasks'));
    }

}
