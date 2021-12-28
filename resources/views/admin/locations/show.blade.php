@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center"> @lang("names.location") {{$location->name}}</h1>
    <a href="{{route('admin.locations.index')}}" class="btn btn-primary">@lang("names.manage-locations")</a>

@endsection
@section('content')

        <div class="row">
            <div class="col-md-8">
                <label>@lang("names.location-name")</label>
                <p><b>{{$location->name}}</b></p> <hr>
                <label>@lang("auth.state")</label>
                <p><b>{{$location->state->name}}</b></p> <hr>
                <label>@lang("names.area")</label>
                <p><b><a href="{{route('admin.areas.show',$location->area->id)}}">{{$location->area->name}}</a></b></p> <hr>
                <label> @lang("auth.street")</label>
                <p><b>{{$location->street}}</b></p> <hr>
                <label> @lang("auth.building")</label>
                <p><b>{{$location->building}}</b></p> <hr>
                <label> @lang("auth.floor")</label>
                <p><b>{{$location->name}}</b></p> <hr>
                <label> @lang("auth.apartment")</label>
                <p><b>{{$location->apartment}}</b></p> <hr>
                <label> @lang("auth.landmarks")</label>
                <p><b>{{$location->landmarks}}</b></p> <hr>
                <label> @lang("auth.latitude")</label>
                <p><b>{{$location->latitude}}</b></p> <hr>
                <label> @lang("auth.longitude")</label>
                <p><b>{{$location->longitude}}</b></p> <hr>


                <div class="d-flex ">
                    @can('role-edit')
                        <a href="{{ route('admin.locations.edit',$location->id) }}" class="btn btn-info o">@lang("auth.edit")</a>
                    @endcan
                    @can('role-delete')
                        <form class="ml-5" action="{{route('admin.locations.destroy',$location->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang("auth.delete")">
                        </form>
                    @endcan
                </div>


            </div>
        </div>

@endsection

