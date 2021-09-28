<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\State;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AreaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:area-show|area-create|area-edit|area-delete',['only'=>['index','show']]);
        $this->middleware('permission:area-create',['only'=>['create','store']]);
        $this->middleware('permission:area-edit',['only'=>['update','edit']]);
        $this->middleware('permission:area-delete',['only'=>['destroy']]);

    }
    public function toggle(Request $request,$id)
    {
        //dd($id);
        //$this->middleware('permission:states');
        $state = State::findOrFail($id);
        //return $device->name;
        $state->active = !$state->active;
        return response()->json($state->active) ;
    }
    public function states()
    {
       // $this->middleware('permission:states');
        $states= State::where('active',true)->with(array('users'=>function ($query){  $query->select('id','name');},'branches','areas','zones'))->get();
//        foreach ($states as $state){
//            dd($state->users);
//        }
        return view('areas.states',compact('states'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $zones = Zone::orderBy('rank')->get();

        $areas = Area::with('zone','state')->orderBy('id','DESC')->paginate(10);
        return view('areas.index',compact('areas','zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $zones = Zone::orderBy('rank')->get();
    //    $states= State::where('active',true)->get();

        return view('areas.create',compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'name'=>'required|unique:areas,name',
            'delivery_cost'=>'required|numeric',
            'return_cost'=>'required|numeric',
            'replacement_cost'=>'required|numeric',
            'over_weight_cost'=>'required|numeric',
            'delivery_time'=>'required|numeric|min:12',
            'zone_id' => 'required|numeric|min:1',
        ]);
        $input = $request->all();
      //  dd($input['zone_id']);
    //    $zone = Zone::find($input['zone_id']);

            $area = Area::create($input);
     //   $zone->areas->attach($area->id);

        return redirect()->route('areas.index')->with('success','Area Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function show($id)
    {
        //
        $area = Area::findOrFail($id);
        return view('areas.show',compact('area'));
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
        $zones = Zone::orderBy('rank')->get();
        $area = Area::findOrFail($id);
       // $states= State::where('active',true)->get();
        return view('areas.edit',compact('area','zones'));
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
      //   dd($request->all());
        $this->validate($request,[
            'name'=>'required',
            'delivery_cost'=>'required|numeric',
            'return_cost'=>'required|numeric',
            'replacement_cost'=>'required|numeric',
            'over_weight_cost'=>'required|numeric',
            'delivery_time'=>'required|numeric',
            'zone_id' => 'required',
        ]);
        $input = $request->all();

        $area = Area::find($id);
        $area->update($input);

        return redirect()->route('areas.index')->with('success','Area Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);
        $area->delete();
        notify()->success('Area Deleted Successfully','Area Deleted');
        return redirect()->route('areas.index');
    }
}
