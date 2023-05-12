<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\System\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

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

        $orders =   auth()->user()->custody()
            ->with(['state'=>fn ($q) => $q->select('states.id','states.name'),
                'area'=>fn ($q) => $q->select('areas.id','areas.name'),
                'user'=>fn ($q) => $q->select('users.id','users.name'),
                'status'=>fn ($q) => $q->select('statuses.id','statuses.name')])
            ->orderBy('id','desc')
            ->paginate(10);

        return view('delivery.orders.orders',compact('orders'));
    }
    public function mytasks()
    {
        //$user = auth()->user()->orders()->orderBy('updated_at','DESC')->paginate(10);
        $tasks =  Task::where('delivery_id','=',auth()->user()->id)->with(array('user'=> function ($query) { $query->select('id','name');}))->get();

//  dd($tasks);
//        $avOrders = auth()->user()->zone[0]->areas;
        //  dd($orders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('delivery.tasks.tasks',compact('tasks'));
    }
    public function Status($id)
    {
        $oid = Hashids::Connection(Order::class)->decode($id);

        if($oid){
            $order =   Order::findOrFail($oid)->first();
        }else{
            abort(404);
        }

        $statuses = Status::whereIn('id',[6,7,8])->get();
        //  dd($statuses);
        return view('delivery.orders.status',compact('order','statuses'));
    }


    public function changeStatus(Request $request,$id)
    {
        $input=  $this->validate($request,[
            'status_id'=> 'required'
        ]);
        //  dd($input);
        $oid = Hashids::Connection(Order::class)->decode($id);

        if($oid){
            $order =   Order::findOrFail($oid)->first();
        }else{
            abort(404);
        }
        $order->status_id = $input['status_id'];
        $order->update();

        $statuses = Status::whereIn('id',[6,7,8])->get();
        toastr()->success('Order Status Changed Successfully','Order Updated');
        return view('delivery.orders.status',compact('order','statuses'));
    }


    public function done($id){

        $task =  Task::findOrFail($id);
        if (auth()->user()->id !== $task->delivery->id ){
            abort(403);
        }

        $task->done_at = now();
        $task->update();
        return redirect()->back();
    }
    public function undone($id){
        $task =  Task::findOrFail($id);
        if (auth()->user()->id !== $task->delivery->id ){
            abort(403);
        }
        $task->done_at = null;
        $task->update();
        return redirect()->back();
    }

}
