@extends('admin.layouts.admin')
@section('page-header')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.receipts.index')}}">@lang("names.manage")}} @lang("names.receipts")}}</a>
                <h1 class="text-center"> @lang("names.receipt")}} {{ $receipt->id }}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>@lang("names.receipt")}} @lang("auth.id")}}</label>
                <p><b>{{$receipt->id}}</b></p> <hr>
                <label>@lang("names.orders")}} @lang("auth.count")}}</label>
                <p><b>{{$receipt->orders_count}}</b></p> <hr>
                <label>@lang("names.receipt")}} @lang("auth.sub_total")}}</label>
                <p><b>{{$receipt->sub_total }}</b></p> <hr>
                <label>@lang("names.receipt")}} @lang("auth.discount")}}</label>
                <p><b>{{$receipt->discount}}</b></p> <hr>
                <label>@lang("names.receipt")}} @lang("auth.tax")}}</label>
                <p><b>{{$receipt->tax}}</b></p> <hr>
                <label>@lang("names.receipt")}} @lang("auth.total")}}</label>
                <p><b> {{$receipt->total}}</b></p> <hr>

                <label>@lang("names.receipt")}} @lang("auth.username")}}</label>
                <p><b><a href="{{route('admin.users.show',$receipt->user->id)}}"></a>{{$receipt->user->name}}</b></p> <hr>
            </div>
        </div>
    </div>
@endsection

