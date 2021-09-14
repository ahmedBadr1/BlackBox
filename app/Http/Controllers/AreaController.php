<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AreaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:area-show');
    }

    public function addfield(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }
}
