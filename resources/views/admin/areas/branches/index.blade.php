@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('branch-create')
                    <a href="{{route('admin.branches.create')}}" class="btn btn-success">{{__("auth.create")}} {{__("names.branch")}}</a>
                @endcan


                <h1 class="text-center">{{__("names.all")}} {{__("names.branches")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">

                    <thead>

                    <th>{{__("names.branch")}}</th>
                    <th>{{__("auth.phone")}}</th>
                    <th>{{__("auth.location")}}</th>
                    <th>{{__("auth.state")}}</th>
                    <th>{{__("auth.manager")}}</th>

                    </thead>

                    <tbody>

                    @foreach($branches as $branch)

                        <tr>

                            <td> <a href="{{ route('admin.branches.show',$branch->id) }}"> {{$branch->name}} </a></td>

                            <td>{{$branch->phone}} </td>
                            <td>{{$branch->location}} </td>
                            <td>{{$branch->state->name }} </td>

                            <td><a href="{{route('admin.users.show',$branch->manager->id)}}">{{$branch->manager->name}}</a></td>
                            @can('branch-assign')
                                <td><a href="{{route('admin.branches.assign',$branch->id)}}" class="btn btn-outline-success">{{__('names.assign')}}</a></td>
                            @endcan
                            @can('branch-edit')
                            <td><a href="{{ route('admin.branches.edit',$branch->id) }}" class="btn btn-info">{{__('auth.edit')}}</a></td>
                            @endcan
                            @can('branch-delete')
                            <td>
                                <form action="{{route('admin.branches.destroy',$branch->id) }}" method="POST">
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
                    {{ $branches->links() }}
            </div>
        </div>
    </div>
@endsection

