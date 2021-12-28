<div class="container-fluid">


    <form method="POST" wire:change="go"  action="{{ route('admin.orders.store') }}" wire:submit.prevent="save">
        @csrf
        <div class="row">

    <div class="col-md-8">

        <div class="card col-lg-12 my-2">
            <div class="card-header">@lang('names.order-details')</div>
            <div class="card-body">

                <div class="form-group row">
                    <label for="user_id" class="col-md-4 col-form-label text-md-right">Order For @lang('names.seller')</label>
                    <div class="col-md-6">
                        <select name="user_id" wire:model.lazy="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            <option value="{{auth()->user()->id}}">For Me</option>
                            @foreach($sellers as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product_name" class="col-md-4 col-form-label text-md-right">@lang("auth.product_name")</label>
                    <div class="col-md-6">
                        <input  type="text" wire:model.lazy="product_name" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}"   >
                        @error('product_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product_description" class="col-md-4 col-form-label text-md-right">@lang("auth.product_description")</label>
                    <div class="col-md-6">
                        <input  type="text" wire:model.lazy="product_description" class="form-control @error('product_description') is-invalid @enderror" name="product_description" value="{{ old('product_description') }}"  >
                        @error('product_description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="package_type" class="col-md-4 col-form-label text-md-right">@lang('auth.package_type')</label>
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
                    <label for="packing" class="col-md-4 col-form-label text-md-right">@lang('auth.packing')</label>
                    <div class="col-md-6">
                        <select name="packing" wire:model.lazy="packing" id="packing" class="form-control @error('packing') is-invalid @enderror">
                            <option value="0">select Type</option>
                            @foreach($packing_type as $pack)
                                <option value="{{$pack->id}}" @if(old('packing') === $pack->id ) selected @endif>{{$pack->type}}</option>
                            @endforeach
                        </select>
                        @error('packing')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="value" class="col-md-4 col-form-label text-md-right">@lang("auth.value-per-one")</label>
                    <div class="col-md-6">
                        <input  type="number" wire:model.lazy="value" step="00.25" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" >
                        @error('value')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="quantity" class="col-md-4 col-form-label text-md-right">@lang("names.product") @lang("names.count")</label>
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
                    <label for="package_weight" class="col-md-4 col-form-label text-md-right">@lang("names.package_weight-kg-per-one")</label>
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
                    <label for="deliver_before" class="col-md-4 col-form-label text-md-right">@lang("names.deliver_before")</label>
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
                    <label for="deliver_before" class="col-md-4 col-form-label text-md-right">@lang("names.cod")</label>
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
                        <label for="exampleFormControlTextarea1" wire:model.lazy="notes" class="form-label">@lang("names.notes")</label>
                        <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>

            </div>
        </div>
        <div class="card col-lg-12 my-2">
            <div class="card-header">@lang('names.consignee-details')</div>
            <div class="card-body">


                <div class="form-group row">
                    <label for="cust_name" class="col-md-4 col-form-label text-md-right">@lang("names.order") @lang("auth.cust_name")</label>
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
                    <label for="cust_num "  class="col-md-4 col-form-label text-md-right">@lang("names.order") @lang("auth.cust_num")</label>
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
                    <label for="address" class="col-md-4 col-form-label text-md-right">@lang("names.order") @lang("auth.address")</label>
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
                    <label for="area_id" class="col-md-4 col-form-label text-md-right">@lang('names.area')</label>
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
                    <p>       @lang('auth.delivery-cost') :  {{$delivery_cost}}   </p>
                    <p>       @lang('auth.packing-cost') :  {{$packing_cost}}   </p>
                    <p>       @lang('auth.package-weight') :  {{  $weight}}   </p>
                    <p>      @lang('auth.package-over-weight') :  {{  $overWeight}}   </p>
                    <p>     @lang('auth.package-over-weight-cost') :  {{  $overWeightCost}}   </p>
                    <p>     @lang('auth.cost') :  {{  $cost}}   </p>
                    <hr>
                    <p>     @lang('auth.sub-total'):  {{$subTotal}}   </p>
                    <p>     @lang('auth.discount'):  {{$discount}}   </p>
                    <p>     @lang('auth.tax'):  {{$tax}}   </p>
                    <hr>
                   <h2> @lang('auth.total') :  {{$total}}</h2>
                </div>
            </div>
        </div>








            <div class="form-group  col-md-6 ">

                    <button type="submit" class="btn btn-success w-100 my-3">
                        @lang('auth.create')
                    </button>

            </div>

        </div>
    </form>


</div>
