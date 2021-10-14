<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:task-show|task-create|task-edit|task-delete',['only'=>['index','show']]);
        $this->middleware('permission:task-create',['only'=>['create','store']]);
        $this->middleware('permission:task-edit',['only'=>['update','edit']]);
        $this->middleware('permission:task-delete',['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Task::where('done_at','=',null)->with(array('user'=> function ($query) { $query->select('id','name');},'delivery'=> function ($query) { $query->select('id','name');}))->orderBy('updated_at','DESC')->paginate(10);
//        $avOrders = auth()->user()->zone[0]->areas;
//        dd($avOrders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);


        return view('admin.tasks.index',compact('tasks'));
    }
    public function archive()
    {
        //
        $tasks = Task::where('done_at','!=',null)->with(array('user'=> function ($query) { $query->select('id','name');},'delivery'=> function ($query) { $query->select('id','name');}))->orderBy('updated_at','DESC')->paginate(10);

//        $avOrders = auth()->user()->zone[0]->areas;
//        dd($avOrders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('admin.tasks.archive',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $types = Task::$types;
        $deliveries = User::role('delivery')->select('id','name')->get();
      //  dd($deliveries);
        return  view('admin.tasks.create',compact('deliveries','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        $this->validate($request,[
           'type' => 'required',
           'delivery_id' => 'required',
            'notes' => ''
        ]);
        $input= $request->all();
        $input['user_id'] =  auth()->user()->id;
        Task::create($input);
        notify()->success('Task created Successfully','Task created');
      return  redirect()->route('admin.tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $task =  Task::where('id',$id)->with(array('user'=> function ($query) { $query->select('id','name');},'delivery'=> function ($query) { $query->select('id','name');}))->first();;
       // dd($task->delivery);
        return view('admin.tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::findOrFail($id);
        $types = Task::$types;
        $deliveries = User::role('delivery')->select('id','name')->get();

        return view('admin.tasks.edit',compact('task','deliveries','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'type' => 'required',
            'delivery_id' => 'required',
            'notes' => ''
        ]);
        $input= $request->all();
        $task =  Task::findOrFail($id);
        $task->update($input);
        notify()->success('Task Updated Successfully','Task Updated');
        return  redirect()->route('admin.tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       $task=  Task::findOrFail($id);
        $task->delete();
        notify()->success('Task Deleted Successfully','Task Deleted');
        return  redirect()->route('admin.tasks.index');
    }

    public function trash(){
        $tasks = Task::onlyTrashed()->with(['user'=>fn($q)=>$q->select('id','name'),'delivery'=>fn($q)=>$q->select('id','name')])->paginate(25);
        return view('admin.tasks.trash',compact('tasks'));
    }

    public function restore( $id){
        $task = Task::onlyTrashed()->findOrFail($id);
        if (!$task->trashed()){
            notify()->error('Task isn\'t in trash');
            return redirect()->back();
        }
        $task->restore();
        notify()->success('Task Restored Successfully');
        return redirect()->route('admin.tasks.trash');
    }

    public function done($id){
       $task =  Task::findOrFail($id);
    //   dd($task);
       $task->done_at = now();
       $task->update();
    return redirect()->back();
    }
    public function undone($id){
        $task =  Task::findOrFail($id);
        //   dd($task);
        $task->done_at = null;
        $task->update();
        return redirect()->back();
    }

    public function assign(){
        $tasks = Task::where('delivery_id',null)->get();
      //   dd($tasks);
        $deliveries = User::whereHas("roles", function($q){ $q->whereIn("name" ,["delivery"]); })->get();

        //   $uniqueId = Str::random(8);
//            while(Order::where('id', $uniqueStr)->exists()) {
//
//            }

//       $id = Hashids::connection(Order::class)->encode('65050');
//      dd($id);

        return view('admin.tasks.assign',compact('deliveries','tasks'));
    }

    public function assignGo(Request $request){

        $this->validate($request,[
            'delivery' => 'required',
            'tasks' => 'required|array'
        ]);
        $input = $request->all();
      //  dd($input);
        $delivery = User::findOrFail($input['delivery']);
        //     dd($delivery->name);
        foreach ($input['tasks'] as $id){
            $task = Task::findOrFail($id);
            //  dd($order);
            $task->delivery_id = $delivery->id;
            $task->update();
            // $branch->users()->save($user); $order->area->time_delivery
        }

        notify()->success( 'Task Assigned Successfully To '.$delivery->name ,'Task Assigned');
        return redirect()->route('admin.orders.index');
    }
}
