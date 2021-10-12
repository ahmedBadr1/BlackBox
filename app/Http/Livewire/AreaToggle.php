<?php

namespace App\Http\Livewire;

use App\Models\Area;
use Livewire\Component;

class AreaToggle extends Component
{
    public $sid ;
    public $active;
    public function mount( $id,$active){
        $this->sid = $id;
        $this->active = $active;
    }
    public function render()
    {
        return view('livewire.area-toggle');
    }
    public function toggle()
    {
        $area = Area::where('id',$this->sid )->first();

        $area->active = !$area->active;
        $this->active = !$this->active;
        $area->update();
        notify()->success(trans($area->name .' is active'));
    }
}
