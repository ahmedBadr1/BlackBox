@extends('delivery.layouts.delivery')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1 class="text-center">@lang("names.all")}} @lang("names.orders")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">

                    <thead>

                    <th>@lang("auth.id")}} @lang("names.order")}}</th>
                    <th>@lang("auth.product_name")}}</th>

                    <th>@lang("auth.cust_name")}}</th>
                    <th>@lang("auth.cust_num")}}</th>
                    <th>@lang("auth.address")}}</th>
                    <th>@lang("names.value")}}</th>
                    <th>@lang("names.count")}}</th>
                    <th>@lang("names.notes")}}</th>
                    <th>@lang("names.status")}}</th>

                    <th>@lang("auth.username")}}</th>

                    </thead>

                    <tbody>

                    @foreach($orders as $order)

                        <tr>

                            <td> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                            <td>{{$order->product_name}} </td>
                            <td>{{$order->cust_name}} </td>
                            <td>{{$order->cust_num}} </td>
                            <td>{{$order->address}}, <a href="{{route('areas.show',$order->area->id)}}">{{ $order->area->name}}</a>, {{$order->state->name}}</td>
                            <td>{{$order->value}} </td>
                            <td>{{$order->quantity}} </td>
                            <td>{{$order->notes ?? 'no notes'}} </td>
                            <td>{{$order->status->name}}  </td>

                            <td>{{ $order->user->name }}</a> </td>
                            @auth
                                @role('delivery|Feedback')
                                <td><a href="{{ route('delivery.orders.status',$order->hashid) }}" class="collapse-item ">@lang("names.order")}} @lang("names.status")}}</a></td>
                                @endrole
                            @endauth
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



