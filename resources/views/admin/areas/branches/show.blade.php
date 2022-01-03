@extends('admin.layouts.admin')
@section('page-header')
    <h1> {{$branch->name}}</h1>
  <div class="">
      <a href="{{route('admin.branches.index')}}" class="btn btn-primary">@lang("names.manage-branches")</a>
  </div>
@endsection
@section('content')
        <div class="row">
            <div class="col-md-8">
                <label>@lang("auth.name")</label>
                <p><b>{{$branch->name}}</b></p> <hr>
                <label>@lang("auth.phone") </label>
                <p><b>{{$branch->phone}}</b></p> <hr>
                <label>@lang("auth.location")</label>
                <p><b>{{$branch->location }}</b></p> <hr>
                <label>@lang("auth.state")</label>
                <p><b>{{$branch->state->name }}</b></p> <hr>
                <label>@lang("auth.manager") </label>
                <p><b><a href="{{route('admin.users.show',$branch->manager->id)}}">{{$branch->manager->name }}</a></b></p> <hr>

                <label>@lang("names.users")</label>
                <p>
                    @foreach($branch->users as $user)
                        <b class="m-2">
                            <a href="{{route('admin.users.show',$user->id)}}">  {{ $user->name }}</a>
                        </b>
                    @endforeach
                </p> <hr>
                <div class="d-flex  justify-content-between">
                    @if($branch->active)
                        @can('branch-close')
                            <a href="{{ route('admin.branches.close',$branch->id) }}" class="btn btn-dark ">@lang("auth.close")</a>
                        @endcan
                    @else
                        @can('branch-open')
                            <a href="{{ route('admin.branches.open',$branch->id) }}" class="btn btn-secondary ">@lang("auth.open")</a>
                        @endcan
                    @endif
                        @can('branch-edit')
                            <a href="{{ route('admin.branches.edit',$branch->id) }}" class="btn btn-info ">@lang("auth.edit")</a>
                        @endcan
                    @can('branch-delete')
                        <form class="ml-5" action="{{route('admin.branches.destroy',$branch->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang("auth.delete")">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
@endsection

