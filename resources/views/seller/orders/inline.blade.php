@extends('seller.layouts.seller')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @role('seller|Feedback')
                <a href="{{route('orders.create')}}" class="btn btn-success">{{__("auth.create")}} {{__("names.order")}}</a>
                @endrole
                <div class="">
                    <form action="{{route('orders.pickup') }}" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-dark"   onclick="return confirm('Sure Want Order pickup?')" value="{{__('auth.request pickup')}}">
                    </form>
                </div>

                <h1 class="text-center">{{__("names.Ready for pickup")}} {{__("names.orders")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                    @forelse($orders as $key => $order)

                        <div class="card">
                            <div class="card-header">
                                {{++$key}} :  <a href="{{ route('orders.show',$order->hashid) }}">{{$order->product_name}} </a> <span>   @php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</span>
                            </div>
                            <div class="card-body">
                                {{$order->cust_name}} :{{$order->cust_num}}
                                <p>{{$order->address}}, <a href="{{route('areas.show',$order->area->id)}}">{{ $order->area->name}}</a>, {{$order->state->name}}</p>
                                {{$order->value}} :{{$order->quantity}}
                                <p>{{$order->notes ?? 'no notes'}}</p>
                                <div class="badge badge-primary">{{$order->status->name}}</div>
                            </div>
                            <div class="card-footer">
                                <div>
                                    <form action="{{route('orders.wait',$order->hashid) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-danger" value="{{__('auth.Remove-line')}}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="card">
                            <div class="card-header">No Orders Found</div>
                    </div>
                    @endforelse
                {{ $orders->links() }}
            </div>

        </div>
    </div>
@endsection

