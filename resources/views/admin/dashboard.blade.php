@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("names.dashboard")</h1>
@endsection
@section('content')
        <div class="row ">
            @can('user-show')<!-- Earnings (Monthly) Card Example -->
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">

            <div class="card bg-primary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="icon1 mt-2 text-center">
                                <i class="bx bx-user bx-lg"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="mt-0 text-center">
                                <span class="text-white">@lang("names.users-count")</span>
                                <h2 class="text-white mb-0">{{$users}} @lang("names.users")</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

    </div>
            @endcan
            @can('orders-show')<!-- Earnings (Monthly) Card Example -->
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">

            <div class="card bg-secondary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="icon1 mt-2 text-center">
                                <i class='bx bx-shopping-bag bx-lg'></i>
                            </div>
                        </div>
                        <div class="col-8">
                                <div class="mt-0 text-center">
                                    <span class="text-white">@lang("names.orders-count")</span>
                                    <h4 class="text-white mb-0">{{$orders}} @lang("names.orders")</h4>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
            @endcan



    </div>
@endsection

