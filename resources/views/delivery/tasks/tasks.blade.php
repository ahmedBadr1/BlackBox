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
                    <th>@lang("auth.notes")</th>

                    <th>@lang("auth.due-to")</th>

                    </thead>

                    <tbody>

                    @foreach($tasks as $task)

                        <tr>

                            <td>{{$task->user->name}} </a></td>
                            <td>{{$task->type}} </td>
                            <td>{{$task->notes ?? '-'}} </td>
                            <td>{{$task->due}}</td>
                            <td>
                                @if(!$task->done_at)
{{--                                    @if($task->type == 'pickup')--}}
                                    <a href="{{route('delivery.tasks.done',$task->id) }}" class="btn btn-dark-gradient">@lang('auth.done')</a>
                                @elseif(!$task->confirmed_at)
                                    <p>{{__('messages.wait-to-confirmed')}}</p>
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



