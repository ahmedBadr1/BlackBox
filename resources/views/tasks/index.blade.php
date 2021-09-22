@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">All tasks</h1>
                @can('task-create')
                    <a href="{{route('tasks.create')}}" class="btn btn-success">Create Task</a>
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
                            <td> <a href="{{ route('users.show',$task->user_id) }}"> {{$task->user_id}} </a></td>

                            <td>{{$task->type}} </td>
                            <td><a href="{{ route('users.show',$task->assign_to) }}"> {{$task->assign_to}} </a> </td>
                            <td>{{$task->created_at}} </td>

                            @can('task-edit')
                                <td><a href="{{ route('tasks.edit',$task->id) }}" class="btn btn-info">edit</a></td>
                            @endcan
                            @can('task-delete')
                            <td>
                               <form action="{{route('tasks.destroy',$task->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                <input type="submit" class="btn btn-danger" name="delete" value="delete">
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

