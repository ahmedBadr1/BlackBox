<?php

namespace App\Exports\Seller;

use App\Models\Order;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdersExportAr implements FromCollection , ShouldAutoSize ,WithMapping ,WithHeadings,WithEvents
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
        $order->created_at->format('d/m/Y'),
     ];
 }

    public function headings():array
    {

        return [
            'رقم التتبع',
            'إسم المنتج',
            'قيمة المنتج',
            'إسم العميل',
            'رقم العميل',
            'العنوان',
            'المنطقة',
            'الكمية',
            'الملاحظات',
            'الحالة',
            'تاريخ الإنشاء',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return auth()->user()->orders()->with(['area' => fn($q)=>$q->select('id','name')]);
    }
    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return [
            AfterSheet::class => function(AfterSheet $event){
                $event->sheet->getDelegate()->setRightToLeft(true);
            $event->sheet->getStyle('A1:K1')->applyFromArray(
            [
               'font'=>['bold'=>true]
            ]);
            }
        ];
    }
}
