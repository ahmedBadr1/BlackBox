@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1 class="text-center">{{__("names.all")}} {{__("names.orders")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">

                    <thead>

                    <th>{{__("auth.id")}} {{__("names.order")}}</th>
                    <th>{{__("auth.product_name")}}</th>

                    <th>{{__("auth.cust_name")}}</th>
                    <th>{{__("auth.cust_num")}}</th>
                    <th>{{__("auth.address")}}</th>
                    <th>{{__("names.value")}}</th>
                    <th>{{__("names.count")}}</th>
                    <th>{{__("names.notes")}}</th>
                    <th>{{__("names.status")}}</th>

                    <th>{{__("auth.username")}}</th>

                    </thead>

                    <tbody>

                    @foreach($orders as $order)

                        <tr>

                            <td> <a href="{{ route('orders.status',$order->hashid) }}"> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                            <td>{{$order->product_name}} </td>
                            <td>{{$order->cust_name}} </td>
                            <td>{{$order->cust_num}} </td>
                            <td>{{$order->address}}, <a href="{{route('areas.show',$order->area->id)}}">{{ $order->area->name}}</a>, {{$order->state->name}}</td>
                            <td>{{$order->value}} </td>
                            <td>{{$order->quantity}} </td>
                            <td>{{$order->notes ?? 'no notes'}} </td>
                            <td>{{$order->status->name}}  </td>

                            <td><a href="{{route('users.show',$order->user_id)}}">{{ $order->user->name }}</a> </td>
                            @auth
                                @role('delivery|Feedback')
                                <td><a href="{{ route('orders.status',$order->id) }}" class="collapse-item ">{{__("names.order")}} {{__("names.status")}}</a></td>
                                @endrole
                            @endauth
                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>
@endsection



