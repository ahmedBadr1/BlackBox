<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Order;
use App\Models\Receipt;
use App\Models\Status;
use App\Models\Task;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        $orders = auth()->user()->orders()->with('area','state','status')->whereIn('status_id',[1,2])->orderBy('updated_at','DESC')->paginate(10);

//        $avOrders = auth()->user()->zone[0]->areas;
        // dd($orders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('seller.orders.inventory',compact('orders'));
    }
    public function  inline()
    {
        $orders = auth()->user()->orders()->with('area','state','status')->whereIn('status_id',[2])->orderBy('updated_at','DESC')->paginate(10);
        return view('seller.orders.inline',compact('orders'));
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
    public function areas()
    {
        $areas = Area::all();
        return view('seller.areas.index',compact('areas'));
    }
    public function areasShow($id)
    {
        $area = Area::findOrFail($id);
        return view('seller.areas.show',compact('area'));
    }
    public function branches()
    {
        $branches = Branch::all();
        return view('seller.areas.index',compact('branches'));
    }
    public function branchesShow($id)
    {
        $branch = Branch::findOrFail($id);
        return view('seller.areas.show',compact('branch'));
    }



}
