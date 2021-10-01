<?php
//namespace App\helpers;
//class helper{
    function setting($key)
    {
        $setting = \Illuminate\Support\Facades\Cache::rememberForever('setting',function (){
            return \App\Models\Setting::first();
        });
        return $setting->$key;
    }
//}

