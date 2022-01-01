@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("auth.edit") @lang("names.order")</h1>
    <div class="">
        <a href="{{route('admin.orders.index')}}" class="btn btn-primary">@lang("names.manage-orders")</a>
    </div>
@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <livewire:admin.order-create :order="$order" />
            </div>
        </div>
    </div>
@endsection

