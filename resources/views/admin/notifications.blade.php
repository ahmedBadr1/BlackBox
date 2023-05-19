@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.all-notifications')</h1>
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


        </div>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="border">
                <div class="bg-gray-100 nav-bg">
                    <nav class="nav nav-tabs">
                        <a class="nav-link active" data-toggle="tab" href="#unReadNotifications">@lang('names.new-notifications')</a>
                        <a class="nav-link" data-toggle="tab" href="#notifications">@lang('names.read-notifications')</a>

                    </nav>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane active show" id="unReadNotifications">
                        <livewire:main.notification-table :notifications="auth()->user()->unreadNotifications " />
                    </div>
                    <div class="tab-pane" id="notifications">
                        <livewire:main.notification-table :notifications="auth()->user()->notifications " />
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
