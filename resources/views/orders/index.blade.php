@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @role('seller|Feedback')
                    <a href="{{route('orders.create')}}" class="btn btn-success">{{__("auth.create")}} {{__("names.order")}}</a>
                @endrole
                @can('order-assign')
                <a href="{{route('orders.assign')}}" class="btn btn-secondary">{{__("auth.assign")}} {{__("names.order")}}</a>
                @endcan


                <h1 class="text-center">{{__("names.all")}} {{__("names.orders")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">

                    <thead>
                    <th>#</th>
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

                    @forelse($orders as $key => $order)

                        <tr>
                                <td>{{++$key}}</td>
                            <td> <a href="{{ route('orders.show',$order->hashid) }}"> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                            <td>{{$order->product_name}} </td>
                            <td>{{$order->cust_name}} </td>
                            <td>{{$order->cust_num}} </td>
                            <td>{{$order->address}}, <a href="{{route('areas.show',$order->area->id)}}">{{ $order->area->name}}</a>, {{$order->state->name}}</td>
                            <td>{{$order->value}} </td>
                            <td>{{$order->quantity}} </td>
                            <td>{{$order->notes ?? 'no notes'}} </td>
                            <td>{{$order->status->name}} </td>

                            <td><a href="{{route('users.show',$order->user_id)}}">{{ $order->user->name }}</a> </td>
                            @auth
                            @role('seller|Feedback')
                                <td><a href="{{route('track',['order_id' => $order->id])}}" class="btn btn-outline-success">{{__('names.track')}}</a></td>
                            @endrole
                            @role('seller|Feedback')
                            <td><a href="{{ route('orders.edit',$order->hashid) }}" class="btn btn-info">{{__('auth.edit')}}</a></td>
                            @endrole
                            @role('seller|Feedback')
                            <td>
                                <form action="{{route('orders.destroy',$order->hashid) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="{{__('auth.delete')}}">
                                </form>
                            </td>
                            @endrole
                            @endauth
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3">No Orders Found</td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
                @if(count($orders) > 1 )
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning" disabled><small>{{__('names.download')}}</small></button>
                        <a href="{{route('export.orders.'.app()->getLocale())}}" class="btn btn-success">{{__('names.excel')}}</a>
                    </div>
                    @endif

                    {{ $orders->links() }}
            </div>

        </div>
    </div>
@endsection

