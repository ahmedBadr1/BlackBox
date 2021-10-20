<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class OrdersImport implements ToModel ,WithHeadingRow ,WithBatchInserts ,WithCustomChunkSize, SkipsOnError
{
    use Importable;

    private $areas;
    private $id;
    public function __construct()
    {
        $this->id = auth()->user()->id;
        $this->areas = Area::select('id','name')->get();
    }


    public function model(array $row)
    {
//        dd($this->areas);
   //     dd($row);
        $area = $this->areas->where('name',$row['area'])->first();
//dd($area->id);
        return new Order([
            'product'=> [
                'name' => $row['product_name'],
                'description' =>$row['description'],
                'value' => $row['value'],
                'quantity' => $row['quantity'],
            ],
            'consignee' => [
                'cust_name' => $row['customer_name'],
                'cust_num' => $row['customer_number'],
                'address' => $row['address'],
            ],
            'details' => [
                'package_type' => $row['package_type'] ?? null,
                'package_weight' => $row['package_weight']?? null,
                'deliver_before' => $row['deliver_before']?? null,
                'cod' =>$row['cod']?? null,
                'notes' => $row['notes']?? null,
            ],

            'area_id' => $area->id ,
            'user_id'=> $this->id,
            'status_id' => 1,
            'cost' => $row['cost'] ?? null,
            'sub_total' => $row['sub_total'] ?? 0,
            'tax' => $row['tax'] ?? 0,
            'discount' => $row['discount']?? 0,
            'total' => $row['total']?? $row['value'] * $row['quantity'],
        ]);

    }
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
     //   notify()->error('somrthing went wrong please try again later','oops');
       throw($e);
    }
    public function chunkSize(): int
    {
        return 5000;
    }
    public function batchSize(): int
    {
        return 1000;
    }
}
