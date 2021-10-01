@extends('delivery.layouts.delivery')

@section('content')
    <div class="container">
        <div class="main-body  justify-content-center">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="/storage/{{ $user->profile->profile_photo ?? 'pics/profile.png'}}" alt="profile picture"  class="rounded-circle border" width="150">
                                <div class="mt-3">
                                    <h4>{{__('messages.welcome')}} {{$user->name}}</h4>
                                    <p class="text-secondary mb-1 ">{{$user->profile->bio}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 align-items-md-center ml-5">
                                    <a class="btn btn-info w-75" href="{{route('profile.edit')}}">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($user->profile->url)
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <i class="fas fab-facebook" ></i>
                                <a href="{{$user->profile->url}}"  class="text-secondary">{{$user->profile->url}}</a>
                            </li>
                        </ul>
                    </div>
                        @endif
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{__('auth.name')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$user->name}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{__('auth.email')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$user->email}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{__('auth.phone')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$user->phone}}
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{__('auth.address')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary" dir="rtl">
                                    {{$user->profile->address}} ,{{$user->profile->area}}, {{$user->state->name}}
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>

                    <div class="row gutters-sm">
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>{{__('names.tasks')}} </h6>
                                    <small>{{__('names.task')}} {{__('names.status')}}</small>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>{{__('names.orders')}}</h6>
                                    <small>{{__('names.order')}} {{__('names.status')}}</small>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
@endsection

