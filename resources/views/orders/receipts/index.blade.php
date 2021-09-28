@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @role('client|Feedback')
                <a href="{{route('receipts.create')}}" class="btn btn-success">{{__("auth.generate")}} {{__("names.receipt")}}</a>
                @endrole

                <h1 class="text-center">{{__("names.all")}} {{__("names.receipts")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">

                    <thead>

                    <th>{{__("auth.id")}} {{__("names.receipt")}}</th>
                    <th>{{__("auth.order_ids")}}</th>
                    <th>{{__("auth.orders_count")}}</th>
                    <th>{{__("auth.sub_total")}}</th>
                    <th>{{__("names.discount")}}</th>
                    <th>{{__("names.tax")}}</th>
                    <th>{{__("names.total")}}</th>
                    <th>{{__("names.barcode")}}</th>

                    <th>{{__("auth.username")}}</th>

                    </thead>

                    <tbody>

                    @foreach($receipts as $receipt)

{{--                        <div class="card w-75" >--}}
{{--                            <div class="card-header">--}}
{{--                                {{__("names.receipt")}}--}}
{{--                            </div>--}}
{{--                            <ul class="list-group list-group-flush">--}}
{{--                                <li class="list-group-item">An item</li>--}}
{{--                                <li class="list-group-item">{{__('names.tax')}} {{$receipt->tax}} </li>--}}
{{--                                <li class="list-group-item"></li>--}}
{{--                            </ul>--}}
{{--                            <div class="card-footer">--}}
{{--                                <div class="">{{__('names.total')}} {{$receipt->total }}</div>--}}
{{--                              <small class="text-muted float-right">{{__('names.updated_at')}} {{$receipt->updated_at->format('Y-m-d')}}</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}


                        <tr>

                            <td> <a href="{{ route('receipts.show',$receipt->id) }}"> {{$receipt->id}} </a></td>

                            <td>{{$receipt->order_id}}</td>
                            <td>{{$receipt->orders_count}}</td>
                            <td>{{$receipt->sub_total}}</td>
                            <td>{{$receipt->discount}} </td>
                            <td>{{$receipt->tax}} </td>
                            <td>{{$receipt->total }} </td>
                            <td>@php echo DNS1D::getBarcodeHTML($receipt->order_id,'C39'); @endphp</td>
                            <td><a href="{{route('users.show',$receipt->user_id)}}">{{ $receipt->user->name }}</a> </td>
                            @role('client|Feedback')
                            <td><a href="{{route('track',['order_id' => $receipt->order_id])}}" class="btn btn-outline-success">{{__('names.track')}}</a></td>
                            @endrole

                            @role('client|Feedback')
                            <td><a href="{{ route('receipts.edit',$receipt->id) }}" class="btn btn-info">{{__('auth.edit')}}</a></td>
                            @endrole
                            @role('client|Feedback')
                            <td>
                                <form action="{{route('receipts.destroy',$receipt->id) }}" method="POST">
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

            </div>

        </div>
    </div>
@endsection

