@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">{{__("names.dashboard")}}</h1>
        <div class="row row-cols-1 row-cols-sm-2  row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

            <!-- Earnings (Monthly) Card Example -->

            @can('user-show')
                <div class="col mb-2">
                    <div class="card text-white bg-primary "  >
                        <div class="card-header">{{__("names.count")}} {{__("names.users")}}</div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.users.index')}}">{{$users}} {{__("names.users")}}</a></h5>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="col mb-2">
                <div class="card text-white bg-success  "  >
                    <div class="card-header">{{__("names.count")}} {{__("names.sellers")}} </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('admin.sellers')}}">{{$sellers}} {{__("names.sellers")}}</a></h5>
                    </div>
                </div>
            </div>

            <div class="col mb-2">
                <div class="card text-white bg-primary " >
                    <div class="card-header">{{__("names.count")}} {{__("names.deliveries")}} </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('admin.users.index')}}">{{$deliveries}} {{__("names.deliveries")}}</a></h5>
                    </div>
                </div>
            </div>


            <div class="col mb-2">
                <div class="card text-white bg-success " >
                    <div class="card-header">{{__("names.count")}} {{__("names.plans")}}</div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('admin.plans.index')}}">{{$plans}} {{__("names.plans")}}</a></h5>
                    </div>
                </div>
            </div>

            <div class="col mb-2">
                <div class="card text-white bg-primary "  >
                    <div class="card-header">{{__("names.count")}} {{__("names.features")}}</div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('admin.features')}}">{{$features}} {{__("names.features")}}</a></h5>
                    </div>
                </div>
            </div>






            @can('state-show')
                <div class="col mb-2">
                    <div class="card text-white bg-success "  >
                        <div class="card-header">{{__("names.count")}} {{__("names.states")}} </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.states')}}">{{$states}} {{__("names.states")}}</a></h5>
                        </div>
                    </div>
                </div>

            @endcan
            @can('branch-show')
                    <div class="col mb-2">
                <div class="card text-white bg-primary "  >
                    <div class="card-header">{{__("names.count")}} {{__("names.branches")}} </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('admin.branches.index')}}">{{$branches}} {{__("names.branches")}}</a></h5>
                    </div>
                </div>
                    </div>
            @endcan
                @can('zone-show')
                            <div class="col mb-2">
                    <div class="card text-white bg-success"  >
                        <div class="card-header">{{__("names.count")}} {{__("names.zones")}} </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.zones.index')}}">{{$zones}} {{__("names.zones")}}</a></h5>
                        </div>
                    </div>
                            </div>
                @endcan
                @can('area-show')
                                    <div class="col mb-2">
                    <div class="card text-white bg-primary ">
                        <div class="card-header">{{__("names.count")}} {{__("names.areas")}}</div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.areas.index')}}">{{$areas}} {{__("names.areas")}}</a></h5>
                        </div>
                    </div>
                                    </div>
                @endcan

                @can('order-show')
                                            <div class="col mb-2">
                    <div class="card text-white bg-success " >
                        <div class="card-header">{{__("names.count")}} {{__("names.locations")}}</div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.locations.index')}}">{{$locations}} {{__("names.locations")}}</a></h5>
                        </div>
                    </div>
                                            </div>
                @endcan

{{--                @can('inbox')--}}
{{--                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">--}}
{{--                        <a href="" class="stretched-link">--}}
{{--                            <div class="card-header">Messages Count</div>--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title">there is {{$messages->count()}} Messages</h5>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                @endcan--}}



            @can('order-show')
                <div class="col mb-2">
                <div class="card text-white bg-primary " >
                    <div class="card-header">{{__("names.count")}} {{__("names.orders")}}</div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('admin.orders.index')}}">{{$orders}} {{__("names.orders")}}</a></h5>
                    </div>
                </div>
                </div>
            @endcan
                @can('task-show')
                        <div class="col mb-2">
                    <div class="card text-white bg-success " >
                        <div class="card-header">{{__("names.count")}} {{__("names.tasks")}}</div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('admin.tasks.index')}}">{{$tasks}} {{__("names.tasks")}}</a></h5>
                        </div>
                    </div>
                        </div>
                @endcan

                            <div class="col mb-2">
                <div class="card text-white bg-primary " >
                    <div class="card-header">{{__("names.count")}} {{__("names.statuses")}}</div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('admin.orders.index')}}">{{$statuses}} {{__("names.statuses")}}</a></h5>
                    </div>
                </div>
                            </div>

                                <div class="col mb-2">
                <div class="card text-white bg-success" >
                    <div class="card-header">{{__("names.count")}} {{__("names.receipts")}}</div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('admin.receipts.index')}}">{{$receipts}} {{__("names.receipts")}}</a></h5>
                    </div>
                </div>
                                </div>

                                    <div class="col mb-2">
                <div class="card text-white bg-primary " >
                    <div class="card-header">{{__("names.count")}} {{__("names.packing")}}</div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('admin.packing')}}">{{$packing}} {{__("names.packing")}}</a></h5>
                    </div>
                </div>
                                    </div>

        </div>
    </div>
@endsection

