@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">Create Area</h1>
    <div class="">
        <a href="{{route('admin.areas.index')}}" class="btn btn-primary">@lang('names.manage-areas')</a>
        <a href="{{route('admin.zones.create')}}" class="btn btn-success">@lang('auth.create-zone')</a>
    </div>

@endsection
@section('content')
        <div class="row ">
            <div class="col-md-8">
            <!-- Button trigger modal -->

{{--                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#zoneModal">@lang('auth.create')}} Zone</button>--}}
                <form method="POST" action="{{ route('admin.areas.store') }}">
                    @csrf
                    <div class="form-group row">


                        <div class="col-md-6">
                            <label for="name" class=" col-form-label text-md-right">@lang('auth.area-name')</label>
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" >

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-4">
                            <label for="delivery_cost" class=" col-form-label text-md-right">@lang('auth.delivery-cost')</label>
                            <input  type="number" class="form-control @error('delivery_cost') is-invalid @enderror" name="delivery_cost" value="{{ old('delivery_cost') }}"  >
                            @error('delivery_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="col-md-4">
                            <label for="return_cost" class=" col-form-label text-md-right">@lang('auth.return-cost')</label>
                            <input  type="number" class="form-control @error('return_cost') is-invalid @enderror" name="return_cost" value="{{ old('return_cost') }}"  >
                            @error('return_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="col-md-4">
                            <label for="replacement_cost" class=" col-form-label text-md-right">@lang('auth.replacement-cost')</label>
                            <input  type="number" class="form-control @error('replacement_cost') is-invalid @enderror" name="replacement_cost" value="{{ old('replacement_cost') }}"  >
                            @error('replacement_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="over_weight_cost" class=" col-form-label text-md-right">@lang('auth.over-weight-cost')</label>
                            <input  type="number" class="form-control @error('over_weight_cost') is-invalid @enderror" name="over_weight_cost" value="{{ old('over_weight_cost') }}"  >
                            @error('over_weight_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-4">
                            <label for="delivery_time" class="col-form-label text-md-right">@lang('auth.delivery-time') </label>
                            <input  type="number" class="form-control @error('delivery_time') is-invalid @enderror" name="delivery_time" value="{{ old('delivery_time') }}"  >
                            @error('delivery_time')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="zone_id" class=" col-form-label text-md-right">@lang('names.zones')</label>
                            <select class="select2 form-control" name="zone_id" id="zonesSelect">
                                <option value="" selected>@lang('auth.select-zone')</option>
                                @foreach($zones as $zone)
                                    <option  value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                            @error('zone_id')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="state_id" class=" col-form-label text-md-right">@lang('names.states')</label>
                            <select class="select2 form-control" name="state_id" id="stateSelect">
                                <option value="" selected>@lang('auth.select-state')</option>
                                @foreach($states as $state)
                                    <option  value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                            <strong>{{ $message }}</strong>
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
                </form>
            </div>
        </div>

@endsection

@section('script')

@endsection
