@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.orders.index')}}">{{__("names.manage")}} {{__("names.orders")}}</a>
                <h1 class="text-center"> {{__("names.order")}} {{$order->cust_name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.order")}} {{__("auth.id")}}</label>
                <p><b>   {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.product_name")}}</label>
                <p><b>{{$order->product_name}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.name")}}</label>
                <p><b>{{$order->cust_name}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.phone")}}</label>
                <p><b>{{$order->cust_num}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.location")}}</label>
                <p><b> {{$order->address}}, <a href="{{route('admin.areas.show',$order->area->id )}}">{{ $order->area->name }}</a>, {{$order->state->name}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.value")}}</label>
                <p><b>{{$order->value}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.count")}}</label>
                <p><b>{{$order->quantity}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.notes")}}</label>
                <p><b>{{$order->notes ?? 'no notes'}} </b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.status")}}</label>
                <p><b>{{$order->status->name}}</b></p> <hr>

                <div class="d-flex ">
                        <a href="{{ route('admin.orders.edit',$order->hashid) }}" class="btn btn-info o">{{__("auth.edit")}}</a>
                        <form class="ml-5" action="{{route('admin.orders.destroy',$order->hashid) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="{{__("auth.delete")}}">
                        </form>
                </div>


            </div>
        </div>
    </div>
@endsection

