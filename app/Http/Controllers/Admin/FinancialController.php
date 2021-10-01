<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class FinancialController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:financial');
    }

    public function index(){

    $availabeOrders = Order::whereIn('status_id',range(3,9))->with('area')->select('total','area_id','delivery_id')->get();

        $revenues = 0;
        foreach($availabeOrders as $order){
            $revenues +=    $order->area->delivery_cost;
        }
     $deliveryOrders  = Order::has('delivery')->select('total');
     $outWithDelivery = $deliveryOrders->sum('total');
     $shipperBalance = $availabeOrders->sum('total');
//dd($revenues);
    $collected = $shipperBalance + $revenues;
//    $shipperBalance = $collected - $costs;

        //$areas = Area::withCount('orders')->orderBy('orders_count')->get();
    return view('admin.financial.index',compact(
        'outWithDelivery',
        'collected',
        'revenues',
        'shipperBalance'
    ));
    }
}
