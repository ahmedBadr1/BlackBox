@extends('admin.layouts.admin')
@section('page-header')
    <h1 >@lang('names.all-tasks')</h1>
    <div class="">
        @can('task-create')
            <a href="{{route('admin.tasks.create')}}" class="btn btn-success">@lang('auth.create-task')</a>
        @endcan
        @can('task-archive')
            <a href="{{route('admin.tasks.archive')}}" class="btn btn-dark">@lang('auth.archive')</a>
        @endcan

    </div>
@endsection
@section('content')
        <div class="row ">
            <div class="col-md-12">

                <table class="table table-hover">

                    <thead>
                    <th>@lang('auth.id')</th>
                    <th>@lang('auth.username')</th>
                    <th>@lang('auth.type')</th>
                    <th>@lang('auth.assign-to')</th>
                    <th>@lang('auth.done-at')</th>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)

                        <tr>
                            <td>{{$task->id}} </td>
                            <td> <a href="{{ route('admin.users.show',$task->user->id) }}"> {{$task->user->name}} </a></td>

                            <td>{{$task->type}}</td>
                            @if($task->delivery_id)
                                <td><a href="{{ route('admin.users.show',$task->delivery->id) }}"> {{$task->delivery->name}} </a> </td>
                            @else
                                <td><a href="{{route('admin.tasks.assign')}}" class="btn btn-primary">assign</a></td>
                            @endif
                            <td>
                                    {{ $task->done_at_for_humans}}
                            </td>

                            @can('task-edit')
                                <td><a href="{{ route('admin.tasks.edit',$task->id) }}" class="btn btn-info">@lang('auth.edit')</a></td>
                            @endcan
                            @can('task-delete')
                                <td>
                                    <form action="{{route('admin.tasks.destroy',$task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger" name="delete" value="@lang('auth.delete')">
                                    </form>
                                </td>
                            @endcan
                            @can('task-undone')
                                <td>
                                        <form action="{{route('admin.tasks.undone',$task->id) }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-secondary"  value="undone">
                                        </form>
                                </td>
                            @endcan
                        </tr>
                    @endforeach

                    </tbody>

                </table>


                {{ $tasks->links() }}


            </div>
        </div>
    </div>


@endsection

