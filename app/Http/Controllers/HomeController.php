<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }
    public function track(Request $request ){
       // dd($request);
        $order_id ='';
        if ($request->query('order_id') !== null){
            $order_id = $request->query('order_id');
        }
        $user =  \auth()->user();
        $status= null;
        return view('orders.track',compact('user','order_id','status'));
    }
}
