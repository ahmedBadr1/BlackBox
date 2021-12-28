@extends('seller.layouts.seller')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.branches.index')}}">@lang("names.manage")}} @lang("names.branches")}}</a>
                <h1 class="text-center"> @lang("names.branch")}} {{$branch->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>@lang("names.branch")}} @lang("auth.name")}}</label>
                <p><b>{{$branch->name}}</b></p> <hr>
                <label>@lang("names.branch")}} @lang("auth.phone")}}</label>
                <p><b>{{$branch->phone}}</b></p> <hr>
                <label>@lang("names.branch")}} @lang("auth.location")}}</label>
                <p><b>{{$branch->location}}</b></p> <hr>
                <label>@lang("names.branch")}} @lang("auth.state")}}</label>
                <p><b>{{$branch->state->name }}</b></p> <hr>
                <label>@lang("names.branch")}} @lang("auth.manager")}}</label>
                <p><b><a href="{{route('admin.users.show',$branch->manager->id)}}">{{$branch->manager->name }}</a></b></p> <hr>

                <label>@lang("names.branch")}} @lang("names.users")}}</label>
                <p>
                    @foreach($branch->users as $user)
                        <b class="m-2">
                            <a href="{{route('admin.users.show',$user->id)}}">  {{ $user->name }}</a>
                        </b>
                    @endforeach
                </p> <hr>
                <div class="d-flex ">
                    @can('branch-edit')
                        <a href="{{ route('admin.branches.edit',$branch->id) }}" class="btn btn-info o">@lang("auth.edit")}}</a>
                    @endcan
                    @can('branch-delete')
                        <form class="ml-5" action="{{route('admin.branches.destroy',$branch->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang("auth.delete")}}">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

