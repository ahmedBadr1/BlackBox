<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

class Profile extends Component
{
    public function mount()
    {
        $this->isActive = (bool) $this->model->getAttribute($this->field);
    }
    public function render()
    {
        return view('livewire.main.profile');
    }
    public function update()
    {

    }
}
