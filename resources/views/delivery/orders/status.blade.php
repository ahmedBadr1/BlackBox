@extends('delivery.layouts.delivery')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('delivery.my-orders')}}">@lang("names.manage")}} @lang("names.orders")}}</a>
                <h1 class="text-center"> @lang("names.order")}} {{$order->cust_name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>@lang("names.order")}} @lang("auth.id")}}</label>
                <p><b>{{$order->hashid}}</b></p> <hr>
                <label>@lang("names.order")}} @lang("auth.product_name")}}</label>
                <p><b>{{$order->product['name']}}</b></p> <hr>
                <label>@lang("names.order")}} @lang("auth.name")}}</label>
                <p><b>{{$order->consignee['cust_name']}}</b></p> <hr>
                <label>@lang("names.order")}} @lang("auth.phone")}}</label>
                <p><b>{{$order->consignee['cust_num']}}</b></p> <hr>
                <label>@lang("names.order")}} @lang("auth.location")}}</label>
                <p><b> {{$order->consignee['address']}}, <a href="{{route('areas.show',$order->area->id )}}">{{ $order->area->name }}</a>, {{$order->state->name}}</b></p> <hr>
                <label>@lang("names.order")}} @lang("auth.count")}}</label>
                <p><b>{{$order->product['quantity']}}</b></p> <hr>
                <label>@lang("names.order")}} @lang("auth.notes")}}</label>
                <p><b>{{$order->details['notes'] ?? 'no notes'}} </b></p> <hr>
                <label>@lang("names.order")}} @lang("auth.status")}}</label>
                <p><b>{{$order->status->name}}</b></p> <hr>



                <div class="d-flex ">
                    <form class="ml-5" action="{{route('delivery.orders.changeStatus',$order->hashid) }}" method="POST">
                        @csrf

                        <select name="status_id" id="">

                            @foreach($statuses as $status)
                                <option value="{{$status->id}}" @if($order->status->id === $status->id) selected @endif>{{$status->name}}</option>
                            @endforeach
                        </select>

                        <input type="submit" class="btn btn-secondary" value="@lang("auth.update")}}">
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection

