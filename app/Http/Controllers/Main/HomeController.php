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
        //   dd($request);
        $order_hashid ='';
        if ($request->query('order_id') !== null){
            $order_hashid = $request->query('order_id');
        }
//        $user =  \auth()->user();
//        $status= null;
//        $orderLogs=  null;


        return view('main.track',compact('order_hashid'));
    }

    public function  trackgo(Request $request)
    {
        //   dd($request->all());
        $this->validate($request,[
            'order_id' => 'required|string|max:8|min:8'
        ]);

        $order_hashid =  $request['order_id'];

        $id =    Hashids::Connection(Order::class)->decode(strtolower($order_hashid)) ?? [0];

        if($id){
            $order =Order::with('status')->findOrFail($id[0]);
        }else{
            $order = null;

        }

        return view('main.track',compact('order'));
    }
    public function privacyPolicy()
    {
        return view('main.privacy');
    }

}
