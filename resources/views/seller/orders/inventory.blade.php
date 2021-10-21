@extends('seller.layouts.seller')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <a href="{{route('orders.ready')}}" class="btn btn-success">{{__("names.ready-orders")}}</a>



                <h1 class="text-center main-content-title">{{__("names.inventory")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover table-responsive">

                    <thead>
                    <th>#</th>
                    <th>{{__("auth.id")}} {{__("names.order")}}</th>
                    <th>{{__("auth.product-name")}}</th>

                    <th>{{__("auth.cust-name")}}</th>
                    <th>{{__("auth.cust-num")}}</th>
                    <th>{{__("auth.address")}}</th>
                    <th>{{__("auth.cost")}}</th>
                    <th>{{__("auth.total")}}</th>

                    <th>{{__("names.notes")}}</th>
                    <th>{{__("names.status")}}</th>

                    <th>{{__("auth.actions")}}</th>

                    </thead>

                    <tbody>

                    @forelse($orders as $key => $order)

                        <tr>
                            <td>{{++$key}}</td>
                            <td> <a href="{{ route('orders.show',$order->hashid) }}"> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                            <td>{{$order->product['name']}} </td>
                            <td>{{$order->consignee['cust_name']}} </td>
                            <td>{{$order->consignee['cust_num']}} </td>
                            <td>{{$order->consignee['address']}}, <a href="{{route('areas.show',$order->area->id)}}">{{ $order->area->name}}</a>, {{$order->state->name}}</td>
                            <td>{{$order->cost}} </td>
                            <td>{{$order->total}} </td>
                            <td>{{$order->detials['notes'] ?? 'no notes'}} </td>
                            <td>{{$order->status->name}} </td>

                            @auth
{{--                                @role('seller|Feedback')--}}
{{--                                <td><a href="{{route('track',['order_id' => $order->id])}}" class="btn btn-outline-success">{{__('names.track')}}</a></td>--}}
{{--                                @endrole--}}
{{--                                @role('seller|Feedback')--}}
{{--                                <td><a href="{{ route('orders.edit',$order->hashid) }}" class="btn btn-info">{{__('auth.edit')}}</a></td>--}}
{{--                                @endrole--}}

                                <td class="d-flex">
                                    <form action="{{route('orders.readyGo',$order->hashid) }}" method="POST">
                                    @csrf
                                        <input type="submit" class="btn btn-secondary-gradient" @if($order->status->id === 2)
                                        disabled
                                               @endif
                                        value="{{__('names.ready-for-pickup')}}">
                                    </form>
                                    <form action="{{route('orders.destroy',$order->hashid) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger-gradient" value="{{__('auth.delete')}}">
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
                @if(count($orders) > 3 )
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning" disabled><small>{{__('names.download')}}</small></button>
                        <a href="{{route('export.orders.'.app()->getLocale())}}" class="btn btn-success">{{__('names.excel')}}</a>
                    </div>
                @endif

                {{ $orders->links() }}
            </div>
{{--            <input type="submit" class="btn-secondary" value="pick up">--}}
        </div>
    </div>


@endsection

