<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Location;
use App\Models\State;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:seller');
    }
    //
    public function index()
    {
        $user = auth()->user();
        $nextPickup = $user->pickups()->where( 'due_to','>', now())->select('due_to')->orderBy('due_to')->first();
        $nextDropoff = $user->dropoffs()->where('due_to' ,'>',now())->select('due_to','id')->first();

        $readyOrdersCount = $user->orders()->where('status_id',2)->count();

//        RoomMonitor::where('room',$roomId)
//            ->where('operation_time', '<=', now()->format("H:i:s"))
//            ->orderBy('operation_time','desc')
//            ->firstOrFail();
    //   dd($nextPickup);
     //   $tasks = Task::with('location')->take(10)->get();
       // dd($tasks);
//        foreach ($pickups as $pickup){
//            dd($pickup->location);
//        }
        $locations = auth()->user()->locations()->with(['state'=> fn($q)=>$q->select('id','name'),'area'=> fn($q)=>$q->select('id','name')])->get();
        return view('seller.tasks.pickups',compact('nextPickup','nextDropoff','readyOrdersCount','locations'));
    }

    public function locations()
    {


       // dd($locations);
        return view('seller.tasks.locations');
    }
    public function createLocation(Request $request)
    {
        $validated = $this->validate($request,[
            'name' => 'required' ,
            'state_id' => 'required|numeric' ,
            'area_id' => 'required|numeric' ,
            'street' => 'nullable' ,
            'building' => 'nullable' ,
            'floor' => 'nullable' ,
            'apartment' => 'nullable' ,
            'landmarks' => 'nullable' ,
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
        ]);

//        $validated = $request->validated();
//        $validated = $request->safe()->only(['name', 'state_id','area_id','street','building','floor','apartment','landmarks','latitude','longitude']);
        $location =    Location::create($validated);
        $user = auth()->user();
        $user->locations()->save($location);

        toastr()->success('Location Created Successfully');
        return redirect()->route('locations');
    }
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
