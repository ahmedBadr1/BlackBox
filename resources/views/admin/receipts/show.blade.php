@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.receipts.index')}}">{{__("names.manage")}} {{__("names.receipts")}}</a>
                <h1 class="text-center"> {{__("names.receipt")}} {{ $receipt->id }}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.receipt")}} {{__("auth.id")}}</label>
                <p><b>{{$receipt->id}}</b></p> <hr>
                <label>{{__("names.orders")}} {{__("auth.count")}}</label>
                <p><b>{{$receipt->orders_count}}</b></p> <hr>
                <label>{{__("names.receipt")}} {{__("auth.sub_total")}}</label>
                <p><b>{{$receipt->sub_total }}</b></p> <hr>
                <label>{{__("names.receipt")}} {{__("auth.discount")}}</label>
                <p><b>{{$receipt->discount}}</b></p> <hr>
                <label>{{__("names.receipt")}} {{__("auth.tax")}}</label>
                <p><b>{{$receipt->tax}}</b></p> <hr>
                <label>{{__("names.receipt")}} {{__("auth.total")}}</label>
                <p><b> {{$receipt->total}}</b></p> <hr>

                <label>{{__("names.receipt")}} {{__("auth.user")}}</label>
                <p><b><a href="{{route('admin.users.show',$receipt->user->id)}}"></a>{{$receipt->user->name}}</b></p> <hr>
            </div>
        </div>
    </div>
@endsection

