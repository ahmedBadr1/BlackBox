@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("auth.create-plan")</h1>
   <div class="">
       <a href="{{route('admin.plans.index')}}" class="btn btn-primary">@lang("names.manage-plans")</a>
   </div>

@endsection
@section('content')

        <div class="row ">
            <div class="col-md-4">
                <form method="POST" action="{{ route('admin.plans.store') }}">
                    @csrf
                    <div class="form-group row">

                        <div class="col-md-12">
                            <label for="name" class="col-form-label text-md-right">@lang("auth.plan-name") </label>

                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="orders_count" class=" col-form-label text-md-right"> @lang("names.orders-count")</label>
                            <input  type="number" class="form-control @error('orders_count') is-invalid @enderror" name="orders_count" value="{{ old('orders_count') }}" >

                            @error('orders_count')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="pickup_cost" class=" col-form-label text-md-right"> @lang("auth.pickup-cost")</label>
                            <input  type="number" class="form-control @error('pickup_cost') is-invalid @enderror" name="pickup_cost" value="{{ old('pickup_cost') }}"  >

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
                                <input type="checkbox" id="{{$feature->name}}" name="features[]" value="{{$feature->id}}">
                                <label for="{{$feature->name}}">{{$feature->name}}</label><br>
                            @endforeach
                            @error('features')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                @lang('auth.create')
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-md-8">
                    <div class="form-group row mb-0">

                    @foreach($areas as $area)
                            <div class="col-md-6">
                                <label for="{{$area->name}}">{{$area->name}}</label><br>
                        <input type="number" id="{{$area->name}}" name="area[{{$area->id}}]" value="{{old('areas['.$area->id.']')}}" class="form-control">
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

