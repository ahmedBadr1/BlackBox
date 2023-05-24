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
    public $type = 'all'  ;
    public array $types = [] ;
    public $date = 'week' ;

    public function mount()
    {
        $this->types = Task::$types;

    }

    public function render()
    {
        $query =    Task::search($this->search);
        $query->date($this->date) ;
//                ->whereNull('delivery_id')
        if ($this->type !== 'all')  $query->where('type', $this->type);
            $tasks = $query->with('user','delivery')->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
            ->paginate($this->perPage);

        return view('livewire.admin.tasks-table', [
            'tasks' => $tasks
        ]);
    }

}
