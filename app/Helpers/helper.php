<?php

if (!function_exists('sys'))   {
    function sys($key)
    {
        $system = \Illuminate\Support\Facades\Cache::rememberForever('Setting',function (){
            return \App\Models\System\Setting::first();
        });
        if (!$system){
            return ;
        }
        return $system->$key;
    }
}



