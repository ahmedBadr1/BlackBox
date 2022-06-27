@extends('admin.layouts.admin')
@section('page-header')
    <h1 >@lang("names.all-roles")</h1>
<div class="">
    @can('permissions')
        <a href="{{route('admin.roles.permissions')}}" class="btn btn-outline-primary">@lang("names.permissions")</a>
    @endcan
    @can('role-create')
        <a href="{{route('admin.roles.create')}}" class="btn btn-success">@lang("auth.create-role")</a>
    @endcan
</div>
@endsection
@section('content')
        <div class="row ">
            <div class="col-md-12">
                <table class="table table-hover table-responsive-md">

                    <thead>

                    <th>@lang("names.role")</th>

                    <th> @lang("auth.id")</th>


                    <th>@lang("auth.created-at")</th>

                    </thead>

                    <tbody>

                    @foreach($roles as $role)

                        <tr>

                            <td> <a href="{{ route('admin.roles.show',$role->id) }}"> {{$role->name}} </a></td>

                            <td>{{$role->id}} </td>



                            <td>{{$role->created_at}} </td>
                            @can('role-edit')
                            <td><a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-info">@lang('auth.edit')</a></td>
                            @endcan
                            @can('role-delete')
                            <td>
                                <form action="{{route('admin.roles.destroy',$role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="@lang('auth.delete')">
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

@endsection

