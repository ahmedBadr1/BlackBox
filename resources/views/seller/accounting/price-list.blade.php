@extends('seller.layouts.seller')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <h1 class="text-center main-content-title">{{ __('names.price-list') }}</h1>
            <p  class="text-center mb-2">{{ __('messages.price-list') }}</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                @foreach($areas as $area)
                <div class="card-body">
                    <h4 class="font-weight-semibold tx-15">{{$area->name}}</h4>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted mb-0 tx-13">@lang('auth.delivery-cost') : <b>{{ $area->delivery_cost }}</b>  @lang('auth.symbol')</p>
                        <p class="text-muted mb-0 tx-13">@lang('auth.delivery-time') : <b>{{ $area->delivery_time }} </b> @lang('auth.hour') </p>
                        <p class="text-muted mb-0 tx-13">@lang('auth.over-weight-cost') : <b>{{ $area->over_weight_cost }}</b> @lang('auth.symbol')</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        @lang('names.plan') {{$plan->name}}
                    </div>

                    <p>@lang('auth.pickup-cost') : <b>{{$plan->pickup_cost}}</b></p>
                    <p>@lang('names.orders-count') : <b>{{$plan->orders_count}}</b></p>
                </div>
            </div>
        </div>
    </div>



@endsection
