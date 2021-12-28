@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.assign-orders')</h1>
    <a href="{{route('admin.branches.index')}}" class="btn btn-primary">@lang("names.manage-branches")</a>
@endsection
@section('content')
        <div class="row ">
            <div class="col-md-12">
                <form action="{{route('admin.orders.assign')}}" method="POST">
                    @csrf


                    <div class="form-group container-fluid col-md-12 mb-0">
                        <h3>Deliveries</h3>
                        <div class="row offset-md-2 ">
                            @foreach($deliveries as $delivery)
                                <div class="m-2">
                                    <input type="radio"  name="delivery"  value="{{$delivery->id}}">
                                    <label for="{{$delivery->name}}">{{$delivery->name}}</label><br>
                                </div>

                            @endforeach

                            @error('delivery')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group container-fluid col-md-12 mb-0">
                        <h3>Ready Orders</h3>
                        <div class="row offset-md-2 ">
                            @foreach($orders as $order)
                                <div class="m-2">
                                <input type="checkbox"  name="orders[]" value="{{$order->id}}" >
                                <label for="{{$order->id}}">{{$order->id}} => <a href="{{route('admin.areas.show',$order->area->id)}}">{{$order->area->name}}</a> </label><br>
                                </div>
                            @endforeach

                            @error('orders')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                @lang('names.assign')
                            </button>
                        </div>
                    </div>

                </form>


            </div>
        </div>

@endsection

