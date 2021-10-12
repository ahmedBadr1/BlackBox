<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Facades\Invoice;
use Spatie\Activitylog\Models\Activity;

class FinancialController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:financial');
    }

    public function index(){

    $availabeOrders = Order::whereIn('status_id',range(3,9))->with('area')->select('total','area_id','delivery_id')->get();

        $revenues = 0;
        foreach($availabeOrders as $order){
            $revenues +=    $order->area->delivery_cost;
        }
     $deliveryOrders  = Order::has('delivery')->select('total');
     $outWithDelivery = $deliveryOrders->sum('total');
     $shipperBalance = $availabeOrders->sum('total');
//dd($revenues);
    $collected = $shipperBalance + $revenues;
//    $shipperBalance = $collected - $costs;

        $deliveriesWithCash = User::with('custody')->withCount('custody')->whereHas("roles", function($q){ $q->where("name" ,'delivery'); })->get();

        $managersWithCash = User::with('orders')->withCount('orders')->whereHas("roles", function($q){ $q->where("name" ,'manager'); })->get();

        $shippersWithBalance = User::with('orders')->withCount('orders')->whereHas("roles", function($q){ $q->where("name" ,'seller'); })->get();

//        foreach ($deliveriesWithCash as $delivery){
//            dd($delivery->orders->sum('total') );
//        }
     //   dd($deliveriesWithCash);

        //$areas = Area::withCount('orders')->orderBy('orders_count')->get();
    return view('admin.financial.index',compact(
        'outWithDelivery',
        'collected',
        'revenues',
        'shipperBalance',
        'deliveriesWithCash',
        'shippersWithBalance'
    ));
    }
    public function invoice()
    {
        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
           // ->logo('https://png.pngtree.com/element_our/png/20180912/coffee-time-png_91570.jpg')
            ->addItem($item);

        return $invoice->stream();
    }
}
