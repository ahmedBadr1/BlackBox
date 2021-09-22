<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Receipt;
use App\Models\Status;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class SellerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:seller');
    }
    public function myorders (){
  //      dd('done');
        $orders = auth()->user()->orders()->with('user','area','state','status')->orderBy('updated_at','DESC')->simplePaginate(10);
        return view('orders.index',compact('orders'));
    }

    public function inventory()
    {
        $orders = auth()->user()->orders()->whereIn('status_id',[1,2])->orderBy('updated_at','DESC')->paginate(10);

//        $avOrders = auth()->user()->zone[0]->areas;
        // dd($orders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('orders.inventory',compact('orders'));
    }
    public function  inline()
    {
        $orders = auth()->user()->orders()->whereIn('status_id',[2])->orderBy('updated_at','DESC')->paginate(10);
        return view('orders.inline',compact('orders'));
    }
    public function  inlinego(Request $request,$id)
    {
     //   dd($hash);
       $key =  Hashids::connection(Order::class)->decode($id);
       $order = Order::findOrFail($key)[0];
      // dd($order);
        $order->status_id = 2 ;
        $order->update();
       // dd($order->status->name);
        return back();
    }
    public function  wait(Request $request,$id)
    {
        //   dd($hash);
        $key =  Hashids::connection(Order::class)->decode($id);
        $order = Order::findOrFail($key)[0];
        // dd($order);
        $order->status_id = 1;
        $order->update();
        // dd($order->status->name);
        return back();
    }

    public function pickup(Request $request)
    {
      //  dd($request->all());

        $orders = auth()->user()->orders()->where('status_id',2)->get();
//        dd();
//        dd($orders->pluck('id'));
        $receipt = new Receipt();
        $receipt->orders_ids = $orders->pluck('id');
        $receipt->orders_count = $orders->count();
        $receipt->total = $orders->sum('total');
        $receipt->user_id = auth()->user()->id;
        $receipt->save();
//        foreach ($orders as $order){
//            $order->status_id = 3;
//            $order->update();
//        }
    // send notifaction to the admins for approvals
        return redirect()->route('orders.inventory');
    }

    public function mybalance (){
        //   $total = auth()->user()->orders->sum('value');
        $avilableOrders = auth()->user()->orders->whereIn('status_id',[3,4,6,7,8,9])->sortBy('status_id');
        $total = $avilableOrders->sum('value');
        // dd($avilableOrders);
        $ordersCount = auth()->user()->orders->count();

        //    dd($total);
        return view('orders.receipts.balance',compact('total','ordersCount','avilableOrders'));
    }
}
