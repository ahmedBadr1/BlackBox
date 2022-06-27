@extends('seller.layouts.seller')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
        /*@media print{*/
        /*    .no-print{*/
        /*        display: none;*/
        /*        position: absolute;*/
        /*        left: 0;*/
        /*        top: 0;*/
        /*    }*/
        /*    #order{*/
        /*        visibility: visible;*/
        /*        background-color: white;*/
        /*        height: 100%;*/
        /*        width: 100%;*/
        /*        position: fixed;*/
        /*        top: 0;*/
        /*        left: 0;*/
        /*        margin: 0;*/
        /*        padding: 15px;*/
        /*        font-size: 14px;*/
        /*        line-height: 18px;*/
        /*    }*/

        /*}*/
    </style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between no-print">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="main-content-title mb-0 my-auto">@lang('names.order')</h4>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">



            <div class="mx-1 ">

                    <a href="{{ route('orders.edit',$order->hashid) }}" class="btn btn-info-gradient btn-sm "><i class='bx bxs-edit tx-20   ' ></i></a>

            </div>
            <div class="mx-1">
                <form action="{{route('orders.destroy',$order->hashid) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-gradient btn-sm" ><i class="bx bx-trash tx-20"></i></button>
                </form>
            </div>


        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row row-sm" id="order">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">@lang('names.invoice') {{$order->hashid}} </h1>

                            <div class="billed-from">
                                <h6>@lang('auth.name') : {{$user->name}}</h6>
                                <p>@lang('auth.address') : {{$user->address}}<br>
                                    @lang('auth.phone') : {{$user->phone}}<br>
                                    @lang('auth.email'): {{$user->email}}</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">@lang('names.consignee-details')</label>
                                <div class="billed-to">
                                    <h6>@lang('auth.name') : {{$order->consignee['cust_name']}}</h6>
                                    <p>@lang('auth.address') : {{$order->consignee['address']}}<br>
                                        @lang('auth.phone') : {{$order->consignee['cust_num']}}<br>
                                        @lang('names.area') :  {{$order->area->name}}</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">@lang('names.invoice-details') </label>
                                <p class="invoice-info-row"><span>@lang('names.order-id')</span> <span>{{$order->hashid}}</span></p>
                                <p class="invoice-info-row"><span>@lang('names.date')</span> <span>{{$order->created_at->format('M d Y')}}</span></p>
                                <p class="invoice-info-row"><span>@lang('names.order-status')</span> <span>{{$order->status->name}}</span></p>

                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="wd-20p">@lang('auth.name')</th>
                                    <th class="wd-40p">@lang('auth.description')</th>
                                    <th class="tx-center">@lang('auth.count')</th>
                                    <th class="tx-right">@lang('auth.unit-price')</th>
                                    <th class="tx-right">@lang('auth.amount')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$order->product['name']}}</td>
                                    <td class="tx-12">{{$order->product['description']}}</td>
                                    <td class="tx-center">{{$order->product['quantity']}}</td>
                                    <td class="tx-right">{{$order->product['value']}}</td>
                                    <td class="tx-right">{{$order->sub_total}}</td>
                                </tr>
                                <tr>
                                    <td class="valign-middle " colspan="2" rowspan="4">
                                        <div class="">
                                            <label class="main-content-label tx-13 text-black ">@lang('auth.notes')</label>
                                            <p>{{$order->details['notes'] ?? @lang('names.no-notes')}}</p>
                                        </div><!-- invoice-notes -->
                                       <div class="mt-5">
                                           @php echo DNS1D::getBarcodeSVG($order->hashid,'C39'); @endphp
                                       </div>
                                    </td>
                                    <td class="tx-right">@lang('auth.sub-total')</td>
                                    <td class="tx-right" colspan="2">{{$order->sub_total}} @lang('auth.symbol')</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">@lang('auth.tax') (14%)</td>
                                    <td class="tx-right" colspan="2">{{$order->tax}} @lang('auth.symbol')</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">@lang('auth.discount')</td>
                                    <td class="tx-right" colspan="2">{{$order->discount}} @lang('auth.symbol')</td>
                                </tr>
                                <tr>
                                    <td class="tx-right tx-uppercase tx-bold tx-inverse">@lang('auth.total')</td>
                                    <td class="tx-right" colspan="2">
                                        <h4 class="tx-primary tx-bold">{{$order->total}} @lang('auth.symbol')</h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40"  >

                                <div id="print_Button">
                                    <a href="#"  onclick="printDiv()" class="btn btn-danger-gradient mx-1">
                                        <i class='bx bx-printer bx-xs' ></i> @lang('auth.print')
                                    </a>
                                    <a href="#" class="btn btn-success-gradient mx-1">
                                        @lang('auth.send') <i class='bx bx-send bx-xs' ></i>
                                    </a>
                                </div>



                        </div>



                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
@endsection




@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('order').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection


