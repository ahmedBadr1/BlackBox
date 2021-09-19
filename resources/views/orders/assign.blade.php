@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{route('branches.index')}}">{{__("names.manage")}} {{__("names.branches")}}</a>
                <h1 class="text-center">{{__('names.orders')}} {{__("names.assing")}} </h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{route('orders.assign')}}" method="POST">
                    @csrf


                    <div class="form-group container-fluid col-md-12 mb-0">
                        <h3>Deliveries</h3>
                        <div class="row offset-md-2 ">
                            @foreach($deliveries as $delivery)
                                <div class="m-2">
                                    <input type="radio"  name="delivery"  value="{{$delivery->id}}">
                                    <label for="{{$delivery->name}}">{{$delivery->name}}</label><br>
                                </div>

                            @endforeach

                            @error('delivery')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group container-fluid col-md-12 mb-0">
                        <h3>Deliveries</h3>
                        <div class="row offset-md-2 ">
                            @foreach($orders as $order)
                                <div class="m-2">
                                <input type="checkbox"  name="orders[]" value="{{$order->id}}" @if($delivery->id === $order->delivery_id) {{__("checked")}} @endif>
                                <label for="{{$order->id}}">{{$order->id}} => <a href="{{route('areas.show',$order->area->id)}}">{{$order->area->name}}</a> </label><br>
                                </div>
                            @endforeach

                            @error('orders')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('names.assign') }}
                            </button>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection

