@extends('seller.layouts.seller')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <h1 class="text-center main-content-title">@lang('names.setting') </h1>

            <p class="text-center">@lang('messages.setting') </p>
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif


        </div>
    </div>

    <div class="row justify-content-center">

       <livewire:seller.setting />
    </div>



@endsection
