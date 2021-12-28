@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center"> @lang("names.packing")</h1>
@endsection
@section('content')
        <div class="row  justify-content-center">

                @foreach($packing as $pack)
                <div class="col-6 col-md-4  col-lg-3 mb-3 ">
                <div class="card">
                    <div class="card-header">{{$pack->type}}</div>
                    <div class="card-body">
                        <p>@lang('auth.price') :<b> {{$pack->price}}</b></p>
                        <p>@lang('auth.size') :<b> {{$pack->size}}</b></p>
                    </div>
                </div>
                </div>
                @endforeach
        </div>

@endsection

