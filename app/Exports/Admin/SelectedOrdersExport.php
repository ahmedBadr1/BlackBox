<?php

namespace App\Exports\Admin;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class SelectedOrdersExport implements FromCollection , ShouldAutoSize ,WithMapping ,WithHeadings,WithEvents
{
    private $orders ;
    public function __construct($selectedOrders)
    {
      //  dd($selectedOrders);
        $this->orders = $selectedOrders;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::with('user','area')->find($this->orders);
    }

    public function map($order): array
    {
            // TODO: Implement map() method.
        return [
            $order->hashid,
            $order->product['name'],
            $order->product['description'],
            $order->product['value'],
            $order->consignee['cust_name'],
            $order->consignee['cust_num'],
            $order->consignee['address'],
            $order->area->name,
            $order->product['quantity'],
            $order->total,
            $order->details['notes'],
            $order->status->name,
            $order->user->name,
            $order->created_at->format('d/m/Y'),
        ];
    }
    public function headings():array
    {

        return [
            'Track ID',
            'product name',
            'description',
            'Value',
            'Customer_name',
            'Customer_number',
            'Address',
            'Area',
            'User',
            'Quantity',
            'Notes',
            'Status',
            'Created_by',
            'Created_at',
        ];
    }
    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return [
            AfterSheet::class => function(AfterSheet $event){
                //    $event->sheet->getDelegate()->setRightToLeft(true);
                $event->sheet->getStyle('A1:M1')->applyFromArray(
                    [
                        'font'=>['bold'=>true]
                    ]);
            }
        ];
    }
}
