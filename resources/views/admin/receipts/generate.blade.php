@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @role('seller|Feedback')
                <a href="{{route('admin.orders.create')}}" class="btn btn-success">{{__("auth.create")}} {{__("names.order")}}</a>
                @endrole



                <h1 class="text-center">{{__("auth.generate")}} {{__("auth.receipt")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @role('seller|Feedback')
                <form action="{{route('admin.receipts.store')}}" method="post">
                    @csrf
                    <input type="hidden" id="selectAll" name="selectAll" value="0">
                    <button  class="btn btn-success">{{__("auth.generate")}} {{__("auth.receipt")}}</button>


                @endrole

                <table class="table table-hover">

                    <thead>
                    <th ><input type="checkbox" id="selectAll" name="selectAll" value="1"></th>
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

                    @foreach($pendingOrders as $order)

                        <tr>
                            <td><input type="checkbox" name="orders[]" value="{{$order->id}}"></td>
                            <td> <a href="{{ route('admin.orders.show',$order->hashid) }}"> {{$order->hashid}}@php echo DNS1D::getBarcodeHTML($order->hashid,'C39'); @endphp</a></td>
                            <td>{{$order->product_name}} </td>
                            <td>{{$order->cust_name}} </td>
                            <td>{{$order->cust_num}} </td>
                            <td>{{$order->address}}, <a href="{{route('admin.areas.show',$order->area->id)}}">{{ $order->area->name}}</a>, {{$order->state->name}}</td>
                            <td>{{$order->value}} </td>
                            <td>{{$order->quantity}} </td>
                            <td>{{$order->notes ?? 'no notes'}} </td>
                            <td>{{$order->status->name}} </td>

                            <td><a href="{{route('admin.users.show',$order->user_id)}}">{{ $order->user->name }}</a> </td>
                        </tr>

                    @endforeach
                </form>
                    </tbody>

                </table>
{{--                @if(count($pendingOrders) > 1 )--}}
{{--                    <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                        <button type="button" class="btn btn-warning" disabled><small>{{__('names.download')}}</small></button>--}}
{{--                        <a href="{{route('export.orders.'.app()->getLocale())}}" class="btn btn-success">{{__('names.excel')}}</a>--}}
{{--                    </div>--}}
{{--                @endif--}}


            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
   // const selectAll = document.getElementById('selectAll');
   // const checkboxes = document.querySelectorAll('[type=checkbox');
   // console.log(checkboxes[1].toggleAttribute("checked"));
   // checkboxes[0].addEventListener('change',()=>{
   //         console.log('go');
   //         checkboxes.forEach((checkbox) =>{
   //              console.log(checkbox.checked);
   //             checkbox.toggleAttribute("disabled");
   //     });
   // });

   // checkboxes.forEach((checkbox) =>{
   //     console.log(checkbox.checked);
   //     checkbox.setAttribute('checked',true);
   // });
    </script>
@endsection
