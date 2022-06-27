<?php

namespace App\Http\Livewire\Main;

use App\Models\User;
use App\Notifications\BlockedUserNotification;
use App\Notifications\UnBlockedUserNotification;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ToggleButton extends Component
{
    public Model $model;
    public string $field;
    public bool $isActive;

    public function mount()
    {
        $this->isActive = (bool) $this->model->getAttribute($this->field);
    }
    public function render()
    {
        return view('livewire.main.toggle-button');
    }
    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field,$value)->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => 'info',  'message' => 'Going Well!']);

        if ($this->model instanceof User ){
            if ($value){
                $this->emit('alert',
                    ['type' => 'success',  'message' => 'User Unblocked Successfully!']);
                $this->model->notify(new UnBlockedUserNotification());
            }else {
                $this->emit('alert',
                    ['type' => 'success', 'message' => 'User Blocked Successfully!']);
                $this->model->notify(new BlockedUserNotification());
            }
        }else{
            $this->emit('alert',
                ['type' => 'success',  'message' => 'Updated Successfully!']);
        }
    }
}
