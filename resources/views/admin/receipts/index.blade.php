@extends('admin.layouts.admin')
@section('page-header')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @role('client|Feedback')
                <a href="{{route('admin.receipts.create')}}" class="btn btn-success">@lang("auth.generate")}} @lang("names.receipt")}}</a>
                @endrole

                <h1 class="text-center">@lang("names.all")}} @lang("names.receipts")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">

                    <thead>

                    <th>@lang("auth.id")}} @lang("names.receipt")}}</th>
                    <th>@lang("auth.order_ids")}}</th>
                    <th>@lang("auth.orders_count")}}</th>
                    <th>@lang("auth.sub_total")}}</th>
                    <th>@lang("names.discount")}}</th>
                    <th>@lang("names.tax")}}</th>
                    <th>@lang("names.total")}}</th>
                    <th>@lang("names.barcode")}}</th>

                    <th>@lang("auth.username")}}</th>

                    </thead>

                    <tbody>

                    @foreach($receipts as $receipt)

{{--                        <div class="card w-75" >--}}
{{--                            <div class="card-header">--}}
{{--                                @lang("names.receipt")}}--}}
{{--                            </div>--}}
{{--                            <ul class="list-group list-group-flush">--}}
{{--                                <li class="list-group-item">An item</li>--}}
{{--                                <li class="list-group-item">@lang('names.tax')}} {{$receipt->tax}} </li>--}}
{{--                                <li class="list-group-item"></li>--}}
{{--                            </ul>--}}
{{--                            <div class="card-footer">--}}
{{--                                <div class="">@lang('names.total')}} {{$receipt->total }}</div>--}}
{{--                              <small class="text-muted float-right">@lang('names.updated_at')}} {{$receipt->updated_at->format('Y-m-d')}}</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}


                        <tr>

                            <td> <a href="{{ route('admin.receipts.show',$receipt->id) }}"> {{$receipt->id}} </a></td>

                            <td>@foreach($receipt->orders_ids as $order)
                              {{ $order }} ,
                                @endforeach
                            </td>
                            <td>{{$receipt->orders_count}}</td>
                            <td>{{$receipt->sub_total}}</td>
                            <td>{{$receipt->discount}} </td>
                            <td>{{$receipt->tax}} </td>
                            <td>{{$receipt->total }} </td>
                            <td>@php echo DNS1D::getBarcodeHTML($receipt->order_id,'C39'); @endphp</td>
                            <td><a href="{{route('admin.users.show',$receipt->user_id)}}">{{ $receipt->user->name }}</a> </td>
                            @role('client|Feedback')
                            <td><a href="{{route('admin.receipts.print',$receipt->id)}}" class="btn btn-outline-success">@lang('auth.print')}}</a></td>
                            @endrole

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>
@endsection

