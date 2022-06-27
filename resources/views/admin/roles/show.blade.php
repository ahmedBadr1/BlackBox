@extends('admin.layouts.admin')
@section('page-header')
    <h1 > @lang("names.role") {{$role->name}}</h1>
    <a href="{{route('admin.roles.index')}}" class="btn btn-primary">@lang("names.manage-roles")</a>
@endsection
@section('content')

        <div class="row">
            <div class="col-md-8">
                <label>@lang("names.permissions")</label><br>
                @forelse($role->permissions as $permission)
                        <span class="badge badge-success">{{$permission->name}}</span>
                    @empty
                       <p>no permissions for this role</p>
                    @endforelse
                 <hr>



                <div class="d-flex ">
                    @can('role-edit')
                    <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-info o">@lang("auth.edit")</a>
                    @endcan
                        @can('role-delete')
                    <form class="ml-5" action="{{route('admin.roles.destroy',$role->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="@lang("auth.delete")">
                    </form>
                        @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

