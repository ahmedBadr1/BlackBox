@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("names.all-orders")</h1>

        @can('order-assign')
            <div class="mx-2">
                <a href="{{route('admin.orders.assign')}}" class="btn btn-secondary">@lang("auth.assign") @lang("names.order")</a>
            </div>
        @endcan

@endsection
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <livewire:admin.orders-create-button />
                <livewire:admin.orders-table />
            </div>
        </div>
@endsection

@section('script')


@endsection
