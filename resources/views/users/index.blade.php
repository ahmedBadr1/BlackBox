@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">All Users</h1>
                @can('user-create')
                    <a href="{{route('users.create')}}" class="btn btn-success">Create User</a>
                 @endcan
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-hover">

                    <thead>
                    <th>ID</th>
                    <th>Username</th>

                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>

                    <th>Created at</th>

                    </thead>

                    <tbody>

                    @foreach($users as $user)

                        <tr>
                            <td>{{$user->id}} </td>
                            <td> <a href="{{ route('users.show',$user->id) }}"> {{$user->name}} </a></td>

                            <td>{{$user->email}} </td>
                            <td>{{$user->phone}} </td>
                            <td><a href="{{ route('roles.show',$user->role) }}">{{ $user->getRoleNames() !== '[]' ? trim($user->getRoleNames(),'[""]') : "customer" }}</a></td>
                            <td>{{$user->created_at}}</td>
                            @can('user-edit')
                                <td><a href="{{ route('users.edit',$user->id) }}" class="btn btn-info">edit</a></td>
                            @endcan
                            @can('user-delete')
                            <td>
                               <form action="{{route('users.destroy',$user->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                <input type="submit" class="btn btn-danger" name="delete" value="delete">
                               </form>
                            </td>
                            @endcan
                        </tr>
                    @endforeach

                    </tbody>

                </table>


                        {{ $users->links() }}


            </div>
        </div>
    </div>


@endsection

