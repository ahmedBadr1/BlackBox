@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.zones.index')}}">@lang("names.manage")}} @lang("names.zones")}}</a>
                <h1 class="text-center">@lang("auth.create")}} @lang("names.zone")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.zones.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang("names.zone")}} @lang("auth.name")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rank" class="col-md-4 col-form-label text-md-right">@lang("names.branch")}} @lang("auth.rank")}}</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('rank') is-invalid @enderror" name="rank" value="{{ old('rank') }}"  >
                            @error('rank')
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
                                <option value="" selected></option>
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
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
                        <label for="state_id" class="col-md-4 col-form-label text-md-right">@lang('state')</label>
                        <div class="col-md-6">
                            <select name="state_id" id="state_id" class="form-control @error('state') is-invalid @enderror">
                                <option value="" selected>@lang('auth.select state')</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
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
                                @lang('auth.create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

