<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExportEn;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Order;
use App\Models\State;
use App\Models\Status;
use App\Models\User;
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
            $orders = Order::with('user','area','status','state')->orderBy('updated_at','DESC')->paginate(10);
//        $avOrders = auth()->user()->zone[0]->areas;
//        dd($avOrders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('admin.orders.index',compact('orders'));
    }
    public function track(Request $request ){
        // dd($request);
        $order_hashid ='';
        if ($request->query('order_id') !== null){
            $order_hashid = $request->query('order_id');
        }
        $user =  \auth()->user();
        $status= null;
        return view('admin.track',compact('user','order_hashid','status'));
    }

    public function  trackgo(Request $request)
    {
        //  dd($request['order_id']);
        $order_hashid =  $request['order_id'];
        $id =    Hashids::Connection(Order::class)->decode($order_hashid);

        if($id){
            $order =Order::findOrFail($id[0]);
            $status =  Status::find($order->status_id)->name;
        }else{
            $status =  null;
        }

//        if (auth()->user()->id !== $order->user->id){
//            abort(404);
//        }


        return view('admin.track',compact('status','order_hashid'));
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
        return view('admin.orders.create',compact('areas'));
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
        $input['total'] = $input['value'] * $input['quantity'] ?? 0;
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
            if (auth()->id() !== $order->user_id){
                abort(404);
            }

        if (!in_array($order->status->id,[1,2])){
            notify()->warning("Order Can't be changed after reaching to Bagy");
            return redirect()->route('admin.orders.index');
        }

       // $states= State::where('active',true)->get();
        $areas = Area::all();
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
            'value'=>'required|numeric',
            'cust_name'=>'required',
            'cust_num'=>'required|numeric',
            'address'=>'required',
            'area_id'=>'required|numeric',
            'quantity'=>'required|numeric',
            'notes'=>'',
        ]);
        $input = $request->all();
        $order->update($input);
        notify()->success('Order Updated Successfully');
        return redirect()->route('admin.orders.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return
     */
    public function destroy(Order $order)
    {
        if (auth()->id() !== $order->user_id){
            abort(404);
        }
        $order->delete();
        notify()->success('Order Deleted Successfully');
        return redirect()->route('orders.index');
    }
    public function trash(){
        $orders = Order::onlyTrashed()->with('user')->paginate(25);
        return view('admin.orders.trash',compact('orders'));
    }

}
