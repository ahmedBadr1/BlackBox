@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.roles.index')}}">{{__("names.manage")}} {{__("names.roles")}}</a>
                <h1 class="text-center"> {{__("names.role")}} {{$role->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.role")}} {{__("auth.id")}}</label>
                <p><b>{{$role->id}}</b></p> <hr>
                <label>{{__("names.role")}} {{__("auth.name")}}</label>
                <p><b>{{$role->name}}</b></p> <hr>
                <label>{{__("names.role")}} {{__("names.permissions")}}</label>
                <p>@foreach($role->permissions as $permission)
                        <span class="badge badge-success">{{$permission->name}}</span>

                    @endforeach
                </p> <hr>



                <div class="d-flex ">
                    @can('role-edit')
                    <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-info o">{{__("auth.edit")}}</a>
                    @endcan
                        @can('role-delete')
                    <form class="ml-5" action="{{route('admin.roles.destroy',$role->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="{{__("auth.delete")}}">
                    </form>
                        @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

