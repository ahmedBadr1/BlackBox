@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">{{$branch->name}} @lang("auth.assign") </h1>
    <div class="">
        <a href="{{route('admin.branches.index')}}">@lang("names.manage-branches") </a>
    </div>
@endsection
@section('content')

        <div class="row">
            <div class="col-md-12">
                <form action="{{route('admin.branches.assign',$branch->id)}}" method="POST">
                    @csrf

                    <div class="form-group row mb-0">
                        <div class="col-md-10">
                            <select name="users[]" id="" class="select2 form-control" multiple>
                            @foreach($users as $user)
                                    <option value="{{$user->id}}"  @if($user->branch_id === $branch->id) selected @endif>{{$user->name}}</option>
                            @endforeach
                            </select>
                        @error('users')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success">
                                @lang('auth.assign')
                            </button>
                        </div>
                    </div>

                </form>


            </div>
        </div>

@endsection

