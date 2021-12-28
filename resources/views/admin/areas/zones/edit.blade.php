@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("auth.create-zone")}} @lang("names.")}}</h1>

    <a href="{{route('admin.zones.index')}}" class="btn btn-primary">@lang("names.manage-zones")</a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('admin.zones.update',$zone->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang("names.zone-name")</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $zone->name }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="state" class="col-md-4 col-form-label text-md-right">@lang('areas')</label>
                        <div class="col-md-8 offset-md-4">
                            <select class="form-select w-75 p-1"  name="areas_id[]" multiple  aria-label="multiple select example">
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}"  @foreach($zone->areas as $area) @if($area->id === $zarea->id)
                                    selected
                                        @endif
                                    @endforeach >{{$area->name}}</option>
                                @endforeach
                            </select>
                            @error('areas_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="state_id" class="col-md-4 col-form-label text-md-right">@lang('state')}}</label>
                        <div class="col-md-6">
                            <select name="state_id" id="state_id" class="form-control select-2 @error('state') is-invalid @enderror">
                                <option value="" selected>@lang('auth.select-state')</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}"   @if($state->id === $zone->state_id)
                                    selected
                                        @endif>{{$state->name}}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                @lang('auth.edit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

