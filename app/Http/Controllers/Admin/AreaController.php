<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\System\State;
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

//    public function toggle(Request $request,$id)
//    {
//        //dd($id);
//        //$this->middleware('permission:states');
//        $state = State::findOrFail($id);
//        //return $device->name;
//        $state->active = !$state->active;
//        return response()->json($state->active) ;
//    }
    public function states()
    {
       // $this->middleware('permission:states');
        $states= State::with(['areas'=>fn ($q) => $q->select('areas.id','areas.name'),'branches','zones'])->get();
//        foreach ($states as $state){
//            dd($state->users);
//        }
        return view('admin.areas.states',compact('states'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $areas = Area::with('zone','state')->orderBy('id','DESC')->paginate(10);
        return view('admin.areas.index',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $zones = Zone::all();
        $states = State::all();

        return view('admin.areas.create',compact('zones','states'));
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
            'zone_id' => 'required|exists:zones,id',
            'state_id' => 'required|exists:states,id',
        ]);
        $input = $request->all();
//        dd($input['state_id']);
    //    $zone = Zone::find($input['zone_id']);

            $area = Area::create($input);
     //   $zone->areas->attach($area->id);

        return redirect()->route('admin.areas.index')->with('success','Area Created Successfully');
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
        return view('admin.areas.show',compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        //
        $zones = Zone::orderBy('rank')->get();
        $area = Area::findOrFail($id);
        $states = State::all();

        return view('admin.areas.edit',compact('area','states','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
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
            'zone_id' => 'required|exists:zones,id',
            'state_id' => 'required|exists:states,id',
        ]);
        $input = $request->all();

        $area = Area::find($id);
        $area->update($input);
        return redirect()->route('admin.areas.index')->with('success','Area Updated Successfully');
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
        toastr()->success('Area Deleted Successfully','Area Deleted');
        return redirect()->route('admin.areas.index');
    }
}
