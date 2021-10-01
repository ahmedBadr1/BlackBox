@extends('admin.layouts.admin');

@section('content')

    <h2>All Zones</h2>
    @can('zone-create')
        <a href="{{route('admin.zones.create')}}" class="btn btn-success">Create Zone</a>
    @endcan
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <table class="table table-hover">

        <thead>
        <th>Zone ID</th>
        <th>Name</th>
        <th>Areas</th>
        <th>State</th>
        <th>Rank</th>

        </thead>
        <tbody>
        @foreach($zones as $zone)
            <tr>
                <td>{{$zone->id}} </td>
                <td> <a href="{{ route('admin.zones.show',$zone->id) }}"> {{$zone->name}} </a></td>
                <td>@foreach($zone->areas as $area)
                        <a href="{{route('admin.areas.show',$area->id)}}"><div class="badge badge-primary"> {{$area->name}}</div></a>
                    @endforeach</td>
                <td>{{$zone->state->name}}</td>
                <td>{{$zone->rank}}</td>

                @can('zone-edit')
                    <td><a href="{{ route('admin.zones.edit',$zone->id) }}" class="btn btn-info">edit</a></td>
                @endcan
                @can('zone-delete')
                    <td>
                        <form action="{{route('admin.zones.destroy',$zone->id) }}" method="POST">
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
    {{ $zones->links() }}

@endsection
