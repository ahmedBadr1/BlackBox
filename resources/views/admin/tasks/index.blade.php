@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.all-tasks')</h1>
    <div class="">
        @can('task-create')
            <a href="{{route('admin.tasks.create')}}" class="btn btn-success">@lang('auth.create-task')</a>
        @endcan
        @can('task-archive')
            <a href="{{route('admin.tasks.archive')}}" class="btn btn-dark">@lang('names.archive')</a>
        @endcan
    </div>
@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">

                <table class="table table-hover table-responsive-md">

                    <thead>
                    <th>@lang('auth.id')</th>
                    <th>@lang('auth.username')</th>
                    <th>@lang('auth.type')</th>
                    <th>@lang('auth.assign-to')</th>
                    <th>@lang('auth.created-at')</th>



                    </thead>

                    <tbody>

                    @foreach($tasks as $task)

                        <tr>
                            <td>{{$task->id}} </td>
                            <td> <a href="{{ route('admin.users.show',$task->user->id) }}"> {{$task->user->name}} </a></td>

                            <td>{{$task->type}} </td>
                            @if($task->delivery_id)
                            <td><a href="{{ route('admin.users.show',$task->delivery->id) }}"> {{$task->delivery->name}} </a> </td>
                            @else
                                <td><a href="{{route('admin.tasks.assign')}}" class="btn btn-primary">@lang('auth.assign')</a></td>
                                @endif
                            <td>
                                    {{$task->created_at->diffForHumans()}}
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
                            @can('task-done')
                                <td>
                                    <form action="{{route('admin.tasks.done',$task->id) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-secondary"  value="@lang('auth.done')">
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

