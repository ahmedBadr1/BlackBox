@extends('admin.layouts.admin')

@section('page-header')
    <h1 class="text-center">@lang('auth.area') {{$area->name}}</h1>
    <a href="{{route('admin.areas.index')}}" class="btn btn-primary">@lang('names.manage-areas')</a>
@endsection

@section('content')
        <div class="row ">
            <div class="col-md-8">
                <label>@lang('auth.area-name')</label>
                <p><b>{{$area->name}}</b></p> <hr>
                <label>@lang('auth.delivery-cost') </label>
                <p><b>{{$area->delivery_cost}}</b></p> <hr>
                <label>@lang('auth.return-cost')</label>
                <p><b>{{$area->return_cost}}</b></p> <hr>
                <label>@lang('auth.replacement-cost')</label>
                <p><b>{{$area->replacement_cost}}</b></p> <hr>
                <label>@lang('auth.over-weight-cost')</label>
                <p><b>{{$area->over_weight_cost}}</b></p> <hr>
                <label>@lang('auth.delivery-time')</label>
                <p><b>{{$area->delivery_time}}</b></p> <hr>
                <label>@lang('auth.zone')</label>
                <p><b><a href="{{route('admin.zones.show',$area->zone->id)}}">{{$area->zone->name}}</a></b></p> <hr>
                <label>@lang('auth.state')</label>
                <p><b>{{$area->state->name}}</b></p> <hr>

                <div class="d-flex ">
                    @can('role-edit')
                        <a href="{{ route('admin.areas.edit',$area->id) }}" class="btn btn-info">@lang('auth.edit')</a>
                    @endcan
                    @can('role-delete')
                        <form class="ml-5" action="{{route('admin.areas.destroy',$area->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang('auth.delete')">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

