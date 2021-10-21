<div class="">

    <form method="POST" wire:change="go"  action="{{ route('orders.store') }}" wire:submit.prevent="save">
        @csrf
        <div class="row">

            <div class="col-md-8">

                <div class="card col-lg-12 my-2">
                    <div class="card-header card-title">@lang('names.order-details')</div>
                    <div class="card-body">


                        <div class="form-group row">

                            <div class="col-md-4">
                                <label for="product_name" class=" col-form-label text-md-right">{{__("auth.product-name")}}</label>
                                <input  type="text" wire:model.lazy="product_name" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}"   >
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="product_description" class="col-form-label text-md-right">{{__("auth.product-description")}}</label>
                                <input  type="text" wire:model.lazy="product_description" class="form-control @error('product_description') is-invalid @enderror" name="product_description" value="{{ old('product_description') }}"  >
                                @error('product_description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="package_type" class=" col-form-label text-md-right">{{__('auth.package-type')}}</label>
                                <select name="package_type" wire:model.lazy="package_type" id="package_type" class="form-control @error('package_type') is-invalid @enderror">
                                    <option value="">@lang('auth.select-package-type')</option>
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
                            <div class="col-md-4">
                                <label for="packing" class=" col-form-label text-md-right">{{__('auth.packing')}}</label>
                                <select name="packing" wire:model.lazy="packing" id="packing" class="form-control @error('packing') is-invalid @enderror">
                                    <option value="0">@lang('auth.select-packing-type')</option>
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
                            <div class="col-md-4">
                                <label for="deliver_before" class="col-form-label text-md-right">{{__("auth.deliver-before")}}</label>
                                <input  type="datetime-local" wire:model.lazy="deliver_before" class="form-control @error('deliver_before') is-invalid @enderror" name="deliver_before" value="{{ old('deliver_before')  }}" >
                                @error('deliver_before')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="value" class="col-form-label text-md-right">{{__("auth.value-per-one")}}</label>
                                <input  type="number" wire:model.lazy="value" step="00.25" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" >
                                @error('value')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="quantity" class=" col-form-label text-md-right">{{__("auth.product-count")}}</label>
                                <input  type="number" wire:model.lazy="quantity"  class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') ?? 1 }}" >
                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="package_weight" class=" col-form-label text-md-right">{{__("auth.package-weight-kg-per-one")}} <small>@lang('auth.kg-per-one')</small></label>
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

                            <div class="col-md-3">
                                <label for="deliver_before" class=" col-form-label text-md-right">{{__("auth.cod")}}</label>
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
                            <div class="col-md-9 ">
                                <label for="exampleFormControlTextarea1" wire:model.lazy="notes" class="form-label">{{__("names.notes")}}</label>
                                <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card col-lg-12 my-2">
                    <div class="card-header card-title">@lang('names.consignee-details')</div>
                    <div class="card-body">


                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="cust_name" class="col-form-label text-md-right">{{__("auth.cust-name")}}</label>
                                <input  type="text" wire:model.lazy="cust_name"  class="form-control @error('cust_name') is-invalid @enderror" name="cust_name" value="{{ old('cust_name') }}"  >
                                @error('cust_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="cust_num "  class=" col-form-label text-md-right">{{__("auth.cust-num")}}</label>
                                <input  type="tel" wire:model.lazy="cust_num"  class="form-control @error('cust_num') is-invalid @enderror" name="cust_num" value="{{ old('cust_num') }}"  >
                                @error('cust_num')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">

                            <div class="col-md-8">
                                <label for="address" class=" col-form-label text-md-right">{{__("auth.address")}}</label>
                                <input  type="text" wire:model.lazy="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  >
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="area_id" class="col-form-label text-md-right">{{__('names.area')}}</label>
                                <select name="area_id" wire:model.lazy="area_id" id="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                    <option value="">@lang('auth.select-area')</option>
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
            <div class="col-md-4 position-relative">
                <div class="card position-sticky ">
                    <div class="card-header card-title">
                       @lang('auth.total')
                    </div>
                    <div class="card-body">
                        <p>      @lang('auth.value'): <b>  {{$value}} </b>  </p>
                        <p>      @lang('auth.quantity'): <b>  {{$quantity }} </b>  </p>
                        <p>       @lang('auth.delivery-cost') : <b>  {{$delivery_cost}} </b>  </p>
                        <p>       @lang('auth.packing-cost') : <b>  {{$packing_cost}}  </b> </p>
                        <p>       @lang('auth.package-weight') : <b>  {{  $weight}}  </b> </p>
                        <p>      @lang('auth.package-over-weight') : <b>  {{  $overWeight}}  </b> </p>
                        <p>     @lang('auth.package-over-weight-cost') : <b>  {{  $overWeightCost}} </b>  </p>
                        <p>     @lang('auth.cost') : <b>  {{  $cost}} </b>  </p>
                        <hr>
                        <p>     @lang('auth.sub-total'):<b>   {{$subTotal}} </b> </p>
                        <p>     @lang('auth.discount'): <b>  {{$discount}}  </b> </p>
                        <p>     @lang('auth.tax'): <b>  {{$tax}}   </b></p>
                        <hr>
                        <h2 class="card-title"> @lang('auth.total') :<b>   {{$total}} </b></h2>
                    </div>
                </div>
                <button type="submit" class="btn btn-success-gradient w-100 m-auto ">
                    {{ __('auth.create') }}
                </button>
            </div>
            <div class="col-md-4">

            </div>




        </div>
    </form>


</div>
