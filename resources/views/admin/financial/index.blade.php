@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.financial')</h1>
@endsection
@section('content')

        <div class="row d-flex ">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Delivers with cash</div>
                    <div class="card-body">
                        @foreach ($deliveriesWithCash as $delivery)
                            <p> name: {{ $delivery->name }} ,cash: {{$delivery->custody->sum('total')}} count: {{$delivery->custody_count}} </p>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
                <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Seller with Balance</div>
                    <div class="card-body">
                        @foreach ($shippersWithBalance as $seller)
                            <p> name: {{ $seller->name }} ,cash: {{$seller->orders->sum('total')}} count: {{$seller->orders_count}} </p>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary m-3 col-md-4"  style="max-width: 18rem;">
                    <div class="card-header">@lang("names.availabe-orders-cost")}}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$collected}} @lang("names.EGP")}}</h5>
                    </div>
                </div>

                <div class="card text-white bg-primary m-3 col-md-4"  style="max-width: 18rem;">
                    <div class="card-header">@lang("names.revenues")}}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$revenues}} @lang("names.EGP")}}</h5>
                    </div>
                </div>

                <div class="card text-white bg-primary m-3 col-md-4"  style="max-width: 18rem;">
                    <div class="card-header">@lang("names.shipper-balance")}}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$shipperBalance}} @lang("names.EGP")}}</h5>
                    </div>
                </div>

                <div class="card text-white bg-primary m-3 col-md-4"  style="max-width: 18rem;">
                    <div class="card-header">@lang("names.cash-with-delivery")}}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$outWithDelivery}} @lang("names.EGP")}}</h5>
                    </div>
                </div>
            </div>
        </div>

@endsection
