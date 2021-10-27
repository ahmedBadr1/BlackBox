<?php

namespace App\Http\Livewire\Seller;

use App\Models\Area;
use App\Models\Business;
use App\Models\Location;
use App\Models\State;
use Livewire\Component;

class BusinessLocation extends Component
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

    public $location ;

    public $name ;
    public $state_id = 0 ;
    public $area_id ;
    public $street ;
    public $building ;
    public $floor ;
    public $apartment ;
    public $landmarks;
    public $latitude ;
    public $longitude ;

    public function mount(){


        $this->location = auth()->user()->business->location ?? null;
        if (isset( $this->location)){
            $this->name = $this->location->name ;
            $this->state_id = $this->location->state_id ;
            $this->area_id = $this->location->area_id ;
            $this->street = $this->location->street ;
            $this->building = $this->location->building ;
            $this->floor = $this->location->floor ;
            $this->apartment = $this->location->apartment ;
            $this->landmarks = $this->location->landmarks ;
            $this->latitude = $this->location->latitude ;
            $this->longitude = $this->location->longitude ;
        }

        $this->states = State::where('active',true)->select('id','name')->get();
        $state = State::find($this->state_id) ;
        if ($state){
            $this->areas = $state->areas()->where('active',true)->select('areas.id','areas.name')->get() ;
        }else{
            $this->areas = [];
        }

    }
    public function render()
    {

        return view('livewire.seller.business-location');
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
        $user = auth()->user();
        if(isset($user->business->location)){
            $user->business->location()->update($validated);
        }else{
            $location =  Location::create($validated);
            $user->business->location()->save($location);
        }



       // $this->emit('refreshLocation');

        return back();
    }

}
