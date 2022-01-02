<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSystemRequest;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:system');
    }


    public function index()
    {
        return view('system.setting.index');
    }

    public function default()
    {
     //   $system = System::first();
//        $currencies     = Setting::$currencies;
//        $languages = Setting::$languages;

      //  $taxes = Tax::where('active',true)->get();

        return view('system.setting.default');
    }
    public function company()
    {
     //  $sys =  Cache::get('System');

        return view('system.setting.company');
    }
    public function invoices()
    {
        return view('system.setting.invoices');
    }

    public function working()
    {

        return view('system.setting.working');
    }
    public function taxes()
    {
        return view('system.setting.taxes');
    }

    public function store(StoreSystemRequest $request)
    {

        $input = $request->validated();

        $path = 'uploads/system/logo';

        $system = system::first();

        if($system){
            if(! isset($input['company_logo'])){
                $photoPath  = $system->company_logo;
            }else {
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                if($system){
                    if(File::exists(storage_path().'/app/public/'.$system->company_logo)){
                        //dd('found');
                        File::delete(storage_path().'/app/public/'.$system->company_logo);
                    }
                }
                $photoPath =  $input['company_logo']->store($path,'public');
                $input['company_logo'] = $photoPath;
            }
            $system->update($input);
        }else{
            system::create($input) ;
        }
        if (isset($input['company_name'])){
            Config::set(['app.name' => $input['company_name']]);
        }

        Cache::forget('System');

        if (app()->getLocale() == 'en'){
            toastr()->success('System Setting Saved Successfully');
        }else{
            toastr()->success('تم حفظ إعدادات السيستم');
        }

        return redirect()->route('admin.dashboard');
    }
}
