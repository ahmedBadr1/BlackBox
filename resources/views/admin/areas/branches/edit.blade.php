@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("auth.edit-branch")</h1>
    <a href="{{ route('admin.branches.index') }}" class="btn btn-primary"  >@lang("names.manage-branches")</a>
@endsection
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('admin.branches.update',$branch->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang("auth.branch")}} @lang("auth.name")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$branch->name}}"  autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">@lang("names.branch")}} @lang("auth.phone")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $branch->phone }}" >
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="location_id" class="col-md-4 col-form-label text-md-right">@lang("names.branch")}} @lang("auth.location")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $branch->location->name }}"  >
                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="state" class="col-md-4 col-form-label text-md-right">@lang('location')</label>
                        <div class="col-md-6">
                            <select name="location_id"  class="form-control @error('location_id') is-invalid @enderror">
                                <option value="" selected>@lang('names.select location')}}</option>
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}"
                                            @if($location->id === $branch->location_id)
                                            selected
                                        @endif>{{$location->name}}</option>
                                @endforeach
                            </select>
                            @error('location_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="state" class="col-md-4 col-form-label text-md-right">@lang('state')}}</label>
                        <div class="col-md-6">
                            <select name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror">
                                <option value="" selected>@lang('names.select state')}}</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}"
                                            @if($state->id === $branch->state_id)
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
                            <select name="user_id" id="user_id">
                            @foreach($managers as $manager)
                                <option value="{{$manager->id}}" @if($manager->id === $branch->user_id) selected @endif >{{$manager->name}}</option>
                            @endforeach
                            </select>
                            @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-info">
                                @lang('auth.edit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

