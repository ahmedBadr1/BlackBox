<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     //   $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return
     */

    public function track(Request $request ){
       // dd($request);
        $order_hashid ='';
        if ($request->query('order_id') !== null){
            $order_hashid = $request->query('order_id');
        }
        $user =  \auth()->user();
        $status= null;
        return view('main.track',compact('user','order_hashid','status'));
    }

    public function  trackgo(Request $request)
    {
        //  dd($request['order_id']);
        $this->validate($request,[
            'order_id' => 'required'
        ]);
        $order_hashid =  $request['order_id'];
        $id =    Hashids::Connection(Order::class)->decode($order_hashid);

        if($id){
            $order =Order::find($id[0]);
            if ($order){
                $status =  Status::find($order->status_id)->name;
            }else{
                $status =  'order-not-found';
            }
        }else{
            $status =  'order-not-found';
        }

//        if (auth()->user()->id !== $order->user->id){
//            abort(404);
//        }


        return view('main.track',compact('status','order_hashid'));
    }
    public function privacyPolicy()
    {
        return view('main.privacy');
    }

}
