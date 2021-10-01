<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:branch-show|branch-create|branch-edit|branch-delete',['only'=>['index','show']]);
        $this->middleware('permission:branch-create',['only'=>['create','store']]);
        $this->middleware('permission:branch-edit',['only'=>['update','edit']]);
        $this->middleware('permission:branch-delete',['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
        //
        $branches = Branch::with(array('manager'=> function($query) {
        $query->select('id','name');
            },'state'))
            ->orderBy('id','DESC')
            ->paginate(10);

        return view('admin.areas.branches.index',compact('branches'))->with('i',($request->input('page',1)-1)*10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        // create manager role
       $managers = User::role(['manager'])->get();
       // $managers = User::role(['manager'])->pluck('id')[0];
        $states= State::where('active',true)->get();
      // dd($managers);
        return view('admin.areas.branches.create',compact('managers','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'name'=>'required|unique:branches,name',
            'phone'=>'required|numeric',
            'location'=>'required',
            'state_id'=>'required|numeric',
            'user_id'=>'required|numeric',
        ]);
        $input = $request->all();
        $branch  = Branch::create($input);

        $user = User::findOrFail($input['user_id']);
        $branch->users()->save($user);
        //dd($user);


        notify()->success($branch->name .' Branch Created Successfully',$branch->name.' Created');

       // notify('Branch '.$branch->name.' Created Successfully');
        return redirect()->route('admin.branches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($id)
    {

        $branch = Branch::with(['users','manager'=>function($q){
            $q->select('id','name');
        }])
        ->findOrFail($id);

     //   dd($branch);
     // dd($branch->users);
        return view('admin.areas.branches.show',compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit($id)
    {
        //
        $branch = Branch::findOrFail($id);
        $managers =User::role(['manager'])->get();
        $states= State::where('active',true)->get();
       return view('admin.areas.branches.edit',compact('branch','managers','states'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|numeric',
            'location'=>'required',
            'state_id'=>'required|numeric',
            'user_id'=>'required|numeric',
        ]);
        $input = $request->all();

        $branch = Branch::findOrFail($id);
        $branch->update($input);
        $user = User::findOrFail($input['user_id']);
        $branch->users()->save($user);

        notify()->success($branch->name .' Branch Updated Successfully','Branch Updated');
        return redirect()->route('admin.branches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return
     */
    public function destroy($id)
    {
      $branch =  Branch::findOrFail($id);

        $branch->delete();
        notify()->success($branch->name .' Branch Deleted Successfully','Branch Deleted');
        return redirect()->route('admin.branches.index');
    }
    public function assign($id){
        $branch = Branch::findOrFail($id);
        $users = User::whereHas("roles", function($q){ $q->whereNotIn("name" ,["seller"]); })->get();

        return view('areas.branches.assign',compact('branch','users'));
    }

    public function assignGo(Request $request,$id){
        $this->validate($request,[
            'users' => 'required|array'
        ]);
        $input = $request->all();
        $branch = Branch::findOrFail($id);
        foreach ($input['users'] as $id){
            $user = User::findOrFail($id);
            $branch->users()->save($user);
        }

        notify()->success( ' Users Assigned Successfully To '.$branch->name . ' Branch','Users Assigned');
        return redirect()->route('admin.branches.index');
    }
}
