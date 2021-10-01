@extends('admin.layouts.admin');

@section('content')

    <h2>All Areas</h2>
    @can('area-create')
        <a href="{{route('admin.areas.create')}}" class="btn btn-success">Create Area</a>
    @endcan
    @can('states')
        <a href="{{route('admin.states')}}" class="btn btn-dark">States</a>
    @endcan
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <table class="table table-hover">

        <thead>
        <th>Area ID</th>
        <th>Area</th>
        <th>Cost</th>
        <th>Zone</th>
        <th>State</th>
        </thead>
        <tbody>
        @foreach($areas as $area)
            <tr>
                <td>{{$area->id}} </td>
                <td> <a href="{{ route('admin.areas.show',$area->id) }}"> {{$area->name}} </a></td>
                <td>{{$area->delivery_cost}}</td>
                <td><a href="{{route('admin.zones.show',$area->zone->id)}}">{{$area->zone->name}}</a></td>
                <td>{{$area->state->name}}</td>

                @can('area-edit')
                    <td><a href="{{ route('admin.areas.edit',$area->id) }}" class="btn btn-info">edit</a></td>
                @endcan
                @can('area-delete')
                    <td>
                        <form action="{{route('admin.areas.destroy',$area->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="delete">
                        </form>
                    </td>
                @endcan
            </tr>
        @endforeach

        </tbody>

    </table>
    {{ $areas->links() }}

@endsection
