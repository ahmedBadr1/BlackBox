<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\State;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:zone-show|zone-create|zone-edit|zone-delete',['only'=>['index','show']]);
        $this->middleware('permission:zone-create',['only'=>['create','store']]);
        $this->middleware('permission:zone-edit',['only'=>['update','edit']]);
        $this->middleware('permission:zone-delete',['only'=>['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $zones = Zone::orderBy('id','DESC')->paginate(10);
        return view('areas.zones.index',compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $areas = Area::orderBy('id','DESC')->get();
        $states= State::where('active',true)->get();
        return view('areas.zones.create',compact('states','areas'));
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
            'name'=>'required|unique:zones,name',
            'rank'=>'',
            'state_id'=>'required'
        ]);
        $input = $request->all();

        $zone = Zone::create($input);

        foreach ($input['areas_id'] as $id){
            $area = Area::findOrFail($id);
            $zone->areas()->save($area);
        }

        notify()->success($zone->name.' Zone Created Successfully',$zone->name.' Created');
        return redirect()->route('zones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        return view('areas.zones.show',compact('zone'));;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return
     */
    public function edit(Zone $zone)
    {
        $areas = Area::orderBy('id','DESC')->get();
        $states= State::where('active',true)->get();
        return view('areas.zones.edit',compact('zone','states','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return
     */
    public function update(Request $request, Zone $zone)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'rank'=>'',
            'state_id'=>'required'
        ]);
        $input = $request->all();

        $zone->update($input) ;

        foreach ($input['areas_id'] as $id){
            $area = Area::findOrFail($id);
            $zone->areas()->save($area);
        }

        notify()->success($zone->name.' Zone Updated Successfully',$zone->name.' Updated');
        return redirect()->route('zones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        //
        $zone->delete();
        notify()->success($zone->name.' Zone Deleted Successfully',$zone->name.' Deleted');
        return redirect()->route('zones.index');
    }
}
