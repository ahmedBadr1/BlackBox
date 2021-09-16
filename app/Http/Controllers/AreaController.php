<?php

namespace App\Http\Controllers;

use App\Models\Area;
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
        dd($request);
        $this->validate($request,[
            'name'=>'required|unique:zones,name',
            'state'=>'required'
        ]);


        $zone =  new Field();
        $zone->name = $request->post('name');
        $zone->state = $request->post('state');

        //    dd($field);
        $zone->save();
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

        $areas = Area::orderBy('id','DESC')->paginate(5);
        return view('areas.index',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $zones = [];
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
            'price'=>'required',
            'zone' => '',
            'state' => 'required'
        ]);
        $input = $request->all();

        Area::create($input);

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
        $zones = [];
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
            'name'=>'required',
            'price'=>'required',
            'zone' => '',
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
        //
        $area = Area::find($id);
        $area->delete();
        notify()->success('Area Deleted Successfully','Area Deleted');
        return redirect()->route('areas.index');
    }
}
