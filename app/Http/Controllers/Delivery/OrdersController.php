<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\System\Status;
use App\Models\Task;
use App\Models\User;
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
    public function myTasks()
    {
        //$user = auth()->user()->orders()->orderBy('updated_at','DESC')->paginate(10);
        $tasks =  Task::mine()->whereNull('confirmed_at')->with(array('user'=> function ($query) { $query->select('id','name');}))->get();

        return view('delivery.tasks.tasks',compact('tasks'));
    }

    public function myDoneTasks()
    {
        //$user = auth()->user()->orders()->orderBy('updated_at','DESC')->paginate(10);
        $tasks =  Task::mine()->where('confirmed_at','!=',null)->with(array('user'=> function ($query) { $query->select('id','name');}))->get();

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
        $user = User::with(['orders'=> fn($q) => $q->whereHas('status', fn($q) => $q->where('name','ready' ))])->where('id',$task->user_id)->first();
//        $orders = Order::whereHas('status', fn($q) => $q->where('name','ready' ))->get(['id','total']);
//        dd($orders);
        return view('delivery.tasks.finish',compact('task','user'));
    }
    public function finish(Request $request){
        $input =  $request->validate(
            ['orders' => 'required|array']
        );
//        dd($input);
        $picked = Status::where('name','picked')->first(['id'])->id;

        foreach ($input['orders'] as $orderHash){
          $order =  $this->getOrder($orderHash);
            $order->status_id = $picked ;
            $order->delivery_id = auth()->id();
            $order->save();
        }
       return view('delivery.orders.orders');
    }

    private function getOrder($hashId){
        $id =   Hashids::Connection(Order::class)->decode($hashId);
        $order =   Order::find($id)->first();
        return $order ;
    }

}
