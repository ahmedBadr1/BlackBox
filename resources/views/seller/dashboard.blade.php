@extends('seller.layouts.seller')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">@lang('messages.welcome-back')</h2>
                <p class="mg-b-0">@lang('messages.start')</p>
            </div>
        </div>
{{--        <div class="main-dashboard-header-right">--}}
{{--            <div>--}}
{{--                <label class="tx-13">Customer Ratings</label>--}}
{{--                <div class="main-star">--}}
{{--                    <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <label class="tx-13">Online Sales</label>--}}
{{--                <h5>563,275</h5>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <label class="tx-13">Offline Sales</label>--}}
{{--                <h5>783,675</h5>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">@lang('names.month-orders')</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$monthOrdersCount}} @lang('names.order')</h4>
                                <p class="mb-0 tx-12 text-white op-7">@lang('names.compare-last-month')</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
										<i class='bx @if(($monthOrdersCount - $lastMonthOrdersCount ) < 0 ) bxs-down-arrow-circle @else bxs-up-arrow-circle @endif text-white bx-xs'></i>
											<span class="text-white op-7">{{$monthOrdersCount - $lastMonthOrdersCount}}</span>
										</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">@lang('names.month-earning')</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format($monthOrdersValue)}} @lang('auth.symbol')</h4>
                                <p class="mb-0 tx-12 text-white op-7">@lang('names.compare-last-month')</p>
                            </div>
                            <span class="float-right my-auto mr-auto">

                                @if($monthOrdersValue)
                                    <i class='bx @if(($monthOrdersValue - $lastMonthOrdersValue ) < 0 ) bxs-down-arrow-circle @else bxs-up-arrow-circle @endif text-white bx-xs'></i>
                                    <span class="text-white op-7">{{number_format(($monthOrdersValue - $lastMonthOrdersValue)  /$monthOrdersValue  * 100) }}%</span>
                                @endif

										</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">@lang('names.total-earning')</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format($total)}} </h4>
                                <p class="mb-0 tx-12 text-white op-7">@lang('names.orders-count')</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
									<i class='bx bxs-package bx-xs text-white' ></i>
											<span class="text-white op-7">{{number_format($count)}}</span>
										</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">@lang('names.success-rate')</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">

                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    @if($count)
                                    {{ number_format($success * 100 / $count)  }}
                                    @else
                                        0
                                    @endif
                                    %</h4>

                                <p class="mb-0 tx-12 text-white op-7">@lang('names.compare-last-month')</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
{{--                                 @if($count)--}}
{{--                                    <i class='bx @if(($success - $success ) < 0 ) bxs-down-arrow-circle @else bxs-up-arrow-circle @endif text-white bx-xs'></i>--}}

{{--                                    <span class="text-white op-7">{{ number_format($success * 100 / $count)  }}%</span>--}}
{{--                                @endif--}}
                            </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">@lang('names.orders-status')</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 text-muted mb-0">@lang('messages.order-status')</p>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{$success}}</h4>
                            <label><i class='bx bxs-circle bx-sm text-primary' ></i>@lang('names.success')</label>
                        </div>
                        <div>
                            <h4>{{$pending}}</h4>
                            <label><i class='bx bxs-circle bx-sm text-danger' ></i>@lang('names.pending')</label>
                        </div>
                        <div>
                            <h4>{{$failed}}</h4>
                            <label><i class='bx bxs-circle bx-sm text-warning' ></i>@lang('names.failed')</label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-12 col-xl-5">
            <div class="card">
                <div class="card-header pb-0">
                    <h3 class="card-title mb-2">@lang('names.recent-orders')</h3>
                    <p class="tx-12 mb-0 text-muted">@lang('messages.order-instruction')</p>
                </div>
                <div class="card-body sales-info ot-0 pt-0 pb-0">
                    <div  class="ht-150"></div>
                    <div class="row sales-infomation pb-0 mb-0 mx-auto wd-100p">
                        <div class="col-md-6 col">
                            <p class="mb-0 d-flex"><span class="legend bg-primary brround"></span>@lang('names.delivered')</p>
                            <h3 class="mb-1">{{$success}}</h3>
                            <div class="d-flex">
                                <p class="text-muted ">@lang('names.last-6-month')</p>
                            </div>
                        </div>
                        <div class="col-md-6 col">
                            <p class="mb-0 d-flex"><span class="legend bg-info brround"></span>@lang('names.cancelled')</p>
                            <h3 class="mb-1">{{$cancelled}}</h3>
                            <div class="d-flex">
                                <p class="text-muted">@lang('names.last-6-month')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- row closed -->

    </div>
    <!-- Container closed -->
@endsection

