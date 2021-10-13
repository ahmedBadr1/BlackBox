@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">Trash</h1>
                <p>{{ __('messages.trash') }}</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @can('task-show')
                    <div class="card text-white bg-primary m-3 col-md-4"  style="max-width: 18rem;">
                        <div class="card-header">{{__("names.deleted")}} {{__("names.count")}} {{__("names.Tasks")}} </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.tasks.trash')}}">{{$deletedTasks}} {{__("names.Tasks")}}</a></h5>
                        </div>
                    </div>
                @endcan
                @can('task-show')
                    <div class="card text-white bg-primary m-3 col-md-4"  style="max-width: 18rem;">
                        <div class="card-header">{{__("names.deleted")}} {{__("names.count")}} {{__("names.Tasks")}} </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.orders.trash')}}">{{$deletedOrders}} {{__("names.Orders")}}</a></h5>
                        </div>
                    </div>
                @endcan

            </div>
        </div>
    </div>


@endsection

