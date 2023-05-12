<?php

namespace App\Http\Livewire;

use App\Models\System\State;
use Livewire\Component;

class ToggleState extends Component
{
    public $sid ;
    public $active;
    public function mount( $id,$active){
       $this->sid = $id;
        $this->active = $active;
    }
    public function render()
    {
        return view('livewire.toggle-state');
    }
    public function toggle()
    {
        $state = State::where('id',$this->sid )->first();

        $state->active = !$state->active;
        $this->active = !$this->active;
        $state->update();
        session()->flash('message', $state->name .'is active');

    }

}
