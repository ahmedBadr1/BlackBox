@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.areas.index')}}" class="btn btn-outline-danger">Manage Areas</a>
                <h1 class="text-center">Show Area {{$area->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>Area ID</label>
                <p><b>{{$area->id}}</b></p> <hr>
                <label>Area Name</label>
                <p><b>{{$area->name}}</b></p> <hr>
                <label>Area delivery_cost</label>
                <p><b>{{$area->delivery_cost}}</b></p> <hr>
                <label>Area return_cost</label>
                <p><b>{{$area->return_cost}}</b></p> <hr>
                <label>Area replacement_cost</label>
                <p><b>{{$area->replacement_cost}}</b></p> <hr>
                <label>Area over_weight_cost</label>
                <p><b>{{$area->over_weight_cost}}</b></p> <hr>
                <label>Area delivery_time</label>
                <p><b>{{$area->delivery_time}}</b></p> <hr>
                <label>Area Zone</label>
                <p><b><a href="{{route('admin.zones.show',$area->zone->id)}}">{{$area->zone->name}}</a></b></p> <hr>
                <label>Area State</label>
                <p><b>{{$area->state->name}}</b></p> <hr>

                <div class="d-flex ">
                    @can('role-edit')
                        <a href="{{ route('admin.areas.edit',$area->id) }}" class="btn btn-info">edit</a>
                    @endcan
                    @can('role-delete')
                        <form class="ml-5" action="{{route('admin.areas.destroy',$area->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="delete">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

