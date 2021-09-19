@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('orders.index')}}">{{__("names.manage")}} {{__("auth.orders")}}</a>
                <h1 class="text-center">{{__("auth.edit")}} {{__("auth.branch")}}</h1>

                <form method="POST" action="{{ route('orders.update',$order->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="product_name" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.product_name")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $order->product_name }}"  autocomplete="name" autofocus>
                            @error('product_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cust_name" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.cust_name")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('cust_name') is-invalid @enderror" name="cust_name" value="{{ $order->cust_name }}"  autocomplete="name" autofocus>
                            @error('cust_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cust_num" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.cust_num")}}</label>
                        <div class="col-md-6">
                            <input  type="tel" class="form-control @error('cust_num') is-invalid @enderror" name="cust_num" value="{{ $order->cust_num }}"  >
                            @error('cust_num')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.address")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $order->address }}"  >
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="area" class="col-md-4 col-form-label text-md-right">{{__('auth.area')}}</label>
                        <div class="col-md-6">
                            <select name="area" id="area" class="form-control @error('area') is-invalid @enderror">

                                @foreach($areas as $area)
                                    <option value="{{$area->id}}"@if($area->id === $order->area) {{ ("selected")}} @endif>{{$area->name}} </option>
                                @endforeach
                            </select>
                            @error('area')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="value" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.value")}}</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ $order->value }}"  autocomplete="name" autofocus>
                            @error('value')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("names.quantity")}}</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $order->quantity }}" >
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <label for="exampleFormControlTextarea1" class="form-label">{{__("names.notes")}}</label>
                            <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $order->notes }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-info">
                                {{ __('auth.edit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

