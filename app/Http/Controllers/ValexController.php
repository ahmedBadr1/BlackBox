<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValexController extends Controller
{
    //
    public function __invoke($name)
    {
        if(view()->exists('valex.'.$name)){
            return view('valex.'.$name);
        }

            return view('valex.'.'404');
        //   return view($id);
    }
}
