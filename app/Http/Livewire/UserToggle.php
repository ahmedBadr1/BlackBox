<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserToggle extends Component
{
    public $sid ;
    public $active;
    public function mount( $id,$active){
        $this->sid = $id;
        $this->active = $active;
    }
    public function render()
    {
        return view('livewire.user-toggle');
    }
    public function toggle()
    {
        $user = User::where('id',$this->sid )->first();

        $user->active = !$user->active;
        $this->active = !$this->active;
        $user->update();
        notify()->success(trans($user->name .' is active'));
    }
}
