@extends('delivery.layouts.delivery')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('orders.index')}}">{{__("names.manage")}} {{__("names.orders")}}</a>
                <h1 class="text-center"> {{__("names.order")}} {{$order->cust_name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.order")}} {{__("auth.id")}}</label>
                <p><b>{{$order->id}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.product_name")}}</label>
                <p><b>{{$order->product_name}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.name")}}</label>
                <p><b>{{$order->cust_name}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.phone")}}</label>
                <p><b>{{$order->cust_num}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.location")}}</label>
                <p><b> {{$order->address}}, <a href="{{route('areas.show',$order->area->id )}}">{{ $order->area->name }}</a>, {{$order->state->name}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.count")}}</label>
                <p><b>{{$order->quantity}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.notes")}}</label>
                <p><b>{{$order->notes ?? 'no notes'}} </b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.status")}}</label>
                <p><b>{{$order->status->name}}</b></p> <hr>



                <div class="d-flex ">
                    <form class="ml-5" action="{{route('orders.changeStatus',$order->id) }}" method="POST">
                        @csrf

                        <select name="status_id" id="">

                            @foreach($statuses as $status)
                                <option value="{{$status->id}}" @if($order->status->id === $status->id){{("selected")}} @endif>{{$status->name}}</option>
                            @endforeach
                        </select>

                        <input type="submit" class="btn btn-secondary" value="{{__("auth.update")}}">
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection

