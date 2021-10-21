@extends('seller.layouts.seller')

@section('content')

    <h1 class="main-content-title">{{__("names.all")}} {{__("names.orders")}}</h1>
    <div class="row ">




            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


            {{--                @can('order-import')--}}
            <div class="col-sm-4">
                <form action="{{route('import.orders')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    {{--                <input type="file" name="import_file">--}}
                    <div class="input-group file-browser">
                        <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly="">
                        <label class="input-group-btn"> <span class="btn btn-default"> Browse
                        <input type="file" name="import_file" class="d-none" > </span>
                        </label>

                        <button type="submit" class="btn btn-info-gradient">@lang('auth.import')</button>
                    </div>
                </form>
            </div>

                <div class="col-sm-4 ">
                    <a href="{{route('orders.create')}}" class="btn btn-success-gradient">{{__("auth.create")}} {{__("names.order")}}</a>
                </div>
            {{--                @endcan--}}


    </div>
    <livewire:seller.orders-table/>

@endsection

