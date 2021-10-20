<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Feature;
use App\Models\Location;
use App\Models\Order;
use App\Models\Packing;
use App\Models\Plan;
use App\Models\Receipt;
use App\Models\Setting;
use App\Models\State;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Models\Zone;
use App\Notifications\Admin\NewUserNotification;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;


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
       $notifications =  \auth()->user()->notifications;
     //  dd($notifications);
     //   auth()->user()->notify(new NewUserNotification());
        return \view('admin.notifications',compact('notifications')) ;
    }
    public function profile()
    {
        $user = Auth::user();

        if ($user->roles->first()->name == 'delivery'){
            $alltasks = $user->taskson->count();
            $donetasks = $user->taskson->where('done_at')->count();
        }else{
            $allTasks = $user->tasks->count();
            $doneTasks = $user->tasks->whereNotNull('done_at')->count();
        }
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

        $path = 'uploads/profiles/photos';
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
    //    dd($photoPath);
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
        return redirect()->route('admin.profile');
    }
    public function sellers()
    {
        $sellers = User::with('plan')->whereHas("roles", function($q){ $q->where("name" ,'seller'); })->get();
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

        notify()->success( ' Orders Assigned Successfully To '.$delivery->name . ' Delivery','Orders Assigned');
        return redirect()->route('admin.orders.index');
    }
    public function help()
    {
        return view('system.help');
    }
    public function setting()
    {
        $setting = Setting::first() ;
        return view('system.setting',compact('setting'));
    }
    public function saveSetting(Request $request)
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
            'reschedule_limit' => 'required',
            'package_weight_limit' => 'required',
        ]);

       $input = $request->except(['_token']);

      //    dd($input);
        $path = 'uploads/setting/logo';

        $setting = Setting::first();

        if($setting){
            if(! isset($input['company_logo'])){
                $photoPath  = $setting->company_logo;
            }else {

                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                if($setting){
                    if(File::exists(storage_path().'/app/public/'.$setting->company_logo)){
                        //dd('found');
                        File::delete(storage_path().'/app/public/'.$setting->company_logo);
                    }
                }
                $photoPath =  $input['company_logo']->store($path,'public');
                $input['company_logo'] = $photoPath;

                $setting->update($input);
            }

        }else{
            Setting::create($input) ;
        }


        Config::set(['app.name' => $input['company_name']]);

        Cache::forget('setting');

        notify()->success('setting saved successfully');
        return redirect()->route('admin.dashboard');
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
