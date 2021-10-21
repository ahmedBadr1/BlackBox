@extends('seller.layouts.seller')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12 mt-1">
{{--                <a href="{{route('orders.index')}}">{{__("names.manage")}} {{__("names.orders")}}</a>--}}
                <h1 class="main-content-title">{{__("auth.create")}} {{__("names.order")}}</h1>

                <livewire:seller.order-create />
            </div>
        </div>
@endsection

