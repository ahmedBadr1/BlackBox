<?php

namespace App\Http\Livewire\Admin;

use App\Http\Controllers\Admin\OrdersController;
use App\Models\Area;
use App\Models\Order;
use App\Models\Plan;
use App\Models\User;
use Livewire\Component;

class OrderCreate extends Component
{

    protected $rules = [
        'product_name' =>'required',
        'value'=>'nullable|numeric|gt:-1',
        'cust_name'=>'required',
        'cust_num'=>'required',
        'address'=>'required',
        'area_id'=>'required|numeric',
        'package_type' => 'nullable',
        'package_weight'=>'nullable|numeric',
        'deliver_before' =>'nullable|date', //  'deliver_before' =>'nullable|date|after:today',
        'quantity'=>'nullable|numeric|gt:0',
        'cod'=> 'required|boolean',
        'notes'=>'nullable',
        'user_id' => 'nullable'
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
    public  $quantity = 0 ;
    public  $value = 0 ;

    public  $delivery_cost = 0 ;

    public  $package_weight = 0 ;
    public $weight = 0;
    public $overWeight = 0 ;
    public  $overWeightCost = 0 ;
    public $area_id ;
    public $settingLimit;
    public   $user_id ;
    private $basicId;

    public $cost =0 ;
    public  $subTotal = 0 ;
    public  $discount = 0 ;
    public  $tax = 0 ;
    public  $total = 0 ;

    public function mount()
    {
        $this->basicId = Plan::first()->id;
        $this->settingLimit = setting('package_weight_limit');
        $this->user = auth()->user();
        $this->user_id = $this->user->id ;
        $this->types = ['cosmetics','clothes','document','furniture','machines','other'];
        $this->areas = Area::where('active',1)->whereHas('state',fn($q)=>$q->where('active','1'))->select('id','name')->orderBy('id','desc')->get();
        $this->sellers = User::with('plan')->whereHas("roles", function($q){ $q->where("name" ,'seller'); })->get();
    }

    public function render()
    {
        return view('livewire.admin.order-create');
    }

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function go()
    {
        if ($this->value && $this->quantity){
            if($this->area_id && $this->package_weight ){
                $orderArea = Area::where('id', $this->area_id)->select('id','delivery_cost','over_weight_cost')->first();
                if($this->user->plan->id !== $this->basicId){
                    $this->delivery_cost = $this->user->plan->area[$this->area_id] ?? $orderArea->delivery_cost ;
                }
                $this->weight  = $this->package_weight * $this->quantity ;
                if( $this->weight  > $this->settingLimit ){
                    $this->overWeight  = $this->weight - $this->settingLimit;
                    $this->overWeightCost =  $this->overWeight * $orderArea->over_weight_cost ;

                    if (!$this->cod){
                         //  dd($this->delivery_cost);
                        $this->subTotal = ( $this->value * $this->quantity  )   - ($this->overWeightCost + $this->delivery_cost )  ;
                   //     dd( $this->subTotal);
                    } else{

                        $this->subTotal = ( $this->value * $this->quantity  )   - $this->overWeightCost ;
                    }
                }elseif ($this->weight  <= $this->settingLimit ){
                    $this->overWeight  = 0;
                    $this->overWeightCost =  0;
                    if(!$this->cod){
                        $this->subTotal = ($this->value * $this->quantity ) -   $this->delivery_cost   ;
                    }else{
                        $this->subTotal = ($this->value * $this->quantity )   ;
                    }
                }
            }else{
                $this->overWeight  = 0;
                $this->overWeightCost =  0;

                $this->subTotal = ($this->value * $this->quantity );
            }
        }elseif($this->value === 0 && $this->quantity ){
            if($this->area_id && $this->package_weight ){
                $orderArea = Area::where('id', $this->area_id)->select('id','delivery_cost','over_weight_cost')->first();
                if($this->user->plan->id !== $this->basicId){
                    $this->delivery_cost = $this->user->plan->area[$this->area_id] ?? $orderArea->delivery_cost ;
                }
                $this->weight  = $this->package_weight * $this->quantity ;
                if( $this->weight  > $this->settingLimit ){
                    $this->overWeight  = $this->weight - $this->settingLimit;
                    $this->overWeightCost =  $this->overWeight * $orderArea->over_weight_cost ;
                    $this->subTotal = $this->quantity     - $this->overWeightCost ;
                    if (!$this->cod){
                        $this->subTotal = $this->quantity     - $this->overWeightCost - $this->delivery_cost  ;
                    } else{
                        $this->subTotal =  $this->quantity     - $this->overWeightCost ;
                    }
                }elseif (!$this->cod){
                    $this->overWeight  = 0;
                    $this->overWeightCost =  0;
                    $this->subTotal = $this->quantity  -    $this->delivery_cost  ;
                } else{
                    $this->overWeight  = 0;
                    $this->overWeightCost =  0;
                  //  $this->subTotal =  $this->quantity ;

                }
            }
        }
     //   $this->tax = round($this->subTotal * 14 / 100) ;
        $this->cost = $this->overWeightCost + $this->delivery_cost ;
        $this->total =  $this->subTotal  + $this->discount -   $this->tax;
    }

//    public function updatedValue()
//    {`1



//if ($this->validate()){
//$orderArea = Area::where('id', $this->area_id)->select('id','delivery_cost','over_weight_cost')->first();
//if($this->user->plan->id !== $this->basicId){
//$this->cost = $this->user->plan->area[$this->area_id] ?? $orderArea->delivery_cost ;
//}
//if($this->package_weight > $this->settingLimit ){
//    $this->overWeightCost =   ($this->package_weight - $this->settingLimit ) * $orderArea->over_weight_cost ;
//    $this->subTotal = ( $this->value -  $this->overWeightCost )   * $this->quantity  ;
//}elseif (!$this->cod){
//    $this->subTotal = ($this->value * $this->quantity ) -  $this->overWeightCost  -   $this->cost  ;
//} else{
//    $this->overWeightCost = 0;
//    $this->subTotal =  $this->value * $this->quantity ;
//}
//}


//        if ($this->quantity){
//            $this->subTotal = intval($this->value)  * intval($this->quantity)     ;
//        }else{
//            $this->subTotal =  intval($this->value)    ;
//        }
//
//    }
//    public function updatedQuantity()
//    {
//        if (!$this->area_id){
//            $this->subTotal = intval($this->value)  * intval($this->quantity)     ;
//        }else{
//            $this->subTotal = ( $this->value -  $this->overWeightCost )   * $this->quantity  ;
//            $this->overWeightCost =  $this->overWeightCost * $this->quantity;
//        }
//    }
//    public function updatedPackageWeight()
//    {
//        if($this->area_id){
//            if($this->package_weight > $this->settingLimit ){
//                $orderArea = Area::where('id', $this->area_id)->select('id','over_weight_cost')->first();
//                $this->overWeightCost =   ($this->package_weight - $this->settingLimit ) * $orderArea->over_weight_cost  ;
//                $this->subTotal = ( $this->value -  $this->overWeightCost )   * $this->quantity  ;
//            }else{
//                $this->overWeightCost = 0;
//            }
//        }
//    }
//    public function updatedAreaId()
//    {
//        if($this->area_id){
//            $orderArea = Area::where('id', $this->area_id)->select('id','delivery_cost','over_weight_cost')->first();
//            if($this->user->plan->id !== $this->basicId){
//                $this->cost = $this->user->plan->area[$this->area_id] ?? $orderArea->delivery_cost ;
//            }
//            if($this->package_weight > $this->settingLimit ){
//                $this->overWeightCost =   ($this->package_weight - $this->settingLimit ) * $orderArea->over_weight_cost ;
//                $this->subTotal = ( $this->value -  $this->overWeightCost )   * $this->quantity  ;
//            }else{
//                $this->overWeightCost = 0;
//                $this->subTotal = ( $this->value * $this->quantity );
//            }
//        }else{
//            $this->overWeightCost = 0;
//        }
//
//
//    }
    public function updatedUserId()
    {
            $this->user = User::findOrFail($this->user_id);
    }
//    public function updatedCod()
//    {
//        if ($this->cod){
//            $this->subTotal = ($this->value * $this->quantity ) -  $this->overWeightCost   ;
//        }else{
//            $this->subTotal = ($this->value * $this->quantity ) -  $this->overWeightCost  -   $this->cost  ;
//        }
//    }


    public function save(){
            $this->validate();

            // Execution doesn't reach here if validation fails.

            Order::create([
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
                    'package_weight' => $this->package_weight,
                    'deliver_before' => $this->deliver_before,
                    'cod' => $this->cod,
                    'notes' => $this->notes,
                ],
                'area_id' => $this->area_id,
                'user_id' => $this->user_id,
                'status_id' => 1,
                'cost' => $this->cost,
                'sub_total' => $this->subTotal,
                'tax' => $this->tax,
                'discount' => $this->discount,
                'total' => $this->total,
            ]);
     //   session()->flash('message', 'Post successfully updated.');
     //   $this->emit('alert', ['success', 'Record has been updated']);

        $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'Order Created Successfully!']);

        return redirect()->route('admin.orders.index');
      // return redirect()->action([OrdersController::class, 'store']);
    }
}

