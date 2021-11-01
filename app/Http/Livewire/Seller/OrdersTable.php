<?php

namespace App\Http\Livewire\Seller;

use App\Exports\Seller\SelectedOrdersExport;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Vinkla\Hashids\Facades\Hashids;
use function PHPUnit\Framework\isEmpty;


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
        $this->startDate =  today()->subDays(365)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');

    }

    public function render()
    {
        $user_id =  auth()->user()->id;

        return view('livewire.seller.orders-table', [
            'orders' => Order::searchSeller($this->search,$user_id )
                ->where('user_id', $user_id )
                ->whereDate('created_at','>=',$this->startDate)
                ->WhereDate('created_at','<=',$this->endDate)
                ->with('area','status','state')
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }

    public function export()
    {
        $user_id =  auth()->user()->id;

        $orders = Order::searchSeller($this->search,$user_id )
            ->where('user_id', $user_id )
            ->whereDate('created_at','>=',$this->startDate)
            ->WhereDate('created_at','<=',$this->endDate)
            ->with('area','status','state')
            ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
            ->pluck('id');
      return Excel::download(new SelectedOrdersExport($orders),'Selected Orders.csv');
    }

    public function refreshOrders()
    {
        auth()->user()->refresh();
    }

    public function delete(string $orderHashId)
    {
        $id =    Hashids::Connection(Order::class)->decode(strtolower($orderHashId)) ?? null;

        if(!$id){
            $this->emit('alert',
                ['type' => 'error',  'message' => "Stop fooling around"]);
            return back();
        }

        $order =Order::findOrFail($id[0]);
        $status =  Status::find($order->status_id)->name;
        if (!in_array($order->status->id,[1,2])){
            $this->emit('alert',
                ['type' => 'warning',  'message' => "Order Can't be changed after reaching to ".sys('company_name')]);
            return back();
        }

        auth()->user()->orders()->where('id', $order->id)->delete();
        $this->refreshOrders();
        $this->emit('alert',
            ['type' => 'success',  'message' => 'Order Deleted Successfully!']);
    }
    public function edit(string $orderHashId)
    {
        $id =    Hashids::Connection(Order::class)->decode(strtolower($orderHashId)) ;
        if(!$id){
            $this->emit('alert',
                ['type' => 'error',  'message' =>  "Stop fooling around"]);
            return back();
        }
        $order =Order::findOrFail($id[0]);
        $status =  Status::find($order->status_id)->name;
        if (!in_array($order->status->id,[1,2])){
            $this->emit('alert',
                ['type' => 'warning',  'message' => "Order Can't be changed after reaching to ".sys('company_name')]);
            return back();
        }
        return Redirect::route('orders.create')->with( ['orderHashId' => $orderHashId] );
     //   Redirect::to('orders/create?order_=' . $orderHashId);
    }
}
