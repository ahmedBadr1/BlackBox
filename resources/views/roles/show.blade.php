@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('roles.index')}}">Manage Roles</a>
                <h1 class="text-center">Show Role {{$role->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>Role ID</label>
                <p><b>{{$role->id}}</b></p> <hr>
                <label>Role Name</label>
                <p><b>{{$role->name}}</b></p> <hr>
                <label>Role Permissions</label>
                <p>@foreach($rolePermissions as $permission)
                        <span class="badge badge-success">{{$permission->name}}</span>

                    @endforeach
                </p> <hr>



                <div class="d-flex ">
                    @can('role-edit')
                    <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-info o">edit</a>
                    @endcan
                        @can('role-delete')
                    <form class="ml-5" action="{{route('roles.destroy',$role->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="delete">
                    </form>
                        @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

