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
            'product_name'  => $row['product_name'],
            'value'    => $row['value'],
            'cust_name' =>$row['customer_name'],
            'cust_num' =>$row['customer_number'],
            'address' =>$row['address'],
            'area_id' => $area->id ,
            'quantity' =>$row['quantity'],
            'notes' => $row['notes'],
            'status_id'=> 1,
            'user_id'=> $this->id,
            'total'=>  $row['value'] * $row['quantity'],

        ]);

    }
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
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
