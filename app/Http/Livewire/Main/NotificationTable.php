<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

class NotificationTable extends Component
{
    public $notifications ;

    public function mount($notifications)
    {
        $this->notifications = $notifications ;
    }
    public function render()
    {

        return view('livewire.main.notification-table');
    }

}
