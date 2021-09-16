@extends('layouts.admin');

@section('content')

    <h2>All Areas</h2>
    @can('area-create')
        <a href="{{route('areas.create')}}" class="btn btn-success">Create Area</a>
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
        <th>Price</th>
        <th>Zone</th>
        <th>State</th>
        </thead>
        <tbody>
        @foreach($areas as $area)
            <tr>
                <td>{{$area->id}} </td>
                <td> <a href="{{ route('areas.show',$area->id) }}"> {{$area->name}} </a></td>
                <td>{{$area->price}}</td>
                <td>{{$area->zone}}</td>
                <td>{{$area->state}}</td>

                @can('area-edit')
                    <td><a href="{{ route('areas.edit',$area->id) }}" class="btn btn-info">edit</a></td>
                @endcan
                @can('area-delete')
                    <td>
                        <form action="{{route('areas.destroy',$area->id) }}" method="POST">
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
