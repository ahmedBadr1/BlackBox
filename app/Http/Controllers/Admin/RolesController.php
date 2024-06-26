<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
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

        $roles = Role::whereNotIn('name', ['seller'])->orderBy('id','DESC')->paginate(5);

        return view('admin.roles.index',compact('roles'))->with('i',($request->input('page',1)-1)*5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {

        $permissions = Permission::getPermissions();
        return view('admin.roles.create',compact('permissions'));
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
            'name'=>'required|unique:roles,name',
            'permissions'=>'required'
        ]);
        $input = $request->all();

        $role =Role::findOrCreate($request->input('name'));
        $role->syncPermissions($request->input('permissions'));
        return redirect()->route('admin.roles.index')->with('success','Role Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($id)
    {
        $role = Role::where('id',$id)->with(array('permissions'=>  function ($query) { $query->select('name');}))->first();
//dd($role);
        return view('admin.roles.show',compact('role'));
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
        $role = Role::findById($id);
        if($role->name === 'seller'){
            abort(403);
        }
        $permissions = Permission::get();
        $rolePermissions =Db::table("role_has_permissions")->where('role_has_permissions.role_id',$id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
        return view('admin.roles.edit',compact('role','permissions','rolePermissions'));

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
        ]);

        $role = Role::find($id);
        // dd($role);

        $role->name =$request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permissions'));
      //  session()->flash('success','Role Updated Successfully');
        toastr()->success($role->name .'Role Updated Successfully','Role Updated');
        return redirect()->route('admin.roles.index');
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
        if($role->name === 'seller'){
            abort(403);
        }
        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('admin.roles.index')->with('success','Role Deleted Successfully');
    }

    public function permissions(){
        $permissions = Permission::getPermissions();
        //$roles = Role::
        return view('admin.roles.permissions',compact('permissions'));
    }
    public function permissionsCreate(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:permissions,name',
        ]);
        $input = $request->all();

        // dd($input['name']);
        Permission::create(['name' => $input['name']]);

        return redirect()->back()->with('success','Permission Created Successfully');
    }
    public function permissionsDelete(int $id)
    {
        $permission = Permission::findById($id);
        $permission->delete();
        return redirect()->back()->with('success','Permission Deleted Successfully');
    }
}
