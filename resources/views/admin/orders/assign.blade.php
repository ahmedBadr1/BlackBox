@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('auth.assign')</h1>
    <div class="">
        <a href="{{route('admin.branches.index')}}" class="btn btn-primary">@lang("names.manage-branches")</a>
    </div>
@endsection
@section('content')
        <div class="row ">
            <div class="col-md-12">
                <form action="{{route('admin.orders.assign')}}" method="POST">
                    @csrf

            <div class="form-group row">
                <div class="col-md-6">
                    <h3>@lang('names.deliveries')</h3>

                    <select name="delivery" class="form-control select2">


                        @foreach($deliveries as $delivery)
                            <option value="{{$delivery->id}}">{{$delivery->name}}</option>
                        @endforeach
                    </select>

                    @error('delivery')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>


                <div class="col-md-6">
                    <h3>@lang('names.ready-orders')</h3>

                    <select name="orders[]" class="form-control select2" multiple  >
                        @foreach($orders as $order)
                            <option value="{{$order->id}}">{{$order->hashid}} -- {{$order->area->name}}</option>
                        @endforeach
                    </select>

                    @error('orders')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

            </div>



                        <div class="col-md-2 ">
                            <button type="submit" class="btn btn-success">
                                @lang('auth.assign')
                            </button>
                        </div>


                </form>


            </div>
        </div>

@endsection

