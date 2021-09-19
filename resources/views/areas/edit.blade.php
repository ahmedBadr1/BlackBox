@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('areas.index')}}">Manage Areas</a>
                <h1 class="text-center">Edit Area</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('areas.update',$area->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Area Name</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$area->name}}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="delivery_cost" class="col-md-4 col-form-label text-md-right">Area delivery_cost</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('delivery_cost') is-invalid @enderror" name="delivery_cost" value="{{ $area->delivery_cost}}"  >
                            @error('delivery_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="return_cost" class="col-md-4 col-form-label text-md-right">Area return_cost</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('return_cost') is-invalid @enderror" name="return_cost" value="{{ $area->return_cost}}"  >
                            @error('return_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="replacement_cost" class="col-md-4 col-form-label text-md-right">Area replacement_cost</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('replacement_cost') is-invalid @enderror" name="replacement_cost" value="{{ $area->replacement_cost}}"  >
                            @error('replacement_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="over_weight_cost" class="col-md-4 col-form-label text-md-right">Area over_weight_cost</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('over_weight_cost') is-invalid @enderror" name="over_weight_cost" value="{{ $area->over_weight_cost}}"  >
                            @error('over_weight_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="time_delivery" class="col-md-4 col-form-label text-md-right">Area time_delivery</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('time_delivery') is-invalid @enderror" name="time_delivery" value="{{ $area->time_delivery}}"  >
                            @error('time_delivery')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="zone_id" class="col-md-4 col-form-label text-md-right">Zone</label>
                        <div class="col-md-6">
                            <select class="js-example-basic-multiple form-control" name="zone_id" id="zonesSelect">
                                @foreach($zones as $zone)
                                    <option value="{{$zone->id}}"
                                            @if($zone->id === $area->zone)
                                    selected
                                        @endif >{{$zone->name}}</option>
                                @endforeach
                            </select>
                            @error('zone')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

{{--                    <div class="form-group row">--}}
{{--                        <label for="state" class="col-md-4 col-form-label text-md-right">{{__('state')}}</label>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <select name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror">--}}
{{--                                <option value="" selected>{{__('names.select state')}}</option>--}}
{{--                                @foreach($states as $state)--}}
{{--                                    <option value="{{$state->id}}"--}}
{{--                                            @if($state->id === $area->state_id)--}}
{{--                                            selected--}}
{{--                                        @endif>{{$state->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('state_id')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-info">
                                {{ __('Edit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

