@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @role('seller|Feedback')
                    <a href="{{route('orders.create')}}" class="btn btn-success">{{__("auth.create")}} {{__("names.order")}}</a>
                @endrole


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

                            <td> <a href="{{ route('orders.show',$order->id) }}">@php echo DNS1D::getBarcodeHTML($order->id,'C39'); @endphp</a></td>
                            <td>{{$order->product_name}} </td>
                            <td>{{$order->cust_name}} </td>
                            <td>{{$order->cust_num}} </td>
                            <td>{{$order->address}}, <a href="{{route('areas.show',$order->area->id)}}">{{ $order->area->name}}</a>, {{$order->state}}</td>
                            <td>{{$order->value}} </td>
                            <td>{{$order->quantity}} </td>
                            <td>{{$order->notes ?? 'no notes'}} </td>
                            <td>{{$order->status}} </td>

                            <td><a href="{{route('users.show',$order->user_id)}}">{{ \App\Models\User::find($order->user_id)->name }}</a> </td>
                            @role('seller|Feedback')
                                <td><a href="{{route('track',['order_id' => $order->id])}}" class="btn btn-outline-success">{{__('names.track')}}</a></td>
                            @endrole
                            @role('seller')
                            <td><a href="{{ route('orders.edit',$order->id) }}" class="btn btn-info">{{__('auth.edit')}}</a></td>
                            @endrole
                            @role('seller')
                            <td>
                                <form action="{{route('orders.destroy',$order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="{{__('auth.delete')}}">
                                </form>
                            </td>
                            @endrole

                        </tr>

                    @endforeach

                    </tbody>

                </table>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-warning" disabled><small>{{__('names.download')}}</small></button>
                    <a href="{{route('export.orders.'.app()->getLocale())}}" class="btn btn-success">{{__('names.excel')}}</a>
                </div>
                    {{ $orders->links() }}
            </div>

        </div>
    </div>
@endsection

