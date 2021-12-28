@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("auth.edit") @lang ("auth.plan")</h1>
    <a href="{{route('admin.plans.index')}}" class="btn btn-primary">@lang("names.manage-plans")</a>
@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="{{ route('admin.plans.update',$plan->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">


                        <div class="col-md-12">
                            <label for="name" class="col-form-label text-md-right">@lang("names.plan-name")</label>
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $plan->name }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="orders_count" class="col-form-label text-md-right">@lang("auth.orders_count")</label>

                            <input  type="number" class="form-control @error('orders_count') is-invalid @enderror" name="orders_count" value="{{ $plan->orders_count }}" >

                            @error('orders_count')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="pickup_cost" class=" col-form-label text-md-right"> @lang("auth.pickup_cost")</label>
                            <input  type="number" class="form-control @error('pickup_cost') is-invalid @enderror" name="pickup_cost" value="{{ $plan->pickup_cost }}"  >

                            @error('pickup_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 ">
                            @foreach($features as $feature)
                                <input type="checkbox" id="{{$feature->name}}" name="features[]" value="{{$feature->id}}" @if(in_array($feature->id ,$planFeatures)) @lang('checked')}}@endif>
                                <label for="{{$feature->name}}">{{$feature->name}}</label><br>
                            @endforeach
                            @error('permissions')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-info">
                                @lang('auth.edit')
                            </button>
                        </div>
                    </div>
            </div>
                    <div class="col-md-8">
                        <div class="form-group row mb-0">

                            @foreach($areas as $area)
                                <div class="col-md-6">
                                    <label for="{{$area->name}}">{{$area->name}}</label><br>
                                    <input type="number" id="{{$area->name}}" name="area[{{$area->id}}]"
                                           @if(array_key_exists($area->id , $plan->area))
                                           value="{{$plan->area[$area->id]}}"
                                               @endif

                                           class="form-control">
                                </div>
                            @endforeach
                            @error('area')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
            </div>


                </form>
            </div>
        </div>
    </div>
@endsection

