@extends('admin.layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.tasks.index')}}">Manage Tasks</a>
                <h1 class="text-center">Show Task {{$task->type}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>Belong TO</label>
                <p><b> <a href="{{route('admin.tasks.show',$task->user->id)}}">{{$task->user->name}}</a></b></p> <hr>
                <label>Task Type</label>
                <p><b>{{$task->type}}</b></p> <hr>
                <label>Assign To</label>
                <p><b>@if($task->delivery)
                        <a href="{{route('admin.tasks.show',$task->delivery->id)}}">{{$task->delivery->name}}</a>
                        @else
                            <a href="{{route('admin.tasks.assign')}}" class="btn btn-primary">assign</a>
                        @endif
                    </b></p> <hr>

                <div class="d-flex ">
                    @can('task-edit')
                        <a href="{{ route('admin.tasks.edit',$task->id) }}" class="btn btn-info o">edit</a>
                    @endcan
                    @can('task-delete')
                        <form class="ml-5" action="{{route('admin.tasks.destroy',$task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="delete">
                        </form>
                    @endcan
                </div>

            </div>
        </div>
    </div>
@endsection

