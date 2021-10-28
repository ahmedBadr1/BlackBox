<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\SellerController;
use App\Models\Area;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;
use Vinkla\Hashids\Facades\Hashids;

class OrdersController extends Controller
{
    public function __construct()
    {
           $this->middleware('role:seller');
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
      //  $orders = auth()->user()->orders()->with('user','area','state','status')->orderBy('updated_at','DESC')->simplePaginate(25);
        return view('seller.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create(Request $request)
    {
   //     dd($request['order_']);
        //
        //   $states= State::where('active',true)->get();

        if (Session::get('orderHashId')){
            $id =    Hashids::Connection(Order::class)->decode(strtolower(Session::get('orderHashId'))) ?? null;
            if(!$id){
             toastError('order not found');
                $order = null;
                return view('seller.orders.create',compact('order'));
            }
            $order =Order::findOrFail($id[0]);
        }else{
            $order = null;
        }

        return view('seller.orders.create',compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $this->validate($request,[
            'product_name' =>'required',
            'value'=>'required|numeric',
            'cust_name'=>'required',
            'cust_num'=>'required|numeric',
            'address'=>'required',
            'area_id'=>'required|numeric',
            'quantity'=>'required|numeric',
            'notes'=>'',

        ]);
        $input = $request->all();
        $input['status_id'] = Status::all()->first()->id;
        $input['user_id'] =auth()->id();
        $input['total'] = $input['value'] * $input['quantity'] ?? 0;
        Order::create($input);

        toastr()->success('Order Created Successfully');
        return redirect()->route('seller.orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return
     */
    public function show(Order $order)
    {
            if (auth()->id() !== $order->user_id){
                abort(404);
            }
            $user = auth()->user();
        return view('seller.orders.show',compact('order','user'));
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

        $logoPath = sys('company_logo')  ? storage_path('app/public/'.sys('company_logo')) :  url('/assets/img/brand/logo-black.png' )  ;


        $invoice = Invoice::make()
            // ->sequence($order->hashid)
            ->buyer($client)
            ->seller($customer)
            ->addItem($item)
            ->shipping($shipping)
          ///  ->logo($logoPath)
            ->date($order->created_at)
            ->filename('order_'.$order->hashid)
            ->payUntilDays(14) ;




        if(app()->getLocale() == "ar"){
            //   toastr()->error('can\'t print arabic charachters');
            $pdf = PDF::chunkLoadView('<html-separator/>', 'vendor.invoices.templates.default',['invoice'=> $invoice]);
            return $pdf->stream('arabic.pdf');
        }

        return $invoice->download($order->hashid.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param\App\Models\Order  $order
     * @return
     */
    public function edit(Order $order)
    {
        if (!auth()->user()->hasRole('Feedback')){
            if (auth()->id() !== $order->user_id){
                abort(404);
            }
        }

        if (!in_array($order->status->id,[1,2])){
            toastr()->warning("Order Can't be changed after reaching to ".sys('company_name'));
            return back();
        }

        // $states= State::where('active',true)->get();
        $areas = Area::all();
        return view('seller.orders.edit',compact('order','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        $this->validate($request,[
            'product_name' =>'required',
            'value'=>'required|numeric',
            'cust_name'=>'required',
            'cust_num'=>'required|numeric',
            'address'=>'required',
            'area_id'=>'required|numeric',
            'quantity'=>'required|numeric',
            'notes'=>'',
        ]);
        $input = $request->all();
        $order->update($input);
        toastr()->success('Order Updated Successfully');
        return redirect()->route('seller.orders.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return
     */
    public function destroy(Order $order)
    {
        if (auth()->id() !== $order->user_id){
            abort(404);
        }
        if (!in_array($order->status_id,[1,2,10]) ){
            toastr()->warning("Order Can't be deleted after reaching to ".sys('company_name'));
         return back();
        }

        $order->delete();
        toastr()->success('Order Deleted Successfully');
        return redirect()->route('orders.index');
    }
    public function trash(){
        $orders = auth()->user()->onlyTrashed()->paginate(25);
        return view('seller.orders.trash',compact('orders'));
    }

    public function mytrash()
    {
        if(Gate::allows('feature','trash')){
            $orders = auth()->user()->orders()->onlyTrashed()->paginate(25);
        }else{
            abort('403');
        }
        //   dd($orders);
        return view('seller.orders.trash',compact('orders'));
    }

}
