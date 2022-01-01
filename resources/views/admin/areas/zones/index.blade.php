@extends('admin.layouts.admin');
@section('page-header')
    <h2>All Zones</h2>
    @can('zone-create')
        <a href="{{route('admin.zones.create')}}" class="btn btn-success">@lang('auth.create-zone')</a>
    @endcan
@endsection
@section('content')

<div class="row">


    <table class="table table-hover table-responsive-md">

        <thead>
        <th>@lang('auth.id')</th>
        <th>@lang('auth.zone-name')</th>
        <th>@lang('names.areas')</th>
        <th>@lang('auth.state')</th>

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
    <div class="d-flex justify-content-center">
        {{ $zones->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
