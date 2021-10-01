@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">All tasks</h1>
                @can('task-create')
                    <a href="{{route('admin.tasks.create')}}" class="btn btn-success">Create Task</a>
                @endcan
                @can('task-archive')
                    <a href="{{route('admin.tasks.archive')}}" class="btn btn-dark">Archive</a>
                @endcan
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-hover">

                    <thead>
                    <th>ID</th>
                    <th>belong to</th>
                    <th>Type</th>
                    <th>assign_to</th>
                    <th>created_at</th>



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
                                <td><a href="{{route('admin.tasks.assign')}}" class="btn btn-primary">assign</a></td>
                                @endif
                            <td>{{$task->created_at}} </td>

                            @can('task-edit')
                                <td><a href="{{ route('admin.tasks.edit',$task->id) }}" class="btn btn-info">edit</a></td>
                            @endcan
                            @can('task-delete')
                            <td>
                               <form action="{{route('admin.tasks.destroy',$task->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                <input type="submit" class="btn btn-danger" name="delete" value="delete">
                               </form>
                            </td>
                            @endcan
                            @can('task-done')
                                <td>
                                    @if(!$task->done_at)
                                    <form action="{{route('admin.tasks.done',$task->id) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-secondary"  value="done">
                                    </form>
                                    @else
                                        <form action="{{route('admin.tasks.undone',$task->id) }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-secondary"  value="undone">
                                        </form>
                                    @endif
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

