@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("names.all-branches") </h1>
<div class="">
    @can('branch-create')
        <a href="{{route('admin.branches.create')}}" class="btn btn-success">@lang("auth.create-branch")</a>
    @endcan
</div>
@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-hover">

                    <thead>

                    <th>@lang("names.branch")</th>
                    <th>@lang("auth.phone")</th>
                    <th>@lang("auth.location")</th>
                    <th>@lang("auth.state")</th>
                    <th>@lang("auth.manager")</th>

                    </thead>

                    <tbody>

                    @foreach($branches as $branch)

                        <tr>

                            <td> <a href="{{ route('admin.branches.show',$branch->id) }}"> {{$branch->name}} </a></td>

                            <td>{{$branch->phone}} </td>
                            @if($branch->location)
                            <td><a href="{{route('admin.locations.show',$branch->location->id)}}">{{$branch->location->name}}</a></td>
                            @endif
                            <td>{{$branch->state->name }} </td>

                            <td><a href="{{route('admin.users.show',$branch->manager->id)}}">{{$branch->manager->name}}</a></td>
                            @can('branch-assign')
                                <td><a href="{{route('admin.branches.assign',$branch->id)}}" class="btn btn-outline-success">@lang('auth.assign')</a></td>
                            @endcan
                            @can('branch-edit')
                            <td><a href="{{ route('admin.branches.edit',$branch->id) }}" class="btn btn-info">@lang('auth.edit')</a></td>
                            @endcan
                            @can('branch-delete')
                            <td>
                                <form action="{{route('admin.branches.destroy',$branch->id) }}" method="POST">
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
                <div class="d-flex justify-content-center">
                    {{ $branches->links() }}
                </div>
        </div>
    </div>
@endsection

