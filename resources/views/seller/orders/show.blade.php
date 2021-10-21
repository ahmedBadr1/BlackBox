@extends('seller.layouts.seller')

@section('content')

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
            <p><b>   {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.product_name")}}</label>
            <p><b>{{$order->product['name']}}</b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.name")}}</label>
            <p><b>{{$order->consignee['cust_name']}}</b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.phone")}}</label>
            <p><b>{{$order->consignee['cust_num']}}</b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.location")}}</label>
            <p><b> {{$order->consignee['address']}}, <a href="{{route('areas.show',$order->area->id )}}">{{ $order->area->name }}</a>, {{$order->state->name}}</b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.value")}}</label>
            <p><b>{{$order->product['value']}}</b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.count")}}</label>
            <p><b>{{$order->product['quantity']}}</b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.notes")}}</label>
            <p><b>{{$order->details['notes'] ?? 'no notes'}} </b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.cost")}}</label>
            <p><b>{{$order->cost }} </b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.total")}}</label>
            <p><b>{{$order->total }} </b></p> <hr>
            <label>{{__("names.order")}} {{__("auth.status")}}</label>
            <p><b>{{$order->status->name}}</b></p> <hr>
            <p>{{__("auth.created")}}<b> {{$order->created_at->diffForHumans()}}</b></p> <hr>

            <div class="d-flex ">
                <a href="{{ route('orders.edit',$order->hashid) }}" class="btn btn-info o">{{__("auth.edit")}}</a>
                <form class="ml-5" action="{{route('orders.destroy',$order->hashid) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="{{__("auth.delete")}}">
                </form>
            </div>


        </div>
    </div>

@endsection

