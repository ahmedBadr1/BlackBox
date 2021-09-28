@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">All sellers</h1>
                <p>{{ __('messages.welcome') }}</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">

                    <thead>
                    <th>ID</th>
                    <th>seller Name</th>

                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>

                    <th>Created at</th>

                    </thead>

                    <tbody>

                    @foreach($sellers as $user)

                        <tr>
                            <td>{{$user->id}} </td>
                            <td> <a href="{{ route('users.show',$user->id) }}"> {{$user->name}} </a></td>

                            <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                            <td>{{$user->phone}} </td>
                            <td>{{$user->roles[0]->name}}</td>
                            <td>{{$user->created_at}}</td>
                            @can('user-show')
                                <td>
                                    <form action="{{route('emailto',['e' => $user->email])}}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-secondary"  value="Email">
                                    </form>
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

