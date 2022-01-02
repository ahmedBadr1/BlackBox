@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("names.deleted-orders")</h1>
@endsection
@section('content')


        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-hover table-responsive-md">

                    <thead>
                    <th>#</th>
                    <th>@lang("names.order-id")</th>
                    <th>@lang("auth.product-name")</th>

                    <th>@lang("auth.cust-name")</th>
                    <th>@lang("auth.cust-num")</th>
                    <th>@lang("auth.address")</th>
                    <th>@lang("auth.value")</th>
                    <th>@lang("auth.count")</th>
                    <th>@lang("auth.notes")</th>
                    <th>@lang("auth.deleted_at")</th>

                    <th>@lang("auth.username")</th>

                    </thead>

                    <tbody>

                    @forelse($orders as $key => $order)

                        <tr>
                            <td>{{++$key}}</td>
                            <td> <a href="{{ route('admin.orders.show',$order->hashid) }}"> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                            <td>{{$order->product['name']}} </td>
                            <td>{{$order->consignee['cust_name']}} </td>
                            <td>{{$order->consignee['cust_num']}} </td>
                            <td>{{$order->consignee['address']}}, <a href="{{route('admin.areas.show',$order->area_id)}}">
                                {{--                                    {{ $order->area->name}}</a>, {{$order->state->name}}--}}
                            </td>
                            <td>{{$order->product['value']}} </td>
                            <td>{{$order->product['quantity']}} </td>
                            <td>{{$order->details['notes'] ?? 'no notes'}} </td>
                            <td>{{$order->deleted_at}} </td>

                            <td><a href="{{route('admin.users.show',$order->user_id)}}">{{ $order->user->name }}</a> </td>
                            @auth
                                @role('seller|Feedback')
                                <td>
                                    <form action="{{route('admin.orders.restore',$order->hashid) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-danger" value="@lang('auth.restore')">
                                    </form>
                                </td>
                                @endrole
                            @endauth
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3">@lang('message.no-orders')</td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
                @if(count($orders) > 1 )
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning" disabled><small>@lang('names.download')</small></button>
                        <a href="{{route('export.orders.'.app()->getLocale())}}" class="btn btn-success">@lang('names.excel')</a>
                    </div>
                @endif

                {{ $orders->links() }}
            </div>

        </div>

@endsection

