<?php

namespace App\Http\Controllers;

use App\Models\Area;
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

    public function addzone(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required|unique:zones,name',
            'order'=>''
        ]);
        $input = $request->all();
        $zone = Zone::create($input);
//        $zone->name = $request->post('name');
//        $zone->state = $request->post('state');
//
//        //    dd($field);
//        $zone->save();

        return response()->json($zone);
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $zones = Zone::orderBy('order')->get();

        $areas = Area::orderBy('id','DESC')->paginate(5);
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
        $zones = Zone::orderBy('order')->get();
        $states= Area::$states;
        return view('areas.create',compact('states','zones'));
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
            'time_delivery'=>'required|numeric',
            'zone_id' => 'required|numeric',
            'state' => 'required'
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
        $zones = Zone::orderBy('order')->get();
        $area = Area::findOrFail($id);
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
        $this->validate($request,[
            'name'=>'required|unique:areas,name',
            'delivery_cost'=>'required|numeric',
            'return_cost'=>'required|numeric',
            'replacement_cost'=>'required|numeric',
            'over_weight_cost'=>'required|numeric',
            'time_delivery'=>'required|numeric',
            'zone_id' => 'required',
            'state' => 'required'
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
