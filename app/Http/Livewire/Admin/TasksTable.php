<?php

namespace App\Http\Livewire\Admin;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;
use function PHPUnit\Framework\isEmpty;

class TasksTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'due_to';
    public $orderDesc = true;
    public  $startDate   ;
    public $endDate ;
    public $type = 'all' ;
    public array $types = [] ;
    public $date = 'week' ;

    public function mount()
    {
        $this->types = Task::$types;
//        $this->type = $this->types[0];

    }

    public function render()
    {
        $type = ($this->type !== 'all') ? $this->type : '';


        return view('livewire.admin.tasks-table', [
            'tasks' => Task::search($this->search)
                ->date($this->date)
//                ->whereNull('delivery_id')
                ->where(function ($query) {
                    if ($this->type !== 'all') {
                        $query->where('type', $this->type);
                    }
                })
                ->with('user','delivery')
//                ->groupBy('type')
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }

}
