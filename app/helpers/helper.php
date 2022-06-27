<?php

use Illuminate\Support\Facades\Cache;
if (!function_exists('sys'))   {
    function sys($key)
    {
        $system = \Illuminate\Support\Facades\Cache::rememberForever('System',function (){
            return \App\Models\System::first();
        });
        if (!$system){
            return ;
        }
        return $system->$key;
    }
}



