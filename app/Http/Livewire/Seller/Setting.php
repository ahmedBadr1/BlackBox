<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;

class Setting extends Component
{
    public bool $businessSetting   =true ;
    public bool $resetPassword =true ;
    public bool $invite  =true ;


    public function render()
    {
        return view('livewire.seller.setting');
    }
    public function active($key )
    {
        dd($key);
        $this->businessSetting = false;
        $this->resetPassword = false;
        $this->invite = false;
    }
}
