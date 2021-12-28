@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">{{$branch->name}} @lang("names.assing") </h1>
    <a href="{{route('admin.branches.index')}}">@lang("names.manage") @lang("names.branches")}}</a>
@endsection
@section('content')

        <div class="row">
            <div class="col-md-8">
                <form action="{{route('admin.branches.assign',$branch->id)}}" method="POST">
                    @csrf

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            @foreach($users as $user)
                                    <input type="checkbox"  name="users[]" value="{{$user->id}}" @if($user->branch_id === $branch->id) @lang("checked")}} @endif>
                                    <label for="{{$user->name}}">{{$user->name}}</label><br>
                            @endforeach

                        @error('users')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                @lang('names.assign')
                            </button>
                        </div>
                    </div>

                </form>


            </div>
        </div>

@endsection

