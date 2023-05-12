<?php

namespace App\Http\Livewire\Main;

use App\Models\System\Location;
use Livewire\Component;

class Locations extends Component
{
    protected $rules = [
        'product_name' =>'required',
        'value'=>'nullable|numeric|gt:0',
        'cust_name'=>'required',
        'cust_num'=>'required',
        'address'=>'required',
        'area_id'=>'required|numeric',
        'package_type' => 'nullable',
        'package_weight'=>'nullable|numeric',
        'deliver_before' =>'nullable|date', //  'deliver_before' =>'nullable|date|after:today',
        'quantity'=>'nullable|numeric|gt:0',
        'cod'=> 'required|boolean',
        'notes'=>'nullable',
        'user_id' => 'nullable'
    ];

    public $aria = 1;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.main.locations',[
            'locations' => Location::select('id','name')->get(),
        ]);
    }
    public function save(){

    }
}
