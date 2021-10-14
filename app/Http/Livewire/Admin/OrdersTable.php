<?php

namespace App\Http\Livewire\Admin;

use App\Exports\Admin\SelectedOrdersExport;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class OrdersTable extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderDesc = true;
    public  $startDate   ;
    public $endDate ;

    public function mount()
    {
        $this->startDate =  today()->subDays(365);
        $this->endDate = now() ;
    }

    public function render()
    {
        return view('livewire.admin.orders-table', [
            'orders' => Order::search($this->search)
                ->whereDate('created_at','>=',$this->startDate)
                ->WhereDate('created_at','<=',$this->endDate)
               ->with('user','area','status','state')
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }

    public function export()
    {
        $orders = Order::search($this->search)
            ->whereDate('created_at','>=',$this->startDate)
            ->WhereDate('created_at','<=',$this->endDate)
            ->with('user','area','status','state')
            ->orderBy($this->orderBy, $this->orderDesc ?  'desc' : 'asc')
            ->pluck('id');
       return Excel::download(new SelectedOrdersExport($orders),'selected orders.csv');
    }


}
