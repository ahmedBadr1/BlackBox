@extends('seller.layouts.seller')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center main-content-title">{{ __('names.notifications') }}</h1>
                <p  class="text-center">{{ __('messages.no-notifications') }}</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

            <div class="col-md-8 offset-md-2">
                <img src="http://blackbox.me/assets/img/svgicons/no-data.svg" alt="" class="mx-auto d-block">
            </div>

            </div>
        </div>



@endsection