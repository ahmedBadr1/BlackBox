@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1 class="text-center">{{__("names.all")}} {{__("names.orders")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">

                    <thead>


                    <th>{{__("names.belong to")}}</th>
                    <th>{{__("names.type")}}</th>

                    <th>{{__("names.created_at")}}</th>

                    </thead>

                    <tbody>

                    @foreach($tasks as $task)

                        <tr>

                            <td><a href="{{route('users.show',$task->user_id)}}">{{$task->user->name}} </a></td>
                            <td>{{$task->type}} </td>

                            <td>{{$task->created_at}}</td>
                            <td>
                                @if(!$task->done_at)
                                    <form action="{{route('tasks.done',$task->id) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-secondary"  value="done">
                                    </form>
                                @else
                                    <form action="{{route('tasks.undone',$task->id) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-secondary"  value="undone">
                                    </form>
                                @endif
                            </td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>
@endsection



