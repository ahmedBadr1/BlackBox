<?php

namespace App\Http\Livewire\Seller;

use App\Models\Area;
use App\Models\Location;
use App\Models\State;
use Livewire\Component;

class LocationsCreate extends Component
{
    protected $rules = [
        'name' => 'required' ,
        'state_id' => 'required|numeric' ,
        'area_id' => 'required|numeric' ,
        'street' => 'nullable' ,
        'building' => 'nullable' ,
        'floor' => 'nullable' ,
        'apartment' => 'nullable' ,
        'landmarks' => 'nullable' ,
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
    ];
    public $states ;
    public $areas ;


    public $name ;
    public $state_id ;
    public $area_id ;
    public $street ;
    public $building ;
    public $floor ;
    public $apartment ;
    public $landmarks;
    public $latitude ;
    public $longitude ;


    public function mount(){

    }
    public function render()
    {
        $this->states = State::where('active',true)->select('id','name')->get();
        $state = State::find($this->state_id) ;
        if ($state){
            $this->areas = $state->areas()->where('active',true)->select('areas.id','areas.name')->get() ;
        }else{
            $this->areas = [];
        }

        return view('livewire.seller.locations-create');
    }
    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function updatedStateId()
    {
        $state = State::find($this->state_id) ?? [];
        $this->areas = $state->areas()->where('active',true)->select('areas.id','areas.name')->get() ;
    }
    public function save()
    {
        $validated =  $this->validate();
        $location =  Location::create($validated);
        $user = auth()->user();
        $user->locations()->save($location);
        $this->emit('refreshLocation');

        return back();
    }
}
