<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Feature;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plans = Plan::with(array('features'=> function ($query) {$query->select('feature_id','name');}))->get();
   //   dd($plans);
        return view('admin.plans.index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       $features = Feature::all('id','name');
       $areas = Area::select('id','name')->get();

//       dd($areas);
        return view('admin.plans.create',compact('features','areas'));
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
            'name'=>'required|unique:plans,name',
            'orders_count'=>'required',
            'pickup_cost'=> 'required',
             'area'=> 'required|array'
        ]);
        $input = $request->all();
     //   dd($input);
        $plan = Plan::create($input);
      foreach ($input['features'] as $id){
          $feature = Feature::findOrFail($id);
          $feature->plans()->attach($plan->id);
      }

        return redirect()->route('admin.plans.index')->with('success','Plan Created Successfully');
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
        $plan = Plan::where('id',$id)->first();
        return view('admin.plans.show',compact('plan'));
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
        $plan = Plan::where('id',$id)->first();
        //$plan = Plan::findOrFail($id);

        $areas = Area::select('id','name')->get();
        $features = Feature::all('id','name');

        $planFeatures =Db::table("feature_plan")->where('feature_plan.plan_id',$id)->pluck('feature_plan.feature_id','feature_plan.feature_id')->all();
       // dd($planFeatures);


        return view('admin.plans.edit',compact('features','plan','planFeatures','areas'));
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
            'orders_count'=>'required',
            'pickup_cost'=> 'required'
        ]);
        $input = $request->all();

        $plan = Plan::findOrFail($id);
        $plan->update($input);
        $plan->features()->detach();
        if (isset($input['features'])){
            foreach ($input['features'] as $fid){
                $feature = Feature::findOrFail($fid);
                $feature->plans()->attach($plan->id);
            }
        }


        return redirect()->route('admin.plans.index')->with('success','Plan Updated Successfully');
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
        if ($id == Plan::first()->id){
            notify()->error('plan cant be deleted');


            return redirect()->back();
        }
        $plan = Plan::findOrFail($id);

        $plan->delete();

        return redirect()->route('admin.plans.index')->with('success','Plan Deleted Successfully');
    }

    public function features()
    {
        $features = Feature::all();
    return view('admin.plans.features',compact('features'));
    }
    public function featuresShow($id)
    {
        $feature = Feature::where('id',$id)->with(array('plans'=> fn($q)=>$q->select('plan_id','name')))->first();
        return view('admin.plans.feature',compact('feature'));
    }

}
