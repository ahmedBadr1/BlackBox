<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdersExportEn implements FromCollection , ShouldAutoSize ,WithMapping ,WithHeadings,WithEvents
{
 public function map($order): array
 {
     // TODO: Implement map() method.
     return [
         $order->hashid,
         $order->product_name,
         $order->value,
         $order->cust_name,
         $order->cust_num,
         $order->address,
         $order->area->name,
         $order->quantity,
         $order->notes,
         $order->status->name,
        $order->created_at,
     ];
 }

    public function headings():array
    {

        return [
            'Track ID',
            'product_name',
            'Value',
            'Customer_name',
            'Customer_number',
            'Address',
            'Area',
            'Quantity',
            'Notes',
            'Status',
            'Created_at',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return auth()->user()->orders()->get();
    }
    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return [
            AfterSheet::class => function(AfterSheet $event){
            //    $event->sheet->getDelegate()->setRightToLeft(true);
            $event->sheet->getStyle('A1:K1')->applyFromArray(
            [
               'font'=>['bold'=>true]
            ]);
            }
        ];
    }
}
