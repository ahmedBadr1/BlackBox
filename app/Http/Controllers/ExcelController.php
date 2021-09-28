<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExportAr;
use App\Exports\OrdersExportEn;
use App\Imports\OrdersImport;
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

    public function importOrders(Request $request)
    {
       // dd( $request->file('import_file'));

        Excel::import(new OrdersImport, $request->file('import_file'));

        return redirect()->back()->with('success', 'All good!');
    }
}
