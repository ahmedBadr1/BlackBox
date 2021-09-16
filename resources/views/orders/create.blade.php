@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('orders.index')}}">{{__("names.manage")}} {{__("names.orders")}}</a>
                <h1 class="text-center">{{__("auth.create")}} {{__("names.order")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="cust_name" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.cust_name")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('cust_name') is-invalid @enderror" name="cust_name" value="{{ old('cust_name') }}"  autocomplete="name" autofocus>
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
                            <input  type="tel" class="form-control @error('cust_num') is-invalid @enderror" name="cust_num" value="{{ old('cust_num') }}"  >
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
                            <input  type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  >
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="state" class="col-md-4 col-form-label text-md-right">{{__('auth.state')}}</label>
                        <div class="col-md-6">
                            <select name="state" id="state" class="form-control @error('state') is-invalid @enderror">
                                <option value="">select state</option>
                                @foreach($states as $state)
                                    <option value="{{$state}}">{{$state}}</option>
                                @endforeach
                            </select>
                            @error('state')
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
                                <option value="">select Area</option>
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
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
                            <input  type="number" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}"  autocomplete="name" autofocus>
                            @error('value')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("names.count")}}</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" >
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
                            <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>



                    <div class="form-group row mb-0 mt-3">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('auth.create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

