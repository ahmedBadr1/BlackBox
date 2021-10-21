@extends('seller.layouts.seller')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1 class="text-center main-content-title" >{{__("names.all")}} {{__("names.mybalance")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif




            </div>



        </div>
        <div class="row row-sm">
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-primary-gradient text-white ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class='bx bx-cart tx-40' ></i>
                                    {{--                               <div class="tx-25">@lang('names.orders-count')</div>--}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <b>
                                        <span class="text-white ">@lang('names.order')</span>
                                        <h2 class="text-white mb-0 tx-30">{{$ordersCount}}</h2>
                                    </b>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-danger-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class='bx bx-dollar tx-40' ></i>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white">@lang('names.sales')</span>
                                    <h2 class="text-white mb-0 tx-30">{{$subTotal}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-warning-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class="fe fe-pie-chart tx-40"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white">@lang('names.taxes')</span>
                                    <h2 class="text-white mb-0 tx-30">{{$tax}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-success-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class="fe fe-bar-chart-2 tx-40"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white">@lang('names.profits')</span>
                                    <h2 class="text-white mb-0 tx-30">{{$total}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--    <div class="row row-sm">--}}
{{--        <div class="col-sm-6 col-lg-6 col-xl-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <div class="">App Views</div>--}}
{{--                            <div class="h3 mt-2 mb-2"><b>19.89K</b><span class="text-success tx-13 ml-2">(+25%)</span></div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto align-self-center ">--}}
{{--                            <div class="feature mt-0 mb-0 tx-30">--}}
{{--                                <i class="fe fe-eye project bg-primary-transparent text-primary "></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="">--}}
{{--                        <p class="mb-1">Overview of Last month</p>--}}
{{--                        <div class="progress progress-sm h-1 mb-1">--}}
{{--                            <div class="progress-bar bg-primary wd-80 " role="progressbar"></div>--}}
{{--                        </div>--}}
{{--                        <small class="mb-0 text-muted">Monthly<span class="float-left text-muted">60%</span></small>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-6 col-lg-6 col-xl-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <div class="">New Users</div>--}}
{{--                            <div class="h3 mt-2 mb-2"><b>692</b><span class="text-success tx-13 ml-2">(+15%)</span></div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto align-self-center ">--}}
{{--                            <div class="feature mt-0 mb-0">--}}
{{--                                <i class="fe fe-users project bg-pink-transparent text-pink "></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="">--}}
{{--                        <p class="mb-1">Overview of Last month</p>--}}
{{--                        <div class="progress progress-sm h-1 mb-1">--}}
{{--                            <div class="progress-bar bg-secondary wd-50 " role="progressbar"></div>--}}
{{--                        </div>--}}
{{--                        <small class="mb-0 text-muted">Monthly<span class="float-left text-muted">50%</span></small>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-6 col-lg-6 col-xl-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <div class="">Churned Users</div>--}}
{{--                            <div class="h3 mt-2 mb-2"><b>286</b><span class="text-success tx-13 ml-2">(+08%)</span></div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto align-self-center ">--}}
{{--                            <div class="feature mt-0 mb-0">--}}
{{--                                <i class="ti-pulse project bg-warning-transparent text-warning "></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="">--}}
{{--                        <p class="mb-1">Overview of Last month</p>--}}
{{--                        <div class="progress progress-sm h-1 mb-1">--}}
{{--                            <div class="progress-bar bg-danger wd-30 " role="progressbar"></div>--}}
{{--                        </div>--}}
{{--                        <small class="mb-0 text-muted">Monthly<span class="float-left text-muted">30%</span></small>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-6 col-lg-6 col-xl-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <div class="">Total Revenue</div>--}}
{{--                            <div class="h3 mt-2 mb-2"><b>$2.98M</b><span class="text-success tx-13 ml-2">(+35%)</span></div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto align-self-center ">--}}
{{--                            <div class="feature mt-0 mb-0">--}}
{{--                                <i class="ti-bar-chart-alt project bg-success-transparent text-success "></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="">--}}
{{--                        <p class="mb-1">Overview of Last month</p>--}}
{{--                        <div class="progress progress-sm h-1 mb-1">--}}
{{--                            <div class="progress-bar bg-success wd-25 " role="progressbar"></div>--}}
{{--                        </div>--}}
{{--                        <small class="mb-0 text-muted">Monthly<span class="float-right text-muted">25%</span></small>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

        <div class="col-md-12 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">@lang('names.recent-orders')</h4>
                        <i class="mdi mdi-dots-vertical"></i>
                    </div>
                    <p class="card-description mb-1">@lang('names.this-week')</p>
                    @foreach($recentOrders as $order)
                        <div class="list d-flex align-items-center border-bottom py-3">
                            <div class="wrapper w-100 mr-3">
                                <p class="mb-0">
                                    <a class="card-title" href="{{route('orders.show',$order->hashid)}}">{{$order->hashid}}</a>
                                    <span class="badge badge-primary">
                                          @lang('names.'.$order->status->name)
                                       </span>
                                    <div class="d-sm-flex justify-content-between justify-content-between">
                                    <div class="d-flex align-items-between">


                                    <p class="ml-2">@lang('auth.total') : <b>{{$order->total}}</b></p>
                                     <p class="ml-2"> @lang('auth.cost') : <b>{{ $order->total - $order->cost}}</b></p>

                                    </div>

                                    <small class="text-muted ">  <i class="mdi mdi-clock text-muted ml-auto"></i>{{$order->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                        </div>


                    @endforeach
                </div>
            </div>
        </div>

@endsection

