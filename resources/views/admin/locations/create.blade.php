@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{route('admin.locations.index')}}">{{__("names.manage")}} {{__("names.locations")}}</a>
                <h1 class="text-center">{{__("auth.create")}} {{__("names.location")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.locations.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{__("names.location")}} {{__("auth.name")}}</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label for="state_id" class="col-md-4 col-form-label text-md-right">{{__("names.location")}} {{__("auth.state")}}</label>
                        <div class="col-md-6 ">
                            <select name="state_id" class="form-control " >
                                <option value="">select State</option>
                            @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                            </select>
                            @error('state_id')

                                        <strong>{{ $message }}</strong>

                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label for="area_id" class="col-md-4 col-form-label text-md-right">{{__("names.location")}} {{__("auth.state")}}</label>
                        <div class="col-md-6 ">

                            <select name="area_id"  class="form-control " >
                                <option value="">select Area</option>
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
                        <label for="orders_count" class="col-md-4 col-form-label text-md-right">{{__("auth.street")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" >
                            @error('street')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="building" class="col-md-4 col-form-label text-md-right">{{__("auth.building")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('building') is-invalid @enderror" name="building" value="{{ old('building') }}" >
                            @error('building')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="floor" class="col-md-4 col-form-label text-md-right">{{__("auth.floor")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('floor') is-invalid @enderror" name="building" value="{{ old('floor') }}" >
                            @error('floor')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apartment" class="col-md-4 col-form-label text-md-right">{{__("auth.apartment")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('apartment') is-invalid @enderror" name="apartment" value="{{ old('apartment') }}" >
                            @error('apartment')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="landmarks" class="col-md-4 col-form-label text-md-right">{{__("auth.landmarks")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('landmarks') is-invalid @enderror" name="landmarks" value="{{ old('landmarks') }}" >
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
                            <input  type="number" step="00.000001" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude') }}" >
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
                            <input  type="number"  step="00.000001" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude') }}" >
                            @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
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
    </div>
@endsection

