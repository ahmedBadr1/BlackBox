<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:delivery');
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
    public function mytasks()
    {
        //$user = auth()->user()->orders()->orderBy('updated_at','DESC')->paginate(10);
        $tasks =  Task::where('delivery_id','=',auth()->user()->id)->with(array('user'=> function ($query) { $query->select('id','name');}))->get();

//  dd($tasks);
//        $avOrders = auth()->user()->zone[0]->areas;
        //  dd($orders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('layouts.delivery.tasks',compact('tasks'));
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
