@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('auth.edit') {{$user->name}}</h1>
    <div class="">
        <a href="{{route('admin.roles.index')}}" class="btn btn-primary">@lang('names.manage-roles')</a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">@lang('names.manage-users')</a>
    </div>
@endsection
@section('content')

        <div class="row ">
            <div class="col-md-12">


                <form method="POST" action="{{route('admin.users.update',$user->id)}}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name" class="col-form-label text-md-right">@lang('auth.name')</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class=" col-form-label text-md-right">@lang('auth.email')</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="email">

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
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone  }}"  autocomplete="phone">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="state" class=" col-form-label text-md-right">@lang('auth.state')</label>

                            <select name="state_id" class="form-control"  >
                                @foreach($states as $state)
                                    <option value="{{$state->id}}" @if($state->name=== $user->state)
                                        @lang('selected')
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
                        <div class="col-md-4">
                            <label for="role" class="col-form-label text-md-right">@lang('names.role') </label>
                            <select name="role" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{$role}}" @if($role=== $userRole  )
                                    @lang('selected')
                                    @endif>{{$role}}</option>
                             @endforeach
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                @lang('auth.edit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



