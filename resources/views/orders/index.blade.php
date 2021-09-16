@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @role('client')
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
                    <th>{{__("auth.name")}}</th>
                    <th>{{__("auth.phone")}}</th>
                    <th>{{__("auth.address")}}</th>
                    <th>{{__("names.value")}}</th>
                    <th>{{__("names.count")}}</th>
                    <th>{{__("names.notes")}}</th>
                    <th>{{__("names.status")}}</th>

                    <th>{{__("auth.username")}}</th>

                    </thead>

                    <tbody>

                    @foreach($orders as $order)
                    @php
                        $area = \App\Models\Area::find($order->area);
                    @endphp
                        <tr>

                            <td> <a href="{{ route('orders.show',$order->id) }}"> {{$order->id}} </a></td>

                            <td>{{$order->cust_name}} </td>
                            <td>{{$order->cust_num}} </td>
                            <td>{{$order->address}}, <a href="{{route('areas.show',$area->id)}}">{{ $area->name}}</a>, {{$order->state}}</td>
                            <td>{{$order->value}} </td>
                            <td>{{$order->quantity}} </td>
                            <td>{{$order->notes ?? 'no notes'}} </td>
                            <td>{{$order->status}} </td>

                            <td><a href="{{route('users.show',$order->user_id)}}">{{ \App\Models\User::find($order->user_id)->name }}</a> </td>
                            @role('client|Feedback')
                                <td><a href="{{route('track',['order_id' => $order->id])}}" class="btn btn-outline-success">{{__('names.track')}}</a></td>
                            @endrole
                            @role('client')
                            <td><a href="{{ route('orders.edit',$order->id) }}" class="btn btn-info">{{__('auth.edit')}}</a></td>
                            @endrole
                            @role('client')
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
                    {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection

