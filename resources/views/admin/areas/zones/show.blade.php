@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center"> @lang("names.zone") {{$zone->name}}</h1>
    <a href="{{route('admin.zones.index')}}" class="btn btn-primary">@lang("names.manage-zones")</a>
@endsection
@section('content')
        <div class="row ">
            <div class="col-md-8">
                <label>@lang("names.zone-name")</label>
                <p><b>{{$zone->name}}</b></p> <hr>
                <label> @lang("auth.location")</label>
                <p><b>{{$zone->state->name}}</b></p> <hr>
                <td>@foreach($zone->areas as $area)
                        <a href="{{route('admin.areas.show',$area->id)}}" class="badge badge-success">{{$area->name}}</a>
                    @endforeach</td>

                <div class="d-flex mt-3">
                    @can('zone-edit')
                        <a href="{{ route('admin.zones.edit',$zone->id) }}" class="btn btn-info o">@lang("auth.edit")</a>
                    @endcan
                    @can('zone-delete')
                        <form class="ml-5" action="{{route('admin.zones.destroy',$zone->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang("auth.delete")">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
@endsection

