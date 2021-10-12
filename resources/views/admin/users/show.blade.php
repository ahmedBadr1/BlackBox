@extends('admin.layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.users.index')}}">Manage Users</a>
                <h1 class="text-center">Show User {{$user->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>User Name</label>
                <p><b>{{$user->name}}</b></p> <hr>
                <label>User Email</label>
                <p><b>{{$user->email}}</b></p> <hr>
                <label>User Phone</label>
                <p><b>{{$user->phone}}</b></p> <hr>
                <label>User State</label>
                <p><b>{{$user->state->name}}</b></p> <hr>
                <label>User Plan</label>
                <p><b><a href="{{route('admin.plans.show',$user->plan->id)}}">{{$user->plan->name}}</a></b></p> <hr>
                <label>User Role</label>
                <p><b>
                            @foreach($user->roles as $role)
                                <a href="{{route('admin.roles.show',$role->id)}}">{{$role->name }}</a>
                            @endforeach
                    </b></p> <hr>
                @if($user->roles[0]->id === 1 )
                    <div class="d-flex ">

                    </div>
                @else
                    <div class="d-flex ">
                        @can('user-edit')

                            <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-info o">edit</a>
                        @endcan
                        @can('user-delete')
                            <form class="ml-5" action="{{route('admin.users.destroy',$user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="delete">
                            </form>
                        @endcan
                    </div>
                @endif


            </div>
        </div>
    </div>
@endsection

