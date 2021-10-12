@extends('seller.layouts.seller')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{route('orders.index')}}">{{__("names.manage")}} {{__("names.orders")}}</a>
                <h1 class="text-center">{{__("auth.create")}} {{__("names.order")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <livewire:seller.order-create />
            </div>
        </div>
    </div>
@endsection

