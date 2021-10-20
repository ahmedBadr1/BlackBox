@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.branches.index')}}">{{__("names.manage")}} {{__("names.branches")}}</a>
                <h1 class="text-center"> {{__("names.branch")}} {{$branch->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.branch")}} {{__("auth.name")}}</label>
                <p><b>{{$branch->name}}</b></p> <hr>
                <label>{{__("names.branch")}} {{__("auth.phone")}}</label>
                <p><b>{{$branch->phone}}</b></p> <hr>
                <label>{{__("names.branch")}} {{__("auth.location")}}</label>
                <p><b><a href="{{route('admin.locations.show',$branch->location->id)}}">{{$branch->location->name }}</a></b></p> <hr>
                <label>{{__("names.branch")}} {{__("auth.state")}}</label>
                <p><b>{{$branch->state->name }}</b></p> <hr>
                <label>{{__("names.branch")}} {{__("auth.manager")}}</label>
                <p><b><a href="{{route('admin.users.show',$branch->manager->id)}}">{{$branch->manager->name }}</a></b></p> <hr>

                <label>{{__("names.branch")}} {{__("names.users")}}</label>
                <p>
                    @foreach($branch->users as $user)
                        <b class="m-2">
                            <a href="{{route('admin.users.show',$user->id)}}">  {{ $user->name }}</a>
                        </b>
                    @endforeach
                </p> <hr>
                <div class="d-flex ">
                    @if($branch->active)
                        @can('branch-close')
                            <a href="{{ route('admin.branches.close',$branch->id) }}" class="btn btn-info ">{{__("auth.close")}}</a>
                        @endcan
                    @else
                        @can('branch-open')
                            <a href="{{ route('admin.branches.open',$branch->id) }}" class="btn btn-info ">{{__("auth.open")}}</a>
                        @endcan
                    @endif
                        @can('branch-edit')
                            <a href="{{ route('admin.branches.edit',$branch->id) }}" class="btn btn-info ">{{__("auth.edit")}}</a>
                        @endcan
                    @can('branch-delete')
                        <form class="ml-5" action="{{route('admin.branches.destroy',$branch->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="{{__("auth.delete")}}">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

