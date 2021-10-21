@extends('seller.layouts.seller')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center main-content-title">{{ __('names.messages') }}</h1>
            <p  class="text-center">{{ __('messages.no-messages') }}</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

@endsection
