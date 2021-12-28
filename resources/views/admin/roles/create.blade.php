@extends('admin.layouts.admin')
@section('page-header')
    <h1 >@lang("auth.create-role")</h1>
    <a href="{{route('admin.roles.index')}}" class="btn btn-primary">@lang("names.manage-roles")</a>

@endsection
@section('content')

    <div class="row ">
            <div class="col-md-8">
                <form method="POST" action="{{ route('admin.roles.store') }}">
                    @csrf
                    <div class="form-group row">


                        <div class="col-md-6">
                            <label for="name" class="col-form-label text-md-right">@lang("names.role-name")</label>
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('role') }}"  autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6 offset-md-4">
                            @foreach($permissions as $permission)
                                <input type="checkbox" id="{{$permission->name}}" name="permissions[]" value="{{$permission->name}}">
                                <label for="{{$permission->name}}">{{$permission->name}}</label><br>
                            @endforeach
                            @error('permissions')
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

