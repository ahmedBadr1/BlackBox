@extends('seller.layouts.seller')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @role('seller|Feedback')
            <a href="{{route('orders.create')}}" class="btn btn-success">@lang("auth.create")}} @lang("names.order")}}</a>
            @endrole
            @can('order-assign')
            <a href="{{route('orders.assign')}}" class="btn btn-secondary">@lang("auth.assign")}} @lang("names.order")}}</a>
            @endcan
            <form action="{{route('import.orders')}}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="file" name="import_file">
                <button type="submit"  class="btn btn-primary">Import</button>
            </form>
            @can('order-import')


            @endcan

            <h1 class="text-center">@lang("names.all")}} @lang("names.orders")}}</h1>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <table class="table table-hover table-responsive-md">

                <thead>
                <th>#</th>
                <th>@lang("auth.id")}} @lang("names.order")}}</th>
                <th>@lang("auth.product_name")}}</th>

                <th>@lang("auth.cust_name")}}</th>
                <th>@lang("auth.cust_num")}}</th>
                <th>@lang("auth.address")}}</th>
                <th>@lang("names.value")}}</th>
                <th>@lang("names.count")}}</th>
                <th>@lang("names.notes")}}</th>
                <th>@lang("names.deleted_at")}}</th>

                <th>@lang("auth.username")}}</th>

                </thead>

                <tbody>

                @forelse($orders as $key => $order)

                <tr>
                    <td>{{++$key}}</td>
                    <td> <a href="{{ route('orders.show',$order->hashid) }}"> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                    <td>{{$order->product_name}} </td>
                    <td>{{$order->cust_name}} </td>
                    <td>{{$order->cust_num}} </td>
                    <td>{{$order->address}}, <a href="{{route('areas.show',$order->area_id)}}">
                            {{--                                    {{ $order->area->name}}</a>, {{$order->state->name}}--}}
                    </td>
                    <td>{{$order->value}} </td>
                    <td>{{$order->quantity}} </td>
                    <td>{{$order->notes ?? 'no notes'}} </td>
                    <td>{{$order->deleted_at}} </td>

                    <td><a href="{{route('users.show',$order->user_id)}}">{{ $order->user->name }}</a> </td>
                    @auth
                    @role('seller|Feedback')
                    <td><a href="{{route('track',['order_id' => $order->hashid])}}" class="btn btn-outline-success">@lang('names.track')}}</a></td>
                    @endrole
                    @role('seller|Feedback')
                    <td><a href="{{ route('orders.edit',$order->hashid) }}"  onclick="return confirm('Sure Want Edit?')" class="btn btn-info">@lang('auth.edit')}}</a></td>
                    @endrole
                    @role('seller|Feedback')
                    <td>
                        <form action="{{route('orders.destroy',$order->hashid) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang('auth.delete')}}">
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
                <button type="button" class="btn btn-warning" disabled><small>@lang('names.download')}}</small></button>
                <a href="{{route('export.orders.'.app()->getLocale())}}" class="btn btn-success">@lang('names.excel')}}</a>
            </div>
            @endif

            {{ $orders->links() }}
        </div>

    </div>
</div>
@endsection

