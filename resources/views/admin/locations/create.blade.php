@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("auth.create-location")</h1>
    <a href="{{route('admin.locations.index')}}" class="btn btn-primary">@lang("names.manage-locations")</a>
@endsection
@section('content')

        <div class="row ">
            <div class="col-md-12">
                <form method="POST" action="{{ route('admin.locations.store') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="name" class=" col-form-label text-md-right">@lang("names.location-name")</label>
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row ">

                        <div class="col-md-6 ">
                            <label for="state_id" class=" col-form-label text-md-right"> @lang("auth.state")</label>
                            <select name="state_id" class="form-control select2"  >
                                <option value="">@lang('auth.select-state')</option>
                            @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                            </select>
                            @error('state_id')

                                        <strong>{{ $message }}</strong>

                            @enderror
                        </div>
                        <div class="col-md-6 ">
                            <label for="area_id" class="col-form-label text-md-right"> @lang("auth.area")</label>
                            <select name="area_id"  class="form-control select2" >
                                <option value="">@lang('auth.select-area')</option>
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                            @error('area_id')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group row">

                        <div class="col-md-12">
                            <label for="orders_count" class="col-form-label text-md-right">@lang("auth.street")</label>
                            <input  type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" >
                            @error('street')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>




                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="building" class=" col-form-label text-md-right">@lang("auth.building")</label>
                            <input  type="text" class="form-control @error('building') is-invalid @enderror" name="building" value="{{ old('building') }}" >
                            @error('building')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="floor" class=" col-form-label text-md-right">@lang("auth.floor")</label>
                            <input  type="text" class="form-control @error('floor') is-invalid @enderror" name="building" value="{{ old('floor') }}" >
                            @error('floor')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="apartment" class=" col-form-label text-md-right">@lang("auth.apartment")</label>
                            <input  type="text" class="form-control @error('apartment') is-invalid @enderror" name="apartment" value="{{ old('apartment') }}" >
                            @error('apartment')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="landmarks" class=" col-form-label text-md-right">@lang("auth.landmarks")</label>
                            <input  type="text" class="form-control @error('landmarks') is-invalid @enderror" name="landmarks" value="{{ old('landmarks') }}" >
                            @error('landmarks')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

{{--                    <div class="form-group row">--}}

{{--                        <div class="col-md-6">--}}
{{--                            <label for="latitude" class=" col-form-label text-md-right">@lang("auth.latitude")</label>--}}
{{--                            <input  type="number" step="00.000001" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude') }}" >--}}
{{--                            @error('latitude')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <label for="longitude" class=" col-form-label text-md-right">@lang("auth.longitude")</label>--}}
{{--                            <input  type="number"  step="00.000001" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude') }}" >--}}
{{--                            @error('longitude')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}


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
        </div>
@endsection

