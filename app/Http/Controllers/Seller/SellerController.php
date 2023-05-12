<?php

namespace App\Http\Controllers\Seller;

use App\Exports\Seller\SelectedOrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
    public function inventoryExport()
    {
        $ordersIds = auth()->user()->orders()->with('area','state','status')->whereIn('status_id',[1,2])->orderBy('updated_at','DESC')->pluck('id');
        return Excel::download(new SelectedOrdersExport($ordersIds), __('names.selected-orders').'.csv');
    }
    public function priceList(){
        $plan = auth()->user()->plan;
        $areas = Area::select('delivery_cost','id','name','delivery_time','over_weight_cost')->get();
      //  dd($areas[4]);
        foreach ($plan->area as $key=> $planArea){
            if ($planArea){
                $areas[$key-1]->delivery_cost = $planArea;
            }

        }

      //  dd($areas);
        return view('seller.accounting.price-list',compact('plan','areas'));
    }
    public function  ready()
    {
        $orders = auth()->user()->orders()->with('area','state','status')->whereIn('status_id',[2])->orderBy('updated_at','DESC')->paginate(10);
        return view('seller.orders.inline',compact('orders'));
    }
    public function  readyGo(Request $request,$id)
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
        $areas = Area::paginate(10);
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
