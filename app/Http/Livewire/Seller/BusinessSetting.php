<?php

namespace App\Http\Livewire\Seller;

use App\Models\Business;
use Livewire\Component;

class BusinessSetting extends Component
{
    protected $rules =[
        'name' => 'required',
        "contact" => "required",
        "industry" => "required",
        "channel" => "required",
        "url" => "required|url",
    ];
    public $industries;
    public $channels ;
    public $business;

    public function mount()
    {
        $this->industries = Business::$industries ;
        $this->channels = Business::$channels;
        $this->business = \auth()->user()->business ?? null;
    }
    public function render()
    {
        return view('livewire.seller.business-setting');
    }
}
