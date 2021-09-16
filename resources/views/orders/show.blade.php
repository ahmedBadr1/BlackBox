@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('orders.index')}}">{{__("names.manage")}} {{__("names.orders")}}</a>
                <h1 class="text-center"> {{__("names.order")}} {{$order->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.order")}} {{__("auth.id")}}</label>
                <p><b>{{$order->id}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.name")}}</label>
                <p><b>{{$order->cust_name}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.phone")}}</label>
                <p><b>{{$order->cust_num}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.location")}}</label>
                <p><b> {{$order->address}}, <a href="{{route('areas.show',$order->area)}}">{{ \App\Models\Area::find($order->area)->name}}</a>, {{$order->state}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.count")}}</label>
                <p><b>{{$order->quantity}}</b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.notes")}}</label>
                <p><b>{{$order->notes ?? 'no notes'}} </b></p> <hr>
                <label>{{__("names.order")}} {{__("auth.status")}}</label>
                <p><b>{{$order->status}}</b></p> <hr>


                <div class="d-flex ">
                        <a href="{{ route('orders.edit',$order->id) }}" class="btn btn-info o">{{__("auth.edit")}}</a>
                        <form class="ml-5" action="{{route('orders.destroy',$order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="{{__("auth.delete")}}">
                        </form>
                </div>


            </div>
        </div>
    </div>
@endsection

