<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;

class PickupsTimeline extends Component
{
    protected $listeners = ['refreshPickup'];

    public $tasks ;

    public function mount()
    {
        $this->tasks = auth()->user()->tasks()->whereNull('done_at')->whereMonth('created_at',now()->month)->with(['location'=>fn($q)=>$q->select('id','name')])->orderBY('due_to','desc')->get();
        //dd( $this->tasks );
    }
    public function render()
    {
        return view('livewire.seller.pickups-timeline');
    }
    public function refreshPickup()
    {
        $this->tasks = auth()->user()->tasks()->whereNull('done_at')->whereMonth('created_at',now()->month)->orderBY('due_to','desc')->get();
    }

    public function delete(int $taskId)
    {
        //    dd($locationId);
        auth()->user()->tasks()->where('id', $taskId)->delete();
        $this->refreshPickup();
        toastr()->success('Have fun storming the castle!', 'Miracle Max Says');
    }
}
