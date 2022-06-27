@extends('admin.layouts.admin')
@section('page-header')
    <h1 >@lang('auth.create-user')</h1>
    <div class="">
        <a href="{{route('admin.roles.index')}}" class="btn btn-primary">@lang('names.manage-roles')</a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">@lang('names.manage-users')</a>
    </div>
@endsection
@section('content')

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('admin.users.index') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name" class=" col-form-label text-md-right">@lang('auth.name')</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class=" col-form-label text-md-right">@lang('auth.email')</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="phone" class=" col-form-label text-md-right">@lang('auth.phone')</label>
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="col-form-label text-md-right">@lang('auth.state')</label>
                            <select name="state_id" id="state_id" class="form-control select2 @error('state_id') is-invalid @enderror">
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
                        <div class="col-md-4">
                            <label for="role" class=" col-form-label text-md-right">@lang('names.role')</label>

                            <select name="role" class="form-control select2"  >
                                @foreach($roles as $role)
                                    <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="password" class="col-form-label text-md-right">@lang('auth.pass')</label>

                            <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password"  >

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password-confirm" class=" col-form-label text-md-right">@lang('auth.conpass')</label>
                            <input  type="password" class="form-control" name="password_confirmation"  >
                        </div>
                    </div>



                    <div class="form-group row mb-0">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success">
                                @lang('Create')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

