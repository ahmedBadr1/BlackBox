<?php

namespace App\Http\Controllers\Main;

use App\Exports\Seller\OrdersExportAr;
use App\Exports\Seller\OrdersExportEn;

use App\Exports\Seller\SelectedOrdersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use App\Imports\OrdersImport;
use App\Jobs\ImportOrdersAdmin;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

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


    public function importOrders(ImportRequest $request)
    {
     //   dd($request->file('import_file'));
    //    ImportOrdersAdmin::dispatch();

        return   Excel::import(new OrdersImport, $request->file('import_file'));

       // return redirect()->back()->with('success', 'All good!');
    }



}
