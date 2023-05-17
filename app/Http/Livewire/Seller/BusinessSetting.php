<?php

namespace App\Http\Livewire\Seller;

use App\Models\Business;
use App\Models\System\Location;
use App\Models\System\State;
use Livewire\Component;

class BusinessSetting extends Component
{
    protected $rules =[
        'name' => 'required',
        "contact" => "required",
        "industry" => "required",
        "channel" => "required",
        "url" => "required|url",

        'location_name' => 'required' ,
        'state_id' => 'required|exists:states,id' ,
        'area_id' => 'required|exists:areas,id' ,
        'street' => 'nullable' ,
        'building' => 'nullable' ,
        'floor' => 'nullable' ,
        'apartment' => 'nullable' ,
        'landmarks' => 'nullable' ,
//        'latitude' => 'required|numeric|between:-90,90',
//        'longitude' => 'required|numeric|between:-180,180',
    ];
    public $industries;
    public $channels ;
    public $business;

    public $name;
    public $contact;
    public $industry;
    public $channel;
    public $url;

    public $states ;
    public $areas ;

    public $location ;

    public $location_name ;
    public $state_id = 0 ;
    public $area_id ;
    public $street ;
    public $building ;
    public $floor ;
    public $apartment ;
    public $landmarks;
//    public $latitude ;
//    public $longitude ;

    public function mount()
    {
        $user = \auth()->user();
        $this->industries = Business::$industries ;
        $this->channels = Business::$channels;
        $this->business = $user->business ?? null;

        if ( $this->business){
            $this->name    =  $this->business->name;
            $this->contact    =  $this->business->contact;
            $this->industry    =  $this->business->industry;
            $this->channel    =  $this->business->channel;
            $this->url    =  $this->business->url;
        }

        $this->location = $this->business->location ?? null;
        if (isset( $this->location)){
            $this->location_name = $this->location->name ;
            $this->state_id = $this->location->state_id ;
            $this->area_id = $this->location->area_id ;
            $this->street = $this->location->street ;
            $this->building = $this->location->building ;
            $this->floor = $this->location->floor ;
            $this->apartment = $this->location->apartment ;
            $this->landmarks = $this->location->landmarks ;
//            $this->latitude = $this->location->latitude ;
//            $this->longitude = $this->location->longitude ;
        }

        $this->states = State::select(['id','name'])->get();
        $state = State::find($this->state_id) ;
        if ($state){
            $this->areas = $state->areas()->where('active',true)->select('areas.id','areas.name')->get() ;
        }else{
            $this->areas = [];
        }
    }
    public function render()
    {
        return view('livewire.seller.business-setting');
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
        $user = \auth()->user();
        $bData = [
            'name' => $validated['name'],
            'contact' => $validated['contact'],
            'industry' => $validated['industry'],
            'channel' => $validated['channel'],
            'url' => $validated['url'],

        ];
        if(isset($user->business)){
            $user->business->update($bData) ;
        }else{
            $business = Business::create($bData);
            $user->business()->associate($business)->save();
        }

        $lData = [
            'name' => $validated['location_name'],
//            'state_id' => $validated['state_id'],
            'area_id' => $validated['area_id'],
            'street' => $validated['street'],
            'building' => $validated['building'],
            'floor' => $validated['floor'],
            'apartment' => $validated['apartment'],
            'landmarks' => $validated['landmarks'],
//            'locationable_type' => 'App\Models\User',
//            'locationable_id' => auth()->id(),

//            'latitude' => $validated['latitude'],
//            'longitude' => $validated['longitude'],

        ];

        if(isset($user->business->location)){
            $user->business->location()->update($lData);
        }else{
//            $location =  Location::create($lData);
            $user->business->location()->create($lData);
        }
        $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'Setting Created Successfully!']);

        return back();
    }
}
