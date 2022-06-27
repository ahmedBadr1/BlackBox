<?php

namespace App\Exports\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdersExportAr implements FromQuery , ShouldAutoSize ,WithMapping ,WithHeadings,WithEvents
{
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
         $order->cost,
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
            'رقم التتبع',
            'إسم المنتج',
            'وصف المنتج',
            'قيمة المنتج',
            'إسم العميل',
            'رقم العميل',
            'العنوان',
            'المنطقة',
            'الكمية',
            'تكلفة الشحن',
            'الإجمالي',
            'الملاحظات',
            'الحالة',
            'إسم التاجر',
            'تاريخ الإنشاء',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Order::with(['area' => fn($q)=>$q->select('id','name'),'user' => fn($q)=>$q->select('id','name'),'status' => fn($q)=>$q->select('id','name')]);
    }
    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return [
            AfterSheet::class => function(AfterSheet $event){
                $event->sheet->getDelegate()->setRightToLeft(true);
            $event->sheet->getStyle('A1:M1')->applyFromArray(
            [
               'font'=>['bold'=>true]
            ]);
            }
        ];
    }
}
