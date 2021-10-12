<?php

namespace App\Http\Livewire\Main;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ModelTable extends Component
{
    public Model $model;
    public  $models;
    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.main.model-table');
    }
    /**
     * Write code on Method
     *
     * @return response
     */
    public function alertInfo()
    {
        $this->dispatchBrowserEvent('alert',
            ['type' => 'info',  'message' => 'Going Well!']);
    }
}
