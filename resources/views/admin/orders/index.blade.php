@extends('admin.layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1 class="text-center">{{__("names.all")}} {{__("names.orders")}}</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

    <div class="d-flex">
        @can('order-assign')
            <div class="mx-2">
                <a href="{{route('admin.orders.assign')}}" class="btn btn-secondary">{{__("auth.assign")}} {{__("names.order")}}</a>
            </div>
        @endcan
        <livewire:admin.orders-create-button />

    </div>


                <livewire:admin.orders-table />


            </div>

        </div>
    </div>





@endsection

@section('script')


@endsection
