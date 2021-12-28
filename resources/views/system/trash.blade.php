@extends('admin.layouts.admin')
<h1 class="text-center">@lang('names.trash')</h1>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <p>@lang('messages.trash')</p>

                @can('task-show')
                    <div class="card  m-3 col-md-4"  style="max-width: 18rem;">
                        <div class="card-header">@lang("names.deleted-tasks") </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.tasks.trash')}}">{{$deletedTasks}} @lang("names.tasks")</a></h5>
                        </div>
                    </div>
                @endcan
                @can('task-show')
                    <div class="card  m-3 col-md-4"  style="max-width: 18rem;">
                        <div class="card-header">@lang("names.deleted-orders")</div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.orders.trash')}}">{{$deletedOrders}} @lang("names.orders")</a></h5>
                        </div>
                    </div>
                @endcan

            </div>
        </div>
    </div>


@endsection

