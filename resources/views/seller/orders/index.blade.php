@extends('seller.layouts.seller')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @role('seller|Feedback')
                    <a href="{{route('orders.create')}}" class="btn btn-success">{{__("auth.create")}} {{__("names.order")}}</a>
                @endrole
                @can('order-import')
                <form action="{{route('import.orders')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="file" name="import_file">
                    <button type="submit"  class="btn btn-primary">Import</button>
                </form>
                @endcan

                <h1 class="text-center">{{__("names.all")}} {{__("names.orders")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <livewire:seller.orders-table />

            </div>

        </div>
    </div>
@endsection

