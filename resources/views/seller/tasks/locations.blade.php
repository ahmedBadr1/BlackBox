@extends('seller.layouts.seller')

@section('content')
    <div class="row justify-content-center">
        <h1 class="main-content-title">
            @lang('names.locations')

        </h1>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif


    </div>
    <div class="row ">
        <div class="col-md-12">
            <livewire:seller.locations-create />
        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">

        <livewire:seller.locations-table />
        </div>
    </div>


@endsection
