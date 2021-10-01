@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.orders.index')}}">{{__("names.manage")}} {{__("names.orders")}}</a>
                <h1 class="text-center">{{__("auth.create")}} {{__("names.order")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.orders.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="product_name" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.product_name")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}"  autocomplete="name" autofocus>
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
                            <input  type="text" class="form-control @error('cust_name') is-invalid @enderror" name="cust_name" value="{{ old('cust_name') }}"  >
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
                        <label for="area_id" class="col-md-4 col-form-label text-md-right">{{__('auth.area')}}</label>
                        <div class="col-md-6">
                            <select name="area_id" id="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                <option value="">select Area</option>
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                            @error('area_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="area_id" class="col-md-4 col-form-label text-md-right">{{__('auth.package_type')}}</label>
                        <div class="col-md-6">
                            <select name="package_type" id="package_type" class="form-control @error('package_type') is-invalid @enderror">
                                <option value="">select Type</option>
                                @foreach($types as $type)
                                    <option value="{{$type}}" @if(old('package_type') === $type ) selected @endif>{{$type}}</option>
                                @endforeach
                            </select>
                            @error('package_type')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="value" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.value-per-one")}}</label>
                        <div class="col-md-6">
                            <input  type="number" step="00.25" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}"  autocomplete="name" autofocus>
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
                            <input  type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') ?? 1 }}" >
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="package_weight" class="col-md-4 col-form-label text-md-right">{{__("names.package_weight-kg")}}</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('package_weight') is-invalid @enderror" name="package_weight" value="{{ old('package_weight')  }}" >
                            <span><sup>kg</sup></span>
                            @error('package_weight')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deliver_before" class="col-md-4 col-form-label text-md-right">{{__("names.deliver_before")}}</label>
                        <div class="col-md-6">
                            <input  type="datetime-local" class="form-control @error('deliver_before') is-invalid @enderror" name="deliver_before" value="{{ old('deliver_before')  }}" >
                            @error('deliver_before')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deliver_before" class="col-md-4 col-form-label text-md-right">{{__("names.cod")}}</label>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cod" value="1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    delivery on Consignee
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cod" value="0">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    delivery on me
                                </label>
                            </div>
                            @error('cod')
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

