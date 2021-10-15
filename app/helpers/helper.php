<?php
//namespace App\helpers;
//class helper{
use Illuminate\Support\Facades\Cache;

function setting($key)
    {
        if (!\App\Models\Setting::first()){
            return ;
        }
//        if(!Cache::has('setting')){
//            $setting = \Illuminate\Support\Facades\Cache::rememberForever('setting',function (){
//                return \App\Models\Setting::first();
//            });
//        }
//        $setting = cache('setting');
    $setting = \Illuminate\Support\Facades\Cache::rememberForever('setting',function (){
                        return \App\Models\Setting::first();
            });
        return $setting->$key;
    }
//}

