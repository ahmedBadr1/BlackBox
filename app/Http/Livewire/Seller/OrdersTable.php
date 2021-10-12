<?php

namespace App\Http\Livewire\Seller;

use App\Exports\OrdersExport;
use App\Exports\OrdersExportEn;
use App\Jobs\ImportOrdersAdmin;
use App\Models\Order;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Vinkla\Hashids\Facades\Hashids;

class OrdersTable extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderDesc = true;
    public  $startDate   ;
    public $endDate ;
    public $user_id ;

    public function mount()
    {
        $this->startDate =  today()->subDays(365);
        $this->endDate = now() ;
    }

    public function render()
    {
        $this->user_id =  auth()->user()->id;

        return view('livewire.seller.orders-table', [
            'orders' => Order::searchSeller($this->search,$this->user_id )
                ->where('user_id', $this->user_id )
                ->whereDate('created_at','>=',$this->startDate)
                ->WhereDate('created_at','<=',$this->endDate)
                ->with('area','status','state')
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }

    public function export()
    {
        $orders = Order::searchSeller($this->search,$this->user_id )
            ->where('user_id', $this->user_id )
            ->whereDate('created_at','>=',$this->startDate)
            ->WhereDate('created_at','<=',$this->endDate)
            ->with('area','status','state')
            ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
            ->pluck('id');
      return Excel::download(new OrdersExport($orders),'selectedOrders.csv');
    }
}
