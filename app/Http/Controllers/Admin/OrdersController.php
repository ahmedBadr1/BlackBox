<?php

namespace App\Http\Controllers\Admin;

use App\Exports\admin\OrdersExportAr;
use App\Exports\Admin\OrdersExportEn;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Order;
use App\Models\Packing;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\State;
use App\Models\Status;
use App\Models\User;
use App\Notifications\DoneNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Activitylog\Models\Activity;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;



class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Feedback');
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
       // $orders = Order::with('user','area','status','state')->orderBy('updated_at','DESC')->paginate(100);

//        $avOrders = auth()->user()->zone[0]->areas;
//        dd($avOrders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('admin.orders.index');
    }
    public function track(Request $request ){
        // dd($request);
        $order_hashid ='';
        if ($request->query('order_id') !== null){
            $order_hashid = $request->query('order_id');
        }
        $user =  \auth()->user();
        $status= null;
        $orderLogs=  null;
        return view('admin.track',compact('user','order_hashid','status','orderLogs'));
    }

    public function  trackgo(Request $request)
    {
        //  dd($request['order_id']);
        $order_hashid =  $request['order_id'];
        $id =    Hashids::Connection(Order::class)->decode(strtolower($order_hashid)) ?? [0];

        if($id){
            $order =Order::findOrFail($id[0]);
            $status =  Status::find($order->status_id)->name;
            $orderLogs  = Activity::inLog('Order')->where('subject_id',$id)->select('causer_id','description','properties','updated_at')->get();
          //  dd($orderLogs);

        }else{
            $status =  null;
            $orderLogs=  null;

        }
//foreach ($orderLogs as $log){
//  ///  dd($log->properties['attributes']);
//    foreach ($log->properties['attributes'] as $prop){
//        dd($prop);
//    }
//}
//        if (auth()->user()->id !== $order->user->id){
//            abort(404);
//        }


        return view('admin.track',compact('status','order_hashid','orderLogs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        //
     //   $states= State::where('active',true)->get();

//        $types = ['cosmetics','clothes','document','furniture','machines','other'];
//        $areas = Area::where('active',1)->whereHas('state',fn($q)=>$q->where('active','1'))->select('id','name')->orderBy('id','desc')->get();
//        $sellers = User::with('plan')->whereHas("roles", function($q){ $q->where("name" ,'seller'); })->get();

      //  $areas = Area::with('state')->select('id','name')->orderBy('id','desc')->get();
      //  dd($areas);

      //  $order = Order::first();

     //   Notification::send( auth()->user(), new DoneNotification($order));
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \auth()->user();

       // dd($request->all());
        $this->validate($request,[
            'product_name' =>'required',
            'value'=>'nullable|numeric|gt:0',
            'cust_name'=>'required',
            'cust_num'=>'required',
            'address'=>'required',
            'area_id'=>'required|numeric',
            'package_type' => 'nullable',
            'package_weight'=>'nullable|numeric',
            'deliver_before' =>'nullable|date', //  'deliver_before' =>'nullable|date|after:today',
            'quantity'=>'nullable|numeric',
            'cod'=> 'required|boolean',
            'notes'=>'nullable',
            'user_id' => 'nullable'
        ]);
        $input = $request->all();
       // auth()->user()->plan->name;
        // dd($input);

        if (isset($input['value'])){
            $orderArea = Area::where('id',$input['area_id'])->select('id','delivery_cost','over_weight_cost')->first();
            if($user->plan->id !== Plan::first()->id){
                $orderArea->delivery_cost = $user->plan->area[$input['area_id']] ?? $orderArea->delivery_cost ;
            }
            $input['status_id'] = Status::all()->first()->id;
            if (!$input['user_id']){
                $input['user_id'] = $user->id;
            }
    //        $input['total'] = $input['value'] * $input['quantity'] ;
            //       dd(setting('package_weight_limit'));
            if(!$input['cod']){
                $input['total'] = ($input['value'] * $input['quantity'] )  - $orderArea->delivery_cost ?? 0;
               // dd($input['total']);
                if($input['package_weight'] > setting('package_weight_limit')){
                    $input['total'] = ($input['value'] -
                            ( $orderArea->delivery_cost + (
                                    ($input['package_weight'] - setting('package_weight_limit')
                                    ) * $orderArea->over_weight_cost )
                            )
                        ) * $input['quantity']  ?? 0;
                }
            }elseif($input['package_weight'] > setting('package_weight_limit')){

                $over = ($input['package_weight'] - setting('package_weight_limit')) * $orderArea->over_weight_cost ;
                $input['total'] = ($input['value'] -  $over) * $input['quantity']  ?? 0;
            }else{

                $input['total'] = $input['value'] * $input['quantity'] ;
            }
        }

     //   dd($input['total']);
        Order::create($input);

        notify()->success('Order Created Successfully');

        return redirect()->route('admin.orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return
     */
    public function show(Order $order)
    {

        return view('admin.orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param\App\Models\Order  $order
     * @return
     */
    public function edit(Order $order)
    {

            if (auth()->id() !== $order->user_id){
                notify()->warning('You cant change this order ');
                return redirect()->back();
            }

        if (!in_array($order->status->id,[1,2])){
            notify()->warning("Order Can't be changed after reaching to Bagy");
            return redirect()->route('admin.orders.index');
        }

        $areas = Area::where('active',1)->whereHas('state',fn($q)=>$q->where('active','1'))->select('id','name')->orderBy('id','desc')->get();
       // $states= State::where('active',true)->get();

        return view('admin.orders.edit',compact('order','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return
     */
    public function update(Request $request, Order $order)
    {

        $this->validate($request,[
            'product_name' =>'required',
            'value'=>'nullable|numeric|gt:0',
            'cust_name'=>'required',
            'cust_num'=>'required',
            'address'=>'required',
            'area_id'=>'required|numeric',
            'package_type' => 'nullable',
            'package_weight'=>'nullable|numeric',
            'deliver_before' =>'nullable|date', //  'deliver_before' =>'nullable|date|after:today',
            'quantity'=>'nullable|numeric',
            'cod'=> 'required|boolean',
            'notes'=>'nullable',
            'user_id' => 'nullable'
        ]);
        $input = $request->all();

        if (isset($input['value'])){

            $orderArea = Area::where('id',$input['area_id'])->select('id','delivery_cost','over_weight_cost')->first();

            if($user->plan->id !== Plan::first()->id){
                $orderArea->delivery_cost = $user->plan->area[$input['area_id']] ?? $orderArea->delivery_cost ;

            }

            //  dd($orderArea->delivery_cost . 'after');
            $input['status_id'] = Status::all()->first()->id;

            if (!$input['user_id']){
                $input['user_id'] = $user->id;
            }

            //        $input['total'] = $input['value'] * $input['quantity'] ;
            //       dd(setting('package_weight_limit'));

            if(!$input['cod']){
                $input['total'] = ($input['value'] * $input['quantity'] )  - $orderArea->delivery_cost ?? 0;

                // dd($input['total']);
                if($input['package_weight'] > setting('package_weight_limit')){
                    $input['total'] = ($input['value'] -
                            ( $orderArea->delivery_cost + (
                                    ($input['package_weight'] - setting('package_weight_limit')
                                    ) * $orderArea->over_weight_cost )
                            )
                        ) * $input['quantity']  ?? 0;
                }
            }elseif($input['package_weight'] > setting('package_weight_limit')){

                $over = ($input['package_weight'] - setting('package_weight_limit')) * $orderArea->over_weight_cost ;
                $input['total'] = ($input['value'] -  $over) * $input['quantity']  ?? 0;
            }else{

                $input['total'] = $input['value'] * $input['quantity'] ;
            }

        }


        dd($input['total']);

        $order->update($input);
        notify()->success('Order Updated Successfully');
        return redirect()->route('admin.orders.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     *@param  \App\Models\Order  $order
     * @return
     */
    public function destroy(Order $order)
    {


        if (auth()->id() !== $order->user_id){
            notify()->warning('You cant Delete this order');
            return redirect()->back()->with('You cant Delete this order');
        }

        $order->delete();
        notify()->success('Order Deleted Successfully');
        return redirect()->route('admin.orders.index');
    }
    public function trash(){
        $orders = Order::onlyTrashed()->with('user')->paginate(25);
        return view('admin.orders.trash',compact('orders'));
    }
    /**
     * Restore the specified resource from trash.
     *
     *
     * @return
     */
    public function restore( $id){

        $oid= Hashids::connection(Order::class)->decode($id) ?? [0];
        if(!$oid){
            abort(404);
        }

        $order = Order::onlyTrashed()->findOrFail($oid[0]);

        if (!$order->trashed()){

            notify()->error('Order isn\'t in trash');
           return redirect()->back();
        }

        $order->restore();
        notify()->success('Order Restored Successfully');
        return redirect()->route('admin.orders.trash');
    }

    public function packing(){
        $packing = Packing::all();
        return view('admin.orders.packing',compact('packing'));
    }

    public function adminExportOrdersAr()
    {

        return Excel::download(new OrdersExportAr, 'orders.xlsx');
    }

    public function adminExportOrdersEn()
    {
        return Excel::download(new OrdersExportEn, 'orders.xlsx');
    }
}
