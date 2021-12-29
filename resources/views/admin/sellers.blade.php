@extends('admin.layouts.admin')
@section('page-header')
        <h1 class="text-center">@lang('names.all-sellers')</h1>
@endsection
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">

                <p>@lang('messages.welcome')</p>

                <table class="table table-hover">

                    <thead>
                    <th>@lang('auth.id')</th>
                    <th>@lang('auth.seller')</th>

                    <th>@lang('auth.email')</th>
                    <th>@lang('auth.phone')</th>
                    <th>@lang('auth.plan')</th>

                    <th>@lang('auth.joined_at')</th>

                    </thead>

                    <tbody>

                    @foreach($sellers as $user)

                        <tr>
                            <td>{{$user->id}} </td>
                            <td> <a href="{{ route('admin.users.show',$user->id) }}"> {{$user->name}} </a></td>

                            <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                            <td>{{$user->phone}} </td>
                            <td><a href="{{route('admin.plans.show',$user->plan->id)}}">{{$user->plan->name}}</a></td>
                            <td>{{$user->created_at}}</td>
                            @can('user-show')
                                <td>
                                    <form action="{{route('admin.emailto',['e' => $user->email])}}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-secondary"  value="Email">
                                    </form>
                                </td>
                            @endcan
                            @can('user-active')
                                <td>
{{--                                    <livewire:user-toggle id="{{$user->id}}" active="{{$user->active}}"  />--}}

                                    @livewire('main.toggle-button',['model' => $user,'field'=>'active'])
                                </td>
                            @endcan

                        </tr>
                    @endforeach

                    </tbody>

                </table>

                {{--            <a href="{{route('welcome.email')}}" class="btn btn-success">send</a>--}}

            </div>
        </div>
    </div>


@endsection

