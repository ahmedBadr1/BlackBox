@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.locations.index')}}">{{__("names.manage")}} {{__("names.locations")}}</a>
                <h1 class="text-center"> {{__("names.location")}} {{$location->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.location")}} {{__("auth.name")}}</label>
                <p><b>{{$location->name}}</b></p> <hr>
                <label>{{__("names.location")}} {{__("auth.state")}}</label>
                <p><b>{{$location->state->name}}</b></p> <hr>
                <label>{{__("names.location")}} {{__("auth.state")}}</label>
                <p><b><a href="{{route('admin.areas.show',$location->area->id)}}">{{$location->area->name}}</a></b></p> <hr>
                <label>{{__("names.location")}} {{__("auth.street")}}</label>
                <p><b>{{$location->street}}</b></p> <hr>
                <label>{{__("names.location")}} {{__("auth.building")}}</label>
                <p><b>{{$location->building}}</b></p> <hr>
                <label>{{__("names.location")}} {{__("auth.floor")}}</label>
                <p><b>{{$location->name}}</b></p> <hr>
                <label>{{__("names.location")}} {{__("auth.apartment")}}</label>
                <p><b>{{$location->apartment}}</b></p> <hr>
                <label>{{__("names.location")}} {{__("auth.landmarks")}}</label>
                <p><b>{{$location->landmarks}}</b></p> <hr>
                <label>{{__("names.location")}} {{__("auth.latitude")}}</label>
                <p><b>{{$location->latitude}}</b></p> <hr>
                <label>{{__("names.location")}} {{__("auth.longitude")}}</label>
                <p><b>{{$location->longitude}}</b></p> <hr>


                <div class="d-flex ">
                    @can('role-edit')
                        <a href="{{ route('admin.locations.edit',$location->id) }}" class="btn btn-info o">{{__("auth.edit")}}</a>
                    @endcan
                    @can('role-delete')
                        <form class="ml-5" action="{{route('admin.locations.destroy',$location->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="{{__("auth.delete")}}">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

