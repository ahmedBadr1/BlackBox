@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('areas.index')}}" class="btn btn-outline-danger">Manage Areas</a>
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
                <label>Area Price</label>
                <p><b>{{$area->price}}</b></p> <hr>
                <label>Area Zone</label>
                <p><b>{{$area->zone}}</b></p> <hr>
                <label>Area State</label>
                <p><b>{{$area->state}}</b></p> <hr>

                <div class="d-flex ">
                    @can('role-edit')
                        <a href="{{ route('areas.edit',$area->id) }}" class="btn btn-info">edit</a>
                    @endcan
                    @can('role-delete')
                        <form class="ml-5" action="{{route('areas.destroy',$area->id) }}" method="POST">
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

