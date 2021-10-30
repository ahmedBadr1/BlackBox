<?php

namespace App\Http\Livewire\Seller;

use App\Models\Area;
use App\Models\Location;
use App\Models\State;
use Livewire\Component;

class LocationsCreate extends Component
{
    protected $listeners = ['editLocation' => 'edit' ];

    protected $rules = [
        'name' => 'required' ,
        'state_id' => 'required|numeric' ,
        'area_id' => 'required|numeric' ,
        'street' => 'nullable' ,
        'building' => 'nullable' ,
        'floor' => 'nullable' ,
        'apartment' => 'nullable' ,
        'landmarks' => 'nullable' ,
//        'latitude' => 'required|numeric|between:-90,90',
//        'longitude' => 'required|numeric|between:-180,180',
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
//    public $latitude ;
//    public $longitude ;

    public $location  ;
    public $title = 'create' ;
    public $button = 'create' ;
    public $color = 'success';

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
        $user = auth()->user();
        if ($this->location){
            $this->location->update($validated);
            $this->emit('alert',
                ['type' => 'info',  'message' => 'Location Updated Successfully!']);
        }else{
            $location =  Location::create($validated);
            $user->locations()->save($location);
            $this->emit('alert',
                ['type' => 'success',  'message' => 'Location Created Successfully!']);
    }
        $this->emit('refreshLocation');
        $this->reset(
            'name',
            'state_id' ,
            'area_id',
            'street' ,
            'building' ,
            'floor' ,
            'apartment',
            'landmarks',
//            'latitude' ,
//            'longitude'
        );


        return back();
    }

    public function edit(int $locationId)
    {
       // dd($locationId);
        $this->location = auth()->user()->locations()->where('id', $locationId)->first();

        $this->name = $this->location->name;
        $this->state_id = $this->location->state_id;
        $this->area_id = $this->location->area_id;
        $this->street = $this->location->street;
        $this->building = $this->location->building;
        $this->floor = $this->location->floor;
        $this->apartment = $this->location->apartment;
        $this->landmarks = $this->location->landmarks;
//        $this->latitude = $this->location->latitude;
//        $this->longitude = $this->location->longitude;

        $this->title = 'edit';
        $this->button = 'update';
        $this->color = 'primary';
    }
}
