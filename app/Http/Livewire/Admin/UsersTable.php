<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UsersTable extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        return view('livewire.admin.users-table', [
            'users' => User::search($this->search)
                ->with('roles','branch')
                ->whereHas("roles", function($q){ $q->whereNotIn("name", ["seller"]); })
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }
//    public function search()
//    {
//        $this->users = QueryBuilder::for(User::class)
//            ->with('roles','state','branch')
//            ->whereHas("roles", function($q){ $q->whereNotIn("name", ["seller"]); })
//            ->allowedFilters(['name','email',AllowedFilter::exact('id')])
//            ->orderBy('id','DESC')
//            ->paginate(10);
//
//    }
//    public function sort()
//    {
//        $this->users = User::with('roles','state','branch')
//            ->whereHas("roles", function($q){ $q->whereNotIn("name", ["seller"])->orderBy('id');})
//            ->orderBy($this->orderBy,$this->orderAsc ? 'asc' : 'desc')
//            ->simplePaginate($this->perPage);
//
//
//        $this->users= User::with('roles','state','branch')
//            ->whereHas("roles", function($q){ $q->whereNotIn("name", ["seller"]); })
//            ->orderBy($this->orderBy,$this->orderAsc ? 'asc' : 'desc')
//            ->simplePaginate($this->perPage);
//    }
}
