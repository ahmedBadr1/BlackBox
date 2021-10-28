<?php

namespace App\Http\Livewire\Seller;

use App\Models\Area;
use App\Models\Order;
use App\Models\Packing;
use App\Models\Plan;
use App\Models\User;
use Livewire\Component;

class OrderCreate extends Component
{
    protected $rules = [
        'product_name' =>'required',
        'value'=>'nullable|numeric|min:0|max:5000',
        'cust_name'=>'required',
        'cust_num'=>'required',
        'address'=>'required',
        'area_id'=>'required|numeric',
        'package_type' => 'nullable',
        'packing'=> 'nullable|numeric',
        'package_weight'=>'nullable|numeric|min:0|max:100',
        'deliver_before' =>'nullable|date', //  'deliver_before' =>'nullable|date|after:today',
        'quantity'=>'nullable|numeric|min:0|max:1000',
        'cod'=> 'required|boolean',
        'notes'=>'nullable',
    ];

    public $types;
    public $areas;
    public $sellers;
    public $product_name ;
    public $product_description ;
    public $cust_name ;
    public $cust_num ;
    public $package_type ;
    public $deliver_before ;
    public $notes ;
    public $address ;
    public $cod = 1 ;
    public  $quantity = 1 ;
    public  $value = 0 ;
    public $packing_type;
    public $packing = 0 ;
    public  $delivery_cost = 0 ;
    public $packing_cost = 0 ;
    public  $package_weight = 0 ;
    public $weight = 0;
    public $overWeight = 0 ;
    public  $overWeightCost = 0 ;
    public $area_id ;
    public $systemLimit;
    private $basicId;

    public $cost =0 ;
    public  $subTotal = 0 ;
    public  $discount = 0 ;
    public  $tax = 0 ;
    public  $total = 0 ;

    public  $order ;
    public $title = 'create' ;
    public $button = 'create' ;
    public $color = 'success';

    public function mount($order = null)
    {
        $this->packing_type = Packing::all();
        $this->basicId = Plan::first()->id;
        $this->systemLimit = sys('package_weight_limit');
        $this->user = auth()->user();
        $this->types = ['cosmetics','clothes','document','furniture','machines','other'];
        $this->areas = Area::where('active',1)->whereHas('state',fn($q)=>$q->where('active','1'))->select('id','name')->orderBy('id','desc')->get();
        if ($order){
            $this->order = $order ;
             $this->product_name =  $this->order->product['name'];
            $this->value =  $this->order->product['value'];
            $this->cust_name =  $this->order->consignee['cust_name'];
            $this->cust_num =  $this->order->consignee['cust_num'];
            $this->product_description =  $this->order->product['description'];
            $this->address =  $this->order->consignee['address'];
            $this->area_id =  $this->order->area_id;
            $this->package_type =  $this->order->details['package_type'];
            $this->packing =  $this->order->details['packing_type'];
            $this->package_weight =  $this->order->details['package_weight'];
            $this->deliver_before =  $this->order->details['deliver_before'];
            $this->quantity =  $this->order->product['quantity'];
            $this->cod =  $this->order->details['cod'];
            $this->notes =  $this->order->details['notes'];
//            $this->delivery_cost =  $this->order->value;
//            $this->packing_cost =  $this->order->value;
//            $this->weight =  $this->order->value;
//            $this->overWeight =  $this->order->value;
//            $this->overWeightCost =  $this->order->value;
          //  dd($this->order->cost);
            $this->cost =  $this->order->cost;
            $this->subTotal =  $this->order->subTotal;
            $this->tax =  $this->order->tax;
            $this->discount =  $this->order->discount;
            $this->total =  $this->order->total;

            $this->title = 'edit';
            $this->button = 'update';
            $this->color = 'primary';

            $this->go();
        }

    }

