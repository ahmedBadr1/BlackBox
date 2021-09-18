<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:role-show|role-create|role-edit|role-delete',['only'=>['index','show']]);
        $this->middleware('permission:role-create',['only'=>['create','store']]);
        $this->middleware('permission:role-edit',['only'=>['update','edit']]);
        $this->middleware('permission:role-delete',['only'=>['destroy']]);
        $this->middleware('permission:permissions',['only'=>['permissions','permissionsCreate','permissionsDelete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
        //
        $branches = Branch::orderBy('id','DESC')->paginate(10);

        return view('branches.index',compact('branches'))->with('i',($request->input('page',1)-1)*10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        // create manager role
        $managers =User::role(['manager'])->pluck('name');
        //$managers = User::whereNotIn('name', ['client']);

       // dd($managers);
        return view('branches.create',compact('managers'));
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
            'manager'=>'required',
        ]);
        $input = $request->all();
        $branch  = Branch::create($input);

        //dd($user);


        notify()->success($branch->name .' Branch Created Successfully',$branch->name.' Created');

       // notify('Branch '.$branch->name.' Created Successfully');
        return redirect()->route('branches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.show',compact('branch'));
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
        $managers =User::role(['manager'])->pluck('name');
       return view('branches.edit',compact('branch','managers'));

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
            'name'=>'required|unique:branches,name',
            'phone'=>'required|numeric',
            'location'=>'required',
            'manager'=>'required',
        ]);
        $input = $request->all();
        $branch = Branch::findOrFail($id);
        $branch->update($input);

        notify()->success($branch->name .' Branch Updated Successfully','Branch Updated');
        return redirect()->route('branches.index');
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
        notify()->success($branch->name .' Branch Deleted Successfully','Branch Deleted');
        $branch->delete();

        return redirect()->route('branches.index');
    }
    public function assign($id){
        $branch = Branch::findOrFail($id);
        $users = User::whereHas("roles", function($q){ $q->whereNotIn("name" ,["seller"]); })->get();

        return view('branches.assign',compact('branch','users'));
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
        return redirect()->route('branches.index');
    }
}
