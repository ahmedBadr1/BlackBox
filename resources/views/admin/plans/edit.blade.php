@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="{{route('admin.plans.index')}}">{{__("names.manage")}} {{__("auth.plan")}}</a>
                <h1 class="text-center">{{__("auth.edit")}} {{__("auth.plan")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.plans.update',$plan->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{__("names.plan")}} {{__("auth.name")}}</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $plan->name }}"  autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="orders_count" class="col-md-4 col-form-label text-md-right">{{__("names.plan")}} {{__("auth.orders_count")}}</label>

                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('orders_count') is-invalid @enderror" name="orders_count" value="{{ $plan->orders_count }}" >

                            @error('orders_count')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pickup_cost" class="col-md-4 col-form-label text-md-right">{{__("names.plan")}} {{__("auth.pickup_cost")}}</label>

                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('pickup_cost') is-invalid @enderror" name="pickup_cost" value="{{ $plan->pickup_cost }}"  >

                            @error('pickup_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            @foreach($features as $feature)
                                <input type="checkbox" id="{{$feature->name}}" name="features[]" value="{{$feature->id}}" @if(in_array($feature->id ,$planFeatures)) {{__('checked')}}@endif>
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
                                {{ __('auth.edit') }}
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

