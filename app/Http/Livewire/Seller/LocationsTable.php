<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;

class LocationsTable extends Component
{
    protected $listeners = [ 'refreshLocation' ];
    public $locations;
    protected $user ;
    public function mount ()
    {

        $this->locations =   auth()->user()->locations()->with(['state'=> fn($q)=>$q->select('states.id','states.name'),'area'=> fn($q)=>$q->select('areas.id','areas.name')])->orderBy('updated_at','desc')->get();
    }
    public function render()
    {
        return view('livewire.seller.locations-table');
    }
    public function refreshLocation()
    {
        $this->locations =   auth()->user()->locations()->with(['state'=> fn($q)=>$q->select('id','name'),'area'=> fn($q)=>$q->select('id','name')])->orderBy('updated_at','desc')->get();
    }
    public function delete(int $locationId)
    {
        auth()->user()->locations()->where('id', $locationId)->delete();
        $this->refreshLocation();
        $this->emit('alert',
            ['type' => 'success',  'message' => 'Location Deleted Successfully!']);
    }
    public function edit(int $locationId)
    {
//        auth()->user()->locations()->where('id', $locationId)->delete();
//        $this->refreshLocation();
       // $this->emitTo('LocationsCreate','editLocation',$locationId);
        $this->emit('editLocation',$locationId);
    }
}
