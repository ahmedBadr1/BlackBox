@extends('admin.layouts.admin')
<h1 class="text-center">@lang('names.trash')</h1>
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">

                @can('task-show')
                    <div class="card  m-3 col-md-4"  style="max-width: 18rem;">
                        <h3 class="card-header">@lang("names.deleted-tasks") </h3>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.tasks.trash')}}">{{$deletedTasks}} @lang("names.tasks")</a></h5>
                        </div>
                    </div>
                @endcan
                @can('task-show')
                    <h3 class="card  m-3 col-md-4"  style="max-width: 18rem;">
                        <div class="card-header">@lang("names.deleted-orders")</div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.orders.trash')}}">{{$deletedOrders}} @lang("names.orders")</a></h5>
                        </div>
                    </h3>
                @endcan

            </div>
        </div>



@endsection

