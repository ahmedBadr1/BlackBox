<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:delivery|Feedback');
    }


    public function myorders()
    {
        //$user = auth()->user()->orders()->orderBy('updated_at','DESC')->paginate(10);
        $orders =  Order::where('delivery_id','=',auth()->user()->id)->get();


//        $avOrders = auth()->user()->zone[0]->areas;
     //  dd($orders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('layouts.delivery.orders',compact('orders'));
    }
    public function Status($id)
    {
      $order =   Order::findOrFail($id);
      $statuses = Status::whereIN('id',[6,7,8])->get();
    //  dd($statuses);
       return view('layouts.delivery.status',compact('order','statuses'));
    }


    public function changeStatus(Request $request,$id)
    {
     $input=  $this->validate($request,[
          'status_id'=> 'required'
       ]);
      //  dd($input);
       $order = Order::findOrFail($id);
       $order->status_id = $input['status_id'];
        $order->update();
        $statuses = Status::whereIN('id',[6,7,8])->get();
    notify()->success('Order Status Changed Successfully','Order Updated');
        return view('layouts.delivery.status',compact('order','statuses'));
    }
}
