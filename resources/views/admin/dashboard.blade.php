@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("names.dashboard")</h1>
@endsection
@section('content')


        <div class="row ">
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">


        @can('user-show')<!-- Earnings (Monthly) Card Example -->
            <div class="card bg-primary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="bx bx-user bx-lg"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">@lang("names.users-count")</span>
                                <h2 class="text-white mb-0">{{$users}} @lang("names.users")</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan


    </div>
    </div>
@endsection

