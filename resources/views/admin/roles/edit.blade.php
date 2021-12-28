@extends('admin.layouts.admin')
@section('page-header')
    <h1>@lang("auth.edit") @lang("names.role") {{$role->name}}  </h1>
    <a href="{{route('admin.roles.index')}}" class="btn btn-primary">@lang("names.manage-roles")</a>
@endsection
@section('content')

        <div class="row ">
            <div class="col-md-8">

                <form method="POST" action="{{ route('admin.roles.update',$role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="name" class=" col-form-label text-md-right">@lang("auth.role-name")</label>
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$role->name}}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6 offset-md-4">
                            @foreach($permissions as $permission)
                                <input type="checkbox" id="{{$permission->name}}" name="permissions[]" value="{{$permission->name}}"  @if(in_array($permission->id ,$rolePermissions)) @lang('checked')}}@endif >
                                <label for="{{$permission->name}}">{{$permission->name}}</label><br>
                            @endforeach
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

