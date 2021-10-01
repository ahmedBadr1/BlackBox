<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('seller.dashboard');
    }
    public function mybalance (){
        //   $total = auth()->user()->orders->sum('value');
        //   Order::with('area')->whereIn('status_id',[3,4,5,6,7,8,9])->sortBy('status_id');
        $avilableOrders = auth()->user()->orders()->with('area','status')->whereIn('status_id',[3,4,5,6,7,8,9])->orderBy('status_id')->get();
        //  dd($avilableOrders);
        $total = $avilableOrders->sum('value');
        // dd($avilableOrders);
        $ordersCount = auth()->user()->orders->count();

        //    dd($total);
        return view('orders.receipts.mybalance',compact('total','ordersCount','avilableOrders'));
    }
    public function mytrash()
    {
        if(Gate::allows('feature','trash')){
            $orders = auth()->user()->orders()->onlyTrashed()->paginate(25);
        }else{
            abort('403');
        }


        //   dd($orders);
        return view('orders.trash',compact('orders'));
    }
}
