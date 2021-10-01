<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


class UserController extends Controller
{
    use SoftDeletes;
    public function __construct()
    {
        $this->middleware('permission:user-show|user-create|user-edit|user-delete',['only'=>['index','show']]);
        $this->middleware('permission:user-create',['only'=>['create','store']]);
        $this->middleware('permission:user-edit',['only'=>['update','edit']]);
        $this->middleware('permission:user-delete',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = QueryBuilder::for(User::class)
            ->with('roles','state','branch')
            ->whereHas("roles", function($q){ $q->whereNotIn("name", ["seller"]); })
            ->allowedFilters(['name','email',AllowedFilter::exact('id')])
            ->orderBy('id','DESC')
            ->paginate(10);

        return view('admin.users.index',compact('users'))->with('i',($request->input('page',1)-1)*10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $states= State::where('active',true)->get();
        $roles = Role::whereNotIn('name', ['seller'])->pluck('name');
        return view('admin.users.create',compact('roles','states'));
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
        $this->validate($request,[
            'name'=>'required|string|unique:users,name',
            'email'=> 'required',
            'role'=>'required',
            'password'=> 'required',

        ]);

        $input = $request->all();
       // dd($input['role']);
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($input['role']);
        return redirect()->route('admin.users.index')->with('success','User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
      //  $user = User::findOrFail($id);
      //  $userRole = DB::table('roles')->where('id',$user->role)->get();
       // $user = User::with('roles')->findOrFail($id);
        $user =  User::where('id',$id)->with(array('roles'=> function ($query) { $query->select('id','name');},'plan'=> function ($query) { $query->select('id','name');}))->first();

//  dd($user->roles);
        // $roles = $user->getRoleNames();
        return view('admin.users.show',compact('user'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id)
    {
        //
        $user = User::findOrFail($id);
        if($user->hasRole('seller')){
            abort(403);
        }
        $states= State::where('active',true)->get();

        //dd($user->roles);
        $roles = Role::whereNotIn('name', ['seller'])->pluck('name')->all();

        $userRole = $user->roles[0]->name;

        return view('admin.users.edit',compact('user','roles','userRole','states'));
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
        $this->validate($request,[
            'name'=>'required',
            'email'=> 'required|email',
            'role'=>'required'
        ]);

        $input = $request->all();
        //dd($input);
        $user =  User::findOrFail($id);
        $role =$user->roles[0];
        $user->removeRole($role);
        $user->assignRole($input['role']);
        $user->update($input);

//        DB::table('model_has_roles')->where('model_id',$id)->delete();
//        $roleId = DB::table('roles')->where('name',$request->input('role'))->value('id');
//
//        DB::table('users')->where('id',$id)->update(['role'=>$roleId]);


        $user->assignRole($request->input('role'));
        return redirect()->route('admin.users.index')->with('success','User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('success','User Deleted Successfully');
    }
}
