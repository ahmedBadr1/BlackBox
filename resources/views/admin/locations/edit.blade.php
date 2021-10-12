@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{route('admin.locations.index')}}">{{__("names.manage")}} {{__("auth.locations")}}</a>
                <h1 class="text-center">{{__("auth.edit")}} {{__("auth.location")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.locations.update',$location->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{__("names.location")}} {{__("auth.name")}}</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $location->name }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="state" class="col-md-4 col-form-label text-md-right">{{__('auth.state')}}</label>

                        <div class="col-md-6">
                            <select name="state_id" class="form-select" aria-label="Default select example" >
                                @foreach($states as $state)
                                    <option value="{{$state->id}}" @if($state->id=== $location->state_id)
                                        {{ __('selected') }}
                                        @endif>{{$state->name}}</option>
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
                        <label for="state" class="col-md-4 col-form-label text-md-right">{{__('auth.state')}}</label>

                        <div class="col-md-6">
                            <select name="area_id" class="form-select" aria-label="Default select example" >
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}" @if($area->id=== $location->area_id)
                                        {{ __('selected') }}
                                        @endif>{{$area->name}}</option>
                                @endforeach
                            </select>
                            @error('area_id')

                                        <strong>{{ $message }}</strong>

                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="street" class="col-md-4 col-form-label text-md-right">{{__("names.location")}} {{__("auth.street")}}</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="street" value="{{ $location->street }}" >
                            @error('street')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="building" class="col-md-4 col-form-label text-md-right">{{__("names.location")}} {{__("auth.building")}}</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('building') is-invalid @enderror" name="building" value="{{ $location->building }}" >
                            @error('building')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="floor" class="col-md-4 col-form-label text-md-right">{{__("names.location")}} {{__("auth.floor")}}</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('floor') is-invalid @enderror" name="floor" value="{{ $location->floor }}"  >
                            @error('floor')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apartment" class="col-md-4 col-form-label text-md-right">{{__("names.location")}} {{__("auth.apartment")}}</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('apartment') is-invalid @enderror" name="apartment" value="{{ $location->apartment }}"  >
                            @error('apartment')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="landmarks" class="col-md-4 col-form-label text-md-right">{{__("names.location")}} {{__("auth.landmarks")}}</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('landmarks') is-invalid @enderror" name="landmarks" value="{{ $location->landmarks }}"  >
                            @error('landmarks')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="latitude" class="col-md-4 col-form-label text-md-right">{{__("auth.latitude")}}</label>
                        <div class="col-md-6">
                            <input  type="number" step="00.000001" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ $location->latitude }}" >
                            @error('latitude')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="longitude" class="col-md-4 col-form-label text-md-right">{{__("auth.longitude")}}</label>
                        <div class="col-md-6">
                            <input  type="number"  step="00.000001" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ $location->longitude }}" >
                            @error('longitude')
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



                </form>
            </div>
        </div>
    </div>
@endsection

