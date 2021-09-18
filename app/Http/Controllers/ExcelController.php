<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExportAr;
use App\Exports\OrdersExportEn;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    //
    public function exportOrdersAr()
    {

        return Excel::download(new OrdersExportAr, 'orders.xlsx');
    }

    public function exportOrdersEn()
    {

        return Excel::download(new OrdersExportEn, 'orders.xlsx');
    }
}