    public function render()
    {
        return view('livewire.seller.order-create');
    }

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function go()
    {
        if ($this->value && $this->quantity){ // if there is value and quantity
            if($this->area_id && $this->package_weight ){
                $orderArea = Area::where('id', $this->area_id)->select('id','delivery_cost','over_weight_cost')->first();
                if($this->user->plan->id !== $this->basicId){
                    $this->delivery_cost = $this->user->plan->area[$this->area_id] ?? $orderArea->delivery_cost ;
                }

                $this->weight  = $this->package_weight * $this->quantity ;
                if( $this->weight  > $this->systemLimit ){
                    $this->overWeight  = $this->weight - $this->systemLimit;
                    $this->overWeightCost =  $this->overWeight * $orderArea->over_weight_cost ;
                }else{

                    $this->overWeight  = 0;
                    $this->overWeightCost =  0;
                }
            }else{
                $this->weight = 0 ;
                $this->overWeight  = 0;
                $this->overWeightCost =  0;

            }
        }
        $this->cost = $this->delivery_cost + $this->overWeightCost  + $this->packing_cost  ;
        $this->subTotal = $this->value *  $this->quantity ;
        if (!$this->cod){
            $this->subTotal =   $this->subTotal - $this->cost ;
        }
        $this->total =  $this->subTotal  + $this->discount -   $this->tax ;
    }


    public function updatedPacking()
    {
        if($this->packing && $this->quantity){
            $this->packing_cost = Packing::find($this->packing)->price * $this->quantity;
        }else{
            $this->packing_cost = 0;
        }

    }

    public function save(){
            $this->validate();
$data = [
    'type' => 'deliver',
    'product'=> [
        'name' => $this->product_name,
        'description' => $this->product_description,
        'value' => $this->value,
        'quantity' => $this->quantity,
    ],
    'consignee' => [
        'cust_name' => $this->cust_name,
        'cust_num' => $this->cust_num,
        'address' => $this->address,
    ],
    'details' => [
        'package_type' => $this->package_type,
        'packing_type' => $this->packing,
        'package_weight' => $this->package_weight,
        'deliver_before' => $this->deliver_before,
        'cod' => $this->cod,
        'notes' => $this->notes,
    ],
    'area_id' => $this->area_id,
    'user_id' => auth()->id(),
    'status_id' => 1,
    'cost' => $this->cost,
    'sub_total' => $this->subTotal,
    'tax' => $this->tax,
    'discount' => $this->discount,
    'total' => $this->total,
];
if ($this->order){
       $this->order->update($data);

    $this->emit('alert',
        ['type' => 'success',  'message' => 'Order Updated Successfully!']);
}else{
    // Execution doesn't reach here if validation fails.

    if ($this->value && $this->quantity){ // if there is value and quantity
        if($this->area_id && $this->package_weight ){
            $orderArea = Area::where('id', $this->area_id)->select('id','delivery_cost','over_weight_cost')->first();
            if($this->user->plan->id !== $this->basicId){
                $this->delivery_cost = $this->user->plan->area[$this->area_id] ?? $orderArea->delivery_cost ;
            }

            $this->weight  = $this->package_weight * $this->quantity ;
            if( $this->weight  > $this->systemLimit ){
                $this->overWeight  = $this->weight - $this->systemLimit;
                $this->overWeightCost =  $this->overWeight * $orderArea->over_weight_cost ;
            }else{
                $this->overWeight  = 0;
                $this->overWeightCost =  0;
            }
        }else{
            $this->overWeight  = 0;
            $this->overWeightCost =  0;

        }
    }
    $this->cost = $this->delivery_cost + $this->overWeightCost  + $this->packing_cost  ;
    $this->subTotal = $this->value *  $this->quantity ;
    if (!$this->cod){
        $this->subTotal =   $this->subTotal - $this->cost ;
    }
    $this->total =  $this->subTotal  + $this->discount -   $this->tax ;


    Order::create($data);

    $this->emit('alert',
        ['type' => 'success',  'message' => 'Order Created Successfully!']);
}


        $this->reset(      'product_name' ,
            'value',
            'cust_name',
            'cust_num',
            'product_description',
            'address',
            'area_id',
            'package_type' ,
            'packing',
            'package_weight',
            'deliver_before' ,
            'quantity',
            'cod',
            'notes',
        'delivery_cost',
            'packing_cost',
            'weight',
            'overWeight',
            'overWeightCost',
            'cost',
        'subTotal',
        'tax',
        'discount',
        'total');
        return back();

      //  return redirect()->route('orders.index');
    }

    public function edit(int $orderId)
    {
         dd($orderId);
        $this->order = auth()->user()->orders()->where('id', $locationId)->first();



    }
}

