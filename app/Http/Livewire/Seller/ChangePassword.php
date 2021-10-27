<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;

class ChangePassword extends Component
{
    protected $rules =[
        'password' => 'required',
        'new_password' => 'required|min:8|same:con_password',
        'con_password' => 'required',
    ];
    public $password ;
    public $new_password;
    public $con_password;
    public function render()
    {
        return view('livewire.seller.change-password');
    }
    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
