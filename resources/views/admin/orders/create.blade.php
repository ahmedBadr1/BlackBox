@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("auth.create-order")</h1>
    <a href="{{route('admin.orders.index')}}" class="btn btn-primary">@lang("names.manage-orders")</a>
@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
               <livewire:admin.order-create />
            </div>

@endsection

