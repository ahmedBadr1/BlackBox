<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExportEn;
use App\Models\Area;
use App\Models\Order;
use App\Models\State;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:seller|Feedback');
    }
    public function  track(Request $request)
    {
      //  dd($request['order_id']);
       $order_id =  $request['order_id'];

       $order =Order::findOrFail($request['order_id']);
        if (auth()->user()->id !== $order->user->id){
            abort(404);
        }
      // dd($order->user->id);
        $status =  Status::find($order->status_id);
     return view('orders.track',compact('status','order_id'));
    }
    public function mybalance (){
      //   $total = auth()->user()->orders->sum('value');
        $avilableOrders = auth()->user()->orders->where('status_id','>',4)->sortBy('status_id');
        $total = $avilableOrders->sum('value');
       // dd($avilableOrders);
        $ordersCount = auth()->user()->orders->count();

    //    dd($total);
         return view('orders.receipts.balance',compact('total','ordersCount','avilableOrders'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
        $orders = auth()->user()->orders()->orderBy('updated_at','DESC')->paginate(10);

//        $avOrders = auth()->user()->zone[0]->areas;
//        dd($avOrders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('orders.index',compact('orders'));
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
        $areas = Area::all();
        return view('orders.create',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       // dd($request->all());
        $this->validate($request,[
            'product_name' =>'required',
            'value'=>'required|numeric',
            'cust_name'=>'required',
            'cust_num'=>'required|numeric',
            'address'=>'required',
            'area_id'=>'required|numeric',
            'quantity'=>'required|numeric',
            'notes'=>'',
        ]);
        $input = $request->all();
        $input['status_id'] = Status::all()->first()->id;
        $input['user_id'] =auth()->id();
        Order::create($input);
//        Order::create([
//            'value' => $input['value'],
//            'cust_name' => $input['cust_name'],
//            'cust_num' => $input['cust_num'],
//            'address' => $input['address'],
//            'state' => $input['state'],
//            'area_id' => $input['area'],
//            'quantity' => $input['quantity'],
//            'notes' => $input['notes'],
//            'status' => Order::$status[0],
//            'user_id' => auth()->id(),
//        ]);

//        $order = new Order();
//       $order->value = $input['value'];
//        $order->cust_name = $input['cust_name'];
//        $order->cust_num = $input['cust_num'];
//        $order->address = $input['address'];
//        $order->state = $input['state'];
//        $order->area = $input['area'];
//        $order->quantity = $input['quantity'];
//        $order->notes = $input['notes'];
//        $order->status = '';
//        $order->user_id =  Auth::user()->id;
//        //dd(Auth::user()->id);
//        $order->save();
        notify()->success('Order Created Successfully');
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return
     */
    public function show(Order $order)
    {
        if (!auth()->user()->role('Feedback')){
            if (auth()->id() !== $order->user_id){
                abort(404);
            }
        }

        return view('orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param\App\Models\Order  $order
     * @return
     */
    public function edit(Order $order)
    {
        if (!auth()->user()->role('Feedback')){
            if (auth()->id() !== $order->user_id){
                abort(404);
            }
        }

        if ($order->status !== 'pending'){
            notify()->warning("Order Can't be changed after reaching to Bagy");
            return redirect()->route('orders.index');
        }

       // $states= State::where('active',true)->get();
        $areas = Area::all();
        return view('orders.edit',compact('order','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        $this->validate($request,[
            'product_name' =>'required',
            'value'=>'required|numeric',
            'cust_name'=>'required',
            'cust_num'=>'required|numeric',
            'address'=>'required',
            'area'=>'required',
            'quantity'=>'required',
            'notes'=>'',
        ]);
        $input = $request->all();
//        Order::update([
//            'value' => $input['value'],
//            'cust_name' => $input['cust_name'],
//            'cust_num' => $input['cust_num'],
//            'address' => $input['address'],
//            'state' => $input['state'],
//            'area' => $input['area'],
//            'quantity' => $input['quantity'],
//            'notes' => $input['notes'],
//            'status' => Order::$status[0],
//            'user_id' => auth()->id(),
//        ]);
        $order->product_name = $input['product_name'];
       $order->value = $input['value'];
        $order->cust_name = $input['cust_name'];
        $order->cust_num = $input['cust_num'];
        $order->address = $input['address'];
        $order->area = $input['area'];
        $order->quantity = $input['quantity'];
        $order->notes = $input['notes'];
       // $order->status = '';
        //$order->user_id =  Auth::user()->id;
        //dd(Auth::user()->id);
        $order->update();
        notify()->success('Order Updated Successfully');
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
        notify()->success('Order Deleted Successfully');
        return redirect()->route('orders.index');
    }


    public function assign(){
        $orders = Order::whereHas("status", function($q){ $q->whereIn("id" ,[2]); })->get();
       // dd($orders);
        $deliveries = User::whereHas("roles", function($q){ $q->whereIn("name" ,["delivery"]); })->get();

        $uniqueId = Str::random(8);
//            while(Order::where('id', $uniqueStr)->exists()) {
//
//            }
        dd($uniqueId);
        return view('orders.assign',compact('deliveries','orders'));
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
            $order->expire_at = now()->addHours(24);
            $order->status_id = 5 ;
            $order->update();
           // $branch->users()->save($user); $order->area->time_delivery
        }

        notify()->success( ' Orders Assigned Successfully To '.$delivery->name . ' Delivery','Orders Assigned');
        return redirect()->route('orders.index');
    }
}
