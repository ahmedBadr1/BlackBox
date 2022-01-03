@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("auth.create-branch")</h1>
    <div class="">
        <a href="{{route('admin.branches.index')}}" class="btn btn-primary">@lang("names.manage-branches")</a>
    </div>

@endsection
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('admin.branches.store') }}">
                    @csrf
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="name" class=" col-form-label text-md-right">@lang("auth.branch-name")</label>
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="phone" class=" col-form-label text-md-right"> @lang("auth.phone")</label>
                            <input  type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="name" autofocus>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="address" class="col-form-label text-md-right"> @lang("auth.address")</label>
                            <input  type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  autocomplete="name" autofocus>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="state" class="col-form-label text-md-right">@lang('names.state')</label>
                            <select name="state_id" id="state_id" class="form-control select2 @error('state_id') is-invalid @enderror">
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
                        <div class="col-md-6 ">
                            <label for="state" class="col-form-label text-md-right">@lang('auth.manager')</label>
                            <select name="user_id" id="user_id" class="form-control select2">
                                <option value="">@lang('auth.select-manager')</option>
                                @foreach($managers as $manager)
                                    <option value="{{$manager->id}}">{{$manager->name}}</option>
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
                            <button type="submit" class="btn btn-success">
                                @lang('auth.create')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection

