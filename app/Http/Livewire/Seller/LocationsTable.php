<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;

class LocationsTable extends Component
{
    protected $listeners = ['refreshLocation'];
    public $locations;
    protected $user ;
    public function mount ()
    {

        $this->locations =   auth()->user()->locations()->with(['state'=> fn($q)=>$q->select('id','name'),'area'=> fn($q)=>$q->select('id','name')])->get();
    }
    public function render()
    {
        return view('livewire.seller.locations-table');
    }
    public function refreshLocation()
    {
        $this->locations =  auth()->user()->locations()->with(['state'=> fn($q)=>$q->select('id','name'),'area'=> fn($q)=>$q->select('id','name')])->get();
    }
    public function delete(int $locationId)
    {
    //    dd($locationId);
        auth()->user()->locations()->where('id', $locationId)->delete();
        $this->refreshLocation();
    }
}
