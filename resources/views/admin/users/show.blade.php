@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('auth.user') {{$user->name}}</h1>
    <a href="{{route('admin.users.index')}}" class="btn btn-primary">@lang('names.manage-users')</a>
@endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <label>@lang('auth.username')</label>
                <p><b>{{$user->name}}</b></p> <hr>
                <label>@lang('auth.email')</label>
                <p><b>{{$user->email}}</b></p> <hr>
                <label>@lang('auth.phone')</label>
                <p><b>{{$user->phone}}</b></p> <hr>
{{--                <label>User State</label>--}}
{{--                <p><b>{{$user->state->name}}</b></p> <hr>--}}
                @if($user->plan)
                <label>@lang('auth.plan')</label>
                <p><b><a href="{{route('admin.plans.show',$user->plan->id)}}">{{$user->plan->name}}</a></b></p> <hr>
                @endif
                <label>@lang('auth.role')</label>
                <p><b>
                            @foreach($user->roles as $role)
                                <a href="{{route('admin.roles.show',$role->id)}}">{{$role->name }}</a>
                            @endforeach
                    </b></p> <hr>
                @if($user->roles[0]->name === "Feedback" )
                    <div class="d-flex ">
                    you can't change this user
                    </div>
                @else
                    <div class="d-flex ">
                        @can('user-edit')

                            <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-info ">@lang('auth.edit')</a>
                        @endcan
                        @can('user-delete')
                            <form class="ml-5" action="{{route('admin.users.destroy',$user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="@lang('auth.delete')">
                            </form>
                        @endcan
                    </div>
                @endif


            </div>
        </div>
    </div>
@endsection

