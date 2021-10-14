<div>
    <div class="container-fluid ">
        <div class="row my-3 d-flex">
            <div class="col-md-6">
                <input type="search" wire:model="search" class="form-control" placeholder="search in names">
            </div>
            <div class="col-xs-2">
                <select wire:model="orderBy" class="form-control-sm">
                    <option>Id</option>
                    <option>Value</option>
                    <option value="cust_name">Consignee Name</option>
                    <option value="cust_num">Consignee Number</option>
                    <option>Quantity</option>
                    <option>total</option>
                    <option>created_at</option>
                </select>
            </div>
            <div class="col-xs-2">
                <select wire:model="orderDesc" class="custom-select-sm border">
                    <option value="1">Desc</option>
                    <option value="0">Asc</option>

                </select>
            </div>
            <div class="col-xs-2">
                <label for="">From</label>
                <input type="date" wire:model="startDate">
                <label for="">To</label>
                <input type="date" wire:model="endDate">
            </div>
            <div class="col-xs-2">
                <select wire:model="perPage" class="form-control-sm">
                    <option>5</option>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
        <div class="row">
    <table class="table table-hover">

        <thead>
        <th>#</th>
        <th>{{__("auth.id")}} {{__("names.order")}}</th>
        <th>{{__("auth.product_name")}}</th>
        <th>{{__("auth.cust_name")}}</th>
        <th>{{__("auth.cust_num")}}</th>
        <th>{{__("auth.address")}}</th>
        <th>{{__("names.total")}}</th>
        <th>{{__("names.count")}}</th>
        <th>{{__("names.notes")}}</th>
        <th>{{__("names.status")}}</th>
        <th>{{__("auth.username")}}</th>

        </thead>

        <tbody>

        @forelse($orders as $key => $order)

            <tr>
                <td>{{++$key}}</td>
                <td> <a href="{{ route('admin.orders.show',$order->hashid) }}" style="max-width: 100px "> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                <td>{{$order->product_name}} </td>
                <td>{{$order->cust_name}} </td>
                <td>{{$order->cust_num}} </td>
                <td>{{$order->address}}, <a href="{{route('admin.areas.show',$order->area_id)}}">
                                                        {{ $order->area->name}}</a>, {{$order->state->name}}
                </td>
                <td>{{$order->total}} </td>
                <td>{{$order->quantity}} </td>
                <td>{{\Illuminate\Support\Str::limit($order->notes, 20) ?? 'no notes'}} </td>
                <td>{{$order->status->name}} </td>

                <td><a href="{{route('admin.users.show',$order->user_id)}}">{{ $order->user->name }}</a> </td>
                @auth
                    @role('seller|Feedback')
                    <td><a href="{{route('admin.track',['order_id' => $order->hashid])}}" class="btn btn-outline-success">{{__('names.track')}}</a></td>
                    @endrole
                    @role('seller|Feedback')
                    <td><a href="{{ route('admin.orders.edit',$order->hashid) }}"  onclick="return confirm('Sure Want Edit?')" class="btn btn-info">{{__('auth.edit')}}</a></td>
                    @endrole
                    @role('seller|Feedback')
                    <td>
                        <form action="{{route('admin.orders.destroy',$order->hashid) }}" method="POST">
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

</div>

        @if(count($orders) > 0 )
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-warning" wire:click="export" wire:loading.attr="disabled"><small>{{__('auth.download')}}</small></button>
                <a href="{{route('admin.export.orders.'.app()->getLocale())}}" class="btn btn-success">{{__('auth.excel')}}</a>
            </div>
        @endif
        <div class="d-flex justify-content-center">
            {{ $orders->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>


{{--<ul class="list-group">--}}
{{--    @forelse($orders as $key => $order)--}}
{{--    <li class="list-group-item border-0 d-flex p-4  mb-2 bg-info border-radius-lg">--}}
{{--        <div class="d-flex flex-column">--}}
{{--            <h6 class="mb-3 text-sm">{{++$key}} : Order For <a href="{{route('admin.users.show',$order->user_id)}}">{{ $order->user->name }}</a></h6>--}}
{{--            <span class="ml-auto text-xs badge badge-success">{{$order->status->name}}</span>--}}
{{--            <div class="d-flex">--}}
{{--                <span class="mb-2 text-xs">Shipper Name: <span class="text-dark font-weight-bold ms-2">{{$order->cust_name}}</span></span>--}}
{{--                <span class="m-2">contact :{{$order->cust_name}}</span>--}}
{{--            </div>--}}


{{--            <span class="mb-2 text-xs">Address: <span class="text-dark font-weight-bold ms-2">{{$order->address}}, <a href="{{route('admin.areas.show',$order->area_id)}}"></span></span>--}}
{{--            <span class="mb-2 text-xs">Notes: <span class="text-dark ms-2 font-weight-bold">{{\Illuminate\Support\Str::limit($order->notes, 20) ?? 'no notes'}}</span></span>--}}

{{--            <span class="text-xs">Track ID : <a href="{{ route('admin.orders.show',$order->hashid) }}" style="max-width: 100px "> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></span>--}}
{{--            <span class="text-xs"><a href="{{route('admin.track',['order_id' => $order->hashid])}}"  class="text-dark ms-2 font-weight-bold" >{{__('names.track')}}</a></span>--}}
{{--        </div>--}}
{{--        <div class="ms-auto">--}}
{{--            <form action="{{route('admin.orders.destroy',$order->hashid) }}" method="POST">--}}
{{--                @csrf--}}
{{--                @method('DELETE')--}}
{{--                <i class="far fa-trash-alt me-2" aria-hidden="true"></i>--}}
{{--                <input type="submit"  value="{{__('auth.delete')}}">--}}
{{--            </form>--}}
{{--            <a href="{{ route('admin.orders.edit',$order->hashid) }}"  onclick="return confirm('Sure Want Edit?')" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>{{__('auth.edit')}}</a>--}}
{{--        </div>--}}
{{--    </li>--}}

{{--    @empty--}}
{{--        <li>--}}
{{--            <spam >No Orders Found</spam>--}}
{{--        </li>--}}
{{--    @endforelse--}}
{{--</ul>--}}
