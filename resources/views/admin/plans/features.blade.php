@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">All Features</h1>
                @can('plan-show')
                    <a href="{{route('admin.plans.index')}}" class="btn btn-outline-info">All Plans</a>
                @endcan
                @can('plan-create')
                    <a href="{{route('admin.plans.create')}}" class="btn btn-success">Create Plan</a>
                @endcan

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-hover">

                    <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Rank</th>
                    <th>Description</th>
                    </thead>

                    <tbody>

                    @foreach($features as $feature)

                        <tr>
                            <td>{{$feature->id}} </td>
                            <td> <a href="{{ route('admin.features.show',$feature->id) }}"> {{$feature->name}} </a></td>

                            <td>{{$feature->rank}} </td>
                            <td>{{$feature->description}} </td>

                        </tr>
                    @endforeach

                    </tbody>

                </table>


            </div>
        </div>
    </div>


@endsection

