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
                        <label for="cost" class="col-md-4 col-form-label text-md-right">Area price</label>

                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ $area->cost }}"  >

                            @error('cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tags" class="col-md-4 col-form-label text-md-right">Zones</label>
                        <div class="col-md-6">
                            <select class="js-example-basic-multiple form-control" name="tags" id="zonesSelect">
                                @foreach($zones as $zone)
                                    <option value="{{$zone}}"
                                            @if($zone === $area->zone)
                                    selected
                                        @endif >{{$zone}}</option>
                                @endforeach
                            </select>
                            @error('zone')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="state" class="col-md-4 col-form-label text-md-right">{{__('state')}}</label>
                        <div class="col-md-6">
                            <select name="state" id="state" class="form-control @error('state') is-invalid @enderror">
                                <option value="" selected>{{__('names.select state')}}</option>
                                @foreach(\App\Models\Area::$states as $state)
                                    <option value="{{$state}}"
                                            @if($state === $area->state)
                                            selected
                                        @endif>{{$state}}</option>
                                @endforeach
                            </select>
                            @error('state')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


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

