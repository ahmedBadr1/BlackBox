@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center"> @lang("names.order") {{$order->hashid}}</h1>
    <a href="{{route('admin.orders.index')}}" class="btn btn-primary">@lang("names.manage-orders")</a>
@endsection
@section('content')

        <div class="row ">
            <div class="col-md-8">


                <label>@lang("names.order-id")</label>
                <p><b>   {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</b></p> <hr>
                <label> @lang("auth.product-name")</label>
                <p><b>{{$order->product['name']}}</b></p> <hr>
                <label> @lang("auth.cust-name")</label>
                <p><b>{{$order->consignee['cust_name']}}</b></p> <hr>
                <label> @lang("auth.cust-num")</label>
                <p><b>{{$order->consignee['cust_num']}}</b></p> <hr>
                <label> @lang("auth.location")</label>
                <p><b> {{$order->consignee['address']}}, <a href="{{route('admin.areas.show',$order->area->id )}}">{{ $order->area->name }}</a>, {{$order->state->name}}</b></p> <hr>
                <label> @lang("auth.value")</label>
                <p><b>{{$order->product['value']}}</b></p> <hr>
                <label> @lang("auth.count")</label>
                <p><b>{{$order->product['quantity']}}</b></p> <hr>
                <label>@lang("names.order") @lang("auth.notes")</label>
                <p><b>{{$order->details['notes'] ?? 'no notes'}} </b></p> <hr>
                <label> @lang("auth.cost")</label>
                <p><b>{{$order->cost }} </b></p> <hr>
                <label> @lang("auth.total")</label>
                <p><b>{{$order->total }} </b></p> <hr>
                <label> @lang("auth.status")</label>
                <p><b>{{$order->status->name}}</b></p> <hr>
                <p>@lang("auth.created")<b> {{$order->created_at->diffForHumans()}}</b></p> <hr>

                <div class="d-flex ">
                        <a href="{{ route('admin.orders.edit',$order->hashid) }}" class="btn btn-info o">@lang("auth.edit")</a>
                        <form class="ml-5" action="{{route('admin.orders.destroy',$order->hashid) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang("auth.delete")">
                        </form>
                </div>


            </div>
        </div>

@endsection

