@extends('seller.layouts.seller')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center main-content-title">@lang("names.ready-for-pickup") </h1>
                <div class="my-2">
                    <a href="{{route('pickups')}}" class="btn btn-dark">
                        @lang('names.request-pickup')
                    </a>
                </div>

                    @forelse($orders as $key => $order)

                        <div class="card">
                            <div class="card-header">
                                {{++$key}} :  <a href="{{ route('orders.show',$order->hashid) }}"> {{$order->hashid}}</a> <span>   @php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</span>
                            </div>
                            <div class="card-body">
                                <h3>@lang('auth.status') : @lang('names.'.$order->status->name)</h3>
                                {{$order->consignee['cust_name']}} :{{$order->consignee['cust_num']}}
                                <p>{{$order->consignee['address']}},{{ $order->area->name}}, {{$order->state->name}}</p>
                                <div class="d-flex justify-content-between">
                                    <p> @lang('auth.cost') :{{$order->cost}}</p>
                                    <p>@lang('auth.total') : {{$order->total}}</p>
                                    <p>{{$order->notes ?? 'no notes'}}</p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div>
                                    <form action="{{route('orders.wait',$order->hashid) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-danger" value="@lang('names.not-ready')">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="card">
                            <div class="card-header">@lang('messages.no-orders')</div>
                    </div>
                    @endforelse
                {{ $orders->links() }}
            </div>

        </div>

@endsection

