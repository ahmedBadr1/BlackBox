<?php

namespace App\Http\Livewire\Main;

use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class MarkAsRead extends Component
{
    public  $notification ;
    public $value = 'mark-as-read';
    public function mount($notification)
    {
        $this->notification = $notification;
    }
    public function render()
    {
        return view('livewire.main.mark-as-read');
    }

    public function mark()
    {
        if (!$this->notification->read_at){
            $this->notification->markAsRead();
            $this->value = 'read';
        }

    }
}
