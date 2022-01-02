@extends('delivery.layouts.delivery')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1 class="text-center">@lang("names.all-orders")</h1>

                <table class="table table-hover table-responsive-md">

                    <thead>

                    <th>@lang("auth.order-id")</th>
                    <th>@lang("auth.product-name")</th>

                    <th>@lang("auth.cust-name")</th>
                    <th>@lang("auth.cust-num")</th>
                    <th>@lang("auth.address")</th>
                    <th>@lang("auth.value")</th>
                    <th>@lang("auth.count")</th>
                    <th>@lang("auth.notes")</th>
                    <th>@lang("auth.status")</th>

                    <th>@lang("auth.username")</th>

                    </thead>

                    <tbody>

                    @foreach($orders as $order)

                        <tr>

                            <td> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                            <td>{{$order->product['name']}} </td>
                            <td>{{$order->consignee['cust_name']}} </td>
                            <td>{{$order->consignee['cust_num']}} </td>
                            <td>{{$order->consignee['address']}},{{ $order->area->name}}, {{$order->state->name}}</td>
                            <td>{{$order->product['value']}} </td>
                            <td>{{$order->product['quantity']}} </td>
                            <td>{{$order->details['notes'] ?? 'no notes'}} </td>
                            <td>{{$order->status->name}}  </td>

                            <td>{{ $order->user->name }}</a> </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>
                <div class="d-flex ">
                    {{ $orders->links() }}
                </div>


            </div>

        </div>
    </div>
@endsection



