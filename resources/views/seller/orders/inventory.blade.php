@extends('seller.layouts.seller')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <a href="{{route('orders.ready')}}" class="btn btn-success">@lang("names.ready-orders")}}</a>



                <h1 class="text-center main-content-title">@lang("names.inventory")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover table-responsive-md">

                    <thead>
                    <th>#</th>
                    <th>@lang("auth.id")}} @lang("names.order")}}</th>
                    <th>@lang("auth.product-name")}}</th>

                    <th>@lang("auth.cust-name")}}</th>
                    <th>@lang("auth.cust-num")}}</th>
                    <th>@lang("auth.address")}}</th>
                    <th>@lang("auth.cost")}}</th>
                    <th>@lang("auth.total")}}</th>

                    <th>@lang("names.notes")}}</th>
                    <th>@lang("names.status")}}</th>

                    <th>@lang("auth.actions")}}</th>

                    </thead>

                    <tbody>

                    @forelse($orders as $key => $order)

                        <tr>
                            <td>{{++$key}}</td>
                            <td> <a href="{{ route('orders.show',$order->hashid) }}"> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                            <td>{{$order->product['name']}} </td>
                            <td>{{$order->consignee['cust_name']}} </td>
                            <td>{{$order->consignee['cust_num']}} </td>
                            <td>{{$order->consignee['address']}}, {{ $order->area->name}}, {{$order->state->name}}</td>
                            <td>{{$order->cost}} </td>
                            <td>{{$order->total}} </td>
                            <td>{{$order->detials['notes'] ?? 'no notes'}} </td>
                            <td>{{$order->status->name}} </td>

                            @auth
{{--                                @role('seller|Feedback')--}}
{{--                                <td><a href="{{route('track',['order_id' => $order->id])}}" class="btn btn-outline-success">@lang('names.track')}}</a></td>--}}
{{--                                @endrole--}}
{{--                                @role('seller|Feedback')--}}
{{--                                <td><a href="{{ route('orders.edit',$order->hashid) }}" class="btn btn-info">@lang('auth.edit')}}</a></td>--}}
{{--                                @endrole--}}

                                <td class="d-flex">
                                    <form action="{{route('orders.readyGo',$order->hashid) }}" method="POST">
                                    @csrf
                                        <input type="submit" class="btn btn-secondary-gradient" @if($order->status->id === 2)
                                        disabled
                                               @endif
                                        value="@lang('names.ready-for-pickup')}}">
                                    </form>
                                    <form action="{{route('orders.destroy',$order->hashid) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger-gradient" value="@lang('auth.delete')}}">
                                    </form>
                                </td>

                            @endauth
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3">No Orders Found</td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
                @if(count($orders) > 2 )
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('orders.inventory.export.'.app()->getLocale())}}" class="btn btn-success">@lang('auth.export')}}</a>
                    </div>
                @endif

                {{ $orders->links() }}
            </div>
{{--            <input type="submit" class="btn-secondary" value="pick up">--}}
        </div>
    </div>


@endsection

