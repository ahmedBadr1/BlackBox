@extends('admin.layouts.admin')

@section('meta')
    <style>
        .invoice {
            background: #fff;
            padding: 20px
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            margin: 0 -20px;
            background: #f0f3f4;
            padding: 20px
        }

        .invoice-date,
        .invoice-from,
        .invoice-to {
            display: table-cell;
            width: 1%
        }

        .invoice-from,
        .invoice-to {
            padding-right: 20px
        }

        .invoice-date .date,
        .invoice-from strong,
        .invoice-to strong {
            font-size: 16px;
            font-weight: 600
        }

        .invoice-date {
            text-align: right;
            padding-left: 20px
        }

        .invoice-price {
            background: #f0f3f4;
            display: table;
            width: 100%
        }

        .invoice-price .invoice-price-left,
        .invoice-price .invoice-price-right {
            display: table-cell;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            width: 75%;
            position: relative;
            vertical-align: middle
        }

        .invoice-price .invoice-price-left .sub-price {
            display: table-cell;
            vertical-align: middle;
            padding: 0 20px
        }

        .invoice-price small {
            font-size: 12px;
            font-weight: 400;
            display: block
        }

        .invoice-price .invoice-price-row {
            display: table;
            float: left
        }

        .invoice-price .invoice-price-right {
            width: 25%;
            background: #2d353c;
            color: #fff;
            font-size: 28px;
            text-align: right;
            vertical-align: bottom;
            font-weight: 300
        }

        .invoice-price .invoice-price-right small {
            display: block;
            opacity: .6;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px
        }

        .invoice-note {
            color: #999;
            margin-top: 80px;
            font-size: 85%
        }

        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
        }

        .btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }
        @media print {
            .invoice{
                width: 100%;
                height: 100%;
            }
            .hidden-print {
                display: none;
            }
        }
    </style>
@endsection
@section('page-header')
    <h1 class="text-center hidden-print"> @lang("names.order") {{$order->hashid}}</h1>
   <div class="hidden-print">
       <a href="{{route('admin.orders.index')}}" class="btn btn-primary ">@lang("names.manage-orders")</a>
   </div>
@endsection
@section('content')



        <!-- row -->
        <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
                              <span class="pull-right hidden-print">
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class='bx bxs-printer bx-xs'></i>@lang('auth.print')</a>
            </span>
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-body">
                            <div class="invoice-header">
                                <h1 class="invoice-title">@lang('names.delivery-order')</h1>
                                <div class="billed-from">
                                    <h6> {{sys('company_name')}}</h6>
                                    <p>{{sys('contact')}}<br>
                                        {{sys('email')}}<br>
                                        {{sys('address')}}</p>
                                </div><!-- billed-from -->
                            </div><!-- invoice-header -->
                            <div class="row mg-t-20">
                                <div class="col-md">
                                    <label class="tx-gray-600">@lang('auth.billed-to')</label>
                                    <div class="billed-to">
                                        <h6>{{$order->consignee['cust_name']}}</h6>
                                        <p>{{$order->consignee['address']}}<br>
                                            {{$order->consignee['cust_num']}}<br>
                                           </p>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label class="tx-gray-600">@lang('auth.order-data')</label>
                                    <p class="invoice-info-row"><span>@lang('auth.order-id')</span> <span>{{$order->hashid}}</span></p>
                                    <p class="invoice-info-row"><span>@lang('auth.order-date'):</span> <span>{{$order->created}}</span></p>
                                    <p class="invoice-info-row"><span>@lang('auth.due-to') :</span> <span>{{$order->due}}</span></p>
                                </div>
                            </div>
                            <div class="table-responsive mg-t-40">
                                <table class="table table-invoice border text-md-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="wd-20p">@lang('auth.type')</th>
                                        <th class="tx-center">@lang('auth.quantity')</th>
                                        <th class="tx-right">@lang('auth.price')</th>
                                        <th class="tx-right">@lang('auth.amount')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>
                                            <span class="tx-12">{{$order->product['name']}}</span><br>
                                            <small>{{$order->product['description']}}</small>
                                        </td>
                                        <td class="text-center">{{$order->product['quantity']}}</td>
                                        <td class="text-right">{{$order->product['value']}}</td>
                                        <td class="text-right">{{ $order->product['quantity'] * $order->product['value']}}</td>
                                    </tr>

                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">@lang('auth.notes')</label>
                                                <p>  {{$order->details['notes'] ?? 'no notes'}}</p>
                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td class="tx-right">@lang('auth.sub-total')</td>
                                        <td class="tx-right" colspan="2">{{$order->sub_total}}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">@lang('auth.tax')</td>
                                        <td class="tx-right" colspan="2">{{$order->tax}}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">@lang('auth.discount')</td>
                                        <td class="tx-right" colspan="2">-{{$order->discount}}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">@lang('auth.total')</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{$order->total}} EGP</h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr class="mg-b-40">
                            <p class="text-center">
                                <small class="m-r-10"><i class="bx  bx-xs bx-globe"></i>www.blackbox.com</small>
                                <small class="m-r-10"><i class="bx  bx-xs bxs-phone"></i> 0109682163</small>
                                <small class="m-r-10"><i class="bx  bx-xs bx-envelope"></i> support@me</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>
        <!-- row closed -->


@endsection
