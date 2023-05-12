<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Area;
use App\Models\System\Location;
use App\Models\System\State;
use Illuminate\Http\Request;

class LocationsControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = Location::with(['state'=> fn($q)=>$q->select('id','name'),'area'=> fn($q)=>$q->select('id','name')])->orderBy('id','desc')->get();
      //  dd($locations);
        return view('admin.locations.index',compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::select('id','name')->get();
        $areas = Area::where('active',true)->select('id','name')->get();
    //    dd($areas);
        return view('admin.locations.create',compact('states','areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $validated = $request->validated();
     //   $validated = $request->safe()->only(['name', 'state_id','area_id','street','building','floor','apartment','landmarks','latitude','longitude']);
       // dd($validated);
        $location = Location::create($validated);
        auth()->user()->locations()->save($location);
        toastr()->success('Location Created Successfully');
        return redirect()->route('admin.locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System\Location  $location
     * @return
     */
    public function show(Location $location)
    {
        //

        return view('admin.locations.show',compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\System\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
        $states = State::select('id','name')->get();
        $areas = Area::where('active',true)->select('id','name')->get();
        //    dd($areas);
        return view('admin.locations.edit',compact('states','areas','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\System\Location $location
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(Request $request, Location $location)
    {

   //     dd($request->all());
       $input =  $this->validate($request,[
            'name' => 'required|max:100',
            'state_id' => 'required|numeric' ,
            'area_id' => 'required|numeric' ,
            'street' => 'nullable' ,
            'building' => 'nullable' ,
            'floor' => 'nullable' ,
            'apartment' => 'nullable' ,
            'landmarks' => 'nullable' ,
//            'latitude' => 'required|numeric|between:-90,90',
//            'longitude' => 'required|numeric|between:-180,180'
        ]);

      //  $validated = $request->validated();
     //   $validated = $request->safe()->only(['name', 'state_id','area_id','street','building','floor','apartment','landmarks','latitude','longitude']);
        //dd($input);
        $location->updateOrFail($input);
        toastr()->success('Location ipdated Successfully');
        return redirect()->route('admin.locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\System\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        // if auth()->user->locations->count

        $location->deleteOrFail();

        toastr()->success('Location Deleted Successfully');
        return redirect()->route('admin.locations.index');
    }
}
