<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\SellerController;
use App\Models\Area;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
class OrdersController extends Controller
{
    public function __construct()
    {
           $this->middleware('role:seller|Feedback');
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
      //  $orders = auth()->user()->orders()->with('user','area','state','status')->orderBy('updated_at','DESC')->simplePaginate(25);
        return view('seller.orders.index');
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
        return view('seller.orders.create',compact('areas'));
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
        return redirect()->route('seller.orders.index');
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
        return view('seller.orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param\App\Models\Order  $order
     * @return
     */
    public function edit(Order $order)
    {
        if (!auth()->user()->hasRole('Feedback')){
            if (auth()->id() !== $order->user_id){
                abort(404);
            }
        }

        if (!in_array($order->status->id,[1,2])){
            notify()->warning("Order Can't be changed after reaching to Bagy");
            return redirect()->route('orders.index');
        }

        // $states= State::where('active',true)->get();
        $areas = Area::all();
        return view('seller.orders.edit',compact('order','areas'));
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
            'area_id'=>'required|numeric',
            'quantity'=>'required|numeric',
            'notes'=>'',
        ]);
        $input = $request->all();
        $order->update($input);
        notify()->success('Order Updated Successfully');
        return redirect()->route('seller.orders.index');
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
        return redirect()->route('seller.orders.index');
    }
    public function trash(){
        $orders = auth()->user()->onlyTrashed()->paginate(25);
        return view('seller.orders.trash',compact('orders'));
    }

}
