@extends('seller.layouts.seller')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center main-content-title">{{ __('names.all-pickups') }}</h1>
            <p  class="text-center">{{ __('messages.pickups') }}</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


        </div>
    </div>

    <div class="row">
        <livewire:seller.request-pickup />
        <div class="col-lg-4">
            @if($nextPickup)
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">@lang('names.next-pickup')</h2>
                        <p>{{$nextPickup->due_to_for_humans}}</p>
                    </div>
                </div>
            @endif
            @if($nextDropoff)
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">@lang('names.next-dropoff')</h2>
                        <p>{{$nextDropoff->due_to_for_humans}}</p>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">@lang('names.ready-orders')</h2>
                    <p>{{$readyOrdersCount}} @lang('names.order')</p>
                </div>

            </div>

        </div>

        <livewire:seller.pickups-timeline />

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">@lang('names.locations')</div>
                    @foreach($locations as $location)
                        {{$location->name}} <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
