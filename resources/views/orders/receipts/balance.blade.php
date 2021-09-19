@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @role('client|Feedback')
                <a href="{{route('mybalance')}}" class="btn btn-success">{{__("auth.create")}} {{__("names.mycbalance")}}</a>
                @endrole

                <h1 class="text-center">{{__("names.all")}} {{__("names.mybalance")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">{{__("names.balance")}} {{__("names.total")}}</div>
                    <div class="card-body">
                        <h5 class="card-title"> {{$total}} EGP</h5>
                    </div>
                </div>
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">{{__("auth.order")}} {{__("names.count")}}</div>
                        <div class="card-body">
                            <h5 class="card-title"> {{$ordersCount}} Avilabe Order</h5>
                        </div>
                    </div>


                @foreach($avilableOrders as $order)
                    <div class="">
                        <a href="{{route('orders.show',$order->id)}}">{{$order->id}}</a>  = {{ \App\Models\Status::find($order->status_id)->name}} : {{$order->value}} :: {{ $order->value - $order->area->delivery_cost}}
                    </div>
                @endforeach

            </div>

        </div>
    </div>
@endsection

