@extends('main.layouts.app')
@section('meta')
    <style>
        .card {
            z-index: 0;
            background-color: #ECEFF1;
            margin-top: 10px;
        }

        .top {
            padding-top: 40px;
            padding-left: 13% !important;
            padding-right: 13% !important
        }
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: #455A64;
            padding-left: 0px;
            margin-top: 30px
        }

        #progressbar li {
            list-style-type: none;
            font-size: 13px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400
        }

        #progressbar .step0:before {
            font-family: 'boxicons'   ;
            content: "";
            color: #fff
        }

        #progressbar li:before {
            width: 40px;
            height: 40px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            background: #C5CAE9;
            border-radius: 50%;
            margin: auto;
            padding: 0px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 12px;
            background: #C5CAE9;
            position: absolute;
            left: 0;
            top: 16px;
            z-index: -1
        }

        #progressbar li:last-child:after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            position: absolute;
            left: -50%
        }

        #progressbar li:nth-child(2):after,
        #progressbar li:nth-child(3):after {
            left: -50%
        }

        #progressbar li:first-child:after {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            position: absolute;
            left: 50%
        }

        #progressbar li:last-child:after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px
        }

        #progressbar li:first-child:after {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #651FFF
        }

        #progressbar li.active:before {
            font-family: 'boxicons';
            content: ""
        }

        .icon {
            width: 60px;
            height: 60px;
            margin-right: 15px
        }

        .icon-content {
            padding-bottom: 20px
        }

        @media screen and (max-width: 992px) {
            .icon-content {
                width: 50%
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <form action="{{route('track')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('auth.enter-order-id')</label>
                        <input type="text" name="order_id" class="form-control" value="{{$order_hashid ?? ''}}">
                        @error('order_id')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>



                    <div class="form-group row mb-0 mt-3">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                @lang('names.track')
                            </button>
                        </div>
                    </div>

                </form>

            </div>

        </div>



        @if(isset($order))
            <div class="card">
                <div class="row d-flex justify-content-between px-3 top">

                    <h5>@lang('names.order') <span class="text-primary font-weight-bold">#{{$order->hashid}}</span></h5>

                    <h5>@lang('auth.status') <span class="text-primary font-weight-bold">#{{$order->status->name}}</span></h5>

                    <div class="d-flex flex-column text-sm-right">
                        <p class="mb-0">@lang('auth.expected-arrival') : <b> {{$order->created_at->addDays($order->area->delivery_time)->format('d M Y')}}</b></p>
                    </div>
                </div> <!-- Add class 'active' to progress -->


                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <ul id="progressbar" class="text-center">
                            @if($order->status->name == 'ready' )
                                <li class="active step0"></li>
                                <li class=" step0"></li>
                                <li class=" step0"></li>
                                <li class=" step0"></li>
                            @elseif($order->status->name == 'inline')
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class=" step0"></li>
                                <li class=" step0"></li>
                            @elseif($order->status->name == 'out-for-delivery')
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class=" step0"></li>
                            @elseif($order->status->name == 'delivered')
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>

                            @else
                                <li class=" step0"></li>
                                <li class=" step0"></li>
                                <li class=" step0"></li>
                                <li class=" step0"></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-between top">
                    <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold"><br>@lang('names.ready')</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold"><br>@lang('names.inline')</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold"><br>@lang('names.out-for-delivery')</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold"><br>@lang('names.delivered')</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="">@lang("messages.order-not-found")</div>
                </div>
            </div>
        @endif
    </div>
@endsection

