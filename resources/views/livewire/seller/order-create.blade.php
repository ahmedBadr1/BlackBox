<div class="container-fluid">


    <form method="POST" wire:change="go"  action="{{ route('orders.store') }}" wire:submit.prevent="save">
        @csrf
        <div class="row">

    <div class="col-md-8">

        <div class="card col-lg-12 my-2">
            <div class="card-header">@lang('names.order-details')</div>
            <div class="card-body">

                <div class="form-group row">
                    <label for="product_name" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.product_name")}}</label>
                    <div class="col-md-6">
                        <input  type="text" wire:model.lazy="product_name" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}"  autocomplete="name" autofocus>
                        @error('product_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="area_id" class="col-md-4 col-form-label text-md-right">{{__('auth.package_type')}}</label>
                    <div class="col-md-6">
                        <select name="package_type" wire:model.lazy="package_type" id="package_type" class="form-control @error('package_type') is-invalid @enderror">
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
                        <input  type="number" wire:model.lazy="value"  class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}"  autocomplete="name" autofocus>
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
                        <input  type="number" wire:model.lazy="quantity"  class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') ?? 1 }}" >
                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="package_weight" class="col-md-4 col-form-label text-md-right">{{__("names.package_weight-kg-per-one")}}</label>
                    <div class="col-md-6">
                        <input  type="number" wire:model.lazy="package_weight" step="00.25" class="form-control @error('package_weight') is-invalid @enderror" name="package_weight" value="{{ old('package_weight')  }}" >
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
                        <input  type="datetime-local" wire:model.lazy="deliver_before" class="form-control @error('deliver_before') is-invalid @enderror" name="deliver_before" value="{{ old('deliver_before')  }}" >
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
                            <input class="form-check-input" wire:model.lazy="cod" type="radio"  name="cod" value="1">
                            <label class="form-check-label"  for="flexRadioDefault1">
                                @lang('auth.delivery-on-consignee')
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" wire:model.lazy="cod" type="radio" name="cod" value="0">
                            <label class="form-check-label" for="flexRadioDefault1">
                                @lang('auth.delivery-on-me')
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
                        <label for="exampleFormControlTextarea1" wire:model.lazy="notes" class="form-label">{{__("names.notes")}}</label>
                        <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>

            </div>
        </div>
        <div class="card col-lg-12 my-2">
            <div class="card-header">@lang('names.consignee-details')</div>
            <div class="card-body">

                <div class="form-group row">
                    <label for="product_name" class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.product_name")}}</label>
                    <div class="col-md-6">
                        <input  type="text" wire:model.lazy="product_name" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}"  autocomplete="name" autofocus>
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
                        <input  type="text" wire:model.lazy="cust_name"  class="form-control @error('cust_name') is-invalid @enderror" name="cust_name" value="{{ old('cust_name') }}"  >
                        @error('cust_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cust_num "  class="col-md-4 col-form-label text-md-right">{{__("names.order")}} {{__("auth.cust_num")}}</label>
                    <div class="col-md-6">
                        <input  type="tel" wire:model.lazy="cust_num"  class="form-control @error('cust_num') is-invalid @enderror" name="cust_num" value="{{ old('cust_num') }}"  >
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
                        <input  type="text" wire:model.lazy="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  >
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="area_id" class="col-md-4 col-form-label text-md-right">{{__('names.area')}}</label>
                    <div class="col-md-6">
                        <select name="area_id" wire:model.lazy="area_id" id="area_id" class="form-control @error('area_id') is-invalid @enderror">
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

            </div>
        </div>

    </div>
        <div class="col-md-4">
            <div class="card sticky-top">
                <div class="card-header">
                    <h4>total</h4>
                </div>
                <div class="card-body">
                    <p>      @lang('auth.value'):  {{$value}}   </p>
                    <p>      @lang('auth.quantity'):  {{$quantity }}   </p>
                    <p>       @lang('auth.delivery-cost') :  {{$cost}}   </p>
                    <p>       @lang('auth.package-weight') :  {{  $weight}}   </p>
                    <p>      @lang('auth.package-over-weight') :  {{  $overWeight}}   </p>
                    <p>     @lang('auth.package-over-weight-cost') :  {{  $overWeightCost}}   </p>
                    <hr>
                    <p>     @lang('auth.tax'):  {{$tax}}   </p>
                    <p>     @lang('auth.total') :  {{$total}}   </p>
                </div>
            </div>
        </div>








            <div class="form-group  col-md-6 ">

                    <button type="submit" class="btn btn-success w-100 my-3">
                        {{ __('auth.create') }}
                    </button>

            </div>

        </div>
    </form>


</div>
