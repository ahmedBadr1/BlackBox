@extends('seller.layouts.seller')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12 mt-1">
{{--                <a href="{{route('orders.index')}}">@lang("names.manage")}} @lang("names.orders")}}</a>--}}


                <livewire:seller.order-create :order="$order" />
            </div>
        </div>
@endsection

