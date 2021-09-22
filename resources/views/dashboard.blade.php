@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center">{{__("names.dashboard")}}</h1>
        <div class="row d-flex align-items-md-center">


{{--            <div class="col-md-4">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-red">--}}
{{--                        <i class="fa fa-chart-line"></i>--}}
{{--                    </span>--}}
{{--                    <div class="info-boc-content">--}}
{{--                        <span class="info-box-text">Users</span>--}}
{{--                        <span class="info-box-number">{{$users}}</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
                @can('user-show')
                    <div class="card text-white bg-primary m-3 col-md-4"  style="max-width: 18rem;">
                        <div class="card-header">{{__("names.count")}} {{__("names.users")}} </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('users.index')}}">{{$users}} {{__("names.users")}}</a></h5>
                        </div>
                    </div>
                @endcan
                @can('state-show')
                    <div class="card text-white bg-success m-3 col-md-4"  style="max-width: 18rem;">
                        <div class="card-header">{{__("names.count")}} {{__("names.states")}} </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('states')}}">{{$states}} {{__("names.states")}}</a></h5>
                        </div>
                    </div>
                @endcan
                @can('branch-show')
                    <div class="card text-white bg-primary m-3 col-md-4"  style="max-width: 18rem;">
                        <div class="card-header">{{__("names.count")}} {{__("names.branches")}} </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('branches.index')}}">{{$branches}} {{__("names.branches")}}</a></h5>
                        </div>
                    </div>
                @endcan


        </div>
        <div class="row ">

                @can('zone-show')
                    <div class="card text-white bg-success m-3 col-md-4"  style="max-width: 18rem;">
                        <div class="card-header">{{__("names.count")}} {{__("names.zones")}} </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('zones.index')}}">{{$zones}} {{__("names.zones")}}</a></h5>
                        </div>
                    </div>
                @endcan
                @can('area-show')
                    <div class="card text-white bg-primary m-3 col-md-4" style="max-width: 18rem;">
                        <div class="card-header">{{__("names.count")}} {{__("names.areas")}}</div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('areas.index')}}">{{$areas}} {{__("names.areas")}}</a></h5>
                        </div>
                    </div>
                @endcan
                @can('order-show')
                    <div class="card text-white bg-success m-3 col-md-4" style="max-width: 18rem;">
                        <div class="card-header">{{__("names.count")}} {{__("names.orders")}}</div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('orders.index')}}">{{$orders}} {{__("names.orders")}}</a></h5>
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

        </div>
    </div>
@endsection

