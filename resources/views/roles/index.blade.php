@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('role-create')
                    <a href="{{route('roles.create')}}" class="btn btn-success">{{__("auth.create")}} {{__("names.role")}}</a>
                @endcan
                @can('permissions')
                        <a href="{{route('roles.permissions')}}" class="btn btn-outline-primary">{{__("names.permissions")}}</a>
                @endcan

                <h1 class="text-center">{{__("names.all")}} {{__("names.roles")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">

                    <thead>

                    <th>{{__("names.role")}}</th>

                    <th>{{__("names.role")}} {{__("auth.id")}}</th>


                    <th>{{__("auth.createdat")}}</th>

                    </thead>

                    <tbody>

                    @foreach($roles as $role)

                        <tr>

                            <td> <a href="{{ route('roles.show',$role->id) }}"> {{$role->name}} </a></td>

                            <td>{{$role->id}} </td>



                            <td>{{$role->created_at}} </td>
                            @can('role-edit')
                            <td><a href="{{ route('roles.edit',$role->id) }}" class="btn btn-info">{{__('auth.edit')}}</a></td>
                            @endcan
                            @can('role-delete')
                            <td>
                                <form action="{{route('roles.destroy',$role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="{{__('auth.delete')}}">
                                </form>
                            </td>
                            @endcan

                        </tr>
                    @endforeach

                    </tbody>

                </table>
                    {{ $roles->links() }}
            </div>
        </div>
    </div>
@endsection

