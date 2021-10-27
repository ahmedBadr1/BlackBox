<?php

namespace App\Http\Controllers\Admin;

use App\Exports\admin\OrdersExportAr;
use App\Exports\Admin\OrdersExportEn;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use App\Imports\OrdersImport;
use App\Models\Area;
use App\Models\Order;
use App\Models\Packing;
use App\Models\Plan;
use App\Models\Status;

use App\Models\User;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;


use Spatie\Activitylog\Models\Activity;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF ;



class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Feedback');
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
       // $orders = Order::with('user','area','status','state')->orderBy('updated_at','DESC')->paginate(100);

//        $avOrders = auth()->user()->zone[0]->areas;
//        dd($avOrders);
//        $orders = Order::orderBy('created_at','DESC')->paginate(20);
        return view('admin.orders.index');
    }
    public function track(Request $request ){
        // dd($request);
        $order_hashid ='';
        if ($request->query('order_id') !== null){
            $order_hashid = $request->query('order_id');
        }
        $user =  \auth()->user();
        $status= null;
        $orderLogs=  null;
        return view('admin.track',compact('user','order_hashid','status','orderLogs'));
    }

    public function  trackgo(Request $request)
    {
        //  dd($request['order_id']);
        $order_hashid =  $request['order_id'];
        $id =    Hashids::Connection(Order::class)->decode(strtolower($order_hashid)) ?? [0];

        if($id){
            $order =Order::findOrFail($id[0]);
            $status =  Status::find($order->status_id)->name;
            $orderLogs  = Activity::inLog('Order')->where('subject_id',$id)->select('causer_id','description','properties','updated_at')->get();
          //  dd($orderLogs);

        }else{
            $status =  null;
            $orderLogs=  null;

        }
//foreach ($orderLogs as $log){
//  ///  dd($log->properties['attributes']);
//    foreach ($log->properties['attributes'] as $prop){
//        dd($prop);
//    }
//}
//        if (auth()->user()->id !== $order->user->id){
//            abort(404);
//        }


        return view('admin.track',compact('status','order_hashid','orderLogs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        //
     //   $states= State::where('active',true)->get();

//        $types = ['cosmetics','clothes','document','furniture','machines','other'];
//        $areas = Area::where('active',1)->whereHas('state',fn($q)=>$q->where('active','1'))->select('id','name')->orderBy('id','desc')->get();
//        $sellers = User::with('plan')->whereHas("roles", function($q){ $q->where("name" ,'seller'); })->get();

      //  $areas = Area::with('state')->select('id','name')->orderBy('id','desc')->get();
      //  dd($areas);

      //  $order = Order::first();

     //   Notification::send( auth()->user(), new DoneNotification($order));
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \auth()->user();
            dd($user);
        dd($request->all());
        $this->validate($request,[
            'product_name' =>'required',
            'value'=>'nullable|numeric|gt:0',
            'cust_name'=>'required',
            'cust_num'=>'required',
            'address'=>'required',
            'area_id'=>'required|numeric',
            'package_type' => 'nullable',
            'package_weight'=>'nullable|numeric',
            'deliver_before' =>'nullable|date', //  'deliver_before' =>'nullable|date|after:today',
            'quantity'=>'nullable|numeric',
            'cod'=> 'required|boolean',
            'notes'=>'nullable',
            'user_id' => 'nullable'
        ]);
        $input = $request->all();
       // auth()->user()->plan->name;
        // dd($input);

        if (isset($input['value'])){
            $orderArea = Area::where('id',$input['area_id'])->select('id','delivery_cost','over_weight_cost')->first();
            if($user->plan->id !== Plan::first()->id){
                $orderArea->delivery_cost = $user->plan->area[$input['area_id']] ?? $orderArea->delivery_cost ;
            }
            $input['status_id'] = Status::all()->first()->id;
            if (!$input['user_id']){
                $input['user_id'] = $user->id;
            }
    //        $input['total'] = $input['value'] * $input['quantity'] ;
            //       dd(System('package_weight_limit'));
            if(!$input['cod']){
                $input['total'] = ($input['value'] * $input['quantity'] )  - $orderArea->delivery_cost ?? 0;
               // dd($input['total']);
                if($input['package_weight'] > sys('package_weight_limit')){
                    $input['total'] = ($input['value'] -
                            ( $orderArea->delivery_cost + (
                                    ($input['package_weight'] - sys('package_weight_limit')
                                    ) * $orderArea->over_weight_cost )
                            )
                        ) * $input['quantity']  ?? 0;
                }
            }elseif($input['package_weight'] > sys('package_weight_limit')){

                $over = ($input['package_weight'] - sys('package_weight_limit')) * $orderArea->over_weight_cost ;
                $input['total'] = ($input['value'] -  $over) * $input['quantity']  ?? 0;
            }else{

                $input['total'] = $input['value'] * $input['quantity'] ;
            }
        }

     //   dd($input['total']);
        Order::create($input);

        toastr()->success('Order Created Successfully');

        return redirect()->route('admin.orders.index');
    }


    public function import(ImportRequest $request)
    {

        Excel::import(new OrdersImport(), $request->file('import_file'));

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return
     */
    public function show(Order $order)
    {

        return view('admin.orders.show',compact('order'));
    }
    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return
     */
    public function print(Order $order)
    {
//
    $client = new Party([
        'name'          => $order->consignee['cust_name'],
        'phone'         =>  $order->consignee['cust_num'],
        'address'         => $order->consignee['address'],
        'custom_fields' => [
            'area'        => $order->area->name,
        ],
    ]);

        $customer = new Party([
            'name'          => $order->user->name,
            'phone'         => $order->user->phone,
            'address'       => $order->user->profile->address,
            'custom_fields' => [
                'email' =>$order->user->email,
            ],
        ]);;

        $item = (new InvoiceItem())->title($order->product['name'])
            ->pricePerUnit($order->product['value'])
            ->quantity($order->product['quantity'])
            ->description($order->product['description'] ?? '');
       $shipping =  $order->cost ;
       // dd($shipping);
        if(!$order->details['cod']){
            $shipping = number_format(0);
        }
      //  dd($shipping);

//        $notes = [
//            'your multiline',
//            'additional notes',
//            'in regards of delivery or something else',
//        ];
//        $notes = implode("<br>", $notes);

        $logoPath =  storage_path('app/public/'.sys('company_logo'))   ?? '';


        $invoice = Invoice::make()
           // ->sequence($order->hashid)
            ->buyer($client)
            ->seller($customer)
            ->addItem($item)
            ->shipping($shipping)
            ->logo($logoPath)
            ->date($order->created_at)
            ->filename('order_'.$order->hashid)
            ->payUntilDays(14) ;
          //  ->subTotalPrice($order->sub_total)
          //  ->discountByPercent(10)
          // ->totalAmount(number_format($order->total))

//        $serial =  $invoice->getSerialNumber() ;
//        dd($serial);
//            ->currencySymbol('L.E')
//            ->currencyCode('EGP')
//            ->discountByPercent(10)
//            ->taxRate(14)
//            ->totalTaxes($order->tax)
//            ->series('fb')
//            ->sequence(88)


//dd($invoice);
//   //     return view('vendor.invoices.templates.default',compact('invoice'));
//        return $invoice->stream();

       // $pdf = PDF::chunkLoadView('pdf.document', $data);
      //  ini_set("pcre.backtrack_limit", "1000000");
    //    $pdf = PDF::chunkLoadView('<html-separator/>', 'vendor.invoices.templates.default',['invoice'=> $invoice]);
        if(app()->getLocale() == "ar"){
         //   toastr()->error('can\'t print arabic charachters');
            $pdf = PDF::chunkLoadView('<html-separator/>', 'vendor.invoices.templates.default',['invoice'=> $invoice]);
            return $pdf->stream('arabic.pdf');
        }

        return $invoice->download($order->hashid.'.pdf');
    }
    public function pdf(Order $order)
    {
//
//        $data = User::take(10)->get();
//////
//////
////        $pdf = PDF::loadView('vendor.invoices.templates.invoice',['data'=>$data]);
////
////       // $pdf->SetDirectionality('rtl');
////
////
////        return $pdf->stream('invoice.pdf');
//
//        $html = view('vendor.invoices.templates.invoice',['data'=>$data])->render(); // file render
//// or pure html
//        $html = '<h1>مرحبا بكم فى العالم </h1>';
//        $pdfarr = [
//            'title'=>'اهلا بكم ',
//            'data'=>$html, // render file blade with content html
//            'header'=>['show'=>false], // header content
//            'footer'=>['show'=>false], // Footer content
//            'font'=>'aealarabiya', //  dejavusans, aefurat ,aealarabiya ,times
//            'font-size'=>12, // font-size
//            'text'=>'', //Write
//            'rtl'=>true, //true or false
//            'creator'=>'phpanonymous', // creator file - you can remove this key
//            'keywords'=>'phpanonymous keywords', // keywords file - you can remove this key
//            'subject'=>'phpanonymous subject', // subject file - you can remove this key
//            'filename'=>'phpanonymous.pdf', // filename example - invoice.pdf
//            'display'=>'print', // stream , download , print
//        ];
//
//        PDF::HTML($pdfarr);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param\App\Models\Order  $order
     * @return
     */
    public function edit(Order $order)
    {

            if (auth()->id() !== $order->user_id){
                toastr()->warning('You cant change this order ');
                return redirect()->back();
            }

        if (!in_array($order->status->id,[1,2])){
            toastr()->warning("Order Can't be changed after reaching to Bagy");
            return redirect()->route('admin.orders.index');
        }

        $areas = Area::where('active',1)->whereHas('state',fn($q)=>$q->where('active','1'))->select('id','name')->orderBy('id','desc')->get();
       // $states= State::where('active',true)->get();

        return view('admin.orders.edit',compact('order','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return
     */
    public function update(Request $request, Order $order)
    {

        $this->validate($request,[
            'product_name' =>'required',
            'value'=>'nullable|numeric|gt:0',
            'cust_name'=>'required',
            'cust_num'=>'required',
            'address'=>'required',
            'area_id'=>'required|numeric',
            'package_type' => 'nullable',
            'package_weight'=>'nullable|numeric',
            'deliver_before' =>'nullable|date', //  'deliver_before' =>'nullable|date|after:today',
            'quantity'=>'nullable|numeric',
            'cod'=> 'required|boolean',
            'notes'=>'nullable',
            'user_id' => 'nullable'
        ]);
        $input = $request->all();

        if (isset($input['value'])){

            $orderArea = Area::where('id',$input['area_id'])->select('id','delivery_cost','over_weight_cost')->first();

            if($user->plan->id !== Plan::first()->id){
                $orderArea->delivery_cost = $user->plan->area[$input['area_id']] ?? $orderArea->delivery_cost ;

            }

            //  dd($orderArea->delivery_cost . 'after');
            $input['status_id'] = Status::all()->first()->id;

            if (!$input['user_id']){
                $input['user_id'] = $user->id;
            }

            //        $input['total'] = $input['value'] * $input['quantity'] ;
            //       dd(sys('package_weight_limit'));

            if(!$input['cod']){
                $input['total'] = ($input['value'] * $input['quantity'] )  - $orderArea->delivery_cost ?? 0;

                // dd($input['total']);
                if($input['package_weight'] > sys('package_weight_limit')){
                    $input['total'] = ($input['value'] -
                            ( $orderArea->delivery_cost + (
                                    ($input['package_weight'] - sys('package_weight_limit')
                                    ) * $orderArea->over_weight_cost )
                            )
                        ) * $input['quantity']  ?? 0;
                }
            }elseif($input['package_weight'] > sys('package_weight_limit')){

                $over = ($input['package_weight'] - sys('package_weight_limit')) * $orderArea->over_weight_cost ;
                $input['total'] = ($input['value'] -  $over) * $input['quantity']  ?? 0;
            }else{

                $input['total'] = $input['value'] * $input['quantity'] ;
            }

        }


        dd($input['total']);

        $order->update($input);
        toastr()->success('Order Updated Successfully');
        return redirect()->route('admin.orders.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     *@param  \App\Models\Order  $order
     * @return
     */
    public function destroy(Order $order)
    {


        if (auth()->id() !== $order->user_id){
            toastr()->warning('You cant Delete this order');
            return redirect()->back()->with('You cant Delete this order');
        }

        $order->delete();
        toastr()->success('Order Deleted Successfully');
        return redirect()->route('admin.orders.index');
    }
    public function trash(){
        $orders = Order::onlyTrashed()->with('user')->paginate(25);
        return view('admin.orders.trash',compact('orders'));
    }
    /**
     * Restore the specified resource from trash.
     *
     *
     * @return
     */
    public function restore( $id){

        $oid= Hashids::connection(Order::class)->decode($id) ?? [0];
        if(!$oid){
            abort(404);
        }

        $order = Order::onlyTrashed()->findOrFail($oid[0]);

        if (!$order->trashed()){

            toastr()->error('Order isn\'t in trash');
           return redirect()->back();
        }

        $order->restore();
        toastr()->success('Order Restored Successfully');
        return redirect()->route('admin.orders.trash');
    }

    public function packing(){
        $packing = Packing::all();
        return view('admin.orders.packing',compact('packing'));
    }

    public function adminExportOrdersAr()
    {

        return Excel::download(new OrdersExportAr, 'orders.xlsx');
    }

    public function adminExportOrdersEn()
    {
        return Excel::download(new OrdersExportEn, 'orders.xlsx');
    }
}
