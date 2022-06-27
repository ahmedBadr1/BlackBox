@extends('admin.layouts.admin')
@section('page-header')

    <h1 class="text-center">@lang('names.task') {{$task->type}}</h1>
    <div class="">
        <a href="{{route('admin.tasks.index')}}" class="btn btn-primary">@lang('names.manage-tasks')</a>
    </div>

@endsection
@section('content')
        <div class="row ">
            <div class="col-md-12">

                <label>@lang('auth.username')</label>
                <p><b> <a href="{{route('admin.tasks.show',$task->user->id)}}">{{$task->user->name}}</a></b></p> <hr>
                <label>@lang('auth.type')</label>
                <p><b>{{$task->type}}</b></p> <hr>
                <label>@lang('auth.assign-to')</label>
                <p><b>@if($task->delivery)
                        <a href="{{route('admin.tasks.show',$task->delivery->id)}}">{{$task->delivery->name}}</a>
                        @else
                            <a href="{{route('admin.tasks.assign')}}" class="btn btn-primary">@lang('auth.assign')</a>
                        @endif
                    </b></p> <hr>

                <div class="d-flex  ">
                    @can('task-edit')
                        <a href="{{ route('admin.tasks.edit',$task->id) }}" class="btn btn-info o">@lang('auth.edit')</a>
                    @endcan
                    @can('task-delete')
                        <form class="ml-5" action="{{route('admin.tasks.destroy',$task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang('auth.delete')">
                        </form>
                    @endcan
                </div>

            </div>
        </div>
    </div>
@endsection

