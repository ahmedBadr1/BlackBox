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
use LaravelDaily\Invoices\Facades\Invoice;
use Milon\Barcode\DNS1D;

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
       dd($role);
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
        $receipt->total = 1000 ;
        $receipt->user_id = auth()->id() ;
        $receipt->save();
        if (!$input['selectAll']){
           foreach ($input['orders'] as $id){
               $order = Order::find($id);
               $order->receipt()->associate($receipt);
               $order->save();
           }

        }
        dd(  $receipt->orders);
        $receipt->orders()->attach($input['orders']);

        $pendingOrders = auth()->user()->orders()->where('status_id','=',1);

       // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       // echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');
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
        $receipt = Receipt::findOrFail($id);
        $customer = new Buyer([
            'name'          => $receipt->user->name,
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = (new InvoiceItem())->title($receipt->id)->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            // ->logo('https://png.pngtree.com/element_our/png/20180912/coffee-time-png_91570.jpg')
            ->addItem($item);

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
    }
}
