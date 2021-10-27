<?php

namespace App\Http\Livewire\Seller;

use App\Models\Task;
use Livewire\Component;

class RequestPickup extends Component
{
    protected $rules = [
        'due_to'=>'required|date|after:today',
        'location_id'=>'required',
        'notes' => 'nullable',
    ];
    public $due_to;
    public $location_id ;
    public $notes ;

    public $businessLocation ;
    public $locations ;

    public function mount()
    {
        $this->businessLocation = auth()->user()->business->location()->select('id','name')->first();

        $this->locations = auth()->user()->locations()->select('id','name')->get();

        $this->location_id =  $this->businessLocation->id;

    }


    public function render()
    {
        return view('livewire.seller.request-pickup');
    }
    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        $validated =  $this->validate();
//        if (Task::whereDate('due_to',$this->due_to)->exists() ){
//            dd('no');
//        }
      //  $task =  Task::create($validated);
        auth()->user()->tasks()->create($validated);
      //  dd(auth()->user()->tasks()->get);
      //  $user->locations()->save($location);
        $this->emit('refreshPickup');
        $this->reset('due_to','notes');

        $this->emit('alert',
            ['type' => 'success',  'message' => 'Pickup Requested Successfully!']);
        return back();
    }
}
