<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Receipt;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Facades\Invoice;
use Milon\Barcode\DNS1D;
use PDF;
class ReceiptController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      //  $receipts = auth()->user()->receipts()->where('ready',0);
       $role =  auth()->user()->roles[0]->name;
     //  dd($role);
        $receipts = auth()->user()->receipts()->with('user')->get();

       // dd($receipts);
        return view('admin.receipts.index',compact('receipts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //auth()->user()->orders->where('status_id','>',4)->sortBy('status_id');
        $pendingOrders = auth()->user()->orders()->where('status_id','=',1)->with(['user'=> fn($q)=>$q->select('users.id','users.name'),
            'state'=> fn($q)=>$q->select('states.id','states.name'),
            'area'=> fn($q)=>$q->select('areas.id','areas.name'),
            'status'=> fn($q)=>$q->select('statuses.id','statuses.name'),
            ])->orderBy('id','desc')->get();
       // dd($pendingOrders);
        return view('admin.receipts.generate',compact('pendingOrders'));
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
       $input =  $this->validate($request,[
           'selectAll' =>'required|boolean',
            'orders' =>'required|array',
        ]);
        $receipt = new Receipt;
        $receipt->orders_ids = $input['orders'];
        $receipt->orders_count = count($input['orders']);
        $receipt->total = 0 ;
        $receipt->user_id = auth()->id() ;
        $receipt->save();
        if (!$input['selectAll']){
           foreach ($input['orders'] as $id){
               $order = Order::find($id);
               $order->receipt()->associate($receipt);
               $order->save();
           }
        }
        $receipt->total =   $receipt->orders()->sum('cost');
        $receipt->save();
     //   $receipt->orders()->attach($input['orders']);

        $pendingOrders = auth()->user()->orders()->where('status_id','=',1);

       // dd($request->all());
        return redirect()->route('admin.receipts.index',compact('pendingOrders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receipt = Receipt::findOrFail($id);
      //  dd($receipt);
       // echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');
        return view('admin.receipts.show',compact('receipt'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
      //  dd($id);
      $user=   auth()->user();
        $receipt = Receipt::findOrFail($id);
        $buyer = new Buyer([
            'name'          => $receipt->user->name,
            'phone'          => $receipt->user->phone,
            'address'          => $receipt->user->profile->address,
            'custom_fields' => [
                'email' => $receipt->user->email,
            ],
        ]);
        $seller = new Party([
            'name'          => sys('owner'),
            'phone'         => sys('contact'),
            'address'       => sys('location_id'),
            'custom_fields' => [
                'email' => sys('email'),
            ],
        ]);



         $orders =    Order::find($receipt->orders_ids);
        $items = [];
         //   dd($orders);
            foreach ($orders as $order) {
                $items[] = (new InvoiceItem())->title($order->hashid)->description($order->id)->pricePerUnit($order->cost);
            }

        $logoPath = sys('company_logo')  ? storage_path('app/public/'.sys('company_logo')) :  url('/assets/img/brand/logo-black.png' )  ;

        $invoice = Invoice::make()
            ->template('custom')
            ->sequence($receipt->id)
            ->buyer($buyer)
            ->seller($seller)
          //  ->discountByPercent(10)
            ->taxRate(14)
            ->shipping(20)
            ->totalAmount($receipt->total)
            ->logo($logoPath)
            ->addItems($items);

        if(app()->getLocale() == "ar"){
            //   toastr()->error('can\'t print arabic charachters');
            $pdf = PDF::chunkLoadView('<html-separator/>', 'vendor.invoices.templates.default',['invoice'=> $invoice]);
            return $pdf->stream('arabic.pdf');
        }
        return $invoice->stream();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        abort(403);
    }
}
