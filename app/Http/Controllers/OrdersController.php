<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:client|Feedback');
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
        $orders = auth()->user()->orders()->orderBy('updated_at','DESC')->paginate(10);


       // dd($orders);
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
        $states= Area::$states;
        $areas = Area::all();
        return view('orders.create',compact('areas','states'));
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
     //   dd($request->all());
        $this->validate($request,[
            'value'=>'required|numeric',
            'cust_name'=>'required',
            'cust_num'=>'required|numeric',
            'address'=>'required',
            'state'=>'required',
            'area'=>'required',
            'quantity'=>'required',
            'notes'=>'',
        ]);
        $input = $request->all();
        Order::create([
            'value' => $input['value'],
            'cust_name' => $input['cust_name'],
            'cust_num' => $input['cust_num'],
            'address' => $input['address'],
            'state' => $input['state'],
            'area' => $input['area'],
            'quantity' => $input['quantity'],
            'notes' => $input['notes'],
            'status' => Order::$status[0],
            'user_id' => auth()->id(),
        ]);

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
       if (auth()->id() !== $order->user_id){
        abort(404);
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
        if (auth()->id() !== $order->user_id){
            abort(404);
        }

        if ($order->status !== 'pending'){
            notify()->warning("Order Can't be changed after reaching to Bagy");
            return redirect()->route('orders.index');
        }

        $states= Area::$states;
        $areas = Area::all();
        return view('orders.edit',compact('order','areas','states'));
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
            'value'=>'required|numeric',
            'cust_name'=>'required',
            'cust_num'=>'required|numeric',
            'address'=>'required',
            'state'=>'required',
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

       $order->value = $input['value'];
        $order->cust_name = $input['cust_name'];
        $order->cust_num = $input['cust_num'];
        $order->address = $input['address'];
        $order->state = $input['state'];
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
}
