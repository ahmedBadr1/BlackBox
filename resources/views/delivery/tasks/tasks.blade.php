@extends('delivery.layouts.delivery')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1 class="text-center">@lang("names.all-tasks")</h1>

                <table class="table table-hover table-responsive-md">

                    <thead>


                    <th>@lang("auth.belong-to")</th>
                    <th>@lang("auth.type")</th>

                    <th>@lang("auth.created-at")</th>

                    </thead>

                    <tbody>

                    @foreach($tasks as $task)

                        <tr>

                            <td>{{$task->user->name}} </a></td>
                            <td>{{$task->type}} </td>

                            <td>{{$task->created_at}}</td>
                            <td>
                                @if(!$task->done_at)
                                    <form action="{{route('delivery.tasks.done',$task->id) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-secondary"  value="@lang('auth.done')">
                                    </form>
                                @else
                                    <form action="{{route('delivery.tasks.undone',$task->id) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-secondary"  value="@lang('auth.undone')">
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



