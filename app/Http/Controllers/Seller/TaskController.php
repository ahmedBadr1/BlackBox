<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function pickup(Request $request)
    {
        //  dd($request->all());

        $orders = auth()->user()->orders()->where('status_id',2)->get();
//        dd();
//        dd($orders->pluck('id'));

//        $receipt = new Receipt();
//        $receipt->orders_ids = $orders->pluck('id');
//        $receipt->orders_count = $orders->count();
//        $receipt->total = $orders->sum('total');
//        $receipt->user_id = auth()->user()->id;
//        $receipt->save();

//        foreach ($orders as $order){
//            $order->status_id = 3;
//            $order->update();
//        }
        $task = new Task();
        $task->user_id = auth()->user()->id ;
        $task->type = Task::$types[0] ;
        $task->save();

        // send notifaction to the admins for approvals
        return redirect()->route('orders.inventory');
    }
}
